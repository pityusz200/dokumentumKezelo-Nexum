<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use File;

class Jogosultsagok{
    public $jogosultsagFelT;
    public $jogosultsagLetT;
}

class alkategoriakController extends Controller
{
    public function index($foKategoria){
            $fokategoriaNeve = DB::table('fokategoriak_table')->where('id',$foKategoria)->get();
            $fokategoriaNeve = $fokategoriaNeve[0]->nev;
        
            //Jogosultság
            $jogosultsagok = new Jogosultsagok;
            $jogosultsagok->jogosultsagFelT = 0;
            $jogosultsagok->jogosultsagLetT = 0;

            if(Auth::check()){
                $jog = DB::table('users')->where('email', Auth::user()->email)->get();
                $jogosultsagok->jogosultsagFelT = $jog[0]->jogosultsagFelT;
                $jogosultsagok->jogosultsagLetT = $jog[0]->jogosultsagLetT;
            }

            require_once('alKBetolto.php');

            return view('alkategoriaOldal/index', compact('hozzaTartozoAlkategoriaNevek','fokategoriaNeve', 'foKategoria', 'jogosultsagok'));
    }

    public function fajlFeltolto(Request $request){
        $nev = $request->input('nev');
        $fajl = $request->file('file');
        $foKategoria = $request->input('foKategoria');
        $alKategoria = $request->input('alKategoria');
        $fokategoriaNeve = DB::table('fokategoriak_table')->where('id',$foKategoria)->get();
        $fokategoriaNeve = $fokategoriaNeve[0]->nev;
    
        //Jogosultság
        $jogosultsagok = new Jogosultsagok;
        $jogosultsagok->jogosultsagFelT = 0;
        $jogosultsagok->jogosultsagLetT = 0;

        if(Auth::check()){
            $jog = DB::table('users')->where('email', Auth::user()->email)->get();
            $jogosultsagok->jogosultsagFelT = $jog[0]->jogosultsagFelT;
            $jogosultsagok->jogosultsagLetT = $jog[0]->jogosultsagLetT;
        }

        //Validálás
        if(!isset($nev)){
            return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('error', 'Sikertelen művelet! Nem adott meg nevet! Fájl feltöltés sikertelen');
        }

        if($jogosultsagok->jogosultsagFelT == 0){
            return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('error', 'Sikertelen művelet! Nincs hozzá jogosultsága!');
        }
        
        if($fajl){
            $fajlNev = $fajl->getClientOriginalName();
            $alKNev = DB::table('alkategoria_table')->select('alkategoria_table')->select('nev')->where('id',$alKategoria)->get();
            $fajl->move(public_path('fajlok/'.$fokategoriaNeve.'/'.$alKNev[0]->nev), $fajlNev);

            if((strcmp(substr($fajlNev, -3), "txt") !== 0) &&
               (strcmp(substr($fajlNev, -3), "doc") !== 0) &&
               (strcmp(substr($fajlNev, -3), "pdf") !== 0) &&
               (strcmp(substr($fajlNev, -4), "docx") !== 0)){
                return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('error', 'Sikertelen művelet! Ez nem docx, doc, txt vagy pdf formátumú fájl!');
            }

            //Verzio meghatározása
            
            $fajlokEzzelAzEredetiNevvel = array();

            $verziok = DB::table('fajlok_table')->where('eredeti_fajlnev', $fajlNev)->get();
            $alkategoriahozTartozoFilek = DB::table('alkfajlkapocs_table')->where('AlK_id', $alKategoria)->get();
            
            if(isset($verziok[0]->verzioszam)){
                for ($i=0; $i < count($verziok); $i++) { 
                    for ($j=0; $j < count($alkategoriahozTartozoFilek); $j++) {
                        if($verziok[$i]->id == $alkategoriahozTartozoFilek[$j]->Fajl_id){
                            $verzio = DB::table('fajlok_table')->where('id', $verziok[$i]->id)->get();
                        }
                    }
                }
            }

            $verzioSzam = 0;

            if(isset($verzio[0]->verzioszam)){
                //Adat feltöltés fajlok_table
                $verzioSzam = $verzio[0]->verzioszam + 1;

                DB::table('fajlok_table')->where('id', $verzio[0]->id)->update(
                    [
                        'nev' => $nev,
                        'eredeti_fajlnev' => $fajlNev,
                        'verzioszam' => $verzioSzam,
                        'feltoltes_idopontja' => date("Y-m-d H:i:s"),
                        'feltolto_felhasznalo' => Auth::user()->name,
                    ]
                );
            }else{
                //Adat feltöltés fajlok_table

                DB::table('fajlok_table')->insert(
                    [
                        'nev' => $nev,
                        'eredeti_fajlnev' => $fajlNev,
                        'verzioszam' => $verzioSzam,
                        'feltoltes_idopontja' => date("Y-m-d H:i:s"),
                        'feltolto_felhasznalo' => Auth::user()->name,
                    ]
                );
                //Adat feltöltés alkfajlkapocs_table

                $Fajl_id = DB::table('fajlok_table')->select('id')->where('eredeti_fajlnev', $fajlNev)->get();

                DB::table('alkfajlkapocs_table')->insert(
                    [
                        'AlK_id' => $alKategoria,
                        'Fajl_id' => $Fajl_id[count($Fajl_id)-1]->id,
                    ]
                );
            }
        }else{
            return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('error', 'Sikertelen fájl feltöltés! Nincs megadva fájl!');
        }

        return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('uzenet', 'Fájl sikeresen feltöltve!');
    }

	public function ujAlKategoriaHozzadasa(Request $request){
        $nev = $request->input('nev');
        $foKategoria = $request->input('foKategoria');
        $fokategoriaNeve = DB::table('fokategoriak_table')->where('id',$foKategoria)->get();
        $fokategoriaNeve = $fokategoriaNeve[0]->nev;


        //Validálás
        if(!isset($nev)){
            return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('error', 'Sikertelen művelet! Nincs megadva új alkategória név!');;
        }

        if(!preg_match("/^[A-ZÁÉÍÓÖŐÚÜŰ][A-Za-zÁÉÍÓÖŐÚÜŰáéíóöőúüű\s\d_.,]+\d{1,}$/", $nev)){
            return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('error', 'Sikertelen művelet! Név nem megfelelő!');
        }

        require_once('alKBetolto.php');

        //Név ellenőrzése, hogy létezik-e még ilyen nevű
        for ($i=0; $i < count($hozzaTartozoAlkategoriaNevek); $i++) {
            if($hozzaTartozoAlkategoriaNevek[$i]->nev == $nev){
                return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('error', 'Sikertelen művelet! Név már létezik!');
            }
        }

        //Adatbázishoz való hozzá adás
        DB::table('alkategoria_table')->insert(
            [
                'nev' => $nev,
            ]
        );

        $AlK_id = DB::table('alkategoria_table')->orderbydesc('id')->select('id')->where('nev', $nev)->get();
        DB::table('fo-alkategoriakapocs_table')->insert(
            [
                'Fok_id' => intval($foKategoria),
                'AlK_id' => $AlK_id[0]->id,
            ]
        );

        //Mappa létrehozása
        $alKategoriaNev = DB::table('alkategoria_table')->where('id', $AlK_id[0]->id)->select('nev')->get();

        $path = public_path().'/'.'fajlok/'.$fokategoriaNeve.'/'.$alKategoriaNev[0]->nev;
        if(!file_exists($path)){
            File::makeDirectory($path);
        }

        return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('uzenet', 'Új kategória sikeresen hozzá adva!');
    }

	public function ujAlKategoriaHozzadasaTov($foKategoria){
        $fokategoriaNeve = DB::table('fokategoriak_table')->where('id',$foKategoria)->get();
        $fokategoriaNeve = $fokategoriaNeve[0]->nev;
        return view('alkategoriaOldal/ujAlKategoriaHozzadasa', compact('foKategoria', 'fokategoriaNeve'));
    }

    public function modals($foKategoria, $alKategoria){
        return view('alkategoriaOldal/modals/modals', compact('foKategoria', 'alKategoria'));
    }

    public function dokumentumokTable($foKategoria, $alKategoria){
        $alKategoriaNev = DB::table('alkategoria_table')->where('id',$alKategoria)->select('nev')->get();
        $alKategoriaNev = $alKategoriaNev[0]->nev;
        $fokategoriaNeve = DB::table('fokategoriak_table')->where('id',$foKategoria)->get();
        $fokategoriaNeve = $fokategoriaNeve[0]->nev;
        $fajlok = DB::table('fajlok_table')->get();

        //Jogosultság
        $jogosultsagok = new Jogosultsagok;
        $jogosultsagok->jogosultsagFelT = 0;
        $jogosultsagok->jogosultsagLetT = 0;

        if(Auth::check()){
            $jog = DB::table('users')->where('email', Auth::user()->email)->get();
            $jogosultsagok->jogosultsagFelT = $jog[0]->jogosultsagFelT;
            $jogosultsagok->jogosultsagLetT = $jog[0]->jogosultsagLetT;
        }

        $fajlok_id = DB::table('alkfajlkapocs_table')->where('AlK_id', $alKategoria)->select('Fajl_id')->get();
        $hozzaTartozoFileNevek = array(); 

        for ($i=0; $i < count($fajlok); $i++) {
            for ($j=0; $j < count($fajlok_id); $j++) {
                if($fajlok[$i]->id == $fajlok_id[$j]->Fajl_id){
                    array_push($hozzaTartozoFileNevek, $fajlok[$i]);
                }
            }
        }

        return view('alkategoriaOldal/modals/dokumentumokTable', compact('foKategoria', 'alKategoria','alKategoriaNev', 'fokategoriaNeve','hozzaTartozoFileNevek','jogosultsagok'));
    }

    public function deleteFileTov($foKategoria,$alKategoria, $fileId){
        $fajl_id = DB::table('alkfajlkapocs_table')->where('AlK_id', $alKategoria)->select('Fajl_id')->get();
        $fajlNev = DB::table('fajlok_table')->where('id', $fileId)->select('nev')->get();
        $fajlNev = $fajlNev[0]->nev;
        return view('alkategoriaOldal/modals/deleteFile', compact('foKategoria','alKategoria', 'fileId', 'fajlNev'));
    }

    public function deleteFile(Request $request){
        $foKategoria = $request->input('foKategoria');
        $alKategoria = $request->input('alKategoria');
        $fileId = $request->input('fileId');
        $alKategoriaNev = DB::table('alkategoria_table')->where('id', $alKategoria)->select('nev')->get();
        $fileName = DB::table('fajlok_table')->where('id', $fileId)->select('eredeti_fajlnev')->get();
        $fokategoriaNeve = DB::table('fokategoriak_table')->where('id',$foKategoria)->get();
        $fokategoriaNeve = $fokategoriaNeve[0]->nev;
        $path = public_path().'/'.'fajlok/'.$fokategoriaNeve.'/'.$alKategoriaNev[0]->nev.'/'.$fileName[0]->eredeti_fajlnev;


        //Fájl törlése
        if(file_exists($path)){
            unlink($path);
        }else{
            return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('error', 'Sikertelen művelet! Fájl nem található!');;
        }

        //Adatbázisból való törlés
        DB::table('fajlok_table')->where('id', $fileId)->delete();
        DB::table('alkfajlkapocs_table')->where('Fajl_id', $fileId)->delete();

        return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('uzenet', 'Fájl sikeresen törölve!');;
    }

    public function alKnevValtozatas(Request $request){
        $ujNev = $request->input('nev');
        $foKategoria = $request->input('foKategoria');
        $alKategoria = $request->input('alKategoria');
        $oldNev = DB::table('alkategoria_table')->where('id', $alKategoria)->select('nev')->get();
        $oldNev = $oldNev[0]->nev;
        $fokategoriaNeve = DB::table('fokategoriak_table')->where('id',$foKategoria)->get();
        $fokategoriaNeve = $fokategoriaNeve[0]->nev;

        //Validálás
        if(!isset($ujNev)){
            return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('error', 'Sikertelen művelet! Nincs megadva új alkategória név!');;
        }

        if(!preg_match("/^[A-ZÁÉÍÓÖŐÚÜŰ][A-Za-zÁÉÍÓÖŐÚÜŰáéíóöőúüű\s\d_.,]+\d{1,}$/", $ujNev)){
            return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('error', 'Sikertelen művelet! Név nem megfelelő!');
        }

        require_once('alKBetolto.php');

        for ($i=0; $i < count($hozzaTartozoAlkategoriaNevek); $i++) {
            if($hozzaTartozoAlkategoriaNevek[$i]->nev == $ujNev){
                return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('error', 'Sikertelen művelet! Név már létezik!');
            }
        }


        //Alkategoriához tartozó mappa átnevezése
        if(file_exists(public_path().'/'.'fajlok/'.$fokategoriaNeve.'/'.$oldNev)){
            rename(public_path().'/'.'fajlok/'.$fokategoriaNeve.'/'.$oldNev, public_path().'/'.'fajlok/'.$fokategoriaNeve.'/'.$ujNev);
        }else{
            return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('error', 'Sikertelen művelet! Hiba történt!');;
        }

        //Alkategoria adatbázisban való átnevezése
        DB::table('alkategoria_table')->where('id', $alKategoria)->update(
            [
                'nev' => $ujNev,
            ]
        );

        return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('uzenet', 'Alkategória neve megváltozott!');;
    }
    
    public function alKtorles(Request $request){
        $foKategoria = $request->input('foKategoria');
        $alKategoria = $request->input('alKategoria');
        
        $hozzaTartozoFilekIDs = DB::table('alkfajlkapocs_table')->where('AlK_id', $alKategoria)->select('Fajl_id')->get();
        $alKategoriaNev = DB::table('alkategoria_table')->where('id', $alKategoria)->select('nev')->get();
        $fokategoriaNeve = DB::table('fokategoriak_table')->where('id',$foKategoria)->get();
        $fokategoriaNeve = $fokategoriaNeve[0]->nev;
        $pathFiles = public_path().'/'.'fajlok/'.$fokategoriaNeve.'/'.$alKategoriaNev[0]->nev .'/*';
        $path = public_path().'/'.'fajlok/'.$fokategoriaNeve.'/'.$alKategoriaNev[0]->nev;

        //Fájl törlése a mappából
        if(file_exists($path)){
            foreach(glob($pathFiles) as $file){
                if(is_file($file)){
                    unlink($file);
                }
            }
            rmdir($path);
        }else{
            return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('error', 'Sikertelen művelet! Hiba történt!');;
        }

        //Fájlok törlése az adatbázisból
        for ($i=0; $i < count($hozzaTartozoFilekIDs); $i++) {
            DB::table('fajlok_table')->where('id', $hozzaTartozoFilekIDs[$i]->Fajl_id)->delete();
        }

        DB::table('alkfajlkapocs_table')->where('AlK_id', $alKategoria)->delete();
        DB::table('fo-alkategoriakapocs_table')->where('AlK_id', $alKategoria)->delete();
        DB::table('alkategoria_table')->where('id', $alKategoria)->delete();
        DB::table('alkfajlkapocs_table')->where('AlK_id', $alKategoria)->delete();

        return \Redirect::to("alkategoriaOldal/index/".$foKategoria)->with('uzenet', 'Alkategoria sikeresen törölve!');;
    }
}
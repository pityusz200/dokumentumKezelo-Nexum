<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class Jogosultsagok{
    public $jogosultsagFelT;
    public $jogosultsagLetT;
}

class foKategoriakController extends Controller
{
    public function index(){
        $foKategoriak = DB::table('fokategoriak_table')->get();

        //Jogosultság
        $jogosultsagok = new Jogosultsagok;
        $jogosultsagok->jogosultsagFelT = 0;
        $jogosultsagok->jogosultsagLetT = 0;
        if(Auth::check()){
            $jog = DB::table('users')->where('email', Auth::user()->email)->get();
            $jogosultsagok->jogosultsagFelT = $jog[0]->jogosultsagFelT;
            $jogosultsagok->jogosultsagLetT = $jog[0]->jogosultsagLetT;
        }

        return view('fooldal/index', compact('foKategoriak', 'jogosultsagok'));
	}

	public function ujFoKategoriaHozzadasa(Request $request){
        $nev = $request->input('nev');

        $foKategoriak = DB::table('fokategoriak_table')->get();

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
            return \Redirect::to("fooldal/index")->with('error', 'Sikertelen művelet! Nincs megadva kategoria név!');;
        }

        if(!preg_match("/[A-Z]\w{1,}\d/", $nev)){
            return \Redirect::to("fooldal/index")->with('error', 'Sikertelen művelet! Név nem megfelelő!');
        }

        $hozzaTartozokategoriaNevek = DB::table('fokategoriak_table')->select('nev')->get();

        for ($i=0; $i < count($hozzaTartozokategoriaNevek); $i++) {
            if($hozzaTartozokategoriaNevek[$i]->nev == $nev){
                return \Redirect::to("fooldal/index")->with('error', 'Sikertelen művelet! Név már létezik!');
            }
        }
        
        DB::table('fokategoriak_table')->insert(
            [
                'nev' => $nev,
            ]
        );

        return \Redirect::to("fooldal/index")->with('uzenet', 'Új fő kategoria sikeresen hozzá adva!');;
    }

	public function ujFoKategoriaHozzadasaTov(){
        return view('fooldal/ujFoKategoriaHozzadasa');
    }

    public function foKnevValtozatas(Request $request){
        $ujNev = $request->input('nev');
        $foKategoriak = DB::table('fokategoriak_table')->get();
        $foKategoriaID = $request->input('foKategoria');

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
        if(!isset($ujNev)){
            return \Redirect::to("fooldal/index")->with('error', 'Sikertelen művelet! Nincs megadva új fő kategoria név!');;
        }

        if(!preg_match("/[A-Z]\w{1,}\d/", $ujNev)){
            return \Redirect::to("fooldal/index")->with('error', 'Sikertelen művelet! Név nem megfelelő!');
        }

        $hozzaTartozokategoriaNevek = DB::table('fokategoriak_table')->select('nev')->get();

        for ($i=0; $i < count($hozzaTartozokategoriaNevek); $i++) {
            if($hozzaTartozokategoriaNevek[$i]->nev == $ujNev){
                return \Redirect::to("fooldal/index")->with('error', 'Sikertelen művelet! Név már létezik!');
            }
        }

        DB::table('fokategoriak_table')->where('id', $foKategoriaID)->update(
            [
                'nev' => $ujNev,
            ]
        );

        return \Redirect::to("fooldal/index")->with('uzenet', 'Főkategoria neve megváltozott!');;
    }

    public function foKtorles(Request $request){
        $foKategoria = $request->input('foKategoria');
        $foKategoriak = DB::table('fokategoriak_table')->get();
        $alKategoria = DB::table('fo-alkategoriakapocs_table')->where('Fok_id', $foKategoria)->select('AlK_id')->get();

        //Jogosultság
        $jogosultsagok = new Jogosultsagok;
        $jogosultsagok->jogosultsagFelT = 0;
        $jogosultsagok->jogosultsagLetT = 0;

        if(Auth::check()){
            $jog = DB::table('users')->where('email', Auth::user()->email)->get();
            $jogosultsagok->jogosultsagFelT = $jog[0]->jogosultsagFelT;
            $jogosultsagok->jogosultsagLetT = $jog[0]->jogosultsagLetT;
        }

        for ($i=0; $i < count($alKategoria); $i++) {    
            
            $hozzaTartozoFilek = array();

            $hozzaTartozoFilekIDs = DB::table('alkfajlkapocs_table')->where('AlK_id', $alKategoria[$i]->AlK_id)->get();
                        
            $alKategoriaNev = DB::table('alkategoria_table')->where('id', $alKategoria[$i]->AlK_id)->select('nev')->get();
            $pathFiles = public_path().'/'.'fajlok/'.$alKategoriaNev[0]->nev .'/*';
            $path = public_path().'/'.'fajlok/'.$alKategoriaNev[0]->nev;

            //Fájl törlése a mappából
                if(file_exists($path)){
                        foreach(glob($pathFiles) as $file){
                            if(is_file($file)){
                                unlink($file);
                            }
                        }
                    rmdir($path);
                }else{
                    return \Redirect::to("fooldal/index")->with('error', 'Sikertelen művelet! Fájl nem található!');;
                }

            //Fájlok törlése az adatbázisból
            for ($j=0; $j < count($hozzaTartozoFilekIDs); $j++) {
                DB::table('fajlok_table')->where('id', $hozzaTartozoFilekIDs[$j]->Fajl_id)->delete();
            }

            DB::table('alkfajlkapocs_table')->where('AlK_id', $alKategoria[$i]->AlK_id)->delete();
            DB::table('fo-alkategoriakapocs_table')->where('AlK_id', $alKategoria[$i]->AlK_id)->delete();
            DB::table('alkategoria_table')->where('id', $alKategoria[$i]->AlK_id)->delete();
            DB::table('alkfajlkapocs_table')->where('AlK_id', $alKategoria[$i]->AlK_id)->delete();
            
        }

        DB::table('fokategoriak_table')->where('id', $foKategoria)->delete();

        return \Redirect::to("fooldal/index")->with('uzenet', 'Fokategoria sikeresen törölve!');;
    }

    public function modals($foKategoria){
        return view('fooldal/modals/modals', compact('foKategoria'));
    }
}
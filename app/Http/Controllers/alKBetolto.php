<?php
$alKategoriakId = DB::table('fo-alkategoriakapocs_table')->select('AlK_id')->where('Fok_id',$foKategoria)->get();
$alKategoriak = DB::table('alkategoria_table')->get();
            $hozzaTartozoAlkategoriaNevek = array();

            for ($i=0; $i < count($alKategoriak); $i++) { 
                for ($j=0; $j < count($alKategoriakId); $j++) { 
                    if($alKategoriak[$i]->id == $alKategoriakId[$j]->AlK_id){
                        array_push($hozzaTartozoAlkategoriaNevek, $alKategoriak[$i]);
                    }
                }
            }
?>
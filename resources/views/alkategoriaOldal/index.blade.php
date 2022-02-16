@extends('layouts.main_alk')

@section('tartalom')

    <div class="callout large primary">
      <div class="melyikfokategoria"><h5><?php echo $fokategoriaNeve; ?></h5></div>
      <div class="row column text-center">
        <h1>Dokumentum Kezelő, Nexum</h1>
      </div>
      

      @for($i = 0; $i < count($hozzaTartozoAlkategoriaNevek);$i++)
        <div class="buttonsDiv">
          <button type="button" 
              class="btn btn-primary margoButton"
              onclick="getTable(this)"
              id="{{$hozzaTartozoAlkategoriaNevek[$i]->id}}" 
              name="{{$hozzaTartozoAlkategoriaNevek[$i]->nev}}">
              {{$hozzaTartozoAlkategoriaNevek[$i]->nev}}
            </button>

          @if(Auth::check())
            @if($jogosultsagok->jogosultsagFelT == 1)
              <button type="button" 
                  class="btn btn-primary margoButton_Pen"
                  data-bs-toggle="modal"
                  data-bs-target="#control"
                  onclick="getData(this)"
                  id="{{$hozzaTartozoAlkategoriaNevek[$i]->id}}" 
                  name="{{$hozzaTartozoAlkategoriaNevek[$i]->nev}}">
                  <img src="/ikonok/pen.png" alt="Módosítás" class="editPen">
              </button>
          </div>
        @endif
      @endif
      @endfor
    <div class="row clear">
      <div class="center">
        @if (Auth::check())
          @if ($jogosultsagok->jogosultsagFelT == 1)
            <a href="/alkategoriaOldal/ujAlKategoriaHozzadasa/{{$foKategoria}}"><button type="button" class="btn btn-primary margo">Új al kategória hozzáadása</button></a>
          @endif
        @endif
      </div>
    </div>
  </div>
</div>

  <div class="row columns">
    <div class="blog-post">
      <div id="dokTable"></div>
      <div id="deleteFile"></div>
    </div>
  </div>
  <div id="modals"></div>
@stop
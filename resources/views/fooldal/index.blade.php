@extends('layouts.main')

@section('tartalom')

    <div class="callout large primary">
      <div class="row column text-center">
        <h1>Dokumentum Kezelő, Nexum</h1>
      </div>
        
      @foreach ($foKategoriak as $fokategoria)
        <a href="/alkategoriaOldal/index/{{$fokategoria->id}}">
          <button type="button" class="btn btn-primary margoButton">
            {{$fokategoria->nev}}</button></a>

        @if(Auth::check())
            @if($jogosultsagok->jogosultsagFelT == 1)
              <button type="button" 
                  class="btn btn-primary margoButton_Pen"
                  data-bs-toggle="modal"
                  data-bs-target="#controlFooldal"
                  onclick="getData(this)"
                  id="{{$fokategoria->id}}" 
                  name="{{$fokategoria->nev}}">
                  <img src="/pen.png" alt="Módosítás" class="editPen">
              </button>
            @endif
          @endif
      @endforeach

      <div class="center">
        @if(Auth::check())
          @if($jogosultsagok->jogosultsagFelT == 1)
            <a href="/ujFoKategoriaHozzadasa"><button type="button" class="btn btn-primary margo">Új kategoria hozzáadása</button></a>
          @endif
        @endif
      </div>
    </div>
    <div id="modals"></div>
@stop
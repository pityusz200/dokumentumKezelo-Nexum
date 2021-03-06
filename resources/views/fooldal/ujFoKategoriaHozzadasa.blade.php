@extends('layouts.main')

@section('tartalom')

    <div class="callout large primary">
      <div class="row column text-center">
        <h1>Dokumentum Kezelő, Nexum</h1>
      </div>
	  <div class="row column text-center">
        <h5>Add meg a nevét és kattints a "Hozzáadás" gombra</h5>
  
        {!! Form::open([  'action' => 'foKategoriakController@ujFoKategoriaHozzadasa', 
        'enctype' => 'multipart/form-data' , 'method' => 'POST' ]) !!}
          
          {!! Form::label('nev', 'Név'); !!}
          {!! Form::text('nev', $value=null, $attributes=['placeholder'=>'Új fő kategoria neve', 'name'=>'nev', 'onkeyup'=>'getText(this)']) !!}

          <div class="nevLeiras">
            <p id="nBetu">A kategóriának nagybetűvel kell kezdődnie</p>
            <p id="min3kar">A névnek legalább 3 karakter hosszúságúnak kell lennie!</p>
            <p id="szamK">A névnek számmal kell végződnie!</p>
          </div>

          {!! Form::submit('Hozzáadás', $attributes=['class'=>'button'])!!}

        {!! Form::close() !!}
		</div>
@stop
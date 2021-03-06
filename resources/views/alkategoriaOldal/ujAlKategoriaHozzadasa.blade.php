@extends('layouts.main')

@section('tartalom')

   <div class="callout large primary">
    <div class="melyikfokategoria"><h5><?php echo $fokategoriaNeve; ?></h5></div>
      <div class="row column text-center">
        <h1>Dokument Kezelő, Nexum</h1>
      </div>
	  <div class="row column text-center">
        <h5>Add meg a nevét és kattints a "Hozzáadás" gombra</h5>
  
        {!! Form::open([  'action' => 'alkategoriakController@ujAlKategoriaHozzadasa', 
        'enctype' => 'multipart/form-data' , 'method' => 'POST' ]) !!}
          
          {!! Form::label('nev', 'Név'); !!}
          {!! Form::text('nev', $value=null, $attributes=['placeholder'=>'Új alkategoria neve', 'name'=>'nev', 'onkeyup'=>'getText(this)']) !!}
          
          {!! Form::hidden('foKategoria', $value= $foKategoria, $attributes=['name'=>'foKategoria', 'id'=>'foKategoria']) !!}

          <div class="nevLeiras">
            <p id="nBetu">A kategóriának nagybetűvel kell kezdődnie</p>
            <p id="min3kar">A névnek legalább 3 karakter hosszúságúnak kell lennie!</p>
            <p id="szamK">A névnek számmal kell végződnie!</p>
          </div>

          {!! Form::submit('Hozzáadás', $attributes=['class'=>'button'])!!}

        {!! Form::close() !!}
		</div>
  </div>
@stop
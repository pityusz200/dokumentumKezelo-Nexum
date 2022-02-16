<div class="modal fade" id="control" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

          <div class="margoModal">
            <!-- Hozzáadás form-->
  
            {!! Form::open([  'action' => 'alkategoriakController@fajlFeltolto', 
            'enctype' => 'multipart/form-data' , 'method' => 'POST' ]) !!}
              
              <h5>Új dokumentum feltöltése:</h5>
  
              {!! Form::text('nev', $value=null, $attributes=['placeholder'=>'Dokumentum neve', 'name'=>'nev', 'onkeyup'=>'nevValidat(this)']) !!}
  
              {!! Form::file('file', $value=null, $attributes=['name'=>'file']) !!}
              
              {!! Form::hidden('foKategoria', $value= $foKategoria, $attributes=['name'=>'foKategoria', 'id'=>'foKategoria']) !!}
              {!! Form::hidden('alKategoria', $value= $alKategoria, $attributes=['name'=>'alKategoria', 'id'=>'alKategoria']) !!}
              
              {!! Form::submit('Hozzáadás', $attributes=['class'=>'button', 'id'=>'hozzaadas'])!!}
  
            {!! Form::close() !!}
          </div>

          <!-- Vége -->
          <!-- Modósítás form-->
  
          <div class="margoModal">
              {!! Form::open([  'action' => 'alkategoriakController@alKnevValtozatas', 
                'enctype' => 'multipart/form-data' , 'method' => 'POST' ]) !!}
                
                <h5>Kategória nevének módosítása:</h5>

                {!! Form::text('nev', $value=null, $attributes=['placeholder'=>'Kategória új neve', 'name'=>'nev','id'=>'nev']) !!}

                {!! Form::hidden('foKategoria', $value= $foKategoria, $attributes=['name'=>'foKategoria', 'id'=>'foKategoria']) !!}
                {!! Form::hidden('alKategoria', $value= $alKategoria, $attributes=['name'=>'alKategoria', 'id'=>'alKategoria']) !!}
  
                {!! Form::submit('Módosítás', $attributes=['class'=>'button'])!!}
  
              {!! Form::close() !!}
          </div>

          <div class="nevLeiras">
            <p>A kategóriának nagybetűvel kell kezdődnie</p>
            <p>A névnek legalább 3 karakter hosszúságúnak kell lennie!</p>
            <p>A névnek számmal kell végződnie!</p>
          </div>
  
            <!-- Vége -->
            <!-- Törlés form-->
  
          <div class="margoModal">
            {!! Form::open([  'action' => 'alkategoriakController@alKtorles', 
            'enctype' => 'multipart/form-data' , 'method' => 'POST' ]) !!}
  
              {!! Form::hidden('foKategoria', $value= $foKategoria, $attributes=['name'=>'foKategoria', 'id'=>'foKategoria']) !!}
              {!! Form::hidden('alKategoria', $value= $alKategoria, $attributes=['name'=>'alKategoria', 'id'=>'alKategoria']) !!}

              <div>
                <p>A kategória törléséhez kattintson a "Törlés" gombra.:</p>
                {!! Form::submit('Törlés', $attributes=['class'=>'btn btn-danger'])!!}
              </div>

            {!! Form::close() !!}
          </div>
  
          <!-- Vége -->

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezárás</button> 
        </div>
      </div>
    </div>
  </div>
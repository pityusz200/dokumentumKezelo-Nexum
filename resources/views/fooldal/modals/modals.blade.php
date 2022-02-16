<div class="modal fade" id="controlFooldal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <!-- Vége -->
          <!-- Modósítás form-->
  
          <div class="margoModal">
              {!! Form::open([  'action' => 'foKategoriakController@foKnevValtozatas', 
                'enctype' => 'multipart/form-data' , 'method' => 'POST' ]) !!}
                
                <h5>Kategória nevének módosítása:</h5>

                {!! Form::text('nev', $value=null, $attributes=['placeholder'=>'Kategória új neve', 'name'=>'nev','id'=>'nev']) !!}

                {!! Form::hidden('foKategoria', $value= $foKategoria, $attributes=['name'=>'foKategoria', 'id'=>'foKategoria']) !!}

                {!! Form::submit('Módosítás', $attributes=['class'=>'button'])!!}
  
              {!! Form::close() !!}
          </div>
  
            <!-- Vége -->
            <!-- Törlés form-->
  
          <div class="margoModal">
            {!! Form::open([  'action' => 'foKategoriakController@foKtorles', 
            'enctype' => 'multipart/form-data' , 'method' => 'POST' ]) !!}
  
              {!! Form::hidden('foKategoria', $value= $foKategoria, $attributes=['name'=>'foKategoria', 'id'=>'foKategoria']) !!}
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
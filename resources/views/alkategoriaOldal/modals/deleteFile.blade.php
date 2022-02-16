<div class="modal fade" id="deletFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

        <div class="margoModal">

          {!! Form::open([  'action' => 'alkategoriakController@deleteFile', 
          'enctype' => 'multipart/form-data' , 'method' => 'POST' ]) !!}
            
            <h5>Bíztos szeretné törölni ezt a fájlt?: {{$fajlNev}}</h5>
              <div class="center">
                  {!! Form::submit('Fájl törlése', $attributes=['class'=>'btn btn-danger'])!!}
              </div>

              {!! Form::hidden('foKategoria', $value= $foKategoria, $attributes=['name'=>'foKategoria', 'id'=>'foKategoria']) !!}
              {!! Form::hidden('alKategoria', $value= $alKategoria, $attributes=['name'=>'alKategoria', 'id'=>'alKategoria']) !!}
              {!! Form::hidden('fileId', $value= $fileId, $attributes=['name'=>'fileId', 'id'=>'fileId']) !!}

          {!! Form::close() !!}
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezárás</button> 
      </div>
    </div>
  </div>
</div>
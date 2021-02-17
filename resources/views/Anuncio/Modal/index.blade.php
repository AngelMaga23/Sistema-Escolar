<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <form id="form_files">
                @csrf
                <input type="hidden" name="idpublic" id="idpublic" value="{{ $id }}">
                <div class="form-group">
                    <label for="">Nombre del archivo</label>
                    <input type="text" name="nom_file" id="nom_file" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Archivo(s)</label>
                    <input type="file" name="archivos[]" class="form-control" multiple>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Guardar</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="table-responsive">
                <!-- Projects table -->
                <table id="files_table" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
    
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $('#form_files').on('submit',function(e){
    e.preventDefault();
    $.ajax({
      type:'post',
      url:'../../guardar_archivos',
      data:new FormData(this),
      contentType: false,
      cache: false,
      processData:false,			
      success:function(response)
      {
          if(response.message == 'ok')
          {
                // message_succesfully_Alumno();
                $('#files_table').DataTable().ajax.reload();

          }
          else{
            message_errorU(response.message);
          }
      }
    });
});
</script>
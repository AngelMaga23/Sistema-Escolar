<div class="col-md-12">
    <h5>Entrega</h5>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form id="form_entrega_edit" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="identrega" value="{{ $entrega[0]->id }}">
                <div class="form-group">
                    <label for="">Nombre de la entrega</label>
                    <input type="text" name="nom_entrega" class="form-control" value="{{ $entrega[0]->nombre }}">
                </div>
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea name="entrega_descripcion" id="entrega_descripcion" cols="30" rows="5" class="form-control">{{ $entrega[0]->descripcion }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label" for="customFile">Subir archivo</label>
                    <input type="file" class="form-control" name="fileEntrega" id="customFile" />
                </div>

                <br>
                <button class="btn btn-primary" type="submit">Reenviar</button>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<script>
    $('#form_entrega_edit').on('submit',function(e){
        e.preventDefault();
        $.ajax({
        type:'post',
        url:'../../send_reenvio',
        data:new FormData(this),
        contentType: false,
        cache: false,
        processData:false,			
        success:function(response)
        {
            if(response.message == 'ok')
            {
                    message_succesfully_SendTarea();
                    Tarea_Options();

            }
            else{
                message_errorU(response.message);
            }
        }
        });
    });
</script>
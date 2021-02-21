<div class="row">
    @if (!$entrega->isEmpty())
        <div class="col-md-12">
            <h5>Entrega</h5>
            <div class="card card-header-actions mx-auto">
                <div class="card-header">
                    Tarea: {{ $entrega[0]->nombre }}
                    <div>
                        Calificación: {{ $entrega[0]->calificacion."/"."10" }}
                    </div>
                    @if ($entrega[0]->archivo != null)
                        <div>
                            <a href="{{ asset('Archivos/'.$entrega[0]->archivo) }}" class="card-link">Descargar <i class="fas fa-file-download"></i></a>
                        </div>
                    @endif

                    <div style="text-align: right;">
                        <button class="btn btn-datatable btn-icon btn-transparent-dark" onclick="Delete_entrega({{ $entrega[0]->id }})">Eliminar <i class="far fa-trash-alt"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    {{ $entrega[0]->descripcion }}
                    
                </div>
                <div class="card-footer">
                    @php
                        $coments = DB::table('')
                    @endphp
                    Comentarios
                </div>
            </div>
        </div>
    @else
        <div class="col-md-12">
            <h5>Entrega</h5>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <form id="form_entrega" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="idtarea" value="{{ $idtarea }}">
                        <div class="form-group">
                            <label for="">Nombre de la entrega</label>
                            <input type="text" name="nom_entrega" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Descripción</label>
                            <textarea name="entrega_descripcion" id="entrega_descripcion" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="customFile">Subir archivo</label>
                            <input type="file" class="form-control" name="fileEntrega" id="customFile" />
                        </div>

                        <br>
                        <button class="btn btn-primary" type="submit">Entregar</button>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    @endif

</div>

<script>
    $('#form_entrega').on('submit',function(e){
        e.preventDefault();
        $.ajax({
        type:'post',
        url:'../../send_tarea',
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
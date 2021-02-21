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
                        $coments = DB::table('coment_entregas as c')
                                    ->select(DB::raw('c.id,c.mensaje,c.created_at,m.primer_nom,m.segundo_nom,m.apellido_p,m.apellido_m'))
                                    ->join('maestros as m','c.idmaestro','=','m.id')
                                    ->where('c.identrega',$entrega[0]->id)
                                    ->get();
                    @endphp
                    Comentarios
                    <div class="row">
                        @if (!$coments->isEmpty())
                            @foreach ($coments as $c)
                                <div class="col-md-12">
                                    <div class="container mt-5" style="margin-top: 0px !important;">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-md-12">
                                                <div class="card p-3 mt-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="user d-flex flex-row align-items-center"> <span><small class="font-weight-bold text-primary">{{ " ".$c->primer_nom." ".$c->segundo_nom." ".$c->apellido_p." ".$c->apellido_m }}</small> <small class="font-weight-bold">{{ $c->mensaje }}</small></span> </div> <small>{{ $c->created_at }}</small>
                                                    </div>
                                                    <div class="action d-flex justify-content-between mt-2 align-items-center">
                                                        <div class="reply px-4"> </div>
                                                        <div class="icons align-items-center"> <i class="fa fa-check-circle-o check-icon text-primary"></i> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>     
                            @endforeach
                        @else
                            <div class="col-md-12">
                                No hay comentarios
                            </div>
                        @endif


                    </div>
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
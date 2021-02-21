<style>
    body {
    background-color: #f7f6f6
}

.card {
    border: none;
    box-shadow: 5px 6px 6px 2px #e9ecef;
    border-radius: 4px
}

.dots {
    height: 4px;
    width: 4px;
    margin-bottom: 2px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block
}

.badge {
    padding: 7px;
    padding-right: 9px;
    padding-left: 16px;
    box-shadow: 5px 6px 6px 2px #e9ecef
}

.user-img {
    margin-top: 4px
}

.check-icon {
    font-size: 17px;
    color: #c3bfbf;
    top: 1px;
    position: relative;
    margin-left: 3px
}

.form-check-input {
    margin-top: 6px;
    margin-left: -24px !important;
    cursor: pointer
}

.form-check-input:focus {
    box-shadow: none
}

.icons i {
    margin-left: 8px
}

.reply {
    margin-left: 12px
}

.reply small {
    color: #b7b4b4
}

.reply small:hover {
    color: green;
    cursor: pointer
}
</style>

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0"><small>Alumno: {{ $tarea[0]->primer_nom." ".$tarea[0]->segundo_nom." ".$tarea[0]->apellido_p." ".$tarea[0]->apellido_m }}</small></h5>
            </div>
        </div>
    </div>
    <div class="card-body">
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
                    Comentarios:
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
                                                        <div class="reply px-4"> <small onclick="Del_coment_Tarea({{ $c->id }})">Eliminar</small> </div>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <input type="hidden" id="identrega" value="{{ $entrega[0]->id }}">
                                <textarea name="coment_profesor" id="coment_profesor" cols="30" rows="3" class="form-control"></textarea>
                                <br>
                                <button class="btn btn-primary" onclick="Add_Coment_Tarea()">Agregar comentario</button>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
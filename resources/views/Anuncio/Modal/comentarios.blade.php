@php
    $coments_public = DB::table('coments_publics as c')
                        ->select(DB::raw('c.comentario,c.created_at,a.primer_nom,a.segundo_nom,a.apellido_p,a.apellido_m'))
                        ->join('alumno_clase as ac','c.idalumno_clase','=','ac.id')
                        ->join('alumnos as a','ac.idalumno','=','a.id')
                        ->where('c.idpublicacion',$id)
                        ->get();
@endphp

@if (!$coments_public->isEmpty())
    @foreach ($coments_public as $c)
        <div class="col-md-12">
            <div class="container mt-5" style="margin-top: 0px !important;">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="card p-3 mt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="user d-flex flex-row align-items-center"> <span><small class="font-weight-bold text-primary">{{ " ".$c->primer_nom." ".$c->segundo_nom." ".$c->apellido_p." ".$c->apellido_m }}</small> <small class="font-weight-bold">{{ $c->comentario }}</small></span> </div> <small>{{ $c->created_at }}</small>
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

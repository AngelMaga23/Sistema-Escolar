@extends('layouts.panel')

@section('content')
@php
    $archivos = DB::table('archivos')->where('idpublicacion',$publicacion[0]->id)->get();
@endphp

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center d-flex justify-content-end">
            <a href="{{ url('/alumno-publicacion/'.$publicacion[0]->idclase_asig) }}" class="btn btn-sm btn-success">
                Regresar
            </a>
        </div>
        <div class="row align-items-center d-flex justify-content-center">
            <h3 class="mb-0">{{ $publicacion[0]->nombre }}</h3>
        </div>
        <div class="row align-items-center d-flex justify-content-center">
            <small>Maestr@: {{ $publicacion[0]->primer_nom." ".$publicacion[0]->segundo_nom." ".$publicacion[0]->apellido_p." ".$publicacion[0]->apellido_m }}</small>
        </div>
        <div class="row align-items-center d-flex justify-content-center">
            <small>Asignatura: {{ $publicacion[0]->asignatura }}</small>
        </div>
        <div class="row align-items-center d-flex justify-content-center">
            <small>Fecha de publicación: {{ $publicacion[0]->created_at }}</small>
        </div>
    </div>

    <div class="card-body">
        <input type="hidden" id="idpublic" value="{{ $publicacion[0]->id }}">
        <div class="row">
            <div class="col-md-12">
                {!!html_entity_decode($publicacion[0]->descripcion)!!}
            </div>
        </div>

        @if (!$archivos->isEmpty())
            <div class="row">
                <div class="col-md-12">
                    <h5><small>Archivos</small></h5>
                    <div class="row">
                        @foreach ($archivos as $a)
                            <div class="col-md-2">
                                <div class="card border-left-dark shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">{{ $a->nombre }}</div>
                                            </div>
                                            @if ($a->archivo != null)
                                                <div class="col-auto">
                                                    <a href="{{ asset('Archivos/'.$a->archivo) }}"><i class="fas fa-file-download"></i></a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif


    </div>
    <div class="card-footer">
        <h5>Comentarios</h5>
        <div class="row">
            <div class="col-md-12">
                <div id="coments_publics"></div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-12">
                <textarea name="comentario" id="comentario" cols="30" rows="5" class="form-control"></textarea>
                <br>
                <button class="btn btn-primary" onclick="Comentar()">Comentar</button>
            </div>
        </div>
    </div>

</div>
@endsection



@section('custom_script')
    <script src="{{ asset('js/Estudiante/publicacion_option.js') }}"></script>

@endsection


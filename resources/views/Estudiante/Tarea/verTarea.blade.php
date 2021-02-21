@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center d-flex justify-content-end">
            <a href="{{ url('/alumno-tarea/'.$tarea[0]->idclase_asig) }}" class="btn btn-sm btn-success">
                Regresar
            </a>
        </div>
        <input type="hidden" name="idtarea" id="idtarea" value="{{ $tarea[0]->id }}">
        <div class="row align-items-center d-flex justify-content-center">
            <h3 class="mb-0">{{ $tarea[0]->nombre }}</h3>
        </div>
        <div class="row align-items-center d-flex justify-content-center">
            <small>Maestr@: {{ $tarea[0]->primer_nom." ".$tarea[0]->segundo_nom." ".$tarea[0]->apellido_p." ".$tarea[0]->apellido_m }}</small>
        </div>
        <div class="row align-items-center d-flex justify-content-center">
            <small>Asignatura: {{ $tarea[0]->asignatura }}</small>
        </div>
        <div class="row align-items-center d-flex justify-content-center">
            <small> {{ "Fecha de inicio: ".$tarea[0]->fecha_ini." - "."Fecha final: ".$tarea[0]->fecha_fin }}</small>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                {!!html_entity_decode($tarea[0]->descripcion)!!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @if ($tarea[0]->archivo != null)
                        <div class="col-md-12">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                <h5 class="card-title">Archivo</h5>
                                <h6 class="card-subtitle mb-2 text-muted"></h6>
                                <p class="card-text">{{ $tarea[0]->archivo }}</p>
                                <a href="{{ asset('Archivos/'.$tarea[0]->archivo) }}" class="card-link">Descargar</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div id="id_footer_tarea"></div>

    </div>

</div>
@endsection



@section('custom_script')
    <script src="{{ asset('js/Estudiante/Tarea_option.js') }}"></script>

@endsection


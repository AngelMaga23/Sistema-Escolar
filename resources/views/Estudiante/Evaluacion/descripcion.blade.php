@php
    $id = Auth::id();
    $alumno = DB::table('alumnos')->where('iduser',$id)->get();
    $alumno_clase = DB::table('alumno_clase')->where('idalumno',$alumno[0]->id)->get();

    $exam_alumno = DB::table('examen_alumno')
                    ->where('idexamen',$examen[0]->id)
                    ->where('idalumnoclase',$alumno_clase[0]->id)
                    ->get();
@endphp

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Examen</h3>
            </div>
            <div class="col text-right">

            </div>
        </div>
    </div>
    {{-- <input type="hidden" id="idclase" value="{{ $idclase }}"> --}}
    <div class="card-body">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $examen[0]->nombre }} </h6>
                <h6 class="m-0 font-weight-bold text-primary"><small>Fecha inicio: {{ $examen[0]->fecha_ini }} - Fecha final: {{ $examen[0]->fecha_fin }}</small></h6>
                <h6 class="m-0 font-weight-bold text-primary"><small>Duración: {{ $examen[0]->duracion }} minutos</small></h6>
                <h6 class="m-0 font-weight-bold text-primary"><small>Preguntas: {{ $preguntas_count }}</small></h6>
            </div>
            <div class="card-body">
                {!!html_entity_decode($examen[0]->descripcion)!!}
            </div>
            <div class="card-footer">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <a href="{{ url('alumno-evaluacion/'.$examen[0]->idclase_asig) }}" class="btn btn-danger">Regresar</a>
                            &nbsp
                            @if(!$exam_alumno->isEmpty())
                                @if ($exam_alumno[0]->estatu)
                                    <button class="btn btn-warning" onclick="continue_test()">Continuar</button>
                                @else
                                    <a href="{{ url('ver-resultado/'.$exam_alumno[0]->id) }}" class="btn btn-info">Calificación</a>
                                @endif
                            @else
                                <button class="btn btn-primary" onclick="Password_Test()">Comenzar</button>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


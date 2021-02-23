@php

    $exam_alumno = DB::table('examen_alumno')
                    ->where('id',$id_examen_alumno)
                    ->get();

    $examen = DB::table('examens')->where('id',$exam_alumno[0]->idexamen)->get();
@endphp



@extends('layouts.panel')

@section('content')
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
                <h6 class="m-0 font-weight-bold text-primary"><small>Puntos Obtenidos: {{ $exam_alumno[0]->puntos }}</small></h6>
      
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
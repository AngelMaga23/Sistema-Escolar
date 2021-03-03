@extends('layouts.panel')

@section('content')
<style>
    body {
        background-color: #eee
    }
    
    label.radio {
        cursor: pointer
    }
    
    label.radio input {
        position: absolute;
        top: 0;
        left: 0;
        visibility: hidden;
        pointer-events: none
    }
    
    label.radio span {
        padding: 4px 0px;
        border: 1px solid red;
        display: inline-block;
        color: red;
        width: 100px;
        text-align: center;
        border-radius: 3px;
        margin-top: 7px;
        text-transform: uppercase
    }
    
    label.radio input:checked+span {
        border-color: red;
        background-color: red;
        color: #fff
    }
    
    .ans {
        margin-left: 36px !important
    }
    
    .btn:focus {
        outline: 0 !important;
        box-shadow: none !important
    }
    
    .btn:active {
        outline: 0 !important;
        box-shadow: none !important
    }    
    </style>
    
    @php
        $exam_alumno = DB::table('examen_alumno')->where('id',$alumno_clase)->get();
        $examen = DB::table('examens')->where('id',$exam_alumno[0]->idexamen)->get();
        $preguntas = DB::table('preguntas')->where('idexamen',$examen[0]->id)->get();
    @endphp
    
    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10 col-lg-10">
                <div class="border">
                    <div class="question bg-white p-3 border-bottom">
                        <div class="d-flex flex-row justify-content-between align-items-center mcq">
                            <h4>{{ $examen[0]->nombre }}</h4>
                            <span id="timervalue"></span><span>{{ $exam_alumno[0]->restante }} minutos</span>
                            <input type="hidden" id="getTime" value="{{ $exam_alumno[0]->restante }}">
                            <input type="hidden" id="alumnoclase" value="{{ $alumno_clase }}">
                        </div>
                    </div>
    
                    @php
                        $i = 0;
                    @endphp
    
                    <input type="hidden" name="alumnoclase" value="{{ $alumno_clase }}">
                    @foreach ($preguntas as $p)
                    <div class="question bg-white p-3 border-bottom">
                        <div class="d-flex flex-row align-items-center question-title">
                            <h3 class="text-danger">{{ ($i = $i + 1).". " }}</h3>
                            <h5 class="mt-1 ml-2">{{ $p->pregunta }}</h5>
                            <input type="hidden" name="idanswers[]" value="{{ $p->id }}">
                        </div>
                        @php
                            $respuestas = DB::table('respuestas')->where('idpregunta',$p->id)->get();
                        @endphp
                        @if (!$respuestas->isEmpty())
                            @foreach ($respuestas as $r)
                                @php
                                    $estatu_answers = '';
                                    $res_correct = '';
                                    $ans_alumno = DB::table('alumno_respuesta')->where('idalumnoclase',$alumno_clase)->where('idpregunta',$p->id)->get();
                                    if($r->estatu == 1)
                                    {
                                            $res_correct = 'border: 5px solid #a0ff70;color: #49bf0c;';
                                    }
                                    
                                    if(!$ans_alumno->isEmpty())
                                    {
                                        if($ans_alumno[0]->idrespuesta == $r->id)
                                        {
                                            $estatu_answers = 'checked';
                                        }
                                    }

                                @endphp
                                <div class="ans ml-2">
                                    <label class="radio"> 
                                        <input type="radio" name="question{{ $p->id }}" value="{{ $r->id }}" {{$estatu_answers}} disabled> <span style="{{ $res_correct }}">{{ $r->respuesta}}</span>
                                    </label>
                                </div>    
                            @endforeach
                        @else
                            
                        @endif
                        <br>
                        
                    </div>
                    <br>
                    @endforeach
                    <div class="d-flex flex-row justify-content-end align-items-center p-3 bg-white">
                        <a class="btn btn-primary border-success align-items-center btn-success" href="{{ url('alumno-evaluacion/'.$examen[0]->idclase_asig) }}">Finalizar</a>
                    </div>
    
    
                    
                </div>
                
            </div>
        </div>
    </div>
    
@endsection
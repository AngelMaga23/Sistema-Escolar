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

                <form id="form_examen_start" action="{{ url('../end_test') }}" method="POST">
                    @csrf
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
                                $ans_alumno = DB::table('alumno_respuesta')->where('idalumnoclase',$alumno_clase)->where('idpregunta',$p->id)->get();

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
                                        <input type="radio" name="question{{ $p->id }}" value="{{ $r->id }}" onclick="Select_Answer({{ $p->id }},{{ $r->id }})" {{$estatu_answers}} required> <span>{{ $r->respuesta}}</span>
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
                        <button class="btn btn-primary border-success align-items-center btn-success" type="submit">Finalizar</button>
                    </div>
                </form>


                
            </div>
            
        </div>
    </div>
</div>



<script>

function Select_Answer(idpregunta,idrespuesta)
{
    var alumnoclase = document.getElementById('alumnoclase').value;
    // console.log(idpregunta,idrespuesta);
    $.ajax({
        url: '../select_answer',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "id":alumnoclase,
            "idpregunta":idpregunta,
            "idrespuesta":idrespuesta
        },

        success:function(response)
        {
            
        },
    });
}

function Updated_Time_Test(time)
{
    var alumnoclase = document.getElementById('alumnoclase').value;
    $.ajax({
        url: '../update_time_test',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "id":alumnoclase,
            "time":time
        },

        success:function(response)
        {
            
        },
    });
    return false;
}

var time = document.getElementById('getTime').value;
const myForm = document.getElementById("form_examen_start");
var minute = (60 * time); 
var timer = new Timer();
timer.start({precision: 'seconds', startValues: {seconds: 0}, target: {seconds: minute}});

// $('#startValuesAndTargetExample .values').html(timer.getTimeValues().toString());

timer.addEventListener('secondsUpdated', function (e) {
    $('#timervalue').html(timer.getTimeValues().toString(['minutes', 'seconds']));
    var time__ = time - timer.getTimeValues().toString(['minutes']);
    Updated_Time_Test(time__);
});

timer.addEventListener('targetAchieved', function (e) {
    console.log('listo');
    myForm.submit();
});
</script>
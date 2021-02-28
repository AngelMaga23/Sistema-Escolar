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
                {{-- <h6 class="m-0 font-weight-bold text-primary"><small>Preguntas: {{ $preguntas_count }}</small></h6> --}}
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="pass_test">Contraseña</label>
                    <input type="text" name="pass_test" id="pass_test" class="form-control">
                </div>
            </div>
            <div class="card-footer">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <button class="btn btn-primary" onclick="start_test()">Comenzar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


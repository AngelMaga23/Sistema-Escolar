@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar tarea</h3>
            </div>
            <div class="col text-right">
            <a href="{{ url('evaluacion/'.$evaluacion[0]->idclase_asig) }}" class="btn btn-sm btn-danger">
                    Cancelar y volver
            </a>
            </div>
        </div>
    </div>
    <div class="card-body">

        @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
        @endif

        <form id="form_evaluacion_edit" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <input type="hidden" name="idclase" value="{{ $evaluacion[0]->idclase_asig }}">
                        <input type="hidden" name="ideval" value="{{ $evaluacion[0]->id }}">
                        <div class="form-group col-md-6">
                            <label for="nombre_eval">Nombre</label>
                            <input type="text" name="nombre_eval" id="nombre_eval" class="form-control" value="{{ $evaluacion[0]->nombre }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="estatu_eval">Estatu</label>
                            <select name="estatu_eval" id="estatu_eval" class="form-control">
                                <option value="">Seleccionar estado de la evaluación</option>
                                <option value="0" @if($evaluacion[0]->estatu == "0") {{ "selected" }} @endif>Inactivo</option>
                                <option value="1" @if($evaluacion[0]->estatu == "1") {{ "selected" }} @endif>Activo</option>
                            </select>
                        </div>   
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="edit-descripcion">Descripción</label>
                            <textarea name="descripcion" id="edit-descripcion" rows="10" cols="100">
                                {{ $evaluacion[0]->descripcion }}
                            </textarea>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fecha_ini">Fecha inicio</label>
                            <input type="datetime-local" name="fecha_ini" id="fecha_ini" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($evaluacion[0]->fecha_ini)) }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha_fin">Fecha final</label>
                            <input type="datetime-local" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($evaluacion[0]->fecha_fin))}}" required>
                        </div>
                    </div>

                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">
                Guardar
            </button>

        </form>

    </div>
</div>
@endsection
@section('custom_script')

<script src="{{ asset('js/eval_option.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
<script>
        ClassicEditor
            .create( document.querySelector( '#edit-descripcion' ) )
            .catch( error => {
                console.error( error );
            } );
    // CKEDITOR.replace('edit-descripcion');
</script>
@endsection
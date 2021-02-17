@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar publicación</h3>
            </div>
            <div class="col text-right">
            <a href="{{ url('publicacion/'.$publicacion->idclase_asig) }}" class="btn btn-sm btn-danger">
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

        <form id="form_publicacion_edit" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <input type="hidden" name="idpublic" value="{{ $publicacion->id }}">
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre de la publicación</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $publicacion->nombre }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tipo_p">Tipo de publicación</label>
                            <select name="tipo_p" id="tipo_p" class="form-control" required>
                                <option value="" selected disabled>Seleccionar</option>
                                
                                @foreach ($tipo as $t)
                                    <option value="{{ $t->id }}" @if($t->id == $publicacion->idtipo) {{ "selected" }} @endif>{{ $t->nombre }}</option>              
                                @endforeach
    
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea name="descripcion" id="edit-descripcion" rows="10" cols="100">
                                {{ $publicacion->descripcion }}
                            </textarea>
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

<script src="{{ asset('js/anuncio_option.js') }}"></script>
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
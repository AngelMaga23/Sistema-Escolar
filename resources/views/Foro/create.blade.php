@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Nuevo foro</h3>
            </div>
            <div class="col text-right">
            <a href="{{ url('foro/'.$idclase_a) }}" class="btn btn-sm btn-danger">
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

        <form id="form_foro" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <input type="hidden" name="idclase" value="{{ $idclase_a }}">
                        <div class="form-group col-md-12">
                            <label for="nombre">Nombre del foro</label>
                            <input type="text" name="nombre" id="nombre" class="form-control">
                        </div>
        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea name="descripcion" id="edit-descripcion" rows="10" cols="100">
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

<script src="{{ asset('js/foro_option.js') }}"></script>
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
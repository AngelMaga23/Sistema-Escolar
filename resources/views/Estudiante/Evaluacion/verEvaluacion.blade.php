@extends('layouts.panel')

@section('content')
    <input type="hidden" id="idexamen" value="{{ $id }}">
    <div id="id_content_evaluacion">

    </div>
@endsection



@section('custom_script')
    <script src="{{ asset('js/Estudiante/Evaluacion_options.js') }}"></script>

@endsection


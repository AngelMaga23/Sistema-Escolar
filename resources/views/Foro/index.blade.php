@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Foros</h3>
            </div>
            <div class="col text-right">
            <a href="{{ url('foro/'.$idclase_a.'/create') }}" class="btn btn-sm btn-success">
                    Nuevo foro
                </a>
            </div>
        </div>
    </div>
    <input type="hidden" id="clase_asignatura" value="{{ $idclase_a }}">
    <div class="card-body">
        <div class="table-responsive">
            <!-- Projects table -->
            <table id="foro_table" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acción</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>

</div>
@endsection



@section('custom_script')
<script src="{{ asset('js/foro.js') }}"></script>

@endsection


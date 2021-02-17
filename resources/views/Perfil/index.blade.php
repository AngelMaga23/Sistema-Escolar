@extends('layouts.panel')

@section('content')

    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title" style="font-size: 1rem;">
                            <div class="page-header-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                Configuración de la cuenta: perfil
                            </div>
                        </h1>
                    </div>  
                </div>
            </div>
        </div>
    </header>

    <form id="form_perfil" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-4">
                <input type="hidden" name="idusuario" value="{{ $usuario[0]->id }}">
                <div class="card">
                    <div class="card-header">Imagen de perfil</div>
                    <div class="card-body text-center">
                        <img class="img-account-profile rounded-circle mb-2" src="{{ asset('images/'.$usuario[0]->imagen) }}" alt="Imagen de perfil" width="200px" height="200px">
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header">Detalles de la cuenta</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="small mb-1" for="nom_user">Nombre de usuario</label>
                            <input class="form-control" type="text" name="nom_user" id="nom_user" value="{{ $usuario[0]->name }}">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Correo</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $usuario[0]->email }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="n_contrasena">Nueva contreña</label>
                                <input type="password" class="form-control" name="n_contrasena" id="n_contrasena">
                            </div>
                        </div>
    
                        @isset($detalle)
                            <input type="hidden" name="idcuenta" value="{{ $idcuenta }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="p_nombre">Primer nombre</label>
                                    <input type="text" class="form-control" name="p_nombre" id="p_nombre" value="{{ $detalle[0]->primer_nom }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="s_nombre">Segundo nombre</label>
                                    <input type="text" class="form-control" name="s_nombre" id="s_nombre" value="{{ $detalle[0]->segundo_nom }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="a_paterno">Apellido paterno</label>
                                    <input type="text" class="form-control" name="a_paterno" id="a_paterno" value="{{ $detalle[0]->apellido_p }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="a_materno">Apellido materno</label>
                                    <input type="text" class="form-control" name="a_materno" id="a_materno" value="{{ $detalle[0]->apellido_m }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" class="form-control" name="direccion" id="direccion" value="{{ $detalle[0]->direccion }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" class="form-control" name="telefono" id="telefono" value="{{ $detalle[0]->telefono }}">
                                </div>
                            </div>                        
                        @endisset
    
    
                    </div>
                </div>
                
                <button class="btn btn-primary">Guardar</button>
            </div>

        </div>
    </form>


@endsection

@section('custom_script')
<script src="{{ asset('js/perfil.js') }}"></script>

@endsection


@extends('layouts.form')

@section('content')
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Bienvenido!</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input 
                                        type="email" 
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        id="email" 
                                        name="email"
                                        aria-describedby="emailHelp"
                                        placeholder="Ingresar correo electrónico..."
                                        value="{{ old('email') }}"
                                        required 
                                        autocomplete="email" 
                                        autofocus
                                    >
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input 
                                        type="password" 
                                        class="form-control form-control-user @error('password') is-invalid @enderror"
                                        id="password" 
                                        name="password"
                                        placeholder="Contreña"
                                        required 
                                        autocomplete="current-password"
                                    >
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input 
                                            type="checkbox" 
                                            class="custom-control-input" 
                                            id="remember"
                                            name="remember"
                                            {{ old('remember') ? 'checked' : '' }}
                                        >
                                        <label class="custom-control-label" for="customCheck">Remember
                                            Me</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Iniciar sesión</button>


                            </form>
                            <hr>
                            {{-- <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="register.html">Create an Account!</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

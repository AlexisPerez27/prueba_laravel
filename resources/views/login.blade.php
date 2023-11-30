@extends('principal')
@section('contenido')

    @if (Session::has('mensaje'))
        <div class="alert alert-danger">{{ Session::get('mensaje') }}</div>
    @endif
    <form action="{{ route('valida_sesion') }}" method="post">
        {{ csrf_field() }}
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="{{ asset('img/login.avif') }}" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form>
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <p class="lead fw-normal mb-0 me-3">Iniciar sesión con </p>
                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-facebook-f"></i>
                            </button>

                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-twitter"></i>
                            </button>

                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-linkedin-in"></i>
                            </button>
                        </div>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Or</p>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="usuario">
                                <i class="fa-solid fa-user"></i> Usuario
                            </label>
                            <input type="text" name="usuario" id="usuario" class="form-control form-control-lg" placeholder="Usuario" />
                            @if ($errors->first('usuario'))
                                <span class="text-danger">{{ $errors->first('usuario') }}</span>
                            @endif
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="contra">
                                <i class="fa-solid fa-lock"></i> Contraseña
                            </label>
                            <input type="password" id="contra" name="contra" class="form-control form-control-lg" placeholder="Contraseña" />
                            @if ($errors->first('contra'))
                                <span class="text-danger">{{ $errors->first('contra') }}</span>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            {{-- <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Remember me
                                </label>
                            </div> --}}
                            <a href="#!" class="text-body">¿Olvidaste contraseña?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">
                                Iniciar Sesión
                            </button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">
                                ¿No estas registrado?
                                <a href="#!" class="link-danger">
                                    Registrate aquí.
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </form>
@stop

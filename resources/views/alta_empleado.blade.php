@extends('principal')
@section('contenido')
    {{-- aqui inicia el formulario  --}}
    <div class="col-lg-12">
        <div class="card border-primary">
            <div class="card-header"><b>Alta empleado</b></div>
            <div class="card-body">
                <form action="{{ route('guarda_emp') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-12">
                            <label class="col-form-label mt-4" for="clave">Clave empleado</label>
                            <input type="text" class="form-control" name="clave" value="{{ $id_sig }}" placeholder="Clave Empleado" id="clave" readonly>
                            @if ($errors->first('clave'))
                                <span class="text-danger">{{ $errors->first('clave') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-6">
                            <label class="col-form-label mt-4" for="inputSmall">Nombre:</label>
                            <input class="form-control" name="nombre" value="{{ old('nombre') }}" type="text" placeholder="Nombre" id="inputSmall">
                            @if ($errors->first('nombre'))
                                <span class="text-danger">{{ $errors->first('nombre') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label mt-4">Apellidos:</label>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" name="apellidos" value="{{ old('apellidos') }}" class="form-control" placeholder="Apellidos">
                                </div>
                                @if ($errors->first('apellidos'))
                                    <span class="text-danger">{{ $errors->first('apellidos') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label mt-4">Email:</label>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="Email" name="email" value="{{ old('email') }}" class="form-control" placeholder="example@example.com">
                                </div>
                                @if ($errors->first('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label mt-4">Telefono:</label>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control" placeholder="Telefono">
                                </div>
                                @if ($errors->first('telefono'))
                                    <span class="text-danger">{{ $errors->first('telefono') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <fieldset class="form-group">
                                <label class="form-label mt-4">Sexo</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sexo" id="masculino"
                                        value="M" checked="">
                                    <label class="form-check-label" for="masculino">
                                        Maculino
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sexo" id="femenino"
                                        value="F">
                                    <label class="form-check-label" for="femenino">
                                        Femenino
                                    </label>
                                </div>
                            </fieldset>
                        </div>
                        <div class="form-group col-6">
                            <label for="depatamento" class="form-label mt-4">Departamento:</label>
                            <select class="form-select" name="departamento" id="depatamento">
                                <option value="0">Seleccionar</option>
                                @foreach ($departamentos as $dep)
                                    <option value="{{ $dep->id_depto }}">{{ $dep->depto }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-12" id="dropzone">
                            <label for="depatamento" class="form-label mt-4">Foto de perfil:</label>
                            <input type="file" name="foto" id="foto" class="form-control dropzone" />
                            @if ($errors->first('foto'))
                                <span class="text-danger">{{ $errors->first('foto') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-12">
                            <label for="desc" class="form-label mt-4">Descripcion</label>
                            <textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-outline-primary">
                        <i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>
    {{-- fin formluario  --}}

@stop

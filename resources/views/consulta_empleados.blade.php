@extends('principal')
@section('contenido')
<h2>Reporte empleado</h2>
<br>
@if (Session::has('mensaje'))
    <div class="alert alert-success">{{ Session::get('mensaje') }}</div>
@endif
<br>
<a href="{{route('alta_empleado')}}" class="btn btn-outline-info"><i class="fa-solid fa-user-plus"></i>&nbsp;Alta empleado</a>
<br>
<table class="table table-bordered border-primary">
    <thead>
        <tr>
            <th scope="col">ID Empleado</th>
            <th scope="col">Foto</th>
            <th scope="col">Empleado</th>
            <th scope="col">Email</th>
            <th scope="col">Telefono</th>
            <th scope="col">Departamento</th>
            <th scope="col"><i class="fa-solid fa-gears"></i>&nbsp; Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($consulta as $con)
        <tr>
            <td>{{$con->id_emp}}</td>
            <td><img src="{{ asset("archivos/$con->imagen") }}" width="100px"></td>
            <td>{{$con->nombre }} {{$con->apellidos}}</td>
            <td>{{$con->email}}</td>
            <td>{{$con->telefono}}</td>
            <td>{{$con->depto}}</td>
            <td>
                <a href="{{route('modificar_emp',['id_emp'=>$con->id_emp])}}" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i>&nbsp;Modificar</a>
                @if ($tipo == "admin")
                    @if ($con->deleted_at)
                        <a href="{{route('activar_emp',['id_emp'=>$con->id_emp])}}" class="btn btn-primary"><i class="fa-solid fa-square-check"></i>&nbsp;Activar</a>
                        <a href="{{route('borrar_emp',['id_emp'=>$con->id_emp])}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i>&nbsp;Borrar</a>
                    @else
                        <a href="{{route('desactivar_emp',['id_emp'=>$con->id_emp])}}" class="btn btn-warning"><i class="fa-solid fa-ban"></i>&nbsp;Desactivar</a>
                    @endif

                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop

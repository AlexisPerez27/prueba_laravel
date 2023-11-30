@extends('principal')
@section('contenido')
<div class="container-fluid">
    <h3>Proceso {{$proceso}} </h3>
    <br>
    @if ($error == 1)
        <div class="alert alert-success">{{ $mensaje }}</div>
    @else
        <div class="alert alert-danger">{{ $mensaje }}</div>
    @endif

</div>
@stop

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

<body>
    <h1>stomper_developer.com</h1>
    {{-- <br>
    El nombre recibido es: <?php echo "$nombre y los dias trabajados son: $dias con el pago total de $nomina"; ?> --}}
    <br>
    <p>
        El nombre recibido es: {{ $nombre }} y los dias trabajados son: {{ $dias }}con el pago total de:
        {{ $nomina }}
    </p>

    @if ($nombre == 'levi')
        <h1>Entra a "levi" Esto es para un comentario</h1>
        <br>
        <img src="{{ asset('img/noti.png') }}" width="100px">
    @elseif ($nombre == 'alexis')
        <h1>Entra a "alexis" Esto es para una img</h1>
        <br>
        <img src="{{ asset('img/upload.png') }}" width="100px">
    @else
        <h1>Sin foto</h1>
        <br>
    @endif
    <br>

    <a href="{{ Route('salir_pagina') }}">Salir de pagina</a>
</body>

</html>

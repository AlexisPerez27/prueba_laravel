<?php
$id_usuario = session('sessionid_usu');
$usuario = session('sessionusuario');
$tipo = session('sessiontipo');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    {{-- para incluir bootstrap --}}
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- para incluir icons fontawesomek --}}
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
    {{-- para incluir el dropzone de archivos  .css --}}
    <link href="{{ asset('dropzone/dropzone.min.css') }}" rel="stylesheet">
    {{-- para incluir una hoja de estilos personalizada  .css --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    {{-- incuimos archivo jquery-3.7.1 --}}
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    {{-- incluimos archivo bootstrap js --}}
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- incluimos archivo fontawesome js  --}}
    <script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
    {{-- para incluir el dropzone de archivos .js  --}}
    <script src="{{ asset('dropzone/dropzone.min.js') }}"></script>

</head>

<body class="main">

    {{-- aqui inicia la barra de navegacion (nav) --}}
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SCN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('principal') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('consulta_emp') }}">Reporte empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                    </li> --}}
                </ul>
                <form class="d-flex">
                    {{-- <input class="form-control me-sm-2" type="search" placeholder="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button> --}}
                    <span>
                        <h5 style="padding-top: 5px;">Bienvenido <?php echo $usuario; ?></h5>
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>
                        <a class="btn btn-secondary" href="{{ route('cerrar_sesion') }}">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp; Cerrar Sesión
                        </a>
                    </span>
                </form>
            </div>
        </div>
    </nav>
    {{-- fin del nav  --}}

    <h2>Sistema de prueba laravel nominas</h2>

    <div class="container-fluid">
        @yield('contenido')
    </div>


    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            {{-- <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                <svg class="bi" width="30" height="24">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a> --}}
            <span class="mb-3 mb-md-0 text-body-secondary">Desarrollado por stomper 2023</span>
        </div>

        {{-- <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24"
                        height="24">
                        <use xlink:href="#twitter"></use>
                    </svg></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24"
                        height="24">
                        <use xlink:href="#instagram"></use>
                    </svg></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24"
                        height="24">
                        <use xlink:href="#facebook"></use>
                    </svg></a></li>
        </ul> --}}
    </footer>



    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> --}}
</body>

</html>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NBA | Inicio</title>
        <link rel="icon" href="img/icono.png">
        <!-- URL para utilizar framework Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <link rel="stylesheet" href="style/custom.css">
        <script src="js/custom.js"></script>
        <script src="js/bootstrap.bundle.js"></script>
    </head>
    <body>
        <?php 
            session_start();
        ?>

        <!-- MENÚ -->

        <div class="container-fluid d-flex justify-content-center align-items-center">
            <div class="d-flex justify-content-end align-items-center mt-3">
                <img src="img/icono.png" alt="Logo NBA" class="img-fluid smaller-logo" style="width: 80px; height: auto;">
            </div>
            <div class="d-flex justify-content-start align-items-center mt-4">
                <h1><b>NBA</b></h1>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg bg-white">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item m-3">
                            <a class="nav-link fs-4 active" href="index.php"><b>Inicio</b></a>
                        </li>
                        <li class="nav-item dropdown m-3">
                            <a class="nav-link dropdown-toggle fs-4" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Equipos
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item fs-5" href="equipos.php?conferencia=Este">Conferencia este</a></li>
                                <li><a class="dropdown-item fs-5" href="equipos.php?conferencia=Oeste">Conferencia oeste</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item fs-5" href="equipos.php">Mostrar todos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown m-3">
                            <a class="nav-link dropdown-toggle fs-4" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Jugadores
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item fs-5" href="jugadores.php?disponible=1">Disponibles</a></li>
                                <li><a class="dropdown-item fs-5" href="jugadores.php?disponible=0">No disponibles</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item fs-5" href="jugadores.php">Mostrar todos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown m-3">
                            <a class="nav-link dropdown-toggle fs-4" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Trofeos
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item fs-5" href="trofeos.php?tipo=Jugador">Individuales</a></li>
                                <li><a class="dropdown-item fs-5" href="trofeos.php?tipo=Equipo">Equipo</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item fs-5" href="trofeos.php">Mostrar todos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item m-3">
                            <a class="nav-link fs-4" href="quiz.php">Quiz</a>
                        </li>
                    </ul>
                    <?php 

                    if (isset($_SESSION['usuario'])) {
                        $nombreUsuario = $_SESSION['usuario'];
                        
                        echo "<div class='dropdown m-3'>
                                <button class='btn btn-light dropdown-toggle fs-5' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                    $nombreUsuario
                                </button>
                                <ul class='dropdown-menu dropdown-menu-end'> <!-- Utiliza 'dropdown-menu-start' para abrir hacia la izquierda -->
                                    <li><a class='dropdown-item' href='logout.php'>Cerrar sesión</a></li>
                                </ul>
                            </div>";
                    } else {
                        echo "<a href='login.php' class='btn btn-primary m-3 fs-5' type='submit'>Iniciar sesión</a>";
                    }

                    ?>
                </div>
            </div>
        </nav>

        <!-- IMAGEN HEADER -->

        <img src="img/headerIndex.jpg" alt="Imagen de fondo" class="img-fluid w-100" style="object-fit: cover;">

        <!-- INTRODUCCIÓN INDEX -->

        <div class="container text-center mt-5 mb-5">
            <h1 class="display-4"><b>Bienvenidos a la mayor base de datos NBA</b></h1>
            <p class="lead">Disfruta e infórmate sobre equipos, jugadores, trofeos y mucho más.</p>
        </div>
        <div class="container text-center mt-5 mb-5">
            <hr class="my-4 mt-5">
        </div>

        <!-- SECCIÓN EQUIPOS EN EL INDEX -->

        <div class="w-100 mx-auto">
            <img src="img/imagenIndexEquiposArriba.jpg" alt="Imagen de fondo" class="img-fluid w-100" style="object-fit: cover;">
        </div>

        <div class="container text-center mt-5 mb-5">
            <h1 class="display-4"><b>Descubre datos sobre estos equipos históricos y muchos más</b></h1>
        </div>

        <div class="container mb-5">
            <div class="row">
                <div class="col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img src="img/equipos/Los Angeles Lakers.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">Los Angeles Lakers</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img src="img/equipos/Chicago Bulls.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">Chicago Bulls</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img src="img/equipos/Boston Celtics.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">Boston Celtics</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img src="img/equipos/Golden State Warriors.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">Golden State Warriors</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="equipos.php" class="btn btn-primary btn-lg w-50">Ver todos los equipos</a>
            </div>
        </div>

        <div class="w-100 mx-auto">
            <img src="img/imagenIndexEquiposAbajo.jpg" alt="Imagen de fondo" class="img-fluid w-100" style="object-fit: cover;">
        </div>

        <div class="p-5 text-center bg-primary text-white">
            <h1 class="display-4"><b>Cuenta atrás para las NBA Finals</b></h1>
            <h2 class="display-4 mt-3" id="contador"></h2>
            <div class="w-25 mx-auto">
                <img src="img/trofeos/NBA Championship.png" alt="Imagen de fondo" class="img-fluid w-100 mt-3" style="object-fit: cover;">
            </div>
        </div>
    </body>
</html>

<script>
    let fechaObjetivo = new Date('2024-06-06T20:00:00').getTime();

    let x = setInterval(function () {
        let fechaActual = new Date().getTime();

        let diferencia = fechaObjetivo - fechaActual;

        let dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
        let horas = Math.floor((diferencia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
        let segundos = Math.floor((diferencia % (1000 * 60)) / 1000);

        document.getElementById('contador').innerHTML = dias + ' días ' + horas + ' horas ' + minutos + ' minutos y ' + segundos + ' segundos ';

        if (diferencia < 0) {
            clearInterval(x);
            document.getElementById('contador').innerHTML = '¡La espera para las NBA Finals ha terminado!';
        }
    }, 1000);
</script>

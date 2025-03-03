<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NBA | Jugadores</title>
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
                            <a class="nav-link fs-4" href="index.php">Inicio</a>
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
                            <a class="nav-link dropdown-toggle fs-4 active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <b>Jugadores</b>
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

        <!-- TÍTULO INTRODUCCIÓN PÁGINA -->

        <h1 class="text-center p-5">JUGADORES NBA</h1>

        <div class="container text-center mb-5">
            <hr class="my-4 mt-5">
            <?php
                if (isset($_SESSION['email']) && $_SESSION['email'] == 'admin@admin.com') {
            ?>
            <p class="text-muted">Nota: No puede haber más de 15 jugadores en un equipo.</p>
            <div class="d-flex justify-content-end">
                <a type="button" class="btn btn-primary" href="altaJugador.php">Insertar jugador</a>
            </div>
            <?php 
            }
            ?>
        </div>
        <!-- JUGADORES -->

        <div class="container-fluid">
            <div class="row m-5 mt-3 mb-5 d-flex flex-wrap justify-content-around">
                
            <?php

                if (count($_GET)===0) {
                    $url_dame_jugadores = 'http://iescristobaldemonroy.duckdns.org:81/USER10/NBA_Microservicios/services/mostrarJugadores.php';
                } elseif (count($_GET)===1) {
                    $paramName = key($_GET);
                    $paramValue = $_GET[$paramName]; 
                    $url_dame_jugadores = 'http://iescristobaldemonroy.duckdns.org:81/USER10/NBA_Microservicios/services/mostrarJugadores.php?'.$paramName.'='.$paramValue;
                }

                // Hacer la solicitud HTTP y obtener el XML como una cadena
                $xmlString = file_get_contents($url_dame_jugadores);

                // Verificar si la solicitud fue exitosa
                if ($xmlString === FALSE) {
                    die('Error al obtener el XML de readStudent.php');
                }

                // Procesar el XML con SimpleXML
                $xml = simplexml_load_string($xmlString);

                foreach ($xml->jugador as $jugador) {                

            ?>
                        <div class="col-md-3 mt-5">
                            <div class="card" style="width: 18rem;">
                                <img src="img/jugadores/jugadorPredeterminado.png" class="card-img-top" alt="Imagen Jugador Predeterminado">
                                <div class="card-body">
                                    <h5 class="card-title text-center mt-3 mb-3"><?php echo $jugador->nombre; ?></h5>
                                    <p class="card-text"><b>Nacionalidad:</b> <?php echo $jugador->nacionalidad; ?></p>
                                    <p class="card-text"><b>Posición:</b> <?php echo $jugador->posicion; ?></p>
                                    <p class="card-text"><b>Edad:</b> <?php echo $jugador->edad; ?></p>
                                    <?php if ($jugador->nombre_equipo != "Sin equipo") { ?>
                                        <p class="card-text"><b>Equipo:</b> <?php echo $jugador->nombre_equipo; ?></p>
                                        <div class="text-center">
                                            <img src="img/equipos/<?php echo $jugador->nombre_equipo?>.png" alt="Imagen del equipo" class="img-fluid w-25 mt-2 mb-4">
                                        </div>
                                    <?php } else { ?>
                                        <p class="card-text"><b>Equipo:</b> Sin equipo</p>
                                        <div class="text-center">
                                            <img src="img/quiz/tickmal.jpg" alt="Imagen del equipo" class="img-fluid w-25 mt-2 mb-4">
                                        </div>
                                    <?php } ?>

                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-primary mb-3 w-100" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $jugador->idjugador; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trophy-fill" viewBox="0 0 16 16">
                                                <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935"/>
                                            </svg>
                                        </button>

                                        <div class="modal fade" id="exampleModal<?php echo $jugador->idjugador; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Palmarés de <?php echo $jugador->nombre ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    $url_dame_palmares = 'http://iescristobaldemonroy.duckdns.org:81/USER10/NBA_Microservicios/services/mostrarPalmaresJugador_Jugadores.php?idjugador=' . $jugador->idjugador;

                                                    // Hacer la solicitud HTTP y obtener el XML como una cadena
                                                    $xmlString = file_get_contents($url_dame_palmares);

                                                    // Verificar si la solicitud fue exitosa
                                                    if ($xmlString === FALSE) {
                                                        die('Error al obtener el XML de readStudent.php');
                                                    }

                                                    // Procesar el XML con SimpleXML
                                                    $xml = simplexml_load_string($xmlString);

                                                    if ($xml->palmares->count() > 0) {
                                                        foreach ($xml->palmares as $palmares) {
                                                    ?>
                                                            <div class="d-flex justify-content-center">
                                                                <div class="card mt-3" style="width: 18rem;">
                                                                    <img src="img/trofeos/<?php echo $palmares->nombre_trofeo; ?>.png" class="card-img-top w-50 mx-auto mt-3" alt="...">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title text-center mt-3 mb-3"><?php echo $palmares->nombre_trofeo ?></h5>
                                                                        <p class="card-text"><b>Cantidad: </b><?php echo $palmares->cantidad ?></p>
                                                                        <p class="card-text"><b>Años: </b><?php echo $palmares->annos ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo "<p>No tiene premios en su haber.</p>";
                                                    }
                                                    ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                     
                                    </div>

                                    <?php
                                        if (isset($_SESSION['email']) && $_SESSION['email'] == 'admin@admin.com') {
                                    ?>
                                    <div class="d-flex justify-content-between">
                                        <form action="modificarJugador.php" method="get" class="w-100">
                                            <input type="hidden" name="idjugador" value="<?php echo $jugador->idjugador; ?>">
                                            <button type="submit" class="btn btn-warning w-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                    
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>

        <!-- IMAGEN -->

        <img src="img/imagenAbajoAlta.jpeg" alt="Imagen de fondo" class="img-fluid w-100" style="object-fit: cover;">
    </body>
</html>
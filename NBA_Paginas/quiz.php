<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NBA | Quiz</title>
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
                            <a class="nav-link fs-4 active" href="quiz.php"><b>Quiz</b></a>
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

        <img src="img/headerQuiz.jpeg" alt="Imagen de fondo" class="img-fluid w-100" style="object-fit: cover;">

        <!-- INTRODUCCIÓN INDEX -->
        <?php 

        if (isset($_SESSION['usuario'])) {

        ?>
        <div class="container text-center mt-5 mb-5">
            <h1 class="display-4"><b>QUIZ</b></h1>
            <p class="lead">Demuestra tus conocimientos sobre NBA en nuestro Quiz</p>
        </div>
        <div class="container text-center mt-5 mb-5">
            <hr class="my-4 mt-5">
        </div>

        <div class="container text-center">
            <div class="w-100 mb-4">
                <h4 class="mb-4">P1 - ¿Cuál de los siguientes equipos es miembro de la Conferencia Este de la NBA?</h4>
                <div class="mb-5">
                    <h5><input type="radio" name="p1" value="A"> A) Los Angeles Lakers</h5>
                    <h5><input type="radio" name="p1" value="B"> B) Miami Heat</h5>
                    <h5><input type="radio" name="p1" value="C"> C) Golden State Warriors</h5>
                    <h5><input type="radio" name="p1" value="D"> D) Houston Rockets</h5>
                </div>
            </div>
            <div class="w-100 mt-5 mb-5">
                <h4 class="mb-4">P2 - ¿Cuál de los siguientes equipos ha ganado más títulos de la Conferencia Oeste?</h4>
                <div class="mb-4">
                    <h5><input type="radio" name="p2" value="A"> A) Boston Celtics</h5>
                    <h5><input type="radio" name="p2" value="B"> B) Los Angeles Lakers</h5>
                    <h5><input type="radio" name="p2" value="C"> C) Chicago Bulls</h5>
                    <h5><input type="radio" name="p2" value="D"> D) Philadelphia 76ers</h5>
                </div>
            </div>
            <div class="w-100 mt-5 mb-5">
                <h4 class="mb-4">P3 - ¿Cuál de los siguientes jugadores ha ganado más MVPs en la Conferencia Este?</h4>
                <div class="mb-4">
                    <h5><input type="radio" name="p3" value="A"> A) Kobe Bryant</h5>
                    <h5><input type="radio" name="p3" value="B"> B) LeBron James</h5>
                    <h5><input type="radio" name="p3" value="C"> C) Tim Duncan</h5>
                    <h5><input type="radio" name="p3" value="D"> D) Stephen Curry</h5>
                </div>
            </div>
            <div class="w-100 mt-5 mb-5">
                <h4 class="mb-4">P4 - ¿Cuál de los siguientes equipos ha ganado más campeonatos de la NBA estando en la Conferencia Este?</h4>
                <div class="mb-4">
                    <h5><input type="radio" name="p4" value="A"> A) Houston Rockets</h5>
                    <h5><input type="radio" name="p4" value="B"> B) San Antonio Spurs</h5>
                    <h5><input type="radio" name="p4" value="C"> C) Cleveland Cavaliers</h5>
                    <h5><input type="radio" name="p4" value="D"> D) Dallas Mavericks</h5>
                </div>
            </div>
            <div class="w-100 mt-5 mb-5">
                <h4 class="mb-4">P5 - ¿Cuál de los siguientes equipos ha sido el último en ganar el campeonato de la NBA estando en la Conferencia Este?</h4>
                <div class="mb-4">
                    <h5><input type="radio" name="p5" value="A"> A) Golden State Warriors</h5>
                    <h5><input type="radio" name="p5" value="B"> B) Toronto Raptors</h5>
                    <h5><input type="radio" name="p5" value="C"> C) Los Angeles Lakers</h5>
                    <h5><input type="radio" name="p5" value="D"> D) Oklahoma City Thunder</h5>
                </div>
            </div>
            <div class="w-100 mt-5 mb-5">
                <h4 class="mb-4">P6 - ¿Cuál de los siguientes equipos ha tenido más apariciones en las Finales de la NBA desde la Conferencia Oeste?</h4>
                <div class="mb-4">
                    <h5><input type="radio" name="p6" value="A"> A) Detroit Pistons</h5>
                    <h5><input type="radio" name="p6" value="B"> B) Orlando Magic</h5>
                    <h5><input type="radio" name="p6" value="C"> C) Utah Jazz</h5>
                    <h5><input type="radio" name="p6" value="D"> D) Los Angeles Lakers</h5>
                </div>
            </div>
            <div class="w-100 mt-5 mb-5">
                <h4 class="mb-4">P7 - ¿Cuál de los siguientes equipos nunca ha sido miembro de la Conferencia Este de la NBA?</h4>
                <div class="mb-4">
                    <h5><input type="radio" name="p7" value="A"> A) Charlotte Hornets</h5>
                    <h5><input type="radio" name="p7" value="B"> B) Brooklyn Nets</h5>
                    <h5><input type="radio" name="p7" value="C"> C) Chicago Bulls</h5>
                    <h5><input type="radio" name="p7" value="D"> D) Oklahoma City Thunder</h5>
                </div>
            </div>
            <div class="w-100 mt-5 mb-5">
                <h4 class="mb-4">P8 - ¿Cuál de los siguientes jugadores ha promediado más puntos por juego en una temporada regular en la Conferencia Este?</h4>
                <div class="mb-4">
                    <h5><input type="radio" name="p8" value="A"> A) Kevin Durant</h5>
                    <h5><input type="radio" name="p8" value="B"> B) Giannis Antetokounmpo</h5>
                    <h5><input type="radio" name="p8" value="C"> C) James Harden</h5>
                    <h5><input type="radio" name="p8" value="D"> D) Michael Jordan</h5>
                </div>
            </div>
            <div class="w-100 mt-5 mb-5">
                <h4 class="mb-4">P9 - ¿Cuál de los siguientes equipos ha sido el más exitoso en la Conferencia Oeste en los últimos 10 años?</h4>
                <div class="mb-4">
                    <h5><input type="radio" name="p9" value="A"> A) New Orleans Pelicans</h5>
                    <h5><input type="radio" name="p9" value="B"> B) Memphis Grizzlies</h5>
                    <h5><input type="radio" name="p9" value="C"> C) San Antonio Spurs</h5>
                    <h5><input type="radio" name="p9" value="D"> D) Golden State Warriors</h5>
                </div>
            </div>
            <div class="w-100 mt-5 mb-5">
                <h4 class="mb-4">P10 - ¿Cuál de los siguientes entrenadores ha llevado a más equipos de la Conferencia Este a las Finales de la NBA?</h4>
                <div class="mb-4">
                    <h5><input type="radio" name="p10" value="A"> A) Phil Jackson</h5>
                    <h5><input type="radio" name="p10" value="B"> B) Gregg Popovich</h5>
                    <h5><input type="radio" name="p10" value="C"> C) Erik Spoelstra</h5>
                    <h5><input type="radio" name="p10" value="D"> D) Doc Rivers</h5>
                </div>
            </div>
        </div>
            <button onclick="evaluarQuiz()" class="btn btn-success d-block m-auto">Tirar triple</button>
            <br>
            <button onclick="resetQuiz()" class="btn btn-danger d-block m-auto">Resetear quiz</button>
            <br>
        </div>
        <div class="col-xl-12">
            <div class="container-fluid" id="resultado">
            </div>
        </div>
        <!-- IMAGEN -->

        <?php 

        } else {
            echo '<div class="container mt-4 p-4 text-center">
                <h5 class="display-5">Debes iniciar sesión para probar nuestro Quiz. <br>Inicia sesión ahora y disfrútalo.</h5>
            </div>';
        }

        ?>

        <img src="img/imagenAbajoAlta.jpeg" alt="Imagen de fondo" class="img-fluid w-100" style="object-fit: cover;">
    </body>
</html>

<script>
    function evaluarQuiz() {
        let respuestaCorrectas = ["B","B","B","C","B","D","D","D","D","C"];
        let respuestasUsuario = new Array();
        let respuestasPreguntas = new Array();
        let aciertos = 0;
        let countPreguntas = 0;
        let bien = "img/quiz/tickbien.jpg";
        let mal = "img/quiz/tickmal.jpg";
        let imagenRespuestas = new Array();
        for (let i = 0; i < 10; i++) {
            respuestasPreguntas = document.getElementsByName('p'+(i+1));
            for (let j = 0; j < 4; j++) {
                if(respuestasPreguntas[j].checked == true) {
                    countPreguntas++;
                    respuestasUsuario[i] = respuestasPreguntas[j].value;
                    if(respuestasPreguntas[j].value == respuestaCorrectas[i]) {
                        imagenRespuestas[i] = bien;
                        aciertos++;
                    } else {
                        imagenRespuestas[i] = mal;
                    }
                }
            }
        }

        for (let i = 0; i < 10; i++) {
            console.log("Respuesta - " + (i+1) + "Imagen" + imagenRespuestas[i]);
        }

        console.log(countPreguntas);

        if (countPreguntas == 10) {
            html = "<div class='w-75 mx-auto'>";
            html += "<p class='text-center'>Resultado (desliza hacia abajo)</p>";
            html += "<table class='table'>";
            html += "<tr>";
            html += "<td>Pregunta</td>";
            html += "<td>Resp Usuario</td>";
            html += "<td>Resp Correcta</td>";
            html += "<td></td>";
            html += "</tr>";
            for (let i = 0; i < 10; i++) {
                html += "<tr>";
                html += "<td>" + (i + 1) + "</td>";
                html += "<td>" + respuestasUsuario[i] + "</td>";
                html += "<td>" + respuestaCorrectas[i] + "</td>";
                html += "<td><img src='" + imagenRespuestas[i] + "' width=30 height=30</td>";
                html += "</tr>";
            }
            html += "<tr>";
            html += "<td colspan=4>Número de aciertos = " + aciertos + "</td>";
            html += "</tr>";
            html += "</table>";

            if (aciertos >= 5) {
                html += "<div class='d-flex align-items-center justify-content-center'>";
                html += "<img src='img/quiz/gifbien.gif' class='img-fluid imagen_playoffs mb-4' alt='...'>";
                html += "</div>";
            } else {
                html += "<div class='d-flex align-items-center justify-content-center'>";
                html += "<img src='img/quiz/gifmal.gif' class='img-fluid imagen_playoffs mb-4' alt='...'>";
                html += "</div>";
            }
            document.getElementById("resultado").innerHTML=html;


        } else {
            alert('Faltan preguntas por contestar');
        }
    }

    function resetQuiz() {
        for (let i = 0; i < 10; i++) {
            respuestasPreguntas = document.getElementsByName('p'+(i+1));
            for (let j = 0; j < 4; j++) {
                respuestasPreguntas[j].checked = false;
            }
        }

        document.getElementById("resultado").innerHTML = "";
    }
</script>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NBA | Modificar trofeo</title>
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

            $idTrofeo = $_GET['idtrofeo'];
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
                            <a class="nav-link dropdown-toggle fs-4 active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <b>Trofeos</b>
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

        <h1 class="text-center mb-5 bg-primary text-white p-5">MODIFICAR TROFEO</h1>

        <?php 

            $alert = "";

            function mostrarAlerta($alert) {
                echo $alert;
            }

            $trofeoAnterior = "";

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificar']) && !empty($_POST['modificar'])) {
                
                $idT = urldecode($_POST['modificar']);
                $nombre = urlencode($_POST['nombre']);
                $tipo = urlencode($_POST['tipo']);

                $url_dame_comprobartrofeo = 'http://iescristobaldemonroy.duckdns.org:81/USER10/NBA_Microservicios/services/comprobarNombreTrofeo.php?nombre=' . $nombre . '&idT=' . $idT;

                // Hacer la solicitud HTTP y obtener el XML como una cadena
                $xmlString = file_get_contents($url_dame_comprobartrofeo);

                // Verificar si la solicitud fue exitosa
                if ($xmlString === FALSE) {
                    die('Error al obtener el XML de readStudent.php');
                }

                // Procesar el XML con SimpleXML
                $xml = simplexml_load_string($xmlString);

                if ($xml->status == 'OK') {
                        $imagenDir = 'img/trofeos/';
                        $imagenNombre = urldecode($nombre) . '.png';
                        $imagenTmpName = $_FILES['imgTrofeo']['tmp_name'];
            
                        if ($_FILES['imgTrofeo']['size'] > 0) {
                            $imagenNuevaNombre = urldecode($nombre) . '.png';
                            $imagenNuevaTmpName = $_FILES['imgTrofeo']['tmp_name'];
                    
                            if (getimagesize($imagenNuevaTmpName)[0] == getimagesize($imagenNuevaTmpName)[1]) {
                                $extensionValida = pathinfo($imagenNuevaNombre, PATHINFO_EXTENSION);
                    
                                if (strtolower($extensionValida) == 'png') {
                                    move_uploaded_file($imagenNuevaTmpName, 'img/trofeos/' . $imagenNuevaNombre);
                    
                                    if ($nombre != $trofeoAnterior) {
                                        $imagenAnterior = 'img/trofeos/' . $trofeoAnterior . '.png';
                                        if (file_exists($imagenAnterior)) {
                                            unlink($imagenAnterior);
                                        }
                                    }
                    
                                    $url_dame_modificartrofeo = 'http://iescristobaldemonroy.duckdns.org:81/USER10/NBA_Microservicios/services/modificarTrofeos.php?idtrofeo='. $idT.'&nombre='. $nombre . '&tipo=' . $tipo;

                                    // Hacer la solicitud HTTP y obtener el XML como una cadena
                                    $xmlString = file_get_contents($url_dame_modificartrofeo);

                                    // Verificar si la solicitud fue exitosa
                                    if ($xmlString === FALSE) {
                                        die('Error al obtener el XML de readStudent.php');
                                    }

                                    // Procesar el XML con SimpleXML
                                    $xml = simplexml_load_string($xmlString);

                                    if ($xml->status == 'OK') {

                                        $alert = "<div class='container alert alert-success alert-dismissible fade show w-75' role='alert'>
                                                $xml->description
                                        </div>";

                                        mostrarAlerta($alert);
                                    }
                                } else {
                                    echo '<div class="container alert alert-danger alert-dismissible fade show w-75" role="alert">
                                            La imagen debe ser un archivo PNG.
                                        </div>';
                                }
                            } else {
                                echo '<div class="container alert alert-danger alert-dismissible fade show w-75" role="alert">
                                        La imagen debe tener una relación de aspecto 1:1.
                                      </div>';
                            }
                        } else {
                            $url_dame_modificartrofeo = 'http://iescristobaldemonroy.duckdns.org:81/USER10/NBA_Microservicios/services/modificarTrofeos.php?idtrofeo='. $idT.'&nombre='. $nombre . '&tipo=' . $tipo;

                                // Hacer la solicitud HTTP y obtener el XML como una cadena
                            $xmlString = file_get_contents($url_dame_modificartrofeo);

                                // Verificar si la solicitud fue exitosa
                            if ($xmlString === FALSE) {
                                    die('Error al obtener el XML de readStudent.php');
                            }

                            // Procesar el XML con SimpleXML
                            $xml = simplexml_load_string($xmlString);

                            if ($xml->status == 'OK') {

                                $alert = "<div class='container alert alert-success alert-dismissible fade show w-75' role='alert'>
                                    $xml->description
                                </div>";

                                mostrarAlerta($alert);
                            }
                    
                            if ($nombre != $trofeoAnterior) {
                                $imagenAnterior = 'img/trofeos/' . $trofeoAnterior . '.png';
                                $imagenNueva = 'img/trofeos/' . $nombre . '.png';
                                
                                if (file_exists($imagenAnterior)) {
                                    rename($imagenAnterior, $imagenNueva);
                                }
                            };
                        }   
                } else {
                    $alert = "<div class='container alert alert-danger alert-dismissible fade show w-75' role='alert'>
                        $xml->description
                    </div>";

                    mostrarAlerta($alert);
                }
            }

            $url_dame_datos = 'http://iescristobaldemonroy.duckdns.org:81/USER10/NBA_Microservicios/services/datosTrofeo.php?idtrofeo='.$idTrofeo;

            // Hacer la solicitud HTTP y obtener el XML como una cadena
            $xmlString = file_get_contents($url_dame_datos);

            // Verificar si la solicitud fue exitosa
            if ($xmlString === FALSE) {
                die('Error al obtener el XML de readStudent.php');
            }

            // Procesar el XML con SimpleXML
            $xml = simplexml_load_string($xmlString);

            foreach ($xml->trofeo as $trofeo) {
                $nombre = urldecode($trofeo->nombre);
                $tipo = urldecode($trofeo->tipo);
                $trofeoAnterior = urldecode($trofeo->nombre);
            }
        ?>

        <!-- FORMULARIO -->

        <div class="container-fluid">
            <div class="row mt-3 mb-5 d-flex flex-column align-items-center">
                <form method='post' action='modificarTrofeo.php?idtrofeo=<?php echo $idTrofeo; ?>' class='w-75' enctype='multipart/form-data'>
                    <input type="hidden" name="modificar" value="<?php echo $idTrofeo; ?>">
                    <label for='exampleFormControlInput1' class='form-label'>Nombre:</label>
                    <input type='text' name='nombre' class='form-control' id='exampleFormControlInput1' value="<?php echo $nombre; ?>" required>
                    <label for='exampleFormControlInput1' class='form-label mt-3'>Tipo:</label>
                    <select name="tipo" class='form-control'>
                        <option value="Jugador" <?php echo ($tipo == 'Jugador') ? 'selected' : ''; ?>>Jugador</option>
                        <option value="Equipo" <?php echo ($tipo == 'Equipo') ? 'selected' : ''; ?>>Equipo</option>
                    </select>
                    <label for='exampleFormControlInput1' class='form-label mt-3'>Imagen del trofeo (Este archivo debe ser .png y de medidas 1:1):</label>
                    <input type='file' name='imgTrofeo' class='form-control' id='exampleFormControlInput1'>
                    <input type='submit' class='btn btn-primary mt-3 w-100' value='Enviar'>
                </form>
            </div>
        </div>

        <!-- IMAGEN -->

        <img src="img/imagenAbajoModificar.jpg" alt="Imagen de fondo" class="img-fluid w-100" style="object-fit: cover;">
    </body>
</html>
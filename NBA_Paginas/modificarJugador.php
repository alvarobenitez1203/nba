<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NBA | Modificar jugador</title>
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

            $idJugador = $_GET['idjugador'];
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

        <h1 class="text-center mb-5 bg-primary text-white p-5">MODIFICAR JUGADOR</h1>

        <?php 

            $alert = "";

            function mostrarAlerta($alert) {
                echo $alert;
            }


            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificar']) && !empty($_POST['modificar'])) {
                $idJ = urldecode($_POST['modificar']);
                $nombre = urlencode($_POST['nombre']);
                $edad = urlencode($_POST['edad']);
                $posicion = urlencode($_POST['posicion']);
                $nacionalidad = urlencode($_POST['pais']);
                $disponible = urlencode($_POST['disponible']);
                $idequipo = urlencode($_POST['equipo']);

                $url_dame_modificarjugador = 'http://iescristobaldemonroy.duckdns.org:81/USER10/NBA_Microservicios/services/modificarJugadores.php?idjugador='.$idJ.'&nombre='. $nombre . '&edad=' . $edad . '&posicion=' . $posicion . '&nacionalidad=' .$nacionalidad. '&disponible=' .$disponible. '&idequipo='. $idequipo;

                // Hacer la solicitud HTTP y obtener el XML como una cadena
                $xmlString = file_get_contents($url_dame_modificarjugador);

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
            }

            $url_dame_datos = 'http://iescristobaldemonroy.duckdns.org:81/USER10/NBA_Microservicios/services/datosJugador.php?idjugador='.$idJugador;

            // Hacer la solicitud HTTP y obtener el XML como una cadena
            $xmlString = file_get_contents($url_dame_datos);

            // Verificar si la solicitud fue exitosa
            if ($xmlString === FALSE) {
                die('Error al obtener el XML de readStudent.php');
            }

            // Procesar el XML con SimpleXML
            $xml = simplexml_load_string($xmlString);

            foreach ($xml->jugador as $jugador) {
                $nombre = urldecode($jugador->nombre);
                $edad = urldecode($jugador->edad);
                $posicion = urldecode($jugador->posicion);
                $pais = urldecode($jugador->nacionalidad);
                $disponible = urldecode($jugador->disponible);
                $idequipo = urldecode($jugador->idequipo);
            }
        ?>

        <!-- FORMULARIO -->

        <div class="container-fluid">
            <div class="row mt-3 mb-5 d-flex flex-column align-items-center">
            <form method='post' action='modificarJugador.php?idjugador=<?php echo $idJugador; ?>' class='w-75' enctype='multipart/form-data'>
                    <input type="hidden" name="modificar" value="<?php echo $idJugador; ?>">
                    <label for='exampleFormControlInput1' class='form-label'>Nombre:</label>
                    <input type='text' name='nombre' class='form-control' id='exampleFormControlInput1' value="<?php echo $nombre; ?>" required>
                    <label for='exampleFormControlInput1' class='form-label mt-3'>Edad:</label>
                    <input type='number' name='edad' class='form-control' id='exampleFormControlInput1' min="18" max="50" value="<?php echo $edad; ?>" required>
                    <label for='exampleFormControlInput1' class='form-label mt-3'>Posición:</label>
                    <select name="posicion" class='form-control'>
                        <option value="Base" <?php echo ($posicion == 'Base') ? 'selected' : ''; ?>>Base</option>
                        <option value="Escolta" <?php echo ($posicion == 'Escolta') ? 'selected' : ''; ?>>Escolta</option>
                        <option value="Alero" <?php echo ($posicion == 'Alero') ? 'selected' : ''; ?>>Alero</option>
                        <option value="Ala-pívot" <?php echo ($posicion == 'Ala-pívot') ? 'selected' : ''; ?>>Ala-pívot</option>
                        <option value="Pívot" <?php echo ($posicion == 'Pívot') ? 'selected' : ''; ?>>Pívot</option>
                    </select>
                    <label for='exampleFormControlInput1' class='form-label mt-3'>País:</label>
                    <select name="pais" class='form-control'>
                        <option value="Afganistán" <?php echo ($pais == 'Afganistán') ? 'selected' : ''; ?>>Afganistán</option>
                        <option value="Albania" <?php echo ($pais == 'Albania') ? 'selected' : ''; ?>>Albania</option>
                        <option value="Alemania" <?php echo ($pais == 'Alemania') ? 'selected' : ''; ?>>Alemania</option>
                        <option value="Andorra" <?php echo ($pais == 'Andorra') ? 'selected' : ''; ?>>Andorra</option>
                        <option value="Angola" <?php echo ($pais == 'Angola') ? 'selected' : ''; ?>>Angola</option>
                        <option value="Anguila" <?php echo ($pais == 'Anguila') ? 'selected' : ''; ?>>Anguila</option>
                        <option value="Antártida" <?php echo ($pais == 'Antártida') ? 'selected' : ''; ?>>Antártida</option>
                        <option value="Antigua y Barbuda" <?php echo ($pais == 'Antigua y Barbuda') ? 'selected' : ''; ?>>Antigua y Barbuda</option>
                        <option value="Antillas Holandesas" <?php echo ($pais == 'Antillas Holandesas') ? 'selected' : ''; ?>>Antillas Holandesas</option>
                        <option value="Arabia Saudí" <?php echo ($pais == 'Arabia Saudí') ? 'selected' : ''; ?>>Arabia Saudí</option>
                        <option value="Argelia" <?php echo ($pais == 'Argelia') ? 'selected' : ''; ?>>Argelia</option>
                        <option value="Argentina" <?php echo ($pais == 'Argentina') ? 'selected' : ''; ?>>Argentina</option>
                        <option value="Armenia" <?php echo ($pais == 'Armenia') ? 'selected' : ''; ?>>Armenia</option>
                        <option value="Aruba" <?php echo ($pais == 'Aruba') ? 'selected' : ''; ?>>Aruba</option>
                        <option value="Australia" <?php echo ($pais == 'Australia') ? 'selected' : ''; ?>>Australia</option>
                        <option value="Austria" <?php echo ($pais == 'Austria') ? 'selected' : ''; ?>>Austria</option>
                        <option value="Azerbaiyán" <?php echo ($pais == 'Azerbaiyán') ? 'selected' : ''; ?>>Azerbaiyán</option>
                        <option value="Bahamas" <?php echo ($pais == 'Bahamas') ? 'selected' : ''; ?>>Bahamas</option>
                        <option value="Bahrein" <?php echo ($pais == 'Bahrein') ? 'selected' : ''; ?>>Bahrein</option>
                        <option value="Bangladesh" <?php echo ($pais == 'Bangladesh') ? 'selected' : ''; ?>>Bangladesh</option>
                        <option value="Barbados" <?php echo ($pais == 'Barbados') ? 'selected' : ''; ?>>Barbados</option>
                        <option value="Bélgica" <?php echo ($pais == 'Bélgica') ? 'selected' : ''; ?>>Bélgica</option>
                        <option value="Belice" <?php echo ($pais == 'Belice') ? 'selected' : ''; ?>>Belice</option>
                        <option value="Benin" <?php echo ($pais == 'Benin') ? 'selected' : ''; ?>>Benin</option>
                        <option value="Bermudas" <?php echo ($pais == 'Bermudas') ? 'selected' : ''; ?>>Bermudas</option>
                        <option value="Bielorrusia" <?php echo ($pais == 'Bielorrusia') ? 'selected' : ''; ?>>Bielorrusia</option>
                        <option value="Birmania" <?php echo ($pais == 'Birmania') ? 'selected' : ''; ?>>Birmania</option>
                        <option value="Bolivia" <?php echo ($pais == 'Bolivia') ? 'selected' : ''; ?>>Bolivia</option>
                        <option value="Bosnia y Herzegovina" <?php echo ($pais == 'Bosnia y Herzegovina') ? 'selected' : ''; ?>>Bosnia y Herzegovina</option>
                        <option value="Botswana" <?php echo ($pais == 'Botswana') ? 'selected' : ''; ?>>Botswana</option>
                        <option value="Brasil" <?php echo ($pais == 'Brasil') ? 'selected' : ''; ?>>Brasil</option>
                        <option value="Brunei" <?php echo ($pais == 'Brunei') ? 'selected' : ''; ?>>Brunei</option>
                        <option value="Bulgaria" <?php echo ($pais == 'Bulgaria') ? 'selected' : ''; ?>>Bulgaria</option>
                        <option value="Burkina Faso" <?php echo ($pais == 'Burkina Faso') ? 'selected' : ''; ?>>Burkina Faso</option>
                        <option value="Burundi" <?php echo ($pais == 'Burundi') ? 'selected' : ''; ?>>Burundi</option>
                        <option value="Bután" <?php echo ($pais == 'Bután') ? 'selected' : ''; ?>>Bután</option>
                        <option value="Cabo Verde" <?php echo ($pais == 'Cabo Verde') ? 'selected' : ''; ?>>Cabo Verde</option>
                        <option value="Camboya" <?php echo ($pais == 'Camboya') ? 'selected' : ''; ?>>Camboya</option>
                        <option value="Camerún" <?php echo ($pais == 'Camerún') ? 'selected' : ''; ?>>Camerún</option>
                        <option value="Canadá" <?php echo ($pais == 'Canadá') ? 'selected' : ''; ?>>Canadá</option>
                        <option value="Chad" <?php echo ($pais == 'Chad') ? 'selected' : ''; ?>>Chad</option>
                        <option value="Chile" <?php echo ($pais == 'Chile') ? 'selected' : ''; ?>>Chile</option>
                        <option value="China" <?php echo ($pais == 'China') ? 'selected' : ''; ?>>China</option>
                        <option value="Chipre" <?php echo ($pais == 'Chipre') ? 'selected' : ''; ?>>Chipre</option>
                        <option value="Ciudad del Vaticano (Santa Sede)" <?php echo ($pais == 'Ciudad del Vaticano (Santa Sede)') ? 'selected' : ''; ?>>Ciudad del Vaticano (Santa Sede)</option>
                        <option value="Colombia" <?php echo ($pais == 'Colombia') ? 'selected' : ''; ?>>Colombia</option>
                        <option value="Comores" <?php echo ($pais == 'Comores') ? 'selected' : ''; ?>>Comores</option>
                        <option value="Congo" <?php echo ($pais == 'Congo') ? 'selected' : ''; ?>>Congo</option>
                        <option value="Congo, República Democrática del" <?php echo ($pais == 'Congo, República Democrática del') ? 'selected' : ''; ?>>Congo, República Democrática del</option>
                        <option value="Corea" <?php echo ($pais == 'Corea') ? 'selected' : ''; ?>>Corea</option>
                        <option value="Corea del Norte" <?php echo ($pais == 'Corea del Norte') ? 'selected' : ''; ?>>Corea del Norte</option>
                        <option value="Costa de Marfíl" <?php echo ($pais == 'Costa de Marfíl') ? 'selected' : ''; ?>>Costa de Marfíl</option>
                        <option value="Costa Rica" <?php echo ($pais == 'Costa Rica') ? 'selected' : ''; ?>>Costa Rica</option>
                        <option value="Croacia (Hrvatska)" <?php echo ($pais == 'Croacia (Hrvatska)') ? 'selected' : ''; ?>>Croacia (Hrvatska)</option>
                        <option value="Cuba" <?php echo ($pais == 'Cuba') ? 'selected' : ''; ?>>Cuba</option>
                        <option value="Dinamarca" <?php echo ($pais == 'Dinamarca') ? 'selected' : ''; ?>>Dinamarca</option>
                        <option value="Djibouti" <?php echo ($pais == 'Djibouti') ? 'selected' : ''; ?>>Djibouti</option>
                        <option value="Dominica" <?php echo ($pais == 'Dominica') ? 'selected' : ''; ?>>Dominica</option>
                        <option value="Ecuador" <?php echo ($pais == 'Ecuador') ? 'selected' : ''; ?>>Ecuador</option>
                        <option value="Egipto" <?php echo ($pais == 'Egipto') ? 'selected' : ''; ?>>Egipto</option>
                        <option value="El Salvador" <?php echo ($pais == 'El Salvador') ? 'selected' : ''; ?>>El Salvador</option>
                        <option value="Emiratos Árabes Unidos" <?php echo ($pais == 'Emiratos Árabes Unidos') ? 'selected' : ''; ?>>Emiratos Árabes Unidos</option>
                        <option value="Eritrea" <?php echo ($pais == 'Eritrea') ? 'selected' : ''; ?>>Eritrea</option>
                        <option value="Eslovenia" <?php echo ($pais == 'Eslovenia') ? 'selected' : ''; ?>>Eslovenia</option>
                        <option value="España" <?php echo ($pais == 'España') ? 'selected' : ''; ?>>España</option>
                        <option value="Estados Unidos" <?php echo ($pais == 'Estados Unidos') ? 'selected' : ''; ?>>Estados Unidos</option>
                        <option value="Estonia" <?php echo ($pais == 'Estonia') ? 'selected' : ''; ?>>Estonia</option>
                        <option value="Etiopía" <?php echo ($pais == 'Etiopía') ? 'selected' : ''; ?>>Etiopía</option>
                        <option value="Fiji" <?php echo ($pais == 'Fiji') ? 'selected' : ''; ?>>Fiji</option>
                        <option value="Filipinas" <?php echo ($pais == 'Filipinas') ? 'selected' : ''; ?>>Filipinas</option>
                        <option value="Finlandia" <?php echo ($pais == 'Finlandia') ? 'selected' : ''; ?>>Finlandia</option>
                        <option value="Francia" <?php echo ($pais == 'Francia') ? 'selected' : ''; ?>>Francia</option>
                        <option value="Gabón" <?php echo ($pais == 'Gabón') ? 'selected' : ''; ?>>Gabón</option>
                        <option value="Gambia" <?php echo ($pais == 'Gambia') ? 'selected' : ''; ?>>Gambia</option>
                        <option value="Georgia" <?php echo ($pais == 'Georgia') ? 'selected' : ''; ?>>Georgia</option>
                        <option value="Ghana" <?php echo ($pais == 'Ghana') ? 'selected' : ''; ?>>Ghana</option>
                        <option value="Gibraltar" <?php echo ($pais == 'Gibraltar') ? 'selected' : ''; ?>>Gibraltar</option>
                        <option value="Granada" <?php echo ($pais == 'Granada') ? 'selected' : ''; ?>>Granada</option>
                        <option value="Grecia" <?php echo ($pais == 'Grecia') ? 'selected' : ''; ?>>Grecia</option>
                        <option value="Groenlandia" <?php echo ($pais == 'Groenlandia') ? 'selected' : ''; ?>>Groenlandia</option>
                        <option value="Guadalupe" <?php echo ($pais == 'Guadalupe') ? 'selected' : ''; ?>>Guadalupe</option>
                        <option value="Guam" <?php echo ($pais == 'Guam') ? 'selected' : ''; ?>>Guam</option>
                        <option value="Guatemala" <?php echo ($pais == 'Guatemala') ? 'selected' : ''; ?>>Guatemala</option>
                        <option value="Guayana" <?php echo ($pais == 'Guayana') ? 'selected' : ''; ?>>Guayana</option>
                        <option value="Guayana Francesa" <?php echo ($pais == 'Guayana Francesa') ? 'selected' : ''; ?>>Guayana Francesa</option>
                        <option value="Guinea" <?php echo ($pais == 'Guinea') ? 'selected' : ''; ?>>Guinea</option>
                        <option value="Guinea Ecuatorial" <?php echo ($pais == 'Guinea Ecuatorial') ? 'selected' : ''; ?>>Guinea Ecuatorial</option>
                        <option value="Guinea-Bissau" <?php echo ($pais == 'Guinea-Bissau') ? 'selected' : ''; ?>>Guinea-Bissau</option>
                        <option value="Haití" <?php echo ($pais == 'Haití') ? 'selected' : ''; ?>>Haití</option>
                        <option value="Honduras" <?php echo ($pais == 'Honduras') ? 'selected' : ''; ?>>Honduras</option>
                        <option value="Hungría" <?php echo ($pais == 'Hungría') ? 'selected' : ''; ?>>Hungría</option>
                        <option value="India" <?php echo ($pais == 'India') ? 'selected' : ''; ?>>India</option>
                        <option value="Indonesia" <?php echo ($pais == 'Indonesia') ? 'selected' : ''; ?>>Indonesia</option>
                        <option value="Irak" <?php echo ($pais == 'Irak') ? 'selected' : ''; ?>>Irak</option>
                        <option value="Irán" <?php echo ($pais == 'Irán') ? 'selected' : ''; ?>>Irán</option>
                        <option value="Irlanda" <?php echo ($pais == 'Irlanda') ? 'selected' : ''; ?>>Irlanda</option>
                        <option value="Isla Bouvet" <?php echo ($pais == 'Isla Bouvet') ? 'selected' : ''; ?>>Isla Bouvet</option>
                        <option value="Isla de Christmas" <?php echo ($pais == 'Isla de Christmas') ? 'selected' : ''; ?>>Isla de Christmas</option>
                        <option value="Islandia" <?php echo ($pais == 'Islandia') ? 'selected' : ''; ?>>Islandia</option>
                        <option value="Islas Caimán" <?php echo ($pais == 'Islas Caimán') ? 'selected' : ''; ?>>Islas Caimán</option>
                        <option value="Islas Cook" <?php echo ($pais == 'Islas Cook') ? 'selected' : ''; ?>>Islas Cook</option>
                        <option value="Islas de Cocos o Keeling" <?php echo ($pais == 'Islas de Cocos o Keeling') ? 'selected' : ''; ?>>Islas de Cocos o Keeling</option>
                        <option value="Islas Faroe" <?php echo ($pais == 'Islas Faroe') ? 'selected' : ''; ?>>Islas Faroe</option>
                        <option value="Islas Heard y McDonald" <?php echo ($pais == 'Islas Heard y McDonald') ? 'selected' : ''; ?>>Islas Heard y McDonald</option>
                        <option value="Islas Malvinas" <?php echo ($pais == 'Islas Malvinas') ? 'selected' : ''; ?>>Islas Malvinas</option>
                        <option value="Islas Marianas del Norte" <?php echo ($pais == 'Islas Marianas del Norte') ? 'selected' : ''; ?>>Islas Marianas del Norte</option>
                        <option value="Islas Marshall" <?php echo ($pais == 'Islas Marshall') ? 'selected' : ''; ?>>Islas Marshall</option>
                        <option value="Islas menores de Estados Unidos" <?php echo ($pais == 'Islas menores de Estados Unidos') ? 'selected' : ''; ?>>Islas menores de Estados Unidos</option>
                        <option value="Islas Palau" <?php echo ($pais == 'Islas Palau') ? 'selected' : ''; ?>>Islas Palau</option>
                        <option value="Islas Salomón" <?php echo ($pais == 'Islas Salomón') ? 'selected' : ''; ?>>Islas Salomón</option>
                        <option value="Islas Svalbard y Jan Mayen" <?php echo ($pais == 'Islas Svalbard y Jan Mayen') ? 'selected' : ''; ?>>Islas Svalbard y Jan Mayen</option>
                        <option value="Islas Tokelau" <?php echo ($pais == 'Islas Tokelau') ? 'selected' : ''; ?>>Islas Tokelau</option>
                        <option value="Islas Turks y Caicos" <?php echo ($pais == 'Islas Turks y Caicos') ? 'selected' : ''; ?>>Islas Turks y Caicos</option>
                        <option value="Islas Vírgenes (EEUU)" <?php echo ($pais == 'Islas Vírgenes (EEUU)') ? 'selected' : ''; ?>>Islas Vírgenes (EEUU)</option>
                        <option value="Islas Vírgenes (Reino Unido)" <?php echo ($pais == 'Islas Vírgenes (Reino Unido)') ? 'selected' : ''; ?>>Islas Vírgenes (Reino Unido)</option>
                        <option value="Islas Wallis y Futuna" <?php echo ($pais == 'Islas Wallis y Futuna') ? 'selected' : ''; ?>>Islas Wallis y Futuna</option>
                        <option value="Israel" <?php echo ($pais == 'Israel') ? 'selected' : ''; ?>>Israel</option>
                        <option value="Italia" <?php echo ($pais == 'Italia') ? 'selected' : ''; ?>>Italia</option>
                        <option value="Jamaica" <?php echo ($pais == 'Jamaica') ? 'selected' : ''; ?>>Jamaica</option>
                        <option value="Japón" <?php echo ($pais == 'Japón') ? 'selected' : ''; ?>>Japón</option>
                        <option value="Jordania" <?php echo ($pais == 'Jordania') ? 'selected' : ''; ?>>Jordania</option>
                        <option value="Kazajistán" <?php echo ($pais == 'Kazajistán') ? 'selected' : ''; ?>>Kazajistán</option>
                        <option value="Kenia" <?php echo ($pais == 'Kenia') ? 'selected' : ''; ?>>Kenia</option>
                        <option value="Kirguizistán" <?php echo ($pais == 'Kirguizistán') ? 'selected' : ''; ?>>Kirguizistán</option>
                        <option value="Kiribati" <?php echo ($pais == 'Kiribati') ? 'selected' : ''; ?>>Kiribati</option>
                        <option value="Kuwait" <?php echo ($pais == 'Kuwait') ? 'selected' : ''; ?>>Kuwait</option>
                        <option value="Laos" <?php echo ($pais == 'Laos') ? 'selected' : ''; ?>>Laos</option>
                        <option value="Lesotho" <?php echo ($pais == 'Lesotho') ? 'selected' : ''; ?>>Lesotho</option>
                        <option value="Letonia" <?php echo ($pais == 'Letonia') ? 'selected' : ''; ?>>Letonia</option>
                        <option value="Líbano" <?php echo ($pais == 'Líbano') ? 'selected' : ''; ?>>Líbano</option>
                        <option value="Liberia" <?php echo ($pais == 'Liberia') ? 'selected' : ''; ?>>Liberia</option>
                        <option value="Libia" <?php echo ($pais == 'Libia') ? 'selected' : ''; ?>>Libia</option>
                        <option value="Liechtenstein" <?php echo ($pais == 'Liechtenstein') ? 'selected' : ''; ?>>Liechtenstein</option>
                        <option value="Lituania" <?php echo ($pais == 'Lituania') ? 'selected' : ''; ?>>Lituania</option>
                        <option value="Luxemburgo" <?php echo ($pais == 'Luxemburgo') ? 'selected' : ''; ?>>Luxemburgo</option>
                        <option value="Macedonia, Ex-República Yugoslava de" <?php echo ($pais == 'Macedonia, Ex-República Yugoslava de') ? 'selected' : ''; ?>>Macedonia, Ex-República Yugoslava de</option>
                        <option value="Madagascar" <?php echo ($pais == 'Madagascar') ? 'selected' : ''; ?>>Madagascar</option>
                        <option value="Malasia" <?php echo ($pais == 'Malasia') ? 'selected' : ''; ?>>Malasia</option>
                        <option value="Malawi" <?php echo ($pais == 'Malawi') ? 'selected' : ''; ?>>Malawi</option>
                        <option value="Maldivas" <?php echo ($pais == 'Maldivas') ? 'selected' : ''; ?>>Maldivas</option>
                        <option value="Malí" <?php echo ($pais == 'Malí') ? 'selected' : ''; ?>>Malí</option>
                        <option value="Malta" <?php echo ($pais == 'Malta') ? 'selected' : ''; ?>>Malta</option>
                        <option value="Marruecos" <?php echo ($pais == 'Marruecos') ? 'selected' : ''; ?>>Marruecos</option>
                        <option value="Martinica" <?php echo ($pais == 'Martinica') ? 'selected' : ''; ?>>Martinica</option>
                        <option value="Mauricio" <?php echo ($pais == 'Mauricio') ? 'selected' : ''; ?>>Mauricio</option>
                        <option value="Mauritania" <?php echo ($pais == 'Mauritania') ? 'selected' : ''; ?>>Mauritania</option>
                        <option value="Mayotte" <?php echo ($pais == 'Mayotte') ? 'selected' : ''; ?>>Mayotte</option>
                        <option value="México" <?php echo ($pais == 'México') ? 'selected' : ''; ?>>México</option>
                        <option value="Micronesia" <?php echo ($pais == 'Micronesia') ? 'selected' : ''; ?>>Micronesia</option>
                        <option value="Moldavia" <?php echo ($pais == 'Moldavia') ? 'selected' : ''; ?>>Moldavia</option>
                        <option value="Mónaco" <?php echo ($pais == 'Mónaco') ? 'selected' : ''; ?>>Mónaco</option>
                        <option value="Mongolia" <?php echo ($pais == 'Mongolia') ? 'selected' : ''; ?>>Mongolia</option>
                        <option value="Montserrat" <?php echo ($pais == 'Montserrat') ? 'selected' : ''; ?>>Montserrat</option>
                        <option value="Mozambique" <?php echo ($pais == 'Mozambique') ? 'selected' : ''; ?>>Mozambique</option>
                        <option value="Namibia" <?php echo ($pais == 'Namibia') ? 'selected' : ''; ?>>Namibia</option>
                        <option value="Nauru" <?php echo ($pais == 'Nauru') ? 'selected' : ''; ?>>Nauru</option>
                        <option value="Nepal" <?php echo ($pais == 'Nepal') ? 'selected' : ''; ?>>Nepal</option>
                        <option value="Nicaragua" <?php echo ($pais == 'Nicaragua') ? 'selected' : ''; ?>>Nicaragua</option>
                        <option value="Níger" <?php echo ($pais == 'Níger') ? 'selected' : ''; ?>>Níger</option>
                        <option value="Nigeria" <?php echo ($pais == 'Nigeria') ? 'selected' : ''; ?>>Nigeria</option>
                        <option value="Niue" <?php echo ($pais == 'Niue') ? 'selected' : ''; ?>>Niue</option>
                        <option value="Norfolk" <?php echo ($pais == 'Norfolk') ? 'selected' : ''; ?>>Norfolk</option>
                        <option value="Noruega" <?php echo ($pais == 'Noruega') ? 'selected' : ''; ?>>Noruega</option>
                        <option value="Nueva Caledonia" <?php echo ($pais == 'Nueva Caledonia') ? 'selected' : ''; ?>>Nueva Caledonia</option>
                        <option value="Nueva Zelanda" <?php echo ($pais == 'Nueva Zelanda') ? 'selected' : ''; ?>>Nueva Zelanda</option>
                        <option value="Omán" <?php echo ($pais == 'Omán') ? 'selected' : ''; ?>>Omán</option>
                        <option value="Países Bajos" <?php echo ($pais == 'Países Bajos') ? 'selected' : ''; ?>>Países Bajos</option>
                        <option value="Panamá" <?php echo ($pais == 'Panamá') ? 'selected' : ''; ?>>Panamá</option>
                        <option value="Papúa Nueva Guinea" <?php echo ($pais == 'Papúa Nueva Guinea') ? 'selected' : ''; ?>>Papúa Nueva Guinea</option>
                        <option value="Paquistán" <?php echo ($pais == 'Paquistán') ? 'selected' : ''; ?>>Paquistán</option>
                        <option value="Paraguay" <?php echo ($pais == 'Paraguay') ? 'selected' : ''; ?>>Paraguay</option>
                        <option value="Perú" <?php echo ($pais == 'Perú') ? 'selected' : ''; ?>>Perú</option>
                        <option value="Pitcairn" <?php echo ($pais == 'Pitcairn') ? 'selected' : ''; ?>>Pitcairn</option>
                        <option value="Polinesia Francesa" <?php echo ($pais == 'Polinesia Francesa') ? 'selected' : ''; ?>>Polinesia Francesa</option>
                        <option value="Polonia" <?php echo ($pais == 'Polonia') ? 'selected' : ''; ?>>Polonia</option>
                        <option value="Portugal" <?php echo ($pais == 'Portugal') ? 'selected' : ''; ?>>Portugal</option>
                        <option value="Puerto Rico" <?php echo ($pais == 'Puerto Rico') ? 'selected' : ''; ?>>Puerto Rico</option>
                        <option value="Qatar" <?php echo ($pais == 'Qatar') ? 'selected' : ''; ?>>Qatar</option>
                        <option value="Reino Unido" <?php echo ($pais == 'Reino Unido') ? 'selected' : ''; ?>>Reino Unido</option>
                        <option value="República Centroafricana" <?php echo ($pais == 'República Centroafricana') ? 'selected' : ''; ?>>República Centroafricana</option>
                        <option value="República Checa" <?php echo ($pais == 'República Checa') ? 'selected' : ''; ?>>República Checa</option>
                        <option value="República de Sudáfrica" <?php echo ($pais == 'República de Sudáfrica') ? 'selected' : ''; ?>>República de Sudáfrica</option>
                        <option value="República Dominicana" <?php echo ($pais == 'República Dominicana') ? 'selected' : ''; ?>>República Dominicana</option>
                        <option value="República Eslovaca" <?php echo ($pais == 'República Eslovaca') ? 'selected' : ''; ?>>República Eslovaca</option>
                        <option value="Reunión" <?php echo ($pais == 'Reunión') ? 'selected' : ''; ?>>Reunión</option>
                        <option value="Ruanda" <?php echo ($pais == 'Ruanda') ? 'selected' : ''; ?>>Ruanda</option>
                        <option value="Rumania" <?php echo ($pais == 'Rumania') ? 'selected' : ''; ?>>Rumania</option>
                        <option value="Rusia" <?php echo ($pais == 'Rusia') ? 'selected' : ''; ?>>Rusia</option>
                        <option value="Sahara Occidental" <?php echo ($pais == 'Sahara Occidental') ? 'selected' : ''; ?>>Sahara Occidental</option>
                        <option value="Saint Kitts y Nevis" <?php echo ($pais == 'Saint Kitts y Nevis') ? 'selected' : ''; ?>>Saint Kitts y Nevis</option>
                        <option value="Samoa" <?php echo ($pais == 'Samoa') ? 'selected' : ''; ?>>Samoa</option>
                        <option value="Samoa Americana" <?php echo ($pais == 'Samoa Americana') ? 'selected' : ''; ?>>Samoa Americana</option>
                        <option value="San Marino" <?php echo ($pais == 'San Marino') ? 'selected' : ''; ?>>San Marino</option>
                        <option value="San Vicente y Granadinas" <?php echo ($pais == 'San Vicente y Granadinas') ? 'selected' : ''; ?>>San Vicente y Granadinas</option>
                        <option value="Santa Helena" <?php echo ($pais == 'Santa Helena') ? 'selected' : ''; ?>>Santa Helena</option>
                        <option value="Santa Lucía" <?php echo ($pais == 'Santa Lucía') ? 'selected' : ''; ?>>Santa Lucía</option>
                        <option value="Santo Tomé y Príncipe" <?php echo ($pais == 'Santo Tomé y Príncipe') ? 'selected' : ''; ?>>Santo Tomé y Príncipe</option>
                        <option value="Senegal" <?php echo ($pais == 'Senegal') ? 'selected' : ''; ?>>Senegal</option>
                        <option value="Seychelles" <?php echo ($pais == 'Seychelles') ? 'selected' : ''; ?>>Seychelles</option>
                        <option value="Sierra Leona" <?php echo ($pais == 'Sierra Leona') ? 'selected' : ''; ?>>Sierra Leona</option>
                        <option value="Singapur" <?php echo ($pais == 'Singapur') ? 'selected' : ''; ?>>Singapur</option>
                        <option value="Siria" <?php echo ($pais == 'Siria') ? 'selected' : ''; ?>>Siria</option>
                        <option value="Somalia" <?php echo ($pais == 'Somalia') ? 'selected' : ''; ?>>Somalia</option>
                        <option value="Sri Lanka" <?php echo ($pais == 'Sri Lanka') ? 'selected' : ''; ?>>Sri Lanka</option>
                        <option value="St Pierre y Miquelon" <?php echo ($pais == 'St Pierre y Miquelon') ? 'selected' : ''; ?>>St Pierre y Miquelon</option>
                        <option value="Suazilandia" <?php echo ($pais == 'Suazilandia') ? 'selected' : ''; ?>>Suazilandia</option>
                        <option value="Sudán" <?php echo ($pais == 'Sudán') ? 'selected' : ''; ?>>Sudán</option>
                        <option value="Suecia" <?php echo ($pais == 'Suecia') ? 'selected' : ''; ?>>Suecia</option>
                        <option value="Suiza" <?php echo ($pais == 'Suiza') ? 'selected' : ''; ?>>Suiza</option>
                        <option value="Surinam" <?php echo ($pais == 'Surinam') ? 'selected' : ''; ?>>Surinam</option>
                        <option value="Tailandia" <?php echo ($pais == 'Tailandia') ? 'selected' : ''; ?>>Tailandia</option>
                        <option value="Taiwán" <?php echo ($pais == 'Taiwán') ? 'selected' : ''; ?>>Taiwán</option>
                        <option value="Tanzania" <?php echo ($pais == 'Tanzania') ? 'selected' : ''; ?>>Tanzania</option>
                        <option value="Tayikistán" <?php echo ($pais == 'Tayikistán') ? 'selected' : ''; ?>>Tayikistán</option>
                        <option value="Territorios franceses del Sur" <?php echo ($pais == 'Territorios franceses del Sur') ? 'selected' : ''; ?>>Territorios franceses del Sur</option>
                        <option value="Timor Oriental" <?php echo ($pais == 'Timor Oriental') ? 'selected' : ''; ?>>Timor Oriental</option>
                        <option value="Togo" <?php echo ($pais == 'Togo') ? 'selected' : ''; ?>>Togo</option>
                        <option value="Tonga" <?php echo ($pais == 'Tonga') ? 'selected' : ''; ?>>Tonga</option>
                        <option value="Trinidad y Tobago" <?php echo ($pais == 'Trinidad y Tobago') ? 'selected' : ''; ?>>Trinidad y Tobago</option>
                        <option value="Túnez" <?php echo ($pais == 'Túnez') ? 'selected' : ''; ?>>Túnez</option>
                        <option value="Turkmenistán" <?php echo ($pais == 'Turkmenistán') ? 'selected' : ''; ?>>Turkmenistán</option>
                        <option value="Turquía" <?php echo ($pais == 'Turquía') ? 'selected' : ''; ?>>Turquía</option>
                        <option value="Tuvalu" <?php echo ($pais == 'Tuvalu') ? 'selected' : ''; ?>>Tuvalu</option>
                        <option value="Ucrania" <?php echo ($pais == 'Ucrania') ? 'selected' : ''; ?>>Ucrania</option>
                        <option value="Uganda" <?php echo ($pais == 'Uganda') ? 'selected' : ''; ?>>Uganda</option>
                        <option value="Uruguay" <?php echo ($pais == 'Uruguay') ? 'selected' : ''; ?>>Uruguay</option>
                        <option value="Uzbekistán" <?php echo ($pais == 'Uzbekistán') ? 'selected' : ''; ?>>Uzbekistán</option>
                        <option value="Vanuatu" <?php echo ($pais == 'Vanuatu') ? 'selected' : ''; ?>>Vanuatu</option>
                        <option value="Venezuela" <?php echo ($pais == 'Venezuela') ? 'selected' : ''; ?>>Venezuela</option>
                        <option value="Vietnam" <?php echo ($pais == 'Vietnam') ? 'selected' : ''; ?>>Vietnam</option>
                        <option value="Yemen" <?php echo ($pais == 'Yemen') ? 'selected' : ''; ?>>Yemen</option>
                        <option value="Yugoslavia" <?php echo ($pais == 'Yugoslavia') ? 'selected' : ''; ?>>Yugoslavia</option>
                        <option value="Zambia" <?php echo ($pais == 'Zambia') ? 'selected' : ''; ?>>Zambia</option>
                        <option value="Zimbabue" <?php echo ($pais == 'Zimbabue') ? 'selected' : ''; ?>>Zimbabue</option>
                    </select>
                    <label for='exampleFormControlInput1' class='form-label mt-3'>Disponible:</label>
                    <select name="disponible" id="disponibleSelect" class='form-control'>
                        <option value="0" <?php echo ($disponible == '0') ? 'selected' : ''; ?>>No disponible</option>
                        <option value="1" <?php echo ($disponible == '1') ? 'selected' : ''; ?>>Disponible</option>
                    </select>
                    <div id="equipoForm" <?php echo ($disponible == '1') ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                        <label for='exampleFormControlInput1' class='form-label mt-3'>Equipo:</label>
                        <select name="equipo" class='form-control'>
                        
                        <?php
                            $url_dame_equipos = 'http://iescristobaldemonroy.duckdns.org:81/USER10/NBA_Microservicios/services/mostrarEquipos.php';
                            
                            // Hacer la solicitud HTTP y obtener el XML como una cadena
                            $xmlString = file_get_contents($url_dame_equipos);

                            // Verificar si la solicitud fue exitosa
                            if ($xmlString === FALSE) {
                                die('Error al obtener el XML de readStudent.php');
                            }

                            // Procesar el XML con SimpleXML
                            $xml = simplexml_load_string($xmlString);

                            foreach ($xml->equipo as $equipo) {
                            
                        ?>    
                            <option value="<?php echo $equipo->idequipo; ?>" <?php echo ($idequipo == $equipo->idequipo) ? 'selected' : ''; ?>><?php echo $equipo->nombre; ?></option>
                        <?php   
                            }
                        ?>
                        
                        </select>
                    </div>
                    <input type='submit' class='btn btn-primary mt-3 w-100' value='Enviar'>
                </form>
            </div>
        </div>

        <!-- IMAGEN -->

        <img src="img/imagenAbajoModificar.jpg" alt="Imagen de fondo" class="img-fluid w-100" style="object-fit: cover;">
    </body>
</html>

<script>
    let select = document.getElementById('disponibleSelect');
    let equipoForm = document.getElementById('equipoForm');

    // Lógica para mostrar o no el formulario de equipo
    function actualizarEquipoForm() {
        if (select.value === '1') {
            equipoForm.style.display = 'block';
        } else {
            equipoForm.style.display = 'none';
        }
    }

    // Llamada inicial para verificar el estado al cargar la página
    actualizarEquipoForm();

    // Evento change para el elemento select
    select.addEventListener('change', actualizarEquipoForm);
</script>
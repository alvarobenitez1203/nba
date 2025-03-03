<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NBA | Alta equipo</title>
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
                            <a class="nav-link dropdown-toggle fs-4 active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <b>Equipos</b>
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

        <!-- TÍTULO INTRODUCCIÓN PÁGINA -->

        <h1 class="text-center mb-5 bg-primary text-white p-5">ALTA EQUIPO</h1>

        <?php 

            $alert = "";

            function mostrarAlerta($alert) {
                echo $alert;
            }


            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['altaequipo']) && $_POST['altaequipo'] === 'altaequipo') {

                $nombre = urlencode($_POST['nombre']);
                $pais = urlencode($_POST['pais']);
                $annofundacion = urlencode($_POST['anno']);
                $conferencia = urlencode($_POST['conferencia']);

                $url_dame_comprobarequipo = 'http://iescristobaldemonroy.duckdns.org:81/USER10/NBA_Microservicios/services/comprobarNombreEquipo.php?nombre='.$nombre;

                // Hacer la solicitud HTTP y obtener el XML como una cadena
                $xmlString = file_get_contents($url_dame_comprobarequipo);

                // Verificar si la solicitud fue exitosa
                if ($xmlString === FALSE) {
                    die('Error al obtener el XML de readStudent.php');
                }

                // Procesar el XML con SimpleXML
                $xml = simplexml_load_string($xmlString);

                if ($xml->status == 'OK') {
                        $imagenDir = 'img/equipos/';
                        $imagenNombre = urldecode($nombre) . '.png';
                        $imagenTmpName = $_FILES['logoEquipo']['tmp_name'];
            
                        if (getimagesize($imagenTmpName)[0] == getimagesize($imagenTmpName)[1]) {
                            $extensionValida = pathinfo($imagenNombre, PATHINFO_EXTENSION);
            
                            if (strtolower($extensionValida) == 'png') {
                                move_uploaded_file($imagenTmpName, $imagenDir . $imagenNombre);
            
                                $url_dame_crearequipos = 'http://iescristobaldemonroy.duckdns.org:81/USER10/NBA_Microservicios/services/crearEquipos.php?nombre='. $nombre . '&pais=' . $pais . '&annofundacion=' . $annofundacion . '&conferencia=' . $conferencia;

                                // Hacer la solicitud HTTP y obtener el XML como una cadena
                                $xmlString = file_get_contents($url_dame_crearequipos);

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
                                } else {
                                    $alert = "<div class='container alert alert-danger alert-dismissible fade show w-75' role='alert'>
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
                    $alert = "<div class='container alert alert-danger alert-dismissible fade show w-75' role='alert'>
                        $xml->description
                    </div>";

                    mostrarAlerta($alert);
                }
            }
        ?>

        <!-- FORMULARIO -->

        <div class="container-fluid">
            <div class="row mt-3 mb-5 d-flex flex-column align-items-center">
                <form method='post' action='altaEquipo.php' class='w-75' enctype='multipart/form-data'>
                    <input type="hidden" name="altaequipo" value="altaequipo">
                    <label for='exampleFormControlInput1' class='form-label'>Nombre:</label>
                    <input type='text' name='nombre' class='form-control' id='exampleFormControlInput1' placeholder='Ingrese el nombre...' required>
                    <label for='exampleFormControlInput1' class='form-label mt-3'>País:</label>
                    <select name="pais" class='form-control'>
                        <option value="Afganistán">Afganistán</option>
                        <option value="Albania">Albania</option>
                        <option value="Alemania">Alemania</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguila">Anguila</option>
                        <option value="Antártida">Antártida</option>
                        <option value="Antigua y Barbuda">Antigua y Barbuda</option>
                        <option value="Antillas Holandesas">Antillas Holandesas</option>
                        <option value="Arabia Saudí">Arabia Saudí</option>
                        <option value="Argelia">Argelia</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaiyán">Azerbaiyán</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrein">Bahrein</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Bélgica">Bélgica</option>
                        <option value="Belice">Belice</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermudas">Bermudas</option>
                        <option value="Bielorrusia">Bielorrusia</option>
                        <option value="Birmania">Birmania</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bosnia y Herzegovina">Bosnia y Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Brasil">Brasil</option>
                        <option value="Brunei">Brunei</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Bután">Bután</option>
                        <option value="Cabo Verde">Cabo Verde</option>
                        <option value="Camboya">Camboya</option>
                        <option value="Camerún">Camerún</option>
                        <option value="Canadá">Canadá</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Chipre">Chipre</option>
                        <option value="Ciudad del Vaticano (Santa Sede)">Ciudad del Vaticano (Santa Sede)</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comores">Comores</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo, República Democrática del">Congo, República Democrática del</option>
                        <option value="Corea">Corea</option>
                        <option value="Corea del Norte">Corea del Norte</option>
                        <option value="Costa de Marfíl">Costa de Marfíl</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Croacia (Hrvatska)">Croacia (Hrvatska)</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Dinamarca">Dinamarca</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egipto">Egipto</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Emiratos Árabes Unidos">Emiratos Árabes Unidos</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Eslovenia">Eslovenia</option>
                        <option value="España">España</option>
                        <option value="Estados Unidos" selected>Estados Unidos</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Etiopía">Etiopía</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Filipinas">Filipinas</option>
                        <option value="Finlandia">Finlandia</option>
                        <option value="Francia">Francia</option>
                        <option value="Gabón">Gabón</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Granada">Granada</option>
                        <option value="Grecia">Grecia</option>
                        <option value="Groenlandia">Groenlandia</option>
                        <option value="Guadalupe">Guadalupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guayana">Guayana</option>
                        <option value="Guayana Francesa">Guayana Francesa</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea Ecuatorial">Guinea Ecuatorial</option>
                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                        <option value="Haití">Haití</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hungría">Hungría</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Irak">Irak</option>
                        <option value="Irán">Irán</option>
                        <option value="Irlanda">Irlanda</option>
                        <option value="Isla Bouvet">Isla Bouvet</option>
                        <option value="Isla de Christmas">Isla de Christmas</option>
                        <option value="Islandia">Islandia</option>
                        <option value="Islas Caimán">Islas Caimán</option>
                        <option value="Islas Cook">Islas Cook</option>
                        <option value="Islas de Cocos o Keeling">Islas de Cocos o Keeling</option>
                        <option value="Islas Faroe">Islas Faroe</option>
                        <option value="Islas Heard y McDonald">Islas Heard y McDonald</option>
                        <option value="Islas Malvinas">Islas Malvinas</option>
                        <option value="Islas Marianas del Norte">Islas Marianas del Norte</option>
                        <option value="Islas Marshall">Islas Marshall</option>
                        <option value="Islas menores de Estados Unidos">Islas menores de Estados Unidos</option>
                        <option value="Islas Palau">Islas Palau</option>
                        <option value="Islas Salomón">Islas Salomón</option>
                        <option value="Islas Svalbard y Jan Mayen">Islas Svalbard y Jan Mayen</option>
                        <option value="Islas Tokelau">Islas Tokelau</option>
                        <option value="Islas Turks y Caicos">Islas Turks y Caicos</option>
                        <option value="Islas Vírgenes (EEUU)">Islas Vírgenes (EEUU)</option>
                        <option value="Islas Vírgenes (Reino Unido)">Islas Vírgenes (Reino Unido)</option>
                        <option value="Islas Wallis y Futuna">Islas Wallis y Futuna</option>
                        <option value="Israel">Israel</option>
                        <option value="Italia">Italia</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japón">Japón</option>
                        <option value="Jordania">Jordania</option>
                        <option value="Kazajistán">Kazajistán</option>
                        <option value="Kenia">Kenia</option>
                        <option value="Kirguizistán">Kirguizistán</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Laos">Laos</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Letonia">Letonia</option>
                        <option value="Líbano">Líbano</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libia">Libia</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lituania">Lituania</option>
                        <option value="Luxemburgo">Luxemburgo</option>
                        <option value="Macedonia, Ex-República Yugoslava de">Macedonia, Ex-República Yugoslava de</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malasia">Malasia</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Maldivas">Maldivas</option>
                        <option value="Malí">Malí</option>
                        <option value="Malta">Malta</option>
                        <option value="Marruecos">Marruecos</option>
                        <option value="Martinica">Martinica</option>
                        <option value="Mauricio">Mauricio</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="México">México</option>
                        <option value="Micronesia">Micronesia</option>
                        <option value="Moldavia">Moldavia</option>
                        <option value="Mónaco">Mónaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Níger">Níger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk">Norfolk</option>
                        <option value="Noruega">Noruega</option>
                        <option value="Nueva Caledonia">Nueva Caledonia</option>
                        <option value="Nueva Zelanda">Nueva Zelanda</option>
                        <option value="Omán">Omán</option>
                        <option value="Países Bajos">Países Bajos</option>
                        <option value="Panamá">Panamá</option>
                        <option value="Papúa Nueva Guinea">Papúa Nueva Guinea</option>
                        <option value="Paquistán">Paquistán</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Perú">Perú</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Polinesia Francesa">Polinesia Francesa</option>
                        <option value="Polonia">Polonia</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Reino Unido">Reino Unido</option>
                        <option value="República Centroafricana">República Centroafricana</option>
                        <option value="República Checa">República Checa</option>
                        <option value="República de Sudáfrica">República de Sudáfrica</option>
                        <option value="República Dominicana">República Dominicana</option>
                        <option value="República Eslovaca">República Eslovaca</option>
                        <option value="Reunión">Reunión</option>
                        <option value="Ruanda">Ruanda</option>
                        <option value="Rumania">Rumania</option>
                        <option value="Rusia">Rusia</option>
                        <option value="Sahara Occidental">Sahara Occidental</option>
                        <option value="Saint Kitts y Nevis">Saint Kitts y Nevis</option>
                        <option value="Samoa">Samoa</option>
                        <option value="Samoa Americana">Samoa Americana</option>
                        <option value="San Marino">San Marino</option>
                        <option value="San Vicente y Granadinas">San Vicente y Granadinas</option>
                        <option value="Santa Helena">Santa Helena</option>
                        <option value="Santa Lucía">Santa Lucía</option>
                        <option value="Santo Tomé y Príncipe">Santo Tomé y Príncipe</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra Leona">Sierra Leona</option>
                        <option value="Singapur">Singapur</option>
                        <option value="Siria">Siria</option>
                        <option value="Somalia">Somalia</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="St Pierre y Miquelon">St Pierre y Miquelon</option>
                        <option value="Suazilandia">Suazilandia</option>
                        <option value="Sudán">Sudán</option>
                        <option value="Suecia">Suecia</option>
                        <option value="Suiza">Suiza</option>
                        <option value="Surinam">Surinam</option>
                        <option value="Tailandia">Tailandia</option>
                        <option value="Taiwán">Taiwán</option>
                        <option value="Tanzania">Tanzania</option>
                        <option value="Tayikistán">Tayikistán</option>
                        <option value="Territorios franceses del Sur">Territorios franceses del Sur</option>
                        <option value="Timor Oriental">Timor Oriental</option>
                        <option value="Togo">Togo</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad y Tobago">Trinidad y Tobago</option>
                        <option value="Túnez">Túnez</option>
                        <option value="Turkmenistán">Turkmenistán</option>
                        <option value="Turquía">Turquía</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Ucrania">Ucrania</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistán">Uzbekistán</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Vietnam">Vietnam</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Yugoslavia">Yugoslavia</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabue">Zimbabue</option>
                    </select>
                    <label for='exampleFormControlInput1' class='form-label mt-3'>Año de fundación:</label>
                    <input type='number' name='anno' class='form-control' id='exampleFormControlInput1' min="1940" max="2024" placeholder='Ingrese el año de fundación...' required>
                    <label for='exampleFormControlInput1' class='form-label mt-3'>Conferencia:</label>
                    <select name="conferencia" class='form-control'>
                        <option value="Este">Conferencia Este</option>
                        <option value="Oeste">Conferencia Oeste</option>
                    </select>
                    <label for='exampleFormControlInput1' class='form-label mt-3'>Logo del equipo:</label>
                    <input type='file' name='logoEquipo' class='form-control' id='exampleFormControlInput1' required>
                    <input type='submit' class='btn btn-primary mt-3 w-100' value='Enviar'>
                </form>
            </div>
        </div>

        <!-- IMAGEN -->

        <img src="img/imagenAbajoAlta.jpeg" alt="Imagen de fondo" class="img-fluid w-100" style="object-fit: cover;">
    </body>
</html>
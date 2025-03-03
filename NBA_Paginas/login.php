<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>NBA | Inicio Sesión</title>
    <link rel="icon" href="img/icono.png">
    <!-- URL para utilizar framework Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="style/custom.css">
    <script src="js/custom.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 g-0">
                <img src="img/imagenLoginRegistro.jpg" alt="Imagen de fondo" class="img-fluid w-100" style="object-fit: cover;">
            </div>
            <div class="col-6 g-0">
                <?php
                    $alert = "";

                    function mostrarAlerta($alert) {
                        echo $alert;
                    }

                    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['iniciarsesion']) && $_GET['iniciarsesion'] === 'iniciarsesion') {

                        $email = urlencode($_GET['email']);
                        $contraseña = urlencode($_GET['contraseña']);

                        $url_dame_iniciosesion = 'http://iescristobaldemonroy.duckdns.org:81/USER10/NBA_Microservicios/services/iniciarSesion.php?email=' . $email . '&contraseña=' . $contraseña;

                        // Hacer la solicitud HTTP y obtener el XML como una cadena
                        $xmlString = file_get_contents($url_dame_iniciosesion);

                        // Verificar si la solicitud fue exitosa
                        if ($xmlString === FALSE) {
                            die('Error al obtener el XML de readStudent.php');
                        }

                        // Procesar el XML con SimpleXML
                        $xml = simplexml_load_string($xmlString);

                        if ($xml->status == 'OK') {
                            session_start();

                            $nombre = (string)$xml->description;
                            $_SESSION['usuario'] = $nombre;
                            $_SESSION['email'] = urldecode($email);

                            header("Location: index.php");
                            exit();
                        } else {
                            $alert = "<div class='alert alert-danger' role='alert'>
                            $xml->description
                        </div>";
                        }
                    }
                                        
                ?>

                <div class='m-3 mt-5 d-flex flex-column align-items-center'>
                    <h1 class='text-center mt-5 mb-5'><b>Inicio sesión</b></h1>

                        <?php mostrarAlerta($alert) ?>

                    <form method='get' action='login.php' class='w-75'>
                        <input type="hidden" name="iniciarsesion" value="iniciarsesion">
                        <label for='exampleFormControlInput1' class='form-label'>Correo electrónico:</label>
                        <input type='email' name='email' class='form-control' id='exampleFormControlInput1' placeholder='Correo electrónico...'>
                        <label for='exampleFormControlInput1' class='form-label mt-3'>Contraseña:</label>
                        <input type='password' name='contraseña' class='form-control' id='exampleFormControlInput1' placeholder='Contraseña...'>
                        <input type='submit' class='btn btn-primary mt-3 w-100' value='Iniciar sesión'>
                    </form>
                    <p class='mt-3'>¿No tienes cuenta? <a href='registro.php'>Regístrate aquí</a>.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
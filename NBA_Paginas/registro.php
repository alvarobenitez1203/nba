<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>NBA | Registro</title>
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
                <?php

                    $alert = "";

                    function mostrarAlerta($alert) {
                        echo $alert;
                    }

                    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['registrar']) && $_GET['registrar'] === 'registrar') {

                        $nombre = urlencode($_GET['nombre']);
                        $email = urlencode($_GET['email']);
                        $contraseña = urlencode($_GET['contraseña']);
                        $telefono = urlencode($_GET['telefono']);

                        $url_dame_registro = 'http://iescristobaldemonroy.duckdns.org:81/USER10/NBA_Microservicios/services/registrarUsuario.php?nombre='. $nombre . '&email=' . $email . '&contraseña=' . $contraseña . '&telefono=' .$telefono;

                        // Hacer la solicitud HTTP y obtener el XML como una cadena
                        $xmlString = file_get_contents($url_dame_registro);

                        // Verificar si la solicitud fue exitosa
                        if ($xmlString === FALSE) {
                            die('Error al obtener el XML de readStudent.php');
                        }

                        // Procesar el XML con SimpleXML
                        $xml = simplexml_load_string($xmlString);

                        if ($xml->status == 'OK') {
                            session_start();
                            $_SESSION['usuario'] = urldecode($nombre);
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
                    <h1 class='text-center mt-5 mb-5'><b>Registro</b></h1>

                        <?php mostrarAlerta($alert) ?>

                    <form method='get' action='registro.php' class='w-75'>
                        <input type="hidden" name="registrar" value="registrar">
                        <label for='exampleFormControlInput1' class='form-label'>Nombre:</label>
                        <input type='text' name='nombre' class='form-control' id='exampleFormControlInput1' placeholder='Nombre...' required>
                        <label for='exampleFormControlInput1' class='form-label mt-3'>Correo electrónico:</label>
                        <input type='email' name='email' class='form-control' id='exampleFormControlInput1' placeholder='Correo electrónico...' required>
                        <label for='exampleFormControlInput1' class='form-label mt-3'>Contraseña:</label>
                        <input type='password' name='contraseña' class='form-control' id='exampleFormControlInput1' placeholder='Contraseña...' minlength='8' maxlenght='15' required>
                        <label for='exampleFormControlInput1' class='form-label mt-3'>Teléfono:</label>
                        <input type='text' name='telefono' class='form-control' id='exampleFormControlInput1' placeholder='Teléfono...' pattern='[0-9]{9}' title='Ingresa un número de teléfono válido (9 dígitos)' required>
                        <input type='submit' class='btn btn-primary mt-3 w-100' value='Registrar'>
                    </form>
                    <p class='mt-3'>¿Ya tienes cuenta? <a href='login.php'>Inicia sesión aquí</a>.</p>
                </div>";
            </div>
            <div class="col-6 g-0">
                <img src="img/imagenLoginRegistro.jpg" alt="Imagen de fondo" class="img-fluid w-100" style="object-fit: cover;">
            </div>
        </div>
    </div>
</body>
</html>
<?php
require '../db/db.php';
require '../utils/utilities.php';

try {
    $nombre = Utilities::validateMandatoryParameter($_GET, 'nombre');
    $email = Utilities::validateMandatoryParameter($_GET, 'email');
    $contraseña = Utilities::validateMandatoryParameter($_GET, 'contraseña');
    $telefono = Utilities::validateMandatoryParameter($_GET, 'telefono');

    $database = new Database();

    $conn = $database->getConnection();

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $responseXML = Utilities::generateResponseXML('Error', 'Ya existe un usuario con este email, si quieres iniciar sesión puedes hacerlo.');
    
        header('Content-Type: application/xml');
        echo $responseXML->asXML();
    } else {

        $sql = $conn->prepare("INSERT INTO usuarios (nombre, email, contrasenna, telefono) VALUES (?, ?, ?, ?)");
        $sql->bind_param("ssss", $nombre, $email, $contraseña, $telefono);

        if ($sql->execute()) {
            $responseXML = Utilities::generateResponseXML('OK', 'Usuario insertado con éxito.');
    
            header('Content-Type: application/xml');
            echo $responseXML->asXML();
        } else {
            throw new Exception("Error al insertar el curso: " . $sql->error);
        }

        $sql->close();
    }

    $stmt->close();
} catch (Exception $e) {
    $responseXML = Utilities::generateResponseXML('ERROR', $e->getMessage());

    header('Content-Type: application/xml');
    echo $responseXML->asXML();
}
?>
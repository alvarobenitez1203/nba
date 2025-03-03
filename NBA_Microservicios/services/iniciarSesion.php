<?php
require '../db/db.php';
require '../utils/utilities.php';

try {
    $email = Utilities::validateMandatoryParameter($_GET, 'email');
    $contraseña = Utilities::validateMandatoryParameter($_GET, 'contraseña');

    $database = new Database();

    $conn = $database->getConnection();

    $sql = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND contrasenna = ?");
    $sql->bind_param("ss", $email, $contraseña);
    $sql->execute();

    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
    
        $responseXML = Utilities::generateResponseXML('OK', $nombre);
        
        header('Content-Type: application/xml');
        echo $responseXML->asXML();
    } else {
        $responseXML = Utilities::generateResponseXML('Error', 'No existe un usuario con este email o contraseña.');
    
        header('Content-Type: application/xml');
        echo $responseXML->asXML();
    }
    
} catch (Exception $e) {
    $responseXML = Utilities::generateResponseXML('ERROR', $e->getMessage());

    header('Content-Type: application/xml');
    echo $responseXML->asXML();
}
?>
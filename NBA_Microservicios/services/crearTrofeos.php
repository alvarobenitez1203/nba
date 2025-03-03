<?php
require '../db/db.php';
require '../utils/utilities.php';

try {
    $nombre = Utilities::validateMandatoryParameter($_GET, 'nombre');
    $tipo = Utilities::validateMandatoryParameter($_GET, 'tipo');
    
    $database = new Database();

    $conn = $database->getConnection();

    $sql = $conn->prepare("INSERT INTO trofeos (nombre, tipo) VALUES (?, ?)");

    $sql->bind_param("ss", $nombre, $tipo);

    if ($sql->execute()) {
        $responseXML = Utilities::generateResponseXML('OK', 'Trofeo insertado con éxito.');

        header('Content-Type: application/xml');
        echo $responseXML->asXML();
    } else {
        throw new Exception("Error al insertar el jugador: " . $sql->error);
    }

    $sql->close();
} catch (Exception $e) {

    $responseXML = Utilities::generateResponseXML('ERROR', $e->getMessage());   
   
    $respuesta=$responseXML->asXML();
    $xml = simplexml_load_string($respuesta);
    echo "<div><h2>{$xml->description}</h2></div>";
    
}
?>
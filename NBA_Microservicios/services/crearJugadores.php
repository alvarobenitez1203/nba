<?php
require '../db/db.php';
require '../utils/utilities.php';

try {
    $database = new Database();
    $conn = $database->getConnection();

    $idequipo = Utilities::validateMandatoryParameter($_GET, 'idequipo');
    
    $stmtCount = $conn->prepare("SELECT COUNT(*) as totalJugadores FROM jugadores WHERE idequipo = ?");
    $stmtCount->bind_param("s", $idequipo);
    $stmtCount->execute();
    
    $resultCount = $stmtCount->get_result();
    $rowCount = $resultCount->fetch_assoc();
    $totalJugadores = $rowCount['totalJugadores'];
    
    $stmtCount->close();

    if ($totalJugadores < 15) {
        $nombre = Utilities::validateMandatoryParameter($_GET, 'nombre');
        $edad = Utilities::validateMandatoryParameter($_GET, 'edad');
        $posicion = isset($_GET['posicion']) ? $_GET['posicion'] : null;
        $nacionalidad = isset($_GET['nacionalidad']) ? $_GET['nacionalidad'] : null;
        $disponible = Utilities::validateMandatoryParameter($_GET, 'disponible');

        $sql = $conn->prepare("INSERT INTO jugadores (nombre, edad, posicion, nacionalidad, disponible, idequipo) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bind_param("ssssss", $nombre, $edad, $posicion, $nacionalidad, $disponible, $idequipo);

        if ($sql->execute()) {
            $responseXML = Utilities::generateResponseXML('OK', 'Jugador insertado con éxito.');

            header('Content-Type: application/xml');
            echo $responseXML->asXML();
        } else {
            throw new Exception("Error al insertar el jugador: " . $sql->error);
        }

        $sql->close();
    } else {
        $responseXML = Utilities::generateResponseXML('ERROR', 'El equipo ya tiene 15 jugadores, no se puede agregar más.');

        header('Content-Type: application/xml');
        echo $responseXML->asXML();
    }
} catch (Exception $e) {

    $responseXML = Utilities::generateResponseXML('ERROR', $e->getMessage());   
   
    $respuesta=$responseXML->asXML();
    $xml = simplexml_load_string($respuesta);
    echo "<div><h2>{$xml->description}</h2></div>";
    
}
?>
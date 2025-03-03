<?php
require '../db/db.php';
require '../utils/utilities.php';

try {
    $database = new Database();

    $conn = $database->getConnection();
    
    $stmtCount = $conn->prepare("SELECT COUNT(*) as totalEquipos FROM equipos");
    $stmtCount->execute();
    
    $resultCount = $stmtCount->get_result();
    $rowCount = $resultCount->fetch_assoc();
    $totalEquipos = $rowCount['totalEquipos'];
    
    $stmtCount->close();

    if ($totalEquipos < 30) {
        $nombre = Utilities::validateMandatoryParameter($_GET, 'nombre');
        $pais = Utilities::validateMandatoryParameter($_GET, 'pais');
        $annofundacion = Utilities::validateMandatoryParameter($_GET, 'annofundacion');
        $conferencia = Utilities::validateMandatoryParameter($_GET, 'conferencia');

        $sql = $conn->prepare("INSERT INTO equipos (nombre, pais, annofundacion, conferencia) VALUES (?, ?, ?, ?)");
        $sql->bind_param("ssss", $nombre, $pais, $annofundacion, $conferencia);

        if ($sql->execute()) {
            $responseXML = Utilities::generateResponseXML('OK', 'Equipo insertado con éxito');

            header('Content-Type: application/xml');
            echo $responseXML->asXML();
        } else {
            throw new Exception("Error al insertar el equipo: " . $sql->error);
        }

        $sql->close();
    } else {
        $responseXML = Utilities::generateResponseXML('ERROR', 'Ya hay 30 equipos registrados, no se puede agregar más.');

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
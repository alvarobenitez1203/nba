<?php
require '../db/db.php';
require '../utils/utilities.php';

try {
    $idequipo = Utilities::validateMandatoryParameter($_GET, 'idequipo');
    $nombre = Utilities::validateMandatoryParameter($_GET, 'nombre');
    $pais = Utilities::validateMandatoryParameter($_GET, 'pais');
    $annofundacion= Utilities::validateMandatoryParameter($_GET, 'annofundacion');
    $conferencia = Utilities::validateMandatoryParameter($_GET, 'conferencia');

    $database = new Database();
    $conn = $database->getConnection();

    $sql = $conn->prepare("UPDATE equipos SET nombre = ?, pais = ?, annofundacion = ?, conferencia=? WHERE idequipo = ?");
    $sql->bind_param("sssss", $nombre, $pais, $annofundacion, $conferencia, $idequipo);

    if ($sql->execute()) {
        $responseXML = Utilities::generateResponseXML('OK', 'Equipo actualizado con éxito.');

        header('Content-Type: application/xml');
        echo $responseXML->asXML();
    } else {
        throw new Exception("Error al actualizar el equipo: " . $sql->error);
    }

    $sql->close();
} catch (Exception $e) {
    $responseXML = Utilities::generateResponseXML('ERROR', $e->getMessage());

    $respuesta=$responseXML->asXML();
    $xml = simplexml_load_string($respuesta);
    echo "<div><h2>{$xml->description}</h2></div>";
}
?>
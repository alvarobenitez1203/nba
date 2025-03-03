<?php
require '../db/db.php';
require '../utils/utilities.php';

try {
    $idtrofeo = Utilities::validateMandatoryParameter($_GET, 'idtrofeo');
    $nombre = Utilities::validateMandatoryParameter($_GET, 'nombre');
    $tipo = Utilities::validateMandatoryParameter($_GET, 'tipo');

    $database = new Database();
    $conn = $database->getConnection();

    $sql = $conn->prepare("UPDATE trofeos SET nombre = ?, tipo = ? WHERE idtrofeo = ?");
    $sql->bind_param("sss", $nombre, $tipo, $idtrofeo);

    if ($sql->execute()) {
        $responseXML = Utilities::generateResponseXML('OK', 'Trofeo actualizado con éxito.');

        header('Content-Type: application/xml');
        echo $responseXML->asXML();
    } else {
        throw new Exception("Error al actualizar el equipo: " . $sql->error);
    }

    // Cerrar la consulta preparada
    $sql->close();
} catch (Exception $e) {
    $responseXML = Utilities::generateResponseXML('ERROR', $e->getMessage());

    $respuesta=$responseXML->asXML();
    $xml = simplexml_load_string($respuesta);
    echo "<div><h2>{$xml->description}</h2></div>";
}
?>
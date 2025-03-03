<?php
require '../db/db.php';
require '../utils/utilities.php';

try {
    $idjugador = Utilities::validateMandatoryParameter($_GET, 'idjugador');
    $nombre = Utilities::validateMandatoryParameter($_GET, 'nombre');
    $edad = Utilities::validateMandatoryParameter($_GET, 'edad');
    $posicion= isset($_GET['posicion']) ? $_GET['posicion'] : null;
    $nacionalidad = isset($_GET['nacionalidad']) ? $_GET['nacionalidad'] : null;
    $disponible = Utilities::validateMandatoryParameter($_GET, 'disponible');
    $idequipo = Utilities::validateMandatoryParameter($_GET, 'idequipo');

    $database = new Database();
    $conn = $database->getConnection();

    $sql = $conn->prepare("UPDATE jugadores SET nombre = ?, edad = ?, posicion = ?, nacionalidad=?, disponible=?, idequipo=? WHERE idjugador = ?");
    $sql->bind_param("sssssss", $nombre, $edad, $posicion, $nacionalidad, $disponible, $idequipo, $idjugador);

    if ($sql->execute()) {
        $responseXML = Utilities::generateResponseXML('OK', 'Jugador actualizado con éxito.');

        header('Content-Type: application/xml');
        echo $responseXML->asXML();

    } else {
        throw new Exception("Error al actualizar el artista: " . $sql->error);
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
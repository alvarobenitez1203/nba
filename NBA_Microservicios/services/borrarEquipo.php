<?php
require '../db/db.php';
require '../utils/utilities.php';

try {

    if (!isset($_GET['idequipo'])) {
        throw new Exception("Error. No se encontró idequipo");
    }

    $idequipo= $_GET['idequipo'];

    $database = new Database();
    $conn = $database->getConnection();

    $result = $conn->query("SELECT COUNT(*) as num_equipos FROM equipos");
    $resNum = $result->fetch_assoc();
    $numEquipos = $resNum['num_equipos'];

    if ($numEquipos > 26) {
        $stmt1 = $conn->prepare("DELETE FROM trofeos_equipos WHERE idequipo = ?");
        $stmt1->bind_param("s", $idequipo);
        $stmt1->execute();
        $stmt1->close();

        $stmt2 = $conn->prepare("UPDATE jugadores SET idequipo = null, disponible = 0 WHERE idequipo = ?");
        $stmt2->bind_param("s", $idequipo);
        $stmt2->execute();
        $stmt2->close();

        $stmt3 = $conn->prepare("DELETE FROM equipos WHERE idequipo = ?");
        $stmt3->bind_param("s", $idequipo);
        $stmt3->execute();
        $stmt3->close();

        $responseXML = Utilities::generateResponseXML('OK', 'Equipo borrado con éxito');

        header('Content-Type: application/xml');
        echo $responseXML->asXML();
    }

    $result->close();
    $conn->close();
} catch (Exception $e) {
    // En caso de error, crear respuesta XML con detalles del error
    $responseXML = Utilities::generateResponseXML('ERROR', $e->getMessage());
    header('Content-Type: application/xml');
    echo $responseXML->asXML();
}
?>
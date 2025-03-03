<?php
require '../db/db.php';
require '../utils/utilities.php';

try {
    $nombre = Utilities::validateMandatoryParameter($_GET, 'nombre');
    $idEquipo = isset($_GET['idE']) ? $_GET['idE'] : null;

    $database = new Database();
    $conn = $database->getConnection();

    if ($idEquipo) {
        $sql = $conn->prepare("SELECT COUNT(*) as total FROM equipos WHERE nombre = ? AND idEquipo != ?");
        $sql->bind_param("ss", $nombre, $idEquipo);
    } else {
        $sql = $conn->prepare("SELECT COUNT(*) as total FROM equipos WHERE nombre = ?");
        $sql->bind_param("s", $nombre);
    }

    $sql->execute();
    $result = $sql->get_result();

    $row = $result->fetch_assoc();
    $total = $row['total'];

    $sql->close();

    if ($total > 0) {
        $responseXML = Utilities::generateResponseXML('ERROR', 'El nombre del equipo ya existe.');
    } else {
        $responseXML = Utilities::generateResponseXML('OK', 'El nombre del equipo está disponible.');
    }

    header('Content-Type: application/xml');
    echo $responseXML->asXML();
    
} catch (Exception $e) {
    $responseXML = Utilities::generateResponseXML('ERROR', $e->getMessage());

    header('Content-Type: application/xml');
    echo $responseXML->asXML();
}
?>

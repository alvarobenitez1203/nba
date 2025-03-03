<?php
require '../db/db.php';
require '../utils/utilities.php';

try {
    $nombre = Utilities::validateMandatoryParameter($_GET, 'nombre');
    $idT = isset($_GET['idT']) ? $_GET['idT'] : null;

    $database = new Database();
    $conn = $database->getConnection();

    if ($idT) {
        $sql = $conn->prepare("SELECT COUNT(*) as total FROM trofeos WHERE nombre = ? AND idtrofeo != ?");
        $sql->bind_param("ss", $nombre, $idT);
    } else {
        $sql = $conn->prepare("SELECT COUNT(*) as total FROM trofeos WHERE nombre = ?");
        $sql->bind_param("s", $nombre);
    }

    $sql->execute();
    $result = $sql->get_result();

    $row = $result->fetch_assoc();
    $total = $row['total'];

    $sql->close();

    if ($total > 0) {
        $responseXML = Utilities::generateResponseXML('ERROR', 'El nombre del trofeo ya existe.');
    } else {
        $responseXML = Utilities::generateResponseXML('OK', 'El nombre del trofeo está disponible.');
    }

    header('Content-Type: application/xml');
    echo $responseXML->asXML();
    
} catch (Exception $e) {
    $responseXML = Utilities::generateResponseXML('ERROR', $e->getMessage());

    header('Content-Type: application/xml');
    echo $responseXML->asXML();
}
?>
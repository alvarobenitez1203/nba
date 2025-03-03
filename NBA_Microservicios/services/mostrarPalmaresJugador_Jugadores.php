<?php
require '../db/db.php';
require '../utils/utilities.php';

try {
    if (count($_GET)===1) {
        $paramOk = strcmp(key($_GET), "idjugador")==0;

        if($paramOk){

            $paramName = key($_GET); 
            $paramValue = $_GET[$paramName]; 

            $database = new Database();
            $conn = $database->getConnection();

            $sql = $conn->prepare("SELECT t.nombre as nombre_trofeo, tj.cantidad as cantidad, tj.annos as annos
            FROM trofeos_jugadores tj
            INNER JOIN trofeos t ON t.idtrofeo = tj.idtrofeo
            INNER JOIN jugadores j ON j.idjugador = tj.idjugador
            WHERE tj.idjugador = ?");
            $sql->bind_param("s", $paramValue);

            $sql->execute();
            $result = $sql->get_result();

            $responseXML = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><response></response>');

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $courseXML = $responseXML->addChild('palmares');
                    $courseXML->addChild('nombre_trofeo', $row['nombre_trofeo']);
                    $courseXML->addChild('cantidad', $row['cantidad']);
                    $courseXML->addChild('annos', $row['annos']);
                }
            } else {
                $responseXML->addChild('status', 'ERROR');
                $responseXML->addChild('description', "No courses found with this $paramName.");
            }

            header('Content-Type: application/xml');
            echo $responseXML->asXML();

            $sql->close();
            

        } else {
            throw new Exception("Bad usage: Only one type of parameter is allowed: idjugador.");
        }       
    } elseif (count($_GET)>1) {
        throw new Exception("Bad usage: too many parameters.");
    }
} catch (Exception $e) {
    $responseXML = Utilities::generateResponseXML('ERROR', $e->getMessage());

    header('Content-Type: application/xml');
    echo $responseXML->asXML();
}
?>

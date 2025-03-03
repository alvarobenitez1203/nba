<?php
require '../db/db.php';
require '../utils/utilities.php';

try {
    if (count($_GET)===0) {
        $database = new Database();
        $conn = $database->getConnection();

        $sql = $conn->prepare("SELECT * FROM equipos");
        $sql->execute();
        $result = $sql->get_result();

        $responseXML = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><response></response>');

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $courseXML = $responseXML->addChild('equipo');
                $courseXML->addChild('idequipo', $row['idequipo']);
                $courseXML->addChild('nombre', $row['nombre']);
                $courseXML->addChild('pais', $row['pais']);
                $courseXML->addChild('annofundacion', $row['annofundacion']);
                $courseXML->addChild('conferencia', $row['conferencia']);
            }
        } else {
            $responseXML->addChild('status', 'ERROR');
            $responseXML->addChild('description', 'No courses found');
        }

        header('Content-Type: application/xml');
        echo $responseXML->asXML();

        $sql->close();

    } elseif (count($_GET)===1){

        $paramOk = strcmp(key($_GET), "conferencia")==0;

        if($paramOk){

            $paramName = key($_GET);
            $paramValue = $_GET[$paramName];

            $database = new Database();
            $conn = $database->getConnection();

            $sql = $conn->prepare("SELECT * FROM equipos WHERE $paramName = ?");
            $sql->bind_param("s", $paramValue);

            $sql->execute();
            $result = $sql->get_result();

            $responseXML = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><response></response>');

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $courseXML = $responseXML->addChild('equipo');
                    $courseXML->addChild('idequipo', $row['idequipo']);
                    $courseXML->addChild('nombre', $row['nombre']);
                    $courseXML->addChild('pais', $row['pais']);
                    $courseXML->addChild('annofundacion', $row['annofundacion']);
                    $courseXML->addChild('conferencia', $row['conferencia']);
                }
            } else {
                $responseXML->addChild('status', 'ERROR');
                $responseXML->addChild('description', "No courses found with this $paramName.");
            }

            header('Content-Type: application/xml');
            echo $responseXML->asXML();

            $sql->close();
            

        } else {
            throw new Exception("Bad usage: Only two types of parameters are allowed: courseId or courseCode.");
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

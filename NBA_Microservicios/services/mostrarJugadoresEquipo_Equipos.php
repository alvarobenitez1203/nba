<?php
require '../db/db.php';
require '../utils/utilities.php';

try {
    if (count($_GET)===1) {

        $paramOk = strcmp(key($_GET), "idequipo")==0;

        if($paramOk){

            $paramName = key($_GET); 
            $paramValue = $_GET[$paramName]; 

            $database = new Database();
            $conn = $database->getConnection();

            $sql = $conn->prepare("SELECT nombre, edad, posicion, nacionalidad
            FROM jugadores
            WHERE idequipo = ?");
            $sql->bind_param("s", $paramValue);

            $sql->execute();
            $result = $sql->get_result();

            $responseXML = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><response></response>');

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $courseXML = $responseXML->addChild('jugadores');
                    $courseXML->addChild('nombre', $row['nombre']);
                    $courseXML->addChild('edad', $row['edad']);
                    $courseXML->addChild('posicion', $row['posicion']);
                    $courseXML->addChild('nacionalidad', $row['nacionalidad']);
                }
            } else {
                $responseXML->addChild('status', 'ERROR');
                $responseXML->addChild('description', "No courses found with this $paramName.");
            }

            header('Content-Type: application/xml');
            echo $responseXML->asXML();

            $sql->close();
            

        } else {
            throw new Exception("Bad usage: Only one type of parameter is allowed: idequipo.");
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

<?php
require '../db/db.php';
require '../utils/utilities.php';

try {
    if (count($_GET)===1){
        
        $paramOk = strcmp(key($_GET), "idequipo")==0;

        if($paramOk){

            $paramName = key($_GET); 
            $paramValue = $_GET[$paramName]; 

            $database = new Database();
            $conn = $database->getConnection();

            $sql = $conn->prepare("SELECT * FROM equipos WHERE idequipo = ?");
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
                $responseXML->addChild('description', "No se han encontrado trofeos");
            }

            header('Content-Type: application/xml');
            echo $responseXML->asXML();

            $sql->close();
            

        } else {
            throw new Exception("Error. Solo se permite buscar por id_jugador");
        }       
    } elseif (count($_GET)>1) {
        throw new Exception("Error. Se han introducido demasiados parametros");
    }
} catch (Exception $e) {
    $responseXML = Utilities::generateResponseXML('ERROR', $e->getMessage());

    $respuesta=$responseXML->asXML();
    $xml = simplexml_load_string($respuesta);
    echo "<div><h2>{$xml->description}</h2></div>";
}
?>
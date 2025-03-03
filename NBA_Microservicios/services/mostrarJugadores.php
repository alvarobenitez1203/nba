<?php
require '../db/db.php';
require '../utils/utilities.php';

try {
    if (count($_GET)===0) {
        $database = new Database();
        
        $conn = $database->getConnection();

        $sql = $conn->prepare("SELECT j.*, e.nombre as nombre_equipo FROM jugadores j 
        LEFT JOIN equipos e ON j.idequipo = e.idequipo ORDER BY j.idequipo");
        
        $sql->execute();
        $result = $sql->get_result();
        
        $responseXML = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><response></response>');

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $courseXML = $responseXML->addChild('jugador');
                $courseXML->addChild('idjugador', $row['idjugador']);
                $courseXML->addChild('nombre', $row['nombre']);
                $courseXML->addChild('edad', $row['edad']);
                $courseXML->addChild('posicion', $row['posicion']);
                $courseXML->addChild('nacionalidad',$row['nacionalidad']);
                $courseXML->addChild('disponible',$row['disponible']);
                $courseXML->addChild('idequipo',$row['idequipo']);
                $courseXML->addChild('nombre_equipo',($row['nombre_equipo'] !== null) ? $row['nombre_equipo'] : 'Sin equipo');
            }
        } else {
            $responseXML->addChild('status', 'ERROR');
            $responseXML->addChild('description', 'No se han encontrado canciones');
        }
        header('Content-Type: application/xml');
        echo $responseXML->asXML();

        $sql->close();

    } elseif (count($_GET)===1){
        
        $paramOk = strcmp(key($_GET), "disponible")==0;

        if($paramOk){

            $paramName = key($_GET); 
            $paramValue = $_GET[$paramName]; 

            $database = new Database();
            $conn = $database->getConnection();

            $sql = $conn->prepare("SELECT j.*, e.nombre as nombre_equipo FROM jugadores j 
            LEFT JOIN equipos e ON j.idequipo = e.idequipo WHERE $paramName = ? ORDER BY j.idequipo");
            $sql->bind_param("s", $paramValue);

            $sql->execute();
            $result = $sql->get_result();

            $responseXML = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><response></response>');

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $courseXML = $responseXML->addChild('jugador');
                    $courseXML->addChild('idjugador', $row['idjugador']);
                    $courseXML->addChild('nombre', $row['nombre']);
                    $courseXML->addChild('edad', $row['edad']);
                    $courseXML->addChild('posicion', $row['posicion']);
                    $courseXML->addChild('nacionalidad',$row['nacionalidad']);
                    $courseXML->addChild('disponible',$row['disponible']);
                    $courseXML->addChild('idequipo',$row['idequipo']);
                    $courseXML->addChild('nombre_equipo',($row['nombre_equipo'] !== null) ? $row['nombre_equipo'] : 'Sin equipo');
                }
            } else {
                $responseXML->addChild('status', 'ERROR');
                $responseXML->addChild('description', "No se han encontrado jugadores");
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

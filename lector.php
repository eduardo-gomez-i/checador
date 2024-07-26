<?php
require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

include 'conex.php'; // Incluir archivo de configuración de base de datos

// Función para registrar eventos en la base de datos
function registrarEvento($tipo_evento, $timestamp, $numero_tarjeta, $bdd) {
    $sql = "INSERT INTO eventos (tipo_evento, timestamp, numero_tarjeta) VALUES (:eventType, :timestamp, :cardNumber)";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':eventType', $tipo_evento);
    $stmt->bindParam(':timestamp', $timestamp);
    $stmt->bindParam(':cardNumber', $numero_tarjeta);
    return $stmt->execute();
}

// Crear una solicitud desde php://input
$request = Request::createFromGlobals();

// Obtener el contenido crudo de la solicitud
$rawData = file_get_contents('php://input');
file_put_contents('log.txt', $rawData);

// Registrar el contenido crudo de rawData para diagnóstico
registrarEvento('raw_data', date('Y-m-d H:i:s'), $rawData, $bdd);

// Verificar si la solicitud contiene datos JSON
if ($request->headers->get('content-type') === 'multipart/form-data') {
    // Obtener la parte JSON de los datos multipart
    $jsonContent = $request->request->get('event_log');
    
    if ($jsonContent) {
        $eventDataArray = json_decode($jsonContent, true);

        if ($eventDataArray) {
            $eventType = $eventDataArray['eventType'] ?? 'unknown';
            $timestamp = $eventDataArray['dateTime'] ?? 'unknown';
            $cardNumber = $eventDataArray['AccessControllerEvent']['serialNo'] ?? 'unknown';

            if (registrarEvento($eventType, $timestamp, $cardNumber, $bdd)) {
                echo "Evento registrado correctamente";
            } else {
                $errorInfo = $bdd->errorInfo();
                registrarEvento('error', date('Y-m-d H:i:s'), json_encode($errorInfo), $bdd);
                echo "Error al registrar el evento";
            }
        } else {
            $errorInfo = "No se recibieron datos válidos";
            registrarEvento('error', date('Y-m-d H:i:s'), $errorInfo . " - " . $rawData, $bdd);
            echo $errorInfo;
        }
    } else {
        $errorInfo = "No se encontró la parte JSON en el contenido MIME";
        registrarEvento('error', date('Y-m-d H:i:s'), $errorInfo . " - " . $rawData, $bdd);
        echo $errorInfo;
    }
} else {
    $errorInfo = "No se encontró el contenido JSON en la solicitud";
    registrarEvento('error', date('Y-m-d H:i:s'), $errorInfo . " - " . $rawData, $bdd);
    echo $errorInfo;
}
?>

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

// Registrar el contenido de $_POST
file_put_contents('log_post.txt', print_r($_POST, true));

// Obtener y decodificar el JSON en $_POST['event_log']
$eventDataString = $_POST['event_log'] ?? null;

if ($eventDataString) {
    // Decodificar la cadena JSON
    $eventDataArray = json_decode($eventDataString, true);

    // Registrar el contenido decodificado para diagnóstico
    file_put_contents('log_decoded.txt', print_r($eventDataArray, true));

    if ($eventDataArray) {
        $eventType = $eventDataArray['eventType'] ?? 'unknown';
        $timestampISO = $eventDataArray['dateTime'] ?? 'unknown';
        $majorEventType = $eventDataArray['AccessControllerEvent']['majorEventType'] ?? null;
        $subEventType = $eventDataArray['AccessControllerEvent']['subEventType'] ?? null;

        // Filtrar por majorEventType y subEventType
        if ($majorEventType == 5 && $subEventType == 75) {
            $cardNumber = $eventDataArray['AccessControllerEvent']['employeeNoString'] ?? 'unknown';

            // Convertir fecha y hora del formato ISO 8601 a formato MySQL
            $timestamp = date('Y-m-d H:i:s', strtotime($timestampISO));

            if (registrarEvento($eventType, $timestamp, $cardNumber, $bdd)) {
                echo "Evento registrado correctamente";
            } else {
                $errorInfo = $bdd->errorInfo();
                registrarEvento('error', date('Y-m-d H:i:s'), json_encode($errorInfo), $bdd);
                echo "Error al registrar el evento";
            }
        } else {
            echo "Evento no filtrado por majorEventType o subEventType";
        }
    } else {
        $errorInfo = "No se recibieron datos válidos";
        registrarEvento('error', date('Y-m-d H:i:s'), $errorInfo, $bdd);
        echo $errorInfo;
    }
} else {
    $errorInfo = "No se encontró la parte JSON en el contenido MIME";
    registrarEvento('error', date('Y-m-d H:i:s'), $errorInfo . " - " . $rawData, $bdd);
    echo $errorInfo;
}
?>

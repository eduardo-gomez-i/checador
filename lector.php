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

// Obtener el contenido crudo de la solicitud
$rawData = file_get_contents('php://input');

// Registrar el contenido crudo de rawData para diagnóstico
file_put_contents('log.txt', $rawData);

// Verificar si la solicitud contiene datos JSON
if (strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
    $eventDataArray = json_decode($rawData, true);

    if ($eventDataArray) {
        $eventType = $eventDataArray['eventType'] ?? 'unknown';
        $timestampISO = $eventDataArray['dateTime'] ?? 'unknown';
        $cardNumber = $eventDataArray['AccessControllerEvent']['serialNo'] ?? 'unknown';

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
        $errorInfo = "No se recibieron datos válidos";
        registrarEvento('error', date('Y-m-d H:i:s'), $errorInfo . " - " . $rawData, $bdd);
        echo $errorInfo;
    }
} else {
    $errorInfo = "No se encontró el contenido JSON en la solicitud";
    registrarEvento('error', date('Y-m-d H:i:s'), $errorInfo . " - " . $rawData, $bdd);
    echo $errorInfo;
}
?>

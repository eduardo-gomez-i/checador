<?php
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

// Obtener el contenido de la solicitud POST
$rawData = file_get_contents('php://input');

// Extraer el JSON del contenido MIME
preg_match('/Content-Type: application\/json\s+Content-Length: \d+\s+(.*)--MIME_boundary/s', $rawData, $matches);

if (isset($matches[1])) {
    $json = trim($matches[1]);
    $eventDataArray = json_decode($json, true);

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
        registrarEvento('error', date('Y-m-d H:i:s'), $errorInfo, $bdd);
        echo $errorInfo;
    }
} else {
    $errorInfo = "No se encontró el contenido JSON en la solicitud";
    registrarEvento('error', date('Y-m-d H:i:s'), $errorInfo, $bdd);
    echo $errorInfo;
}
?>

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

// Obtener el JSON de la solicitud POST
$eventData = file_get_contents('php://input');
$eventDataArray = json_decode($eventData, true);

if ($eventDataArray) {
    $eventType = $eventDataArray['eventType'] ?? 'unknown';
    $timestamp = $eventDataArray['timestamp'] ?? 'unknown';
    $cardNumber = $eventDataArray['cardNumber'] ?? 'unknown';

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
?>

<?php
require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

include 'conex.php'; // Incluir archivo de configuración de base de datos

// Verificar si la conexión a la base de datos se ha establecido correctamente
if (!$bdd) {
    die('Error en la conexión a la base de datos');
}

// Función para registrar eventos en la base de datos
function registrarEvento($tipo_evento, $timestamp, $numero_tarjeta, $bdd) {
    $sql = "INSERT INTO eventos (tipo_evento, timestamp, numero_tarjeta) VALUES (:eventType, :timestamp, :cardNumber)";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':eventType', $tipo_evento);
    $stmt->bindParam(':timestamp', $timestamp);
    $stmt->bindParam(':cardNumber', $numero_tarjeta);
    return $stmt->execute();
}

// Registrar el contenido de $_SERVER
file_put_contents('log_server.txt', print_r($_SERVER, true));

// Registrar el contenido de $_POST
file_put_contents('log_post.txt', print_r($_POST, true));

// Registrar el contenido de $_FILES
file_put_contents('log_files.txt', print_r($_FILES, true));

// Obtener el contenido crudo de la solicitud
$rawData = file_get_contents('php://input');
file_put_contents('log_raw_data.txt', $rawData);

// Verificar si hay datos en $_POST
if ($_SERVER['CONTENT_TYPE'] === 'multipart/form-data') {
    // Verificar si hay datos en $_POST
    $eventDataArray = $_POST['event_log'] ?? null;

    if ($eventDataArray) {
        $eventDataArray = json_decode($eventDataArray, true);

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
            registrarEvento('error', date('Y-m-d H:i:s'), $errorInfo, $bdd);
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

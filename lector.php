<?php
include 'conex.php'; // Incluir archivo de configuración de base de datos

// Función para registrar eventos o errores en la base de datos
function registrarEvento($tipo_evento, $timestamp, $numero_tarjeta = null) {
    global $conexion;

    $tipo_evento = mysqli_real_escape_string($conexion, $tipo_evento);
    $timestamp = mysqli_real_escape_string($conexion, $timestamp);
    $numero_tarjeta = $numero_tarjeta ? mysqli_real_escape_string($conexion, $numero_tarjeta) : 'NULL';

    $sql = "INSERT INTO eventos (tipo_evento, timestamp, numero_tarjeta) 
            VALUES ('$tipo_evento', '$timestamp', $numero_tarjeta)";

    if (!mysqli_query($conexion, $sql)) {
        // Registrar en el archivo de log en caso de fallo
        error_log("Error al registrar el evento o error en la base de datos: " . mysqli_error($conexion));
    }
}

// Manejo de errores de conexión a la base de datos
if (!$conexion) {
    $error_msg = "Error al conectar con la base de datos: " . mysqli_connect_error();
    registrarEvento("Error de Conexión", date('Y-m-d H:i:s'), $error_msg);
    http_response_code(500); // Error interno del servidor
    echo "Error interno del servidor.";
    exit();
}

// Obtén los datos POST
$input = file_get_contents('php://input');
$json = json_decode($input, true);

// Verifica si el JSON fue decodificado correctamente
if (json_last_error() === JSON_ERROR_NONE) {
    // Extrae los campos necesarios
    $tipo_evento = isset($json['event_type']) ? $json['event_type'] : 'Desconocido';
    $timestamp = isset($json['timestamp']) ? $json['timestamp'] : date('Y-m-d H:i:s');
    $numero_tarjeta = isset($json['card_number']) ? $json['card_number'] : null;

    // Inserta los datos en la base de datos
    registrarEvento($tipo_evento, $timestamp, $numero_tarjeta);

    http_response_code(200); // OK
    echo "Evento procesado correctamente.";
} else {
    // Registra el mensaje de error en la columna numero_tarjeta
    $error_msg = "Error al decodificar el JSON: " . json_last_error_msg();
    registrarEvento("Error de JSON", date('Y-m-d H:i:s'), $error_msg);

    http_response_code(400); // Solicitud incorrecta
    echo "JSON inválido.";
}

mysqli_close($conexion);
?>

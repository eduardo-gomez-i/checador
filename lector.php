<?php
// Obtener todos los encabezados de la solicitud
$headers = getallheaders();

// Registrar los encabezados en un archivo de log
file_put_contents('log_headers.txt', print_r($headers, true));

// Obtener el contenido crudo de la solicitud
$rawData = file_get_contents('php://input');

// Registrar el contenido crudo en un archivo de log
file_put_contents('log_raw_data.txt', $rawData);

// Imprimir los encabezados para verlos en la salida
echo "Encabezados recibidos:\n";
print_r($headers);
?>

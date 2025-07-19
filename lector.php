<?php
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

include 'conex.php'; // Incluir archivo de configuración de base de datos

$fecha_hoy = date("Y-m-d");
date_default_timezone_set('America/Mexico_City');
$hora_actual = date("H:i:s");

// Función para registrar eventos en la base de datos
function registrarEvento($tipo_evento, $timestamp, $numero_tarjeta, $bdd)
{
    $sql = "INSERT INTO eventos (tipo_evento, timestamp, numero_tarjeta) VALUES (:eventType, :timestamp, :cardNumber)";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':eventType', $tipo_evento);
    $stmt->bindParam(':timestamp', $timestamp);
    $stmt->bindParam(':cardNumber', $numero_tarjeta);
    return $stmt->execute();
}

// Registrar el contenido de $_POST
//file_put_contents('log_post.txt', print_r($_POST, true));

// Obtener y decodificar el JSON en $_POST['event_log']
$eventDataString = $_POST['event_log'] ?? null;

if ($eventDataString) {
    // Decodificar la cadena JSON
    $eventDataArray = json_decode($eventDataString, true);

    // Registrar el contenido decodificado para diagnóstico
    //file_put_contents('log_decoded.txt', print_r($eventDataArray, true));

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

                //Buscar tarjeta en Trabajadores
                $sql_trabajador = "SELECT id, tarjeta FROM trabajadores WHERE id_lector='$cardNumber'";
                $consulta_trabajador = mysqli_query($conexion, $sql_trabajador);
                $row_trabajador = mysqli_fetch_assoc($consulta_trabajador);

                //si la tarjeta si existe
                if (!empty($row_trabajador)) {
                    $id_trabajador = $row_trabajador['id'];

                    // Verificar si el empleado tiene configurado ignorar horario de comida para el día de la semana
                    $dia_semana = date('N'); // 1=Lunes, 7=Domingo
                    $sql_verificar_comida = "SELECT ignorar_horario_comida FROM horarios_trabajadores 
                                            WHERE id_trabajador=$id_trabajador AND dia_semana='$dia_semana'";
                    $consulta_verificar_comida = mysqli_query($conexion, $sql_verificar_comida);
                    $row_comida = mysqli_fetch_assoc($consulta_verificar_comida);
                    $ignorar_comida = isset($row_comida['ignorar_horario_comida']) ? $row_comida['ignorar_horario_comida'] : 0;

                    $sql_asistencia = "SELECT * FROM asistencia WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
                    $consulta_asistencia = mysqli_query($conexion, $sql_asistencia);
                    $row_asistencia = mysqli_fetch_assoc($consulta_asistencia);

                    if (!empty($row_asistencia)) {
                        $hora_entrada = $row_asistencia['hora_entrada'];
                        $hora_salida_a_comer = $row_asistencia['hora_comida_salida'];
                        $hora_regreso_de_comida = $row_asistencia['hora_comida_entrada'];
                        $hora_salida = $row_asistencia['hora_salida'];
                        $estado_trabajo = $row_asistencia['estado_trabajo'];
                        //ESTADOS
                        //1=entrada, 2=salida a comer, 3=regreso de comer, 4=salida

                        //intervalo de tiempos entre checado
                        $intervalo_entrada = date('H:i:s', strtotime("$hora_entrada + 10 minute"));
                        $intervalo_salida_a_comer = date('H:i:s', strtotime("$hora_salida_a_comer + 10 minute"));
                        $intervalo_regreso_de_comida = date('H:i:s', strtotime("$hora_regreso_de_comida + 10 minute"));
                        $intervalo_salida = date('H:i:s', strtotime("$hora_salida + 10 minute"));

                        //registra salida de comida o salida final (si ignora horario de comida)
                        if ($estado_trabajo == 1) {

                            if ($hora_actual <= $intervalo_entrada) {
                                echo "ERROR - ENTRADA";
                                $errorsql = "UPDATE avisos SET texto='ERROR ENTRADA', leido='no' WHERE idavisos=1";
                            } else {
                                // Si el empleado ignora horario de comida, registrar salida directamente
                                if ($ignorar_comida == 1) {
                                    $sql_actualizar_asistencia = "UPDATE asistencia SET hora_salida='$hora_actual', estado_trabajo=4
					WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
                                    $resultado_actualizar_asistencia = mysqli_query($conexion, $sql_actualizar_asistencia);
                                    echo "CORRECTO REGISTRANDO SALIDA (SIN HORARIO DE COMIDA)";
                                } else {
                                    // Registro normal de salida a comer
                                    $sql_actualizar_asistencia = "UPDATE asistencia SET hora_comida_salida='$hora_actual', estado_trabajo=2
					WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
                                    $resultado_actualizar_asistencia = mysqli_query($conexion, $sql_actualizar_asistencia);
                                    echo "CORRECTO REGISTRANDO SALIDA A COMER";
                                }
                            }
                        }

                        //registra regreso de comida o muestra el error (solo si no ignora horario de comida)
                        if ($estado_trabajo == 2) {
                            // Si el empleado ignora horario de comida, no debería estar en estado 2
                            if ($ignorar_comida == 1) {
                                echo "ERROR - ESTADO INCORRECTO (EMPLEADO SIN HORARIO DE COMIDA)";
                                $errorsql = "UPDATE avisos SET texto='ERROR ESTADO INCORRECTO', leido='no' WHERE idavisos=1";
                            } else {
                                if ($hora_actual <= $intervalo_comida_salida) {
                                    echo "ERROR - SALIDA A COMER";
                                    $errorsql = "UPDATE avisos SET texto='ERROR SALIDA A COMER', leido='no' WHERE idavisos=1";
                                } else {
                                    $sql_actualizar_asistencia = "UPDATE asistencia SET hora_comida_llegada='$hora_actual', estado_trabajo=3
					WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
                                    $resultado_actualizar_asistencia = mysqli_query($conexion, $sql_actualizar_asistencia);
                                    echo "CORRECTO REGISTRANDO REGRESO DE COMER";
                                }
                            }
                        }

                        //registra salida o muestra el error (solo si no ignora horario de comida)
                        if ($estado_trabajo == 3) {
                            // Si el empleado ignora horario de comida, no debería estar en estado 3
                            if ($ignorar_comida == 1) {
                                echo "ERROR - ESTADO INCORRECTO (EMPLEADO SIN HORARIO DE COMIDA)";
                                $errorsql = "UPDATE avisos SET texto='ERROR ESTADO INCORRECTO', leido='no' WHERE idavisos=1";
                            } else {
                                if ($hora_actual <= $intervalo_comida_llegada) {
                                    echo "ERROR - REGRESO DE COMER";
                                    $errorsql = "UPDATE avisos SET texto='ERROR REGRESO DE COMER', leido='no' WHERE idavisos=1";
                                } else {
                                    $sql_actualizar_asistencia = "UPDATE asistencia SET hora_salida='$hora_actual', estado_trabajo=4
					WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
                                    $resultado_actualizar_asistencia = mysqli_query($conexion, $sql_actualizar_asistencia);
                                    echo "CORRECTO REGISTRANDO SALIDA";
                                }
                            }
                        }

                        //muestra error si ya registro salida
                        if ($estado_trabajo == 4) {
                            echo "ERROR -  SALIDA";
                            $errorsql = "UPDATE avisos SET texto='ERROR SALIDA', leido='no' WHERE idavisos=1";
                        }

                        if (!empty($errorsql)) {
                            mysqli_query($conexion, $errorsql);
                        }
                    } else {
                        //registra entrada o muestra el error			
                        $sql_actualizar_asistencia = "INSERT INTO asistencia (id_trabajador, hora_entrada, fecha, estado_trabajo, id_incidencia)
			            VALUES('$id_trabajador','$hora_actual','$fecha_hoy', 1, 2)";
                        $resultado_actualizar_asistencia = mysqli_query($conexion, $sql_actualizar_asistencia);
                        echo "CORRECTO REGISTRANDO ENTRADA";
                    }
                    //fin registro de asistencias

                }
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

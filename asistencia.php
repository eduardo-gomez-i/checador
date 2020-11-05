<?php
include 'conex.php';
$fecha_hoy = date("Y-m-d");
$hora = date("H:i:s");


$tarjeta = $_GET['tarjeta'];


if ($tarjeta) {
  //Buscar tarjeta en Trabajadores
  $sql_trabajador = "SELECT id, tarjeta FROM trabajadores WHERE tarjeta='$tarjeta'";
  $consulta_trabajador = mysqli_query($conexion, $sql_trabajador);
  $row_trabajador = mysqli_fetch_assoc($consulta_trabajador);

  if (!empty($row_trabajador)) {
    $id_trabajador = $row_trabajador['id'];

    $sql_asistencia = "SELECT * FROM asistencia WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
    $consulta_asistencia = mysqli_query($conexion, $sql_asistencia);
    $row_asistencia = mysqli_fetch_assoc($consulta_asistencia);
    if (!empty($row_asistencia)) {
      $hora_entrada = $row_asistencia['hora_entrada'];
      $hora_comida_salida = $row_asistencia['hora_comida_salida'];
      $hora_comida_llegada = $row_asistencia['hora_comida_entrada'];
      $hora_salida = $row_asistencia['hora_salida'];
      $estado_trabajo = $row_asistencia['estado_trabajo'];

      //tiempo de espera de hora de llegada
      $espera_hora_llegada = date('H:i:s', strtotime("$hora_entrada + 10 minute"));
      $espera_hora_salida_comida = date('H:i:s', strtotime("$hora_comida_salida + 10 minute"));
      $espera_hora_llegada_comida = date('H:i:s', strtotime("$hora_comida_llegada + 10 minute"));
      $espera_hora_salida = date('H:i:s', strtotime("$hora_salida + 10 minute"));

      if (($espera_hora_llegada <= $hora) && ($estado_trabajo == 1)) {
        $sql_actualizar_asistencia = "UPDATE asistencia SET hora_comida_salida='$hora', estado_trabajo=2
        WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
        $resultado_actualizar_asistencia = mysqli_query($conexion, $sql_actualizar_asistencia);
      }
      echo "($espera_hora_salida_comida <= $hora) && ($estado_trabajo == 2)";
      if (($espera_hora_salida_comida <= $hora) && ($estado_trabajo == 2)) {
        $sql_actualizar_asistencia = "UPDATE asistencia SET hora_comida_entrada='$hora', estado_trabajo=3
        WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
        $resultado_actualizar_asistencia = mysqli_query($conexion, $sql_actualizar_asistencia);
      }

      if (($espera_hora_llegada_comida <= $hora) && ($estado_trabajo == 3)) {
        $sql_actualizar_asistencia = "UPDATE asistencia SET hora_salida='$hora', estado_trabajo=4
        WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
        $resultado_actualizar_asistencia = mysqli_query($conexion, $sql_actualizar_asistencia);
      }
    } else {
      //Primer Checado
      $sql_insertar_asistencia = "INSERT INTO asistencia 
      (id_trabajador, hora_entrada, fecha, id_incidencia, estado_trabajo) 
      VALUES ('$id_trabajador', '$hora', '$fecha_hoy', 1, 1)";
      $resultado_insertar = mysqli_query($conexion, $sql_insertar_asistencia);
      echo "insertado";
    }
  }
}

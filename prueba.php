<?php
include 'conex.php';

$fecha_hoy = date("Y-m-d");
$hora = date("H:i:s");

$sql_trabajadores = "SELECT id,tarjeta, hora_llegada FROM trabajadores";
$consulta_trabajadores = mysqli_query($conexion, $sql_trabajadores);

$sql_incidencias = "SELECT * FROM reglas_incidencias WHERE id_incidencia=1";
$consulta_incidencias = mysqli_query($conexion, $sql_incidencias);
$row_incidencias = mysqli_fetch_assoc($consulta_incidencias);
$tolerancia_row = $row_incidencias['tolerancia'];
$retardo_row = $row_incidencias['retardo'];
$falta_row = $row_incidencias['falta'];

$timestamp_tolerancia = strtotime($tolerancia_row);
$timestamp_retardo = strtotime($retardo_row);
$timestamp_falta = strtotime($falta_row);

$minutos_tolerancia = date('i', $timestamp_tolerancia);
$minutos_retardo = date('i', $timestamp_retardo);
$minutos_falta = date('i', $timestamp_falta);

if (isset($_POST['btn_checar'])) {
  $id_trabajador = htmlspecialchars($_POST['tarjeta']);

  $sql_asistencia = "SELECT * FROM asistencia 
  WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
  $consulta_asistencia = mysqli_query($conexion, $sql_asistencia);
  $row_asistencia = mysqli_fetch_assoc($consulta_asistencia);

  if (!empty($row_asistencia)) {

    if (empty($row_asistencia['hora_comida_salida'])) {
      $actualizar_hora = "UPDATE asistencia SET hora_comida_salida='$hora', 
      estado_trabajo=2 WHERE id_trabajador=$id_trabajador";
      $consulta_hora = mysqli_query($conexion, $actualizar_hora);

      echo "<script>alert('Que tengas un Buen Provecho');</script>";
      echo "<script>window.location.replace('prueba.php');</script>";
    } elseif (empty($row_asistencia['hora_comida_entrada'])) {
      $actualizar_hora = "UPDATE asistencia SET hora_comida_entrada='$hora', 
      estado_trabajo=3 WHERE id_trabajador=$id_trabajador";
      $consulta_hora = mysqli_query($conexion, $actualizar_hora);

      echo "<script>alert('Bienvenido de Nuevo');</script>";
      echo "<script>window.location.replace('prueba.php');</script>";
    } elseif (empty($row_asistencia['hora_salida'])) {
      $actualizar_hora = "UPDATE asistencia SET hora_salida='$hora', 
      estado_trabajo=4 WHERE id_trabajador=$id_trabajador";
      $consulta_hora = mysqli_query($conexion, $actualizar_hora);

      echo "<script>alert('Adios nos vemos mañana');</script>";
      echo "<script>window.location.replace('prueba.php');</script>";
    } else {
      echo "<script>alert('Ya cumpliste tu Jornada Laboral');</script>";
      echo "<script>window.location.replace('prueba.php');</script>";
    }
  } else {

    $hora_1 = date_create($hora_llegada_trabajador);
    $hora_2 = date_create($hora_entrada_row);
    $resultado = date_diff($hora_1, $hora_2);
    $resultado->format('%H:%I');

    $tiempo_tolerancia = date('H:i', strtotime("$hora_llegada_trabajador +$minutos_tolerancia minute"));
    $tiempo_retardo = date('H:i', strtotime("$hora_llegada_trabajador +$minutos_retardo minute"));
    $tiempo_falta = date('H:i', strtotime("$hora_llegada_trabajador +$minutos_falta minute"));

    echo "$tiempo_retardo >= $hora_entrada_row";
    if (($hora_llegada_trabajador == $hora_entrada_row) or ($tiempo_tolerancia >= $hora_entrada_row)) {
      echo "Llego a tiempo: ";
      $tipo_incidencias = 1;
    } elseif ($hora_entrada_row <= $tiempo_retardo) {
      echo "Llego con retardo";
      $tipo_incidencias = 2;
    } else {
      echo "Llego con falta";
      $tipo_incidencias = 3;
    }

    $sql_insertar_asistencia = "INSERT INTO asistencia (id_trabajador, hora_entrada, fecha, id_incidencia, estado_trabajo) 
    VALUES ('$id_trabajador','$hora','$fecha_hoy',$tipo_incidencias, 1)";
    $resultado_insertar_asistencia = mysqli_query($conexion, $sql_insertar_asistencia);
    echo "<script>alert('Primer checado');</script>";
    //echo "<script>window.location.replace('prueba.php');</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Checador Prueba</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

  <div class="container">
    <h2>Checador Prueba </h2>
    <p><?php echo $fecha_hoy . " " . $hora; ?></p>
    <form method="POST">
      <div class="form-group">
        <label>Tarjeta de empleado:</label>
        <select name="tarjeta" required>
          <option value="">Seleccione una tarjeta</option>
          <?php
          while ($row_tarjeta = mysqli_fetch_array($consulta_trabajadores, MYSQLI_ASSOC)) {
            $id = $row_tarjeta['id'];
            $tarjeta = $row_tarjeta['tarjeta'];
            echo "<option value='$id'>$tarjeta</option>";
          }
          ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary" name="btn_checar">Checar</button>
    </form>
  </div>

</body>

</html>
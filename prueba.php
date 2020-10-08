<?php
include 'conex.php';

$fecha_hoy = date("Y-m-d");
$hora = date("H:i:s");

$sql_trabajadores = "SELECT id,tarjeta FROM trabajadores";
$consulta_trabajadores = mysqli_query($conexion, $sql_trabajadores);

if (isset($_POST['btn_checar'])) {
  $id_trabajador = htmlspecialchars($_POST['tarjeta']);

  $sql_asistencia = "SELECT * FROM asistencia 
  WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
  $consulta_asistencia = mysqli_query($conexion, $sql_asistencia);
  $row_asistencia = mysqli_fetch_assoc($consulta_asistencia);

  if (!empty($row_asistencia)) {
    echo "segundo checado del empleado";
  } else {
    $sql_insertar_asistencia = "INSERT INTO asistencia (id_trabajador, hora_entrada, fecha) 
    VALUES ('$id_trabajador','$hora','$fecha_hoy')";
    $resultado_insertar_asistencia = mysqli_query($conexion, $sql_insertar_asistencia);
    echo "<script>alert('Primer checado');</script>";
    echo "<script>window.location.replace('prueba.php');</script>";
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
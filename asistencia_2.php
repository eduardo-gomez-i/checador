
<?php
require_once "conex.php";
/*$tarjeta = $_GET['tarjeta'];
$sql = "UPDATE trabajadores SET tarjeta='$tarjeta' WHERE id=2";

if (mysqli_query($conexion, $sql)) {
  echo "Record updated successfully";
  var_dump(http_response_code());
  //header(':', true, 200);
} else {
	http_response_code(404);
	var_dump(http_response_code());
	//header("HTTP/1.1 404 Not Found");
	//header(':', true, 400);
  echo "Error updating record: " . mysqli_error($conexion);
}*/
/*
if (!empty($_GET['tarjeta'])) {
	$tarjeta=$_GET['tarjeta'];
	echo "<br>Tarjeta: ". $tarjeta;

	$query=mysqli_query($conexion, "SELECT * FROM trabajadores WHERE tarjeta='$tarjeta'");
	$idtrabajador=sql_result($query, 0, "id");
	//echo "<br>". $idtrabajador;
	
	if ($idtrabajador > 0 ) {
		$query=mysqli_query($conexion, "SELECT * FROM trabajadores WHERE tarjeta='$tarjeta'");
		$trabajador=sql_result($query, 0, "nombre");
		echo "<br>Nombre: ". $trabajador;

		$query=mysqli_query($conexion, "SELECT * FROM trabajadores WHERE tarjeta='$tarjeta'");
		$depto=sql_result($query, 0, "depto");
		echo "<br>Departamento: ". $depto;

		$ahorita=date("H:i:s");
		$fecha=date("Y-m-d");
		
		$query=mysqli_query($conexion, "SELECT * FROM asistencia WHERE tarjeta='$tarjeta'");
		$hentrada=sql_result($query, 0, "hentrada");
		
		$query=mysqli_query($conexion, "SELECT * FROM asistencia WHERE tarjeta='$tarjeta'");
		$hscomida=sql_result($query, 0, "hscomida");
		
		$query=mysqli_query($conexion, "SELECT * FROM asistencia WHERE tarjeta='$tarjeta'");
		$hrcomida=sql_result($query, 0, "hrcomida");
		
		$query=mysqli_query($conexion, "SELECT * FROM asistencia WHERE tarjeta='$tarjeta'");
		$hsalida=sql_result($query, 0, "hsalida");
		
		if (empty($hentrada)) {
			mysqli_query($conexion, "INSERT INTO asistencia (nombre, depto, hentrada, tarjeta, fecha) VALUES('$trabajador','$depto','$ahorita','$tarjeta','$fecha')");
			$mensaje="Registrando H. Entrada";
			echo "<br><p id='estatus'>OK - $mensaje $ahorita</p>";
			mysqli_query($conexion, "UPDATE estatus SET mensaje='$mensaje', trabajador='$trabajador' WHERE id=1");
		}elseif (empty($hscomida)) {
			mysqli_query($conexion, "UPDATE asistencia SET hscomida='$ahorita' WHERE tarjeta='$tarjeta' AND fecha='$fecha';");
			$mensaje="Registrando H.S. Comida";
			echo "<br><p id='estatus'>OK - $mensaje $ahorita</p>";
			mysqli_query($conexion, "UPDATE estatus SET mensaje='$mensaje', trabajador='$trabajador' WHERE id=1");
		}elseif (empty($hrcomida)) {
			mysqli_query($conexion, "UPDATE asistencia SET hrcomida='$ahorita' WHERE tarjeta='$tarjeta' AND fecha='$fecha';");
			$mensaje="Registrando H.R. Comida";
			echo "<br><p id='estatus'>OK - $mensaje $ahorita</p>";
			mysqli_query($conexion, "UPDATE estatus SET mensaje='$mensaje', trabajador='$trabajador' WHERE id=1");
		}elseif (empty($hsalida)) {
			mysqli_query($conexion, "UPDATE asistencia SET hsalida='$ahorita' WHERE tarjeta='$tarjeta' AND fecha='$fecha';");
			$mensaje="Registrando H. Salida";
			echo "<br><p id='estatus'>OK - $mensaje $ahorita</p>";
			mysqli_query($conexion, "UPDATE estatus SET mensaje='$mensaje', trabajador='$trabajador' WHERE id=1");
		}elseif (!empty($hsalida)) {
			$mensaje="ERROR - Ya registró salida.";
			echo "<br><p id='estatus'>$mensaje</p>";
		}

		echo "<br>". "H. Entrada: ".$hentrada;
		echo "<br>". "H.S. Comida: ".$hscomida;
		echo "<br>". "H.R. Comida: ".$hrcomida;
		echo "<br>". "H. Salida: ".$hsalida;

	}

	if ($idtrabajador < 1 ) {
		mysqli_query($conexion, "UPDATE new SET tarjeta='$tarjeta' WHERE id=1");
		$mensaje="ERROR - tarjeta no registrada";
		mysqli_query($conexion, "UPDATE estatus SET mensaje='$mensaje', trabajador='ERROR' WHERE id=1");
		echo "<br>". "<p id='estatus'>$mensaje</p>";
	}
	
}*/


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

if (isset($_GET['tarjeta'])) {
  $id_trabajador = htmlspecialchars($_GET['tarjeta']);

  $sql_asistencia = "SELECT * FROM asistencia 
  WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
  $consulta_asistencia = mysqli_query($conexion, $sql_asistencia);
  $row_asistencia = mysqli_fetch_assoc($consulta_asistencia);

  if (!empty($row_asistencia)) {

    if (empty($row_asistencia['hora_comida_salida'])) {
      $actualizar_hora = "UPDATE asistencia SET hora_comida_salida='$hora', 
      estado_trabajo=2 WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
      $consulta_hora = mysqli_query($conexion, $actualizar_hora);

      //echo "<script>alert('Que tengas un Buen Provecho');</script>";
      //echo "<script>window.location.replace('prueba.php');</script>";
    } elseif (empty($row_asistencia['hora_comida_entrada'])) {
      $actualizar_hora = "UPDATE asistencia SET hora_comida_entrada='$hora', 
      estado_trabajo=3 WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
      $consulta_hora = mysqli_query($conexion, $actualizar_hora);

      //echo "<script>alert('Bienvenido de Nuevo');</script>";
      //echo "<script>window.location.replace('prueba.php');</script>";
    } elseif (empty($row_asistencia['hora_salida'])) {
      $actualizar_hora = "UPDATE asistencia SET hora_salida='$hora', 
      estado_trabajo=4 WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
      $consulta_hora = mysqli_query($conexion, $actualizar_hora);

      $consulta_hora1 = mysqli_query($conexion, "SELECT hora_llegada, hora_salida FROM asistencia WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'");
      $row_hora1 = mysqli_fetch_assoc($consulta_hora1);
      $hora1_llegada = $row_hora1['hora_llegada'];
      $hora2_salida = $row_hora1['hora_salida'];

      $hora1 = date_create($hora1_llegada);
      $hora2 = date_create($hora2_salida);
      $resultado = date_diff($hora1, $hora2);
      echo $resultado->format('%H:%I');

      $consulta_horas_trabajadas = mysqli_query($conexion, "UPDATE asistencia SET horas_trabajadas='$horas_trabajadas' WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'");

      //echo "<script>alert('Adios nos vemos mañana');</script>";
      //echo "<script>window.location.replace('prueba.php');</script>";
    } else {
      //echo "<script>alert('Ya cumpliste tu Jornada Laboral');</script>";
      //echo "<script>window.location.replace('prueba.php');</script>";
    }
  } else {

    $tiempo_tolerancia = date('H:i', strtotime("$hora_llegada_trabajador +$minutos_tolerancia minute"));
    $tiempo_retardo = date('H:i', strtotime("$hora_llegada_trabajador +$minutos_retardo minute"));
    $tiempo_falta = date('H:i', strtotime("$hora_llegada_trabajador +$minutos_falta minute"));

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
    //echo "<script>alert('Primer checado');</script>";
    //echo "<script>window.location.replace('prueba.php');</script>";
  }
}
?>
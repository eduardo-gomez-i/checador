<?php
include 'conex.php';
$fecha_hoy = date("Y-m-d");
$hora_actual = date("H:i:s");


$tarjeta = $_GET['tarjeta'];


if ($tarjeta) {
  //Buscar tarjeta en Trabajadores
	$sql_trabajador = "SELECT id, tarjeta FROM trabajadores WHERE tarjeta='$tarjeta'";
	$consulta_trabajador = mysqli_query($conexion, $sql_trabajador);
	$row_trabajador = mysqli_fetch_assoc($consulta_trabajador);

  //si la tarjeta si existe
	if (!empty($row_trabajador)) {
		$id_trabajador = $row_trabajador['id'];

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
			
			//registra salida de comida o muestra el error
			if ($estado_trabajo == 1) {

				if ($hora_actual <= $intervalo_entrada) {
					echo "ERROR - ENTRADA";
					$errorsql="UPDATE avisos SET texto='ERROR ENTRADA', leido='no' WHERE idavisos=1";
				}else{
					$sql_actualizar_asistencia = "UPDATE asistencia SET hora_comida_salida='$hora_actual', estado_trabajo=2
					WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
					$resultado_actualizar_asistencia = mysqli_query($conexion, $sql_actualizar_asistencia);
					echo "REGISTRANDO SALIDA A COMER";					
				}
			}

			//registra regreso de comida o muestra el error
			if ($estado_trabajo == 2) {

				if ($hora_actual <= $intervalo_salida_a_comer) {
					echo "ERROR - SALIDA DE COMIDA";
					$errorsql="UPDATE avisos SET texto='ERROR SALIDA COMIDA', leido='no' WHERE idavisos=1";
				}else{
					$sql_actualizar_asistencia = "UPDATE asistencia SET hora_comida_entrada='$hora_actual', estado_trabajo=3
					WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
					$resultado_actualizar_asistencia = mysqli_query($conexion, $sql_actualizar_asistencia);
					echo "REGISTRANDO REGRESO DE COMIDA";					
				}
			}

			//registra la salida o muestra el error
			if ($estado_trabajo == 3) {

				if ($hora_actual <= $intervalo_regreso_de_comida) {
					echo "ERROR - REGRESO DE COMIDA";
					$errorsql="UPDATE avisos SET texto='ERROR REGRESO COMIDA', leido='no' WHERE idavisos=1";
				}else{
					$sql_actualizar_asistencia = "UPDATE asistencia SET hora_salida='$hora_actual', estado_trabajo=4
					WHERE id_trabajador=$id_trabajador AND fecha='$fecha_hoy'";
					$resultado_actualizar_asistencia = mysqli_query($conexion, $sql_actualizar_asistencia);
					echo "REGISTRANDO SALIDA";					
				}
			}

			//muestra error si ya registro salida
			if ($estado_trabajo == 4) {
				echo "ERROR - SALIDA";
				$errorsql="UPDATE avisos SET texto='ERROR SALIDA', leido='no' WHERE idavisos=1";				
			}

			if (!empty($errorsql)) {
				mysqli_query($conexion, $errorsql);
			}			

		}else{
			//registra entrada o muestra el error			
			$sql_actualizar_asistencia = "INSERT INTO asistencia (id_trabajador, hora_entrada, fecha, estado_trabajo)
			VALUES('$id_trabajador','$hora_actual','$fecha_hoy', 1)";
			$resultado_actualizar_asistencia = mysqli_query($conexion, $sql_actualizar_asistencia);
			echo "REGISTRANDO ENTRADA";							
		}
		//fin registro de asistencias

	}else{
		//La tarjeta no Existe
		echo "La Tarjeta NO EXISTE";
		mysqli_query($conexion, "UPDATE new SET tarjeta='$tarjeta', conocida='NO' WHERE id=1"); 
	}
}
?>
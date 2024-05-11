<?php 
SESSION_START();
include 'conex.php';
date_default_timezone_set('America/Chihuahua');
$hoy=date("Y-m-d");

	if (!empty($_GET['search'])) {
		
		$consulta=mysqli_query($conexion, "SELECT id_trabajador, hora_entrada, hora_comida_salida, hora_comida_entrada, hora_salida, nombre, puesto, fecha FROM asistencia INNER JOIN trabajadores ON (asistencia.id_trabajador=trabajadores.id) ORDER BY actualizado DESC limit 1");
	    
		while($campo=mysqli_fetch_array($consulta)){
		  $id=$campo['id_trabajador'];
		  $trabajador=$campo['nombre'];
		  $entrada=$campo['hora_entrada'];
		  $scomida=$campo['hora_comida_salida'];
		  $rcomida=$campo['hora_comida_entrada'];
		  $salida=$campo['hora_salida'];
		  $horas_trabajadas="00:00";
		  $fecha=$campo['fecha'];
		}

		if (!empty($salida)) {
			$nota="nos-vemos";
		}elseif (!empty($rcomida)) {
			$nota="hola-de-nuevo";
	 	}elseif (!empty($scomida)) {
			$nota="buen-provecho";
	  	}elseif (!empty($entrada)) {
			$nota="ok";
		}

		$consulta_avisos=mysqli_query($conexion, "SELECT texto FROM avisos WHERE idavisos=1 AND leido='no'");
		$avisos=resultado($consulta_avisos, 0, "texto");	

		if ($avisos !== null && strpos($avisos, 'ERROR') !== false) {
			$nota = "error";
		}

		if (!empty($id)) {
			echo "<input type='text' id='nuevo' value='".$trabajador."' hidden>";
			echo "<input type='text' id='nota2' value='".$nota."' hidden>";
		}		
	}// fin de search

	//busca nuevas tarjetas
	$sql_tarjeta=mysqli_query($conexion, "SELECT tarjeta FROM new WHERE conocida='NO' AND id=1");
	$tarjeta=resultado($sql_tarjeta, 0, "tarjeta");

	if (is_numeric($tarjeta)) {
		echo "<input type='text' id='nueva_tarjeta' value='new' hidden>";		
	}else{
		echo "<input type='text' id='nueva_tarjeta' value='no' hidden>";
	 }

	if (!empty($_GET['newcard'])) {
		mysqli_query($conexion, "UPDATE new SET conocida=NULL WHERE id='1'");
		echo "borrando nueva tarjeta";
	}

	if (!empty($_GET['aviso'])) {
		mysqli_query($conexion, "UPDATE avisos SET leido=NULL WHERE idavisos='1'");
		echo "borrando aviso";
	}
?>
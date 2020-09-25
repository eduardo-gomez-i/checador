<?php
require_once "conecta_bdd.php";

if (!empty($_GET['tarjeta'])) {
	$tarjeta=$_GET['tarjeta'];
	echo "<br>Tarjeta: ". $tarjeta;

	$query=mysqli_query($conexion1, "SELECT * FROM trabajadores WHERE tarjeta='$tarjeta'");
	$idtrabajador=sql_result($query, 0, "id");
	//echo "<br>". $idtrabajador;
	
	if ($idtrabajador > 0 ) {
		$query=mysqli_query($conexion1, "SELECT * FROM trabajadores WHERE tarjeta='$tarjeta'");
		$trabajador=sql_result($query, 0, "nombre");
		echo "<br>Nombre: ". $trabajador;

		$query=mysqli_query($conexion1, "SELECT * FROM trabajadores WHERE tarjeta='$tarjeta'");
		$depto=sql_result($query, 0, "depto");
		echo "<br>Departamento: ". $depto;

		$ahorita=date("H:i:s");
		$fecha=date("Y-m-d");
		
		$query=mysqli_query($conexion1, "SELECT * FROM asistencia WHERE tarjeta='$tarjeta'");
		$hentrada=sql_result($query, 0, "hentrada");
		
		$query=mysqli_query($conexion1, "SELECT * FROM asistencia WHERE tarjeta='$tarjeta'");
		$hscomida=sql_result($query, 0, "hscomida");
		
		$query=mysqli_query($conexion1, "SELECT * FROM asistencia WHERE tarjeta='$tarjeta'");
		$hrcomida=sql_result($query, 0, "hrcomida");
		
		$query=mysqli_query($conexion1, "SELECT * FROM asistencia WHERE tarjeta='$tarjeta'");
		$hsalida=sql_result($query, 0, "hsalida");
		
		if (empty($hentrada)) {
			mysqli_query($conexion1, "INSERT INTO asistencia (nombre, depto, hentrada, tarjeta, fecha) VALUES('$trabajador','$depto','$ahorita','$tarjeta','$fecha')");
			$mensaje="Registrando H. Entrada";
			echo "<br><p id='estatus'>OK - $mensaje $ahorita</p>";
			mysqli_query($conexion1, "UPDATE estatus SET mensaje='$mensaje', trabajador='$trabajador' WHERE id=1");
		}elseif (empty($hscomida)) {
			mysqli_query($conexion1, "UPDATE asistencia SET hscomida='$ahorita' WHERE tarjeta='$tarjeta' AND fecha='$fecha';");
			$mensaje="Registrando H.S. Comida";
			echo "<br><p id='estatus'>OK - $mensaje $ahorita</p>";
			mysqli_query($conexion1, "UPDATE estatus SET mensaje='$mensaje', trabajador='$trabajador' WHERE id=1");
		}elseif (empty($hrcomida)) {
			mysqli_query($conexion1, "UPDATE asistencia SET hrcomida='$ahorita' WHERE tarjeta='$tarjeta' AND fecha='$fecha';");
			$mensaje="Registrando H.R. Comida";
			echo "<br><p id='estatus'>OK - $mensaje $ahorita</p>";
			mysqli_query($conexion1, "UPDATE estatus SET mensaje='$mensaje', trabajador='$trabajador' WHERE id=1");
		}elseif (empty($hsalida)) {
			mysqli_query($conexion1, "UPDATE asistencia SET hsalida='$ahorita' WHERE tarjeta='$tarjeta' AND fecha='$fecha';");
			$mensaje="Registrando H. Salida";
			echo "<br><p id='estatus'>OK - $mensaje $ahorita</p>";
			mysqli_query($conexion1, "UPDATE estatus SET mensaje='$mensaje', trabajador='$trabajador' WHERE id=1");
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
		mysqli_query($conexion1, "UPDATE new SET tarjeta='$tarjeta' WHERE id=1");
		$mensaje="ERROR - tarjeta no registrada";
		mysqli_query($conexion1, "UPDATE estatus SET mensaje='$mensaje', trabajador='ERROR' WHERE id=1");
		echo "<br>". "<p id='estatus'>$mensaje</p>";
	}
	
}

?>
<?php
date_default_timezone_set('America/Mexico_City');
$conexion1 = mysqli_connect("localhost","root","","checador");

	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
	}

	function sql_result($consulta, $fila, $campo){
		$i=0; while($resultados=mysqli_fetch_array($consulta)){
		if ($i==$fila){$result=$resultados[$campo];}
		$i++;}
		return $result;
	}
?>
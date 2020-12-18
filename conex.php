<?php
date_default_timezone_set('America/Mexico_City');
ini_set('display_errors', 1);

$db_host = "192.168.1.75";
$db_name = "checador";
$db_user = "remoto";
$db_password = "checador123";
$conexion = mysqli_connect($db_host, $db_user, $db_password);
if (!$conexion) {
	die("NO SE PUDO CONECTAR A LA BASE DE DATOS: " . mysqli_error($conexion));
}

function db_data()
{
	global $db_name;
	global $conexion;
	mysqli_select_db($conexion, $db_name);
	mysqli_query($conexion, "SET NAMES utf8");
	mysqli_query($conexion, "SET CHARACTER_SET utf8");
}

db_data();

//funcion para obtener un resultado especifico
// ejemplo: $var=resultado($consulta, 0, "nombre_campo");
function resultado($consulta, $fila, $campo = 0)
{
	$consulta->data_seek($fila);
	$datarow = $consulta->fetch_array();

	if ($datarow) {
		return $datarow[$campo];
	}
}


/*$conexion1 = mysqli_connect("SQLAZO","remoto","ConexionRemota01","checador");

	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
	}
*/
function sql_result($consulta, $fila, $campo)
{
	$i = 0;
	while ($resultados = mysqli_fetch_array($consulta)) {
		if ($i == $fila) {
			$result = $resultados[$campo];
		}
		$i++;
	}
	return $result;
}

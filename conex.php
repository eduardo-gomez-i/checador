<?php
date_default_timezone_set('America/Mexico_City');
ini_set('display_errors', 1);

$db_host = "localhost";
$db_name = "checador";
$db_user = "root";
$db_password = "";
$conexion = mysqli_connect($db_host, $db_user, $db_password);

/*
$bdd = new PDO('mysql:host=localhost;dbname=checador;charset=utf8', 'root', '');
if (!$conexion) {
	die("NO SE PUDO CONECTAR A LA BASE DE DATOS: " . mysqli_error($conexion));
}
*/

$bdd = mysqli_connect($db_host, $db_user, $db_password, $db_name);

	// Check connection
	if (mysqli_connect_errno()) {
	  echo "NO SE PUDO CONECTAR A LA BASE DE DATOS: " . mysqli_connect_error();
	  exit();
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

function fechamx($fecha){
		
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		
		$dia_letra=$dias[date("w",$fecha)];
		$dia_numero=date("d",$fecha);
		$mes_letra=$meses[date("n",$fecha)-1];
		$anio=date("Y",$fecha);

		$fecha_formateada=$dia_letra."&nbsp".$dia_numero." de ".$mes_letra." de ".$anio;
		
		return $fecha_formateada;
	}

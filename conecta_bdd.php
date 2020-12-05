<?php 
date_default_timezone_set('America/Mexico_City');
ini_set('display_errors', 1);

$db1_host="192.168.1.73";
$db1_name="checador";
$db1_user="remoto";
$db1_password= "checador123";
$conexion1 = mysqli_connect($db1_host, $db1_user, $db1_password);
if (!$conexion1){
	die ("NO SE PUDO CONECTAR A LA BASE DE DATOS: ". mysqli_error($conexion1));
}

function db1_data(){
	global $db1_name;
	global $conexion1;
	mysqli_select_db($conexion1, $db1_name);
	mysqli_query($conexion1, "SET NAMES utf8");
	mysqli_query($conexion1, "SET CHARACTER_SET utf8");
} 

db1_data();

//funcion para obtener un resultado especifico
// ejemplo: $var=resultado($consulta, 0, "nombre_campo");
function resultado($consulta, $fila, $campo=0) {
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
	function sql_result($consulta, $fila, $campo){
		$i=0; while($resultados=mysqli_fetch_array($consulta)){
		if ($i==$fila){$result=$resultados[$campo];}
		$i++;}
		return $result;
	}
?>
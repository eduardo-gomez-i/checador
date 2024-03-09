<?php
include 'conex.php';
echo "Resultado: ";

if (!empty($_GET['tarjeta'])) {
	$xtarjeta=$_GET['tarjeta'];
	
	$consulta=mysqli_query($conexion, "SELECT COUNT(nombre) AS trabajador FROM trabajadores WHERE tarjeta='$xtarjeta'");
	$existe=resultado($consulta, 0, "trabajador");
	
	if ($existe > 0 ) {
		echo "Acceso Correcto";
	}
	if ($existe == 0 ) {
		echo "ERROR";	
		//mysql_query("UPDATE $tabla_newcard SET tarjeta='$xtarjeta' WHERE id=1");
	}
}
/////fin del php
?>
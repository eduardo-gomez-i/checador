<?php 
include 'conex.php';

$empleados_sql = "SELECT * FROM trabajadores";
$consulta_empleados = mysqli_query($conexion, $empleados_sql);

while($row_empleado = mysqli_fetch_array($consulta_empleados, MYSQLI_ASSOC)){
    $id_empleado = $row_empleado['id'];
    $nombre_empreado = $row_empleado['nombre'];
}

?>
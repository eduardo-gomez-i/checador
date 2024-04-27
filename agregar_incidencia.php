<?php
include 'conex.php'; 

$idUsuario = htmlspecialchars($_POST['idUsuario']);
$tipo_agregar = htmlspecialchars($_POST['tipo_agregar']);
$fecha_y_hora_agregar = htmlspecialchars($_POST['fecha_y_hora_agregar']);
$fecha_y_hora_regreso = $_POST['fecha_y_hora_regreso'] != '' ? "'" . htmlspecialchars($_POST['fecha_y_hora_regreso']) . "'" : 'NULL';
$notas = htmlspecialchars($_POST['notas']);

$sql_agregar_incidencia = "INSERT INTO incidencias (idtrabajador, tipo, notas, fecha, regreso) 
    VALUES ('$idUsuario','$tipo_agregar','$notas', '$fecha_y_hora_agregar', $fecha_y_hora_regreso)";

$resultado_agregar_incidencia = mysqli_query($conexion, $sql_agregar_incidencia);

if ($resultado_agregar_incidencia) {
    echo "<script>alert('Agregado Correctamente');</script>";
    echo "<script>window.location.replace('checador.php');</script>";
} else {
    echo "<script>alert('Fallo al agregar');</script>";
    echo "<script>window.location.replace('checador.php');</script>";
}

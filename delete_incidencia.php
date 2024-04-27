<?php
include 'conex.php'; 

$id_incidencia_eliminar = htmlspecialchars($_POST['id_incidencia_eliminar_new']);
$sql_eliminar_incidecia = "DELETE FROM incidencias WHERE idincidencias=$id_incidencia_eliminar";
$resultado_eliminar_incidencia = mysqli_query($conexion, $sql_eliminar_incidecia);

if ($resultado_eliminar_incidencia) {
    echo "<script>alert('Eliminado Correctamente');</script>";
    echo "<script>window.location.replace('incidencias.php');</script>";
} else {
    echo "<script>alert('Fallo al Eliminar');</script>";
    echo "<script>window.location.replace('incidencias.php');</script>";
}
?>
<?php
include '../conex.php';
//Lista Trabajadores
$sql_trabajadores = "SELECT id, nombre FROM trabajadores ORDER BY nombre ASC";
$consulta_trabajadores = mysqli_query($conexion, $sql_trabajadores);
//Lista Trabajadores

//Lista Vehiculos
$sql_vehiculos = "SELECT * FROM unidades";
$consulta_vehiculos = mysqli_query($conexion, $sql_vehiculos);
//

if ($_POST) {
    # code...
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Verificar Vehiculo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container-fluid">
        <div class="container">
            <h1>Verificar Vehiculo</h1>

            <div class="row">
                <a href="entrada.php" type="button" class="btn btn-primary">
                    Entradas
                </a>
                <a href="salida.php" type="button" class="btn btn-success">
                    Salidas
                </a>
            </div>
            
        </div>
    </div>

</body>

</html>
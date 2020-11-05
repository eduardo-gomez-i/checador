<?php
include '../conex.php';
$hoy = date("Y-m-d H:i:s"); 

//Lista Trabajadores
$sql_trabajadores = "SELECT id, nombre FROM trabajadores ORDER BY nombre ASC";
$consulta_trabajadores = mysqli_query($conexion, $sql_trabajadores);
//Lista Trabajadores

//Lista Vehiculos
$sql_vehiculos = "SELECT * FROM unidades WHERE estado_unidad='ocupado'";
$consulta_vehiculos = mysqli_query($conexion, $sql_vehiculos);
//

if (isset($_POST['btn_agregar'])) {
    $id_unidad_editar = htmlspecialchars($_POST['agregar_vehiculo']);
    $kilometraje_final_editar = htmlspecialchars($_POST['kilometraje_final']);
    $gasolina_final_editar = htmlspecialchars($_POST['gasolina_final']);

    $sql_editar_entrada = "UPDATE historial_unidad SET kilometraje_final='$kilometraje_final_editar', 
    gasolina_final='$gasolina_final_editar', fecha_entrada='$hoy'
    WHERE id_unidad=$id_unidad_editar";
    $resultado_editar_entrada = mysqli_query($conexion, $sql_editar_entrada);

    if ($resultado_editar_entrada) {
        $actualizar_estado = mysqli_query($conexion, "UPDATE unidades SET estado_unidad='disponible'
        WHERE id=$id_unidad_editar");
        echo "<script>alert('Agregado Correctamente');</script>";
        echo "<script>window.location.replace('entrada.php');</script>";
    } else {
        echo "<script>alert('Fallo al agregar');</script>";
        echo "<script>window.location.replace('entrada.php');</script>";
    }
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
            <h1>Entrada Vehiculo</h1>
            <div class="row">
                <a href="verificar_unidad.php" type="button" class="btn btn-danger">
                    Volver
                </a>
            </div>
            <form method="POST">
                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label>Seleccione Vehiculo:</label>
                            <select name="agregar_vehiculo" class="form-control">
                                <option value="">Seleccionar Vehiculo</option>
                                <?php
                                while ($row_vehiculos = mysqli_fetch_array($consulta_vehiculos, MYSQLI_ASSOC)) {
                                    $id_vehiculo = $row_vehiculos['id'];
                                    $modelo_vehiculo = $row_vehiculos['modelo'];
                                    $placa_vehiculo = $row_vehiculos['placas'];
                                ?>
                                    <option value="<?php echo $id_vehiculo; ?>"><?php echo "Modelo: " . $modelo_vehiculo . " - Placa: " . $placa_vehiculo ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col">

                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Kilometraje Final</label>
                            <input type="number" class="form-control" placeholder="Kilometraje Final" name="kilometraje_final">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label>Gasolina Final</label>
                            <input type="number" class="form-control" placeholder="Gasolina Final" name="gasolina_final">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="btn_agregar">Agregar</button>
            </form>
        </div>
    </div>

</body>

</html>
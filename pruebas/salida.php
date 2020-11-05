<?php
include '../conex.php';

$hoy = date("Y-m-d H:i:s"); 

//Lista Trabajadores
$sql_trabajadores = "SELECT id, nombre FROM trabajadores ORDER BY nombre ASC";
$consulta_trabajadores = mysqli_query($conexion, $sql_trabajadores);
//Lista Trabajadores

//Lista Vehiculos
$sql_vehiculos = "SELECT * FROM unidades WHERE estado_unidad='disponible'";
$consulta_vehiculos = mysqli_query($conexion, $sql_vehiculos);
//

if (isset($_POST['btn_agregar'])) {
    $id_unidad_agregar = htmlspecialchars($_POST['agregar_vehiculo']);
    $id_trabajador_agregar = htmlspecialchars($_POST['agregar_trabajador']);
    $kilometraje_inicio_agregar = htmlspecialchars($_POST['kilometraje_inicio_agregar']);
    $gasolina_inicio_agregar = htmlspecialchars($_POST['gasolina_inicial_agregar']);

    $sql_agregar_salida = "INSERT INTO historial_unidad (id_unidad, id_trabajador, kilometraje_inicial, gasolina_inicial, fecha_salida) 
    VALUES ('$id_unidad_agregar', '$id_trabajador_agregar', '$kilometraje_inicio_agregar', '$gasolina_inicio_agregar', '$hoy')";
    $resultado_agregar_salida = mysqli_query($conexion, $sql_agregar_salida);

    if($resultado_agregar_salida){
        $actualizar_estado = mysqli_query($conexion, "UPDATE unidades SET estado_unidad='ocupado'
        WHERE id=$id_unidad_agregar");
        echo "<script>alert('Agregado Correctamente');</script>";
        echo "<script>window.location.replace('salida.php');</script>";
    } else {
        echo "<script>alert('Fallo al agregar');</script>";
        echo "<script>window.location.replace('salida.php');</script>";
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
            <h1>Vehiculo de Salida</h1>
            <a href="verificar_unidad.php" type="button" class="btn btn-danger">
                Volver
            </a>
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
                        <div class="form-group">
                            <label>Trabajador:</label>
                            <select class="form-control" name="agregar_trabajador" required>
                                <option value="">Seleccione Trabajador</option>
                                <?php
                                while ($row_trabajadores = mysqli_fetch_array($consulta_trabajadores, MYSQLI_ASSOC)) {
                                    $id_trabajador = $row_trabajadores['id'];
                                    $nombre_trabajador = $row_trabajadores['nombre'];
                                ?>
                                    <option value="<?php echo $id_trabajador; ?>"><?php echo $nombre_trabajador; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Kilometraje Inicio</label>
                            <input type="number" class="form-control" name="kilometraje_inicio_agregar" placeholder="Kilometraje Inicial">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label>Gasolina Inicial</label>
                            <input type="number" class="form-control" name="gasolina_inicial_agregar" placeholder="Gasolina Inicial">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="btn_agregar">Agregar</button>
            </form>
        </div>
    </div>

</body>

</html>
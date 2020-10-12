<?php
$titulo_pagina = "Incidencias | Checador Universal";
include 'header.html';
include 'sidebar.php';

$sql_incidencias = "SELECT * FROM reglas_incidencias WHERE id_incidencia=1";
$consulta_incidencias = mysqli_query($conexion, $sql_incidencias);
$row_incidencias = mysqli_fetch_assoc($consulta_incidencias);
$tolerancia_row = $row_incidencias['tolerancia'];
$retardo_row = $row_incidencias['retardo'];
$falta_row = $row_incidencias['falta'];


$timestamp_tolerancia = strtotime($tolerancia_row);
$timestamp_retardo = strtotime($retardo_row);
$timestamp_falta = strtotime($falta_row);


$minutos_tolerancia = date('i', $timestamp_tolerancia);
$minutos_retardo = date('i', $timestamp_retardo);
$minutos_falta = date('i', $timestamp_falta);

if (isset($_POST['btn_agregar'])) {
}

if (isset($_POST['btn_guardar'])) {
    $tolerancia = htmlspecialchars($_POST['tolerancia']);
    $retardo = htmlspecialchars($_POST['retardo']);
    $falta = htmlspecialchars($_POST['falta']);

    $sql_update = "UPDATE reglas_incidencias SET tolerancia='$tolerancia', retardo='$retardo', falta='$falta' 
    WHERE id_incidencia=1";

    $resultado_update = mysqli_query($conexion, $sql_update);
    if ($resultado_update) {
        echo "<script>alert('Actualizado Correctamente');</script>";
        echo "<script>window.location.replace('incidencias.php');</script>";
    } else {
        echo "<script>alert('Error al Actualizar');</script>";
        echo "<script>window.location.replace('incidencias.php');</script>";
    }
}


if (isset($_POST['btn_eliminar'])) {
}
?>

<!-- Main Content -->
<div id="content">

    <?php include 'topbar.php'; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <h2>Incidencias</h2>
            <div id="accordion">

                <!-- Lista de incidencias -->
                <div class="card">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#lista_incidencias">
                            Lista de Incidencias
                        </a>
                    </div>
                    <div id="lista_incidencias" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <form method="POST">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tolerancia</label>
                                    <select class="col-sm-6" name="tolerancia">
                                        <?php
                                        if ($tolerancia_row == '00:00:00') {
                                            echo "<option value='00:00:00'>Seleccione tiempo de Tolerancia</option>";
                                        } else {
                                            echo "<option value='$tolerancia_row'>$minutos_tolerancia  minutos </option>";
                                            echo "<option value='00:00:00>Sin tolerancia</option>";
                                        }
                                        ?>
                                        <option value="00:05:00">5 minutos</option>
                                        <option value="00:10:00">10 minutos</option>
                                        <option value="00:15:00">15 minutos</option>
                                        <option value="00:30:00">30 minutos</option>
                                    </select>
                                </div>



                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Retardo</label>
                                    <select class="col-sm-6" name="retardo">
                                        <?php
                                        if ($retardo_row == '00:00:00') {
                                            echo "<option value='00:00:00'>Seleccione tiempo de Retardo</option>";
                                        } else {
                                            echo "<option value='$retardo_row'>$minutos_retardo  minutos </option>";
                                            echo "<option value='00:00:00'>Sin Retardos</option>";
                                        }
                                        ?>
                                        <option value="00:05:00">5 minutos</option>
                                        <option value="00:10:00">10 minutos</option>
                                        <option value="00:15:00">15 minutos</option>
                                        <option value="00:30:00">30 minutos</option>
                                    </select>
                                </div>

                                <!-- Error de Duplicidad -->
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Retardo</label>
                                    <select class="col-sm-6" name="retardo">
                                        <?php
                                        if ($retardo_row == '00:00:00') {
                                            echo "<option value='00:00:00'>Seleccione tiempo de Retardo</option>";
                                        } else {
                                            echo "<option value='$retardo_row'>$minutos_retardo  minutos </option>";
                                            echo "<option value='00:00:00'>Sin Retardos</option>";
                                        }
                                        ?>
                                        <option value="00:05:00">5 minutos</option>
                                        <option value="00:10:00">10 minutos</option>
                                        <option value="00:15:00">15 minutos</option>
                                        <option value="00:30:00">30 minutos</option>
                                    </select>
                                </div>
                                <!-- Error de Duplicidad -->


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Falta</label>
                                    <select class="col-sm-6" name="falta">
                                        <?php
                                        if ($falta_row == '00:00:00') {
                                            echo "<option value='00:00:00'>Seleccione tiempo de Falta</option>";
                                        } else {
                                            echo "<option value='$falta_row'>$minutos_falta  minutos </option>";
                                            echo "<option value='00:00:00'>Sin Faltas</option>";
                                        }
                                        ?>
                                        <option value="00:05:00">5 minutos</option>
                                        <option value="00:10:00">10 minutos</option>
                                        <option value="00:15:00">15 minutos</option>
                                        <option value="00:30:00">30 minutos</option>
                                    </select>
                                </div>




                                <div class="form-group row">
                                    <div class="float-right">
                                        <input type="submit" class="btn btn-primary" value="Guardar" name="btn_guardar">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ./ Lista de incidencias -->

            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<script>
    //obtener datos para modificar
    function datos() {

    }
</script>

<?php include 'footer.php'; ?>
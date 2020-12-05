<?php
$titulo_pagina = "Trabajador Horarios | Checador Universal";
include 'header.html';
include 'sidebar.php';

$id_trabajador = htmlspecialchars($_GET['id_trabajador']);
$dia_semana = htmlspecialchars($_GET['dia_semana']);
///////////////////////////////////////////////////////////////
$sql_empleado = "SELECT nombre FROM trabajadores WHERE id=$id_trabajador";
$consulta_empleado = mysqli_query($conexion, $sql_empleado);
$row_empleado = mysqli_fetch_assoc($consulta_empleado);
$nombre_trabajador = $row_empleado['nombre'];
///////////////////////////////////////////////////////////////

$consulta_semana = mysqli_query($conexion, "SELECT dia FROM semana WHERE id=$dia_semana");
$row_semana = mysqli_fetch_assoc($consulta_semana);
$dia = $row_semana['dia'];

////////////////////////////////////////////////////////////
$sql_horarios = "SELECT * FROM horarios_trabajadores WHERE id_trabajador=$id_trabajador AND dia_semana=$dia_semana";
$consulta_horarios = mysqli_query($conexion, $sql_horarios);
$row_horarios = mysqli_fetch_assoc($consulta_horarios);
$dia_semana = $row_horarios['dia_semana'];
$hora_llegada = $row_horarios['hora_llegada'];
$hora_comida_salida = $row_horarios['hora_comida_salida'];
$hora_comida_llegada = $row_horarios['hora_comida_llegada'];
$hora_salida = $row_horarios['hora_salida'];
$estado = $row_horarios['estado'];

if ($estado == 1) {
    $checked = "checked";
    $disponible = "";
} else {
    $checked = "";
    $disponible = "disabled='disabled'";
}
////////////////////////////////////////////////////////////
if (isset($_POST['btn_guardar'])) {
    $id_trabajador_editar = $id_trabajador;
    $dia_semana_editar = $dia_semana;


    if (!empty($_POST['check'])) {
        $check_editar = htmlspecialchars($_POST['check']);

        $hora_llegada_editar = htmlspecialchars($_POST['hora_llegada_editar']);
        $hora_comida_salida_editar = htmlspecialchars($_POST['hora_comida_salida_editar']);
        $hora_comida_llegada_editar = htmlspecialchars($_POST['hora_comida_llegada_editar']);
        $hora_salida_editar = htmlspecialchars($_POST['hora_salida_editar']);

        if (!empty($hora_comida_salida_editar)) {
            $sql_editar = "UPDATE horarios_trabajadores SET hora_llegada='$hora_llegada_editar', 
            hora_comida_salida='$hora_comida_salida_editar', 
            hora_comida_llegada='$hora_comida_llegada_editar', 
            hora_salida='$hora_salida_editar',
            estado=1
            WHERE id_trabajador=$id_trabajador_editar AND dia_semana=$dia_semana_editar";
        } else {
            $sql_editar = "UPDATE horarios_trabajadores SET hora_llegada='$hora_llegada_editar', 
            hora_comida_salida=NULL, 
            hora_comida_llegada=NULL, 
            hora_salida='$hora_salida_editar',
            estado=1
            WHERE id_trabajador=$id_trabajador_editar AND dia_semana=$dia_semana_editar";
        }
    } else {
        $sql_editar = "UPDATE horarios_trabajadores SET hora_llegada=NULL, 
        hora_comida_salida=NULL, 
        hora_comida_llegada=NULL, 
        hora_salida=NULL, 
        estado=0 
        WHERE id_trabajador=$id_trabajador_editar AND dia_semana=$dia_semana_editar";
    }

    $resultado_editar = mysqli_query($conexion, $sql_editar);
    if ($resultado_editar) {
        echo "<script>alert('Editado Correctamente');</script>";
        echo $sql_editar;
        //echo "<script>window.location.replace('horarios_trabajador.php?id_trabajador=$id_trabajador_editar&dia_semana=$dia_semana');</script>";
    } else {
        echo "<script>alert('Error al editar');</script>";
        echo "<script>window.location.replace('editar_horario.php?id_trabajador=$id_trabajador_editar&dia_semana=$dia_semana');</script>";
    }
}

?>
<link href="css/sliden-button.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!------- FIN ESTILO BUSQUEDA -------------->
<!-- Main Content -->
<div id="content">

    <?php include 'topbar.php'; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Editar Horario Trabajador</h1>


        <!-- Lista de Trabajadores -->
        <div class="row alta_row">

            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#LISTA" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $dia; ?></h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="LISTA">
                    <div class="card-body">

                        <!--Ejemplo tabla con DataTables-->
                        <div class="container">

                            <div class="row">
                                <div class="col">
                                    <label>Trabajador:</label>
                                    <input type="text" class="form-control col-md-6" value="<?php echo $nombre_trabajador; ?>" readonly>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">

                                    <form action="" method="POST">
                                        <div class="col">
                                            <label>Lunes</label>
                                            <br>
                                            <label class="switch">
                                                <input type="checkbox" name="check" id="check" <?php echo $checked; ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Hora de Llegada</label>
                                            <input type="time" id="hora_llegada" name="hora_llegada_editar" class="form-control" value="<?php echo $hora_llegada; ?>" <?php echo $disponible; ?>>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Hora de Comida Salida</label>
                                            <input type="time" id="hora_comida_salida" name="hora_comida_salida_editar" class="form-control" value="<?php echo $hora_comida_salida; ?>" <?php echo $disponible; ?>>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label>Hora de Comida Llegada</label>
                                            <input type="time" id="hora_comida_llegada" name="hora_comida_llegada_editar" class="form-control" value="<?php echo $hora_comida_llegada; ?>" <?php echo $disponible; ?>>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label>Hora de Salida</label>
                                            <input type="time" id="hora_salida" name="hora_salida_editar" class="form-control" value="<?php echo $hora_salida; ?>" <?php echo $disponible; ?>>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <a href="horarios_trabajador.php?id_trabajador=<?php echo $id_trabajador; ?>&dia_semana=<?php echo $dia_semana; ?>" class="btn btn-danger">
                                                Volver
                                            </a>
                                            <input type="submit" value="Guardar" class="btn btn-primary" name="btn_guardar">
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Lista de Trabajadores -->


        </div>
        <!--////////////////////////////////////// -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php include 'footer.php'; ?>

<script>
    $(document).ready(function() {
        $("#check").click(function() {
            $("#hora_llegada").attr('disabled', !$("#hora_llegada").attr('disabled'));
            $("#hora_comida_salida").attr('disabled', !$("#hora_comida_salida").attr('disabled'));
            $("#hora_comida_llegada").attr('disabled', !$("#hora_comida_llegada").attr('disabled'));
            $("#hora_salida").attr('disabled', !$("#hora_salida").attr('disabled'));
        });
    });
</script>
<?php
$titulo_pagina = "Trabajador Horarios | Checador Universal";
include 'header.html';
include 'sidebar.php';

$id_trabajador = htmlspecialchars($_GET['id_trabajador']);

$sql_trabajador = "SELECT * FROM trabajadores WHERE id=$id_trabajador";
$consulta_trabajador = mysqli_query($conexion, $sql_trabajador);
$row_trabajador = mysqli_fetch_assoc($consulta_trabajador);
$nombre_trabajador = $row_trabajador['nombre'];

$consulta_lunes = mysqli_query($conexion, "SELECT * FROM horarios_trabajadores WHERE id_trabajador=$id_trabajador AND dia_semana='lunes'");
$consulta_martes = mysqli_query($conexion, "SELECT * FROM horarios_trabajadores WHERE id_trabajador=$id_trabajador AND dia_semana='martes'");
$consulta_miercoles = mysqli_query($conexion, "SELECT * FROM horarios_trabajadores WHERE id_trabajador=$id_trabajador AND dia_semana='miercoles'");
$consulta_jueves = mysqli_query($conexion, "SELECT * FROM horarios_trabajadores WHERE id_trabajador=$id_trabajador AND dia_semana='jueves'");
$consulta_viernes = mysqli_query($conexion, "SELECT * FROM horarios_trabajadores WHERE id_trabajador=$id_trabajador AND dia_semana='viernes'");
$consulta_sabado = mysqli_query($conexion, "SELECT * FROM horarios_trabajadores WHERE id_trabajador=$id_trabajador AND dia_semana='sabado'");
$consulta_domingo = mysqli_query($conexion, "SELECT * FROM horarios_trabajadores WHERE id_trabajador=$id_trabajador AND dia_semana='domingo'");

$row_lunes = mysqli_fetch_assoc($consulta_lunes);
$hora_llegada_lunes = $row_lunes['hora_llegada'];
$hora_comida_salida_lunes = $row_lunes['hora_comida_salida'];
$hora_comida_llegada_lunes = $row_lunes['hora_comida_llegada'];
$hora_salida_lunes = $row_lunes['hora_salida'];
$estado_lunes = $row_lunes['estado'];
if ($estado_lunes == 1) {
    $checked_lunes = "checked";
    $disponible_lunes = "";
} else {
    $checked_lunes = "";
    $disponible_lunes = "disabled='disabled'";
}

$row_mates = mysqli_fetch_assoc($consulta_martes);
$hora_llegada_martes = $row_mates['hora_llegada'];
$hora_comida_salida_martes = $row_mates['hora_comida_salida'];
$hora_comida_llegada_martes = $row_mates['hora_comida_llegada'];
$hora_salida_martes = $row_mates['hora_salida'];
$estado_martes = $row_mates['estado'];
if ($estado_martes == 1) {
    $checked_martes = "checked";
    $disponible_martes = "";
} else {
    $checked_martes = "";
    $disponible_martes = "disabled='disabled'";
}

$row_miercoles = mysqli_fetch_assoc($consulta_miercoles);
$hora_llegada_miercoles = $row_miercoles['hora_llegada'];
$hora_comida_salida_miercoles = $row_miercoles['hora_comida_salida'];
$hora_comida_llegada_miercoles = $row_miercoles['hora_comida_llegada'];
$hora_salida_miercoles = $row_miercoles['hora_salida'];
$estado_miercoles = $row_miercoles['estado'];
if ($estado_miercoles == 1) {
    $checked_miercoles = "checked";
    $disponible_miercoles = "";
} else {
    $checked_miercoles = "";
    $disponible_miercoles = "disabled='disabled'";
}

$row_jueves = mysqli_fetch_assoc($consulta_jueves);
$hora_llegada_jueves = $row_jueves['hora_llegada'];
$hora_comida_salida_jueves = $row_jueves['hora_comida_salida'];
$hora_comida_llegada_jueves = $row_jueves['hora_comida_llegada'];
$hora_salida_jueves = $row_jueves['hora_salida'];
$estado_jueves = $row_jueves['estado'];
if ($estado_jueves == 1) {
    $checked_jueves = "checked";
    $disponible_jueves = "";
} else {
    $checked_jueves = "";
    $disponible_jueves = "disabled='disabled'";
}

$row_viernes = mysqli_fetch_assoc($consulta_viernes);
$hora_llegada_viernes = $row_viernes['hora_llegada'];
$hora_comida_salida_viernes = $row_viernes['hora_comida_salida'];
$hora_comida_llegada_viernes = $row_viernes['hora_comida_llegada'];
$hora_salida_viernes = $row_viernes['hora_salida'];
$estado_viernes = $row_viernes['estado'];
if ($estado_viernes == 1) {
    $checked_viernes = "checked";
    $disponible_viernes = "";
} else {
    $checked_viernes = "";
    $disponible_viernes = "disabled='disabled'";
}

$row_sabado = mysqli_fetch_assoc($consulta_sabado);
$hora_llegada_sabado = $row_sabado['hora_llegada'];
$hora_comida_salida_sabado = $row_sabado['hora_comida_salida'];
$hora_comida_llegada_sabado = $row_sabado['hora_comida_llegada'];
$hora_salida_sabado = $row_sabado['hora_salida'];
$estado_sabado = $row_sabado['estado'];
if ($estado_sabado == 1) {
    $checked_sabado = "checked";
    $disponible_sabado = "";
} else {
    $checked_sabado = "";
    $disponible_sabado = "disabled='disabled'";
}

$row_domingo = mysqli_fetch_assoc($consulta_domingo);
$hora_llegada_domingo = $row_domingo['hora_llegada'];
$hora_comida_salida_domingo = $row_domingo['hora_comida_salida'];
$hora_comida_llegada_domingo = $row_domingo['hora_comida_llegada'];
$hora_salida_domingo = $row_domingo['hora_salida'];
$estado_domingo = $row_domingo['estado'];
if ($estado_domingo == 1) {
    $checked_domingo = "checked";
    $disponible_domingo = "";
} else {
    $checked_domingo = "";
    $disponible_domingo = "disabled='disabled'";
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
        <h1 class="h3 mb-4 text-gray-800">Horario Trabajador</h1>


        <!-- Lista de Trabajadores -->
        <div class="row alta_row">

            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#LISTA" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Trabajador</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="LISTA">
                    <div class="card-body">

                        <!--Ejemplo tabla con DataTables-->
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="#" method="POST" id="form_horarios">
                                        <input type="hidden" name="id_trabajador_horario_editar" id="id_trabajador_hor">

                                        <div class="row">
                                            <div class="col">
                                                <label>Trabajador:</label>
                                                <input type="text" class="form-control" value="<?php echo $nombre_trabajador; ?>" readonly>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col">
                                                <label>Lunes</label>
                                                <br>
                                                <label class="switch">
                                                    <input type="checkbox" name="check_lunes" id="check_lunes" <?php echo $checked_lunes; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Hora de Llegada</label>
                                                <input type="time" class="form-control" id="lunes_hora_llegada_edi" name="lunes_hora_llegada_editar"  value="<?php echo $hora_llegada_lunes; ?>" <?php echo $disponible_lunes; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Comida Salida</label>
                                                <input type="time" class="form-control" id="lunes_hora_comida_salida_edi" name="lunes_hora_comida_salida_editar" value="<?php echo $hora_comida_salida_lunes; ?>" <?php echo $disponible_lunes; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Comida Llegada</label>
                                                <input type="time" class="form-control" id="lunes_hora_comida_llegada_edi" name="lunes_hora_comida_llegada_editar" value="<?php echo $hora_comida_llegada_lunes; ?>" <?php echo $disponible_lunes; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Salida</label>
                                                <input type="time" class="form-control" id="lunes_hora_salida_edi" name="lunes_hora_salida_editar" value="<?php echo $hora_salida_lunes; ?>" <?php echo $disponible_lunes; ?>>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col">
                                                <label>Martes</label>
                                                <br>
                                                <label class="switch">
                                                    <input type="checkbox" id="check_martes" <?php echo $checked_martes; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Hora de Llegada</label>
                                                <input type="time" class="form-control" id="martes_hora_llegada_edi" name="martes_hora_llegada_editar" value="<?php echo $hora_llegada_martes; ?>" <?php echo $disponible_martes; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Comida Salida</label>
                                                <input type="time" class="form-control" id="martes_hora_comida_salida_edi" name="martes_hora_comida_salida_editar" value="<?php echo $hora_comida_salida_martes; ?>" <?php echo $disponible_martes; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Comida Llegada</label>
                                                <input type="time" class="form-control" id="martes_hora_comida_llegada_edi" name="martes_hora_comida_llegada_editar" value="<?php echo $hora_comida_llegada_martes; ?>" <?php echo $disponible_martes; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Salida</label>
                                                <input type="time" class="form-control" id="martes_hora_salida_edi" name="martes_hora_salida_editar" value="<?php echo $hora_salida_martes; ?>" <?php echo $disponible_martes; ?>>
                                            </div>
                                        </div>

                                        <br>


                                        <div class="row">
                                            <div class="col">
                                                <label>Miercoles</label>
                                                <br>
                                                <label class="switch">
                                                    <input type="checkbox" id="check_miercoles" <?php echo $checked_miercoles; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Hora de Llegada</label>
                                                <input type="time" class="form-control" id="miercoles_hora_llegada_edi" name="miercoles_hora_llegada_editar" value="<?php echo $hora_llegada_miercoles; ?>" <?php echo $disponible_miercoles; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Comida Salida</label>
                                                <input type="time" class="form-control" id="miercoles_hora_comida_salida_edi" name="miercoles_hora_comida_salida_editar" value="<?php echo $hora_comida_salida_miercoles; ?>" <?php echo $disponible_miercoles; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Comida Llegada</label>
                                                <input type="time" class="form-control" id="miercoles_hora_comida_llegada_edi" name="miercoles_hora_comida_llegada_editar" value="<?php echo $hora_comida_llegada_miercoles; ?>" <?php echo $disponible_miercoles; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Salida</label>
                                                <input type="time" class="form-control" id="miercoles_hora_salida_edi" name="miercoles_lunes_hora_salida_editar" value="<?php echo $hora_llegada_miercoles; ?>" <?php echo $disponible_miercoles; ?>>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Jueves</label>
                                                <br>
                                                <label class="switch">
                                                    <input type="checkbox" id="check_jueves" <?php echo $checked_jueves; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Hora de Llegada</label>
                                                <input type="time" class="form-control" id="jueves_hora_llegada_edi" name="jueves_hora_llegada_editar" value="<?php echo $hora_llegada_jueves; ?>" <?php echo $disponible_jueves; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Comida Salida</label>
                                                <input type="time" class="form-control" id="jueves_hora_comida_salida_edi" name="jueves_hora_comida_salida_editar" value="<?php echo $hora_comida_salida_jueves; ?>" <?php echo $disponible_jueves; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Comida Llegada</label>
                                                <input type="time" class="form-control" id="jueves_hora_comida_llegada_edi" name="jueves_hora_comida_llegada_editar" value="<?php echo $hora_comida_llegada_jueves; ?>" <?php echo $disponible_jueves; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Salida</label>
                                                <input type="time" class="form-control" id="jueves_hora_salida_edi" name="jueves_hora_salida_editar" value="<?php echo $hora_salida_lunes; ?>" <?php echo $disponible_jueves; ?>>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col">
                                                <label>Viernes</label>
                                                <br>
                                                <label class="switch">
                                                    <input type="checkbox" id="check_viernes" <?php echo $checked_viernes; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Hora de Llegada</label>
                                                <input type="time" class="form-control" id="viernes_hora_llegada_edi" name="viernes_hora_llegada_editar" value="<?php echo $hora_llegada_viernes; ?>" <?php echo $disponible_viernes; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Comida Salida</label>
                                                <input type="time" class="form-control" id="viernes_hora_comida_salida_edi" name="viernes_hora_comida_salida_editar" value="<?php echo $hora_comida_salida_viernes; ?>" <?php echo $disponible_viernes; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Comida Llegada</label>
                                                <input type="time" class="form-control" id="viernes_hora_comida_llegada_edi" name="viernes_hora_comida_llegada_editar" value="<?php echo $hora_comida_llegada_viernes; ?>" <?php echo $disponible_viernes; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Salida</label>
                                                <input type="time" class="form-control" id="viernes_hora_salida_edi" name="viernes_hora_salida_editar" value="<?php echo $hora_salida_lunes; ?>" <?php echo $disponible_viernes; ?>>
                                            </div>
                                        </div>

                                        <br>


                                        <div class="row">
                                            <div class="col">
                                                <label>Sabado</label>
                                                <br>
                                                <label class="switch">
                                                    <input type="checkbox" id="check_sabado" <?php echo $checked_sabado; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Hora de Llegada</label>
                                                <input type="time" class="form-control" id="sabado_hora_llegada_edi" name="sabado_hora_llegada_editar" value="<?php echo $hora_llegada_sabado; ?>" <?php echo $disponible_sabado; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Comida Salida</label>
                                                <input type="time" class="form-control" id="sabado_hora_comida_salida_edi" name="sabado_hora_comida_salida_editar" value="<?php echo $hora_comida_salida_sabado; ?>" <?php echo $disponible_sabado; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Comida Llegada</label>
                                                <input type="time" class="form-control" id="sabado_hora_comida_llegada_edi" name="sabado_hora_comida_llegada_editar" value="<?php echo $hora_comida_llegada_sabado; ?>" <?php echo $disponible_sabado; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Salida</label>
                                                <input type="time" class="form-control" id="sabado_hora_salida_edi" name="sabado_hora_salida_editar" value="<?php echo $hora_salida_sabado; ?>" <?php echo $disponible_sabado; ?>>
                                            </div>
                                        </div>

                                        <br>


                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Domingo</label>
                                                <br>
                                                <label class="switch">
                                                    <input type="checkbox" id="check_domingo" <?php echo $checked_domingo; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Hora de Llegada</label>
                                                <input type="time" class="form-control" id="domingo_hora_llegada_edi" name="domingo_hora_llegada_editar" value="<?php echo $hora_llegada_domingo; ?>" <?php echo $disponible_domingo; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Comida Salida</label>
                                                <input type="time" class="form-control" id="domingo_hora_comida_salida_edi" name="domingo_hora_comida_salida_editar" value="<?php echo $hora_comida_salida_domingo; ?>" <?php echo $disponible_domingo; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Comida Llegada</label>
                                                <input type="time" class="form-control" id="domingo_hora_comida_llegada_edi" name="domingo_hora_comida_llegada_editar" value="<?php echo $hora_comida_llegada_domingo; ?>" <?php echo $disponible_domingo; ?>>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Hora de Salida</label>
                                                <input type="time" class="form-control" id="domingo_hora_salida_edi" name="domingo_hora_salida_editar" value="<?php echo $hora_salida_domingo; ?>" <?php echo $disponible_domingo; ?>>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
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

<script>
    $(document).ready(function() {
        $("#check_lunes").click(function() {
            $("#lunes_hora_llegada_edi").attr('disabled', !$("#lunes_hora_llegada_edi").attr('disabled'));
            $("#lunes_hora_comida_salida_edi").attr('disabled', !$("#lunes_hora_comida_salida_edi").attr('disabled'));
            $("#lunes_hora_comida_llegada_edi").attr('disabled', !$("#lunes_hora_comida_llegada_edi").attr('disabled'));
            $("#lunes_hora_salida_edi").attr('disabled', !$("#lunes_hora_salida_edi").attr('disabled'));

        });

        $("#check_martes").click(function() {
            $("#martes_hora_llegada_edi").attr('disabled', !$("#martes_hora_llegada_edi").attr('disabled'));
            $("#martes_hora_comida_salida_edi").attr('disabled', !$("#martes_hora_comida_salida_edi").attr('disabled'));
            $("#martes_hora_comida_llegada_edi").attr('disabled', !$("#martes_hora_comida_llegada_edi").attr('disabled'));
            $("#martes_hora_salida_edi").attr('disabled', !$("#martes_hora_salida_edi").attr('disabled'));

        });


        $("#check_miercoles").click(function() {
            $("#miercoles_hora_llegada_edi").attr('disabled', !$("#miercoles_hora_llegada_edi").attr('disabled'));
            $("#miercoles_hora_comida_salida_edi").attr('disabled', !$("#miercoles_hora_comida_salida_edi").attr('disabled'));
            $("#miercoles_hora_comida_llegada_edi").attr('disabled', !$("#miercoles_hora_comida_llegada_edi").attr('disabled'));
            $("#miercoles_hora_salida_edi").attr('disabled', !$("#miercoles_hora_salida_edi").attr('disabled'));

        });


        $("#check_jueves").click(function() {
            $("#jueves_hora_llegada_edi").attr('disabled', !$("#jueves_hora_llegada_edi").attr('disabled'));
            $("#jueves_hora_comida_salida_edi").attr('disabled', !$("#jueves_hora_comida_salida_edi").attr('disabled'));
            $("#jueves_hora_comida_llegada_edi").attr('disabled', !$("#jueves_hora_comida_llegada_edi").attr('disabled'));
            $("#jueves_hora_salida_edi").attr('disabled', !$("#jueves_hora_salida_edi").attr('disabled'));

        });


        $("#check_viernes").click(function() {
            $("#viernes_hora_llegada_edi").attr('disabled', !$("#viernes_hora_llegada_edi").attr('disabled'));
            $("#viernes_hora_comida_salida_edi").attr('disabled', !$("#viernes_hora_comida_salida_edi").attr('disabled'));
            $("#viernes_hora_comida_llegada_edi").attr('disabled', !$("#viernes_hora_comida_llegada_edi").attr('disabled'));
            $("#viernes_hora_salida_edi").attr('disabled', !$("#viernes_hora_salida_edi").attr('disabled'));

        });


        $("#check_sabado").click(function() {
            $("#sabado_hora_llegada_edi").attr('disabled', !$("#sabado_hora_llegada_edi").attr('disabled'));
            $("#sabado_hora_comida_salida_edi").attr('disabled', !$("#sabado_hora_comida_salida_edi").attr('disabled'));
            $("#sabado_hora_comida_llegada_edi").attr('disabled', !$("#sabado_hora_comida_llegada_edi").attr('disabled'));
            $("#sabado_hora_salida_edi").attr('disabled', !$("#sabado_hora_salida_edi").attr('disabled'));

        });


        $("#check_domingo").click(function() {
            $("#domingo_hora_llegada_edi").attr('disabled', !$("#domingo_hora_llegada_edi").attr('disabled'));
            $("#domingo_hora_comida_salida_edi").attr('disabled', !$("#domingo_hora_comida_salida_edi").attr('disabled'));
            $("#domingo_hora_comida_llegada_edi").attr('disabled', !$("#domingo_hora_comida_llegada_edi").attr('disabled'));
            $("#domingo_hora_salida_edi").attr('disabled', !$("#domingo_hora_salida_edi").attr('disabled'));

        });
    });
</script>

<?php include 'footer.php'; ?>
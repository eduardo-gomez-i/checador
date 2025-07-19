<?php
$titulo_pagina = "Trabajador Horarios | Checador Universal";
include 'header.php';
include 'sidebar.php';

$id_trabajador = htmlspecialchars($_GET['id_trabajador']);
///////////////////////////////////////////////////////////////
$sql_empleado = "SELECT nombre FROM trabajadores WHERE id=$id_trabajador";
$consulta_empleado = mysqli_query($conexion, $sql_empleado);
$row_empleado = mysqli_fetch_assoc($consulta_empleado);
$nombre_trabajador = $row_empleado['nombre'];
///////////////////////////////////////////////////////////////

$sql_horarios = "SELECT * FROM horarios_trabajadores WHERE id_trabajador=$id_trabajador";
$consulta_horarios = mysqli_query($conexion, $sql_horarios);

////////////////////////////////////////////////////////////


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
                                <div class="col">
                                    <label>Trabajador:</label>
                                    <input type="text" class="form-control" value="<?php echo $nombre_trabajador; ?>" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" style="width:100%" data-pagecount="1">
                                            <thead>
                                                <tr>
                                                    <th>Dia</th>
                                                    <th>Hora Llegada</th>
                                                    <th>Hora Salida Comida</th>
                                                    <th>Hora Llegada Comida</th>
                                                    <th>Hora Salida</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row_horarios = mysqli_fetch_array($consulta_horarios, MYSQLI_ASSOC)) {
                                                    $dia_semana = $row_horarios['dia_semana'];
                                                    $hora_llegada = $row_horarios['hora_llegada'];
                                                    $hora_comida_salida = $row_horarios['hora_comida_salida'];
                                                    $hora_comida_llegada = $row_horarios['hora_comida_llegada'];
                                                    $hora_salida = $row_horarios['hora_salida'];
                                                    $estado = $row_horarios['estado'];
                                                    $ignorar_horario_comida = isset($row_horarios['ignorar_horario_comida']) ? $row_horarios['ignorar_horario_comida'] : 0;

                                                    $consulta_semana = mysqli_query($conexion, "SELECT dia FROM semana WHERE id=$dia_semana");
                                                    $row_semana = mysqli_fetch_assoc($consulta_semana);
                                                    $dia = $row_semana['dia'];

                                                    if ($estado == 1) {
                                                        $boton_estado = "<button type='button' class='btn btn-success'>Activo</button>";
                                                    } else {
                                                        $boton_estado = "<button type='button' class='btn btn-danger'>Inactivo</button>";
                                                    }
                                                ?>
                                                    <tr>
                                                        <td><?php echo $dia; ?></td>
                                                        <?php
                                                        if ($estado == 1) {
                                                        ?>
                                                            <td><?php echo $hora_llegada; ?></td>
                                                            <?php
                                                            if ($ignorar_horario_comida == 1) {
                                                            ?>
                                                                <td style="background-color: #28a745; color: white; text-align: center;">Sin horario de comida</td>
                                                                <td style="background-color: #28a745; color: white; text-align: center;">Sin horario de comida</td>
                                                            <?php
                                                            } else if (!empty($hora_comida_salida)) {
                                                            ?>
                                                                <td><?php echo $hora_comida_salida; ?></td>
                                                                <td><?php echo $hora_comida_llegada; ?></td>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <td style="background-color: red;"></td>
                                                                <td style="background-color: red;"></td>
                                                            <?php
                                                            }
                                                            ?>

                                                            <td><?php echo $hora_salida; ?></td>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <td style="background-color: red;"></td>
                                                            <td style="background-color: red;"></td>
                                                            <td style="background-color: red;"></td>
                                                            <td style="background-color: red;"></td>
                                                        <?php
                                                        }
                                                        ?>
                                                        <td>
                                                            <a href="editar_horario.php?id_trabajador=<?php echo $id_trabajador; ?>&dia_semana=<?php echo $dia_semana; ?>">
                                                                <i class='fas fa-edit'></i>
                                                            </a>
                                                        </td>
                                                        <td><?php echo $boton_estado; ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
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
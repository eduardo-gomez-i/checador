<?php
$titulo_pagina = "Nomina | Checador Universal";
include 'header.php';
include 'sidebar.php';

$hoy = date("d/M/Y");
$hoy_sql = date('Y-m-d');
$hora = date("H:i:s");


$sql_trabajadores = "SELECT * FROM nomina ORDER BY nombre ASC";
$consulta_trabajadores = mysqli_query($conexion, $sql_trabajadores);

?>

<!-- Main Content -->
<div id="content">

    <?php include 'topbar.php'; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Checador en tiempo real-->
        <div class="container">
            <h1 class="h3 mb-4 text-gray-800">Nomina</h1>
            <div id="accordion">

                <!-- Lista de Asistencias -->
                <div class="card">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#">
                            <h6 class="m-0 font-weight-bold text-primary">Fecha <?php echo $hoy; ?> </h6>
                        </a>
                    </div>
                    <div id="lista_incidencias" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead class="bg-light">
                                        <tr>
                                            <th onclick="sortTable(0)">Nombre</th>
                                            <th onclick="sortTable(1)">Departamento</th>
                                            <!--<th onclick="sortTable(2)">Puesto</th>-->
                                            <th>Dias Trabajados</th>
                                            <th>Horas Trabajadas</th>
                                            <th>Sueldo</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="bg-light">
                                        <th>Nombre</th>
                                        <th>Departamento</th>
                                        <!--<th>Puesto</th>-->
                                        <th>Dias Trabajados</th>
                                        <th>Horas Trabajadas</th>
                                        <th>Sueldo</th>
                                        <th>Estado</th>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        while ($row_trabajadores = mysqli_fetch_array($consulta_trabajadores, MYSQLI_ASSOC)) {
                                            //$id_trabajador = $row_trabajadores['id'];
                                            $nombre_trabajador = $row_trabajadores['nombre'];
                                            //$id_departamento_trabajador = $row_trabajadores['id_departamento'];
                                            //$puesto_trabajador = $row_trabajadores['puesto'];
                                            $nombre_departamento = $row_trabajadores['departamento'];
                                            $dias_trabajados = $row_trabajadores['dias_trabajados'];
                                            $horas_trabajadas = $row_trabajadores['horas_trabajadas'];
                                            $sueldo = $row_trabajadores['sueldo'];

                                            /*$consulta_departamento = mysqli_query($conexion, "SELECT departamento FROM departamentos WHERE id=$id_departamento_trabajador");
                                            $row_departamento = mysqli_fetch_assoc($consulta_departamento);
                                            

                                            $sql_asistencias = "SELECT * FROM asistencia WHERE id_trabajador=$id_trabajador AND fecha='$hoy_sql'";
                                            $consulta_asistencias = mysqli_query($conexion, $sql_asistencias);
                                            $row_asistencias = mysqli_fetch_assoc($consulta_asistencias);*/

                                            if (!empty($row_asistencias)) {
                                                $hora_entrada_row = $row_asistencias['hora_entrada'];
                                                $hora_comida_salida_row = $row_asistencias['hora_comida_salida'];
                                                $hora_comida_entrada_row = $row_asistencias['hora_comida_entrada'];
                                                $hora_salida_row = $row_asistencias['hora_salida'];
                                                $estado_trabajo_row = $row_asistencias['estado_trabajo'];
                                                $estado_incidencias_row = $row_asistencias['id_incidencia'];
                                            }

                                        ?>
                                            <tr>
                                                <td><?php echo $nombre_trabajador; ?></td>
                                                <td><?php echo $nombre_departamento; ?></td>
                                                <!--<td><?php echo $nombre_departamento; ?></td>-->
                                                <td><?php echo $dias_trabajados; ?></td>
                                                <td><?php echo $horas_trabajadas; ?></td>
                                                <td><?php echo $sueldo; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <!------- FIN TABLA -------------->

                            </div>


                        </div>
                    </div>
                </div>
                <!-- ./ Lista de Asistencias -->

            </div>
        </div>
        <!-- Checador en tiempo real-->

    </div>
    <!-- End of Main Content -->

</div>

<!-- Modales -->


<!-- Modales -->

<script>
    //obtener datos para modificar
</script>

<?php include 'footer.php'; ?>
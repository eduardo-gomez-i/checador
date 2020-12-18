<?php
$titulo_pagina = "Trabajadores | Checador Universal";
include 'header.php';
include 'sidebar.php';

//Lista Trabajadores
$sql_trabajadores = "SELECT * FROM trabajadores ORDER BY nombre ASC";
$consulta_trabajadores = mysqli_query($conexion, $sql_trabajadores);
//Lista Trabajadores

//Lista Permisos
$sql_permisos = "SELECT permisos.id, 
trabajadores.nombre, 
permisos.razon,
 permisos.fecha, 
 permisos.tipo, 
 permisos.descuento 
FROM permisos, trabajadores
WHERE permisos.id_trabajador=trabajadores.id";
$consulta_permisos = mysqli_query($conexion, $sql_permisos);
//Lista Permisos


if (isset($_POST['btn_agregar'])) {
    $agregar_trabajador = htmlspecialchars($_POST['agregar_trabajador']);
    $agregar_razon = htmlspecialchars($_POST['agregar_razon']);
    $agregar_fecha = htmlspecialchars($_POST['agregar_fecha']);
    $agregar_tipo = htmlspecialchars($_POST['agregar_tipo']);
    $agregar_descuento = htmlspecialchars($_POST['agregar_descuento']);

    $sql_insertar_permiso = "INSERT INTO permisos (id_trabajador, razon, fecha, tipo, descuento) 
    VALUES ('$agregar_trabajador', '$agregar_razon', '$agregar_fecha', '$agregar_tipo', '$agregar_descuento')";
    $consulta_insertar_empleado = mysqli_query($conexion, $sql_insertar_permiso);

    if ($consulta_insertar_empleado) {
        echo "<script>alert('Agregado Correctamente');</script>";
        echo "<script>window.location.replace('permisos.php');</script>";
    } else {
        echo "<script>alert('Fallo al agregar');</script>";
        echo "<script>window.location.replace('permisos.php');</script>";
    }
}

if (isset($_POST['btn_guardar'])) {
    $id_permiso_editar = htmlspecialchars($_POST['id_permiso_editar']);
    $razon_editar = htmlspecialchars($_POST['razon_editar']);
    $fecha_editar = htmlspecialchars($_POST['fecha_editar']);
    $tipo_editar = htmlspecialchars($_POST['tipo_editar']);
    $descuento_editar = htmlspecialchars($_POST['descuento_editar']);

    $sql_editar_permiso = "UPDATE permisos SET razon='$razon_editar', fecha='$fecha_editar', tipo='$tipo_editar', descuento='$descuento_editar'
    WHERE id=$id_permiso_editar";

    $resultado_editar_permiso = mysqli_query($conexion, $sql_editar_permiso);

    if ($resultado_editar_permiso) {
        echo "<script>alert('Editado Correctamente');</script>";
        echo "<script>window.location.replace('permisos.php');</script>";
    } else {
        echo "<script>alert('Fallo al editar');</script>";
        echo "<script>window.location.replace('permisos.php');</script>";
    }
}


if (isset($_POST['btn_eliminar'])) {
    $id_permiso_eliminar = htmlspecialchars($_POST['id_permiso_eliminar']);

    $sql_eliminar_permiso = "DELETE FROM permisos WHERE id=$id_permiso_eliminar";
    $resultado_eliminar_permiso = mysqli_query($conexion, $sql_eliminar_permiso);

    if ($resultado_eliminar_permiso) {
        echo "<script>alert('Eliminado Correctamente');</script>";
        echo "<script>window.location.replace('permisos.php');</script>";
    } else {
        echo "<script>alert('Error al eliminar');</script>";
        echo "<script>window.location.replace('permisos.php');</script>";
    }
}
?>

<!------- FIN ESTILO BUSQUEDA -------------->
<!-- Main Content -->
<div id="content">

    <?php include 'topbar.php'; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Permisos para Trabajadores</h1>


        <!--////////////////////////////////////// -->
        <!-- Content Row -->
        <div class="row alta_row">

            <!-- Alta de Trabajadores -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#ALTAS" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Generar Permiso</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="ALTAS">
                    <div class="card-body">

                        <form method="POST">

                            <div class="row">
                                <div class="col">
                                    <label>Trabajador</label>
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

                                <div class="col">
                                    <label>Razon</label>
                                    <input type="text" class="form-control" placeholder="Razon del Permiso" name="agregar_razon" required>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col">
                                    <label>Fecha</label>
                                    <input type="date" class="form-control" name="agregar_fecha" required>
                                </div>

                                <div class="col">
                                    <label>Tipo de permiso</label>
                                    <select class="form-control" name="agregar_tipo" required>
                                        <option value="">Seleccionar tipo de permiso</option>
                                        <option value="retardo">Retardo</option>
                                        <option value="falta">Falta</option>
                                    </select>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col">
                                    <label>Descuento</label>
                                    <input type="number" class="form-control" name="agregar_descuento" placeholder="Descuento" required>

                                </div>

                                <div class="col">

                                </div>
                            </div>

                            <br>

                            <div class="row">

                                <div class="col">
                                    <label></label>
                                    <button type="reset" class="btn btn-danger mt-3">Limpiar</button>
                                    <button type="submit" class="btn btn-primary mt-3" name="btn_agregar">Agregar</button>
                                </div>

                                <div class="col">
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- ./ Alta de Trabajadores -->

        <!-- Lista de Trabajadores -->
        <div class="row alta_row">

            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#LISTA" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de Permisos</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="LISTA">
                    <div class="card-body">

                        <!--Ejemplo tabla con DataTables-->
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <!------- ESTILO BUSQUEDA -------------->

                                        <!------- TABLA -------------->
                                        <!------- BUSQUEDA -------------->
                                        <input type="text" id="myInput" onkeyup="busqueda()" placeholder="Buscar por nombre">
                                        <!------- FIN BUSQUEDA -------------->
                                        <table id="myTable" class="table table-striped table-bordered" style="width:100%" data-pagecount="1">
                                            <thead>
                                                <tr>
                                                    <th onclick="sortTable(0)">ID</th>
                                                    <th onclick="sortTable(1)">Trabajador</th>
                                                    <th onclick="sortTable(2)">Razon</th>
                                                    <th onclick="sortTable(3)">Fecha</th>
                                                    <th onclick="sortTable(4)">Tipo</th>
                                                    <th onclick="sortTable(5)">Descuento</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row_permisos = mysqli_fetch_array($consulta_permisos, MYSQLI_ASSOC)) {
                                                    $id_permiso = $row_permisos['id'];
                                                    $nombre_trabajador_permiso = $row_permisos['nombre'];
                                                    $razon_permiso = $row_permisos['razon'];
                                                    $fecha_permiso = $row_permisos['fecha'];
                                                    $tipo_permiso = $row_permisos['tipo'];
                                                    $descuento_permiso = $row_permisos['descuento'];
                                                ?>
                                                    <tr>
                                                        <td><?php echo $id_permiso; ?></td>
                                                        <td><?php echo $nombre_trabajador_permiso; ?></td>
                                                        <td><?php echo $razon_permiso; ?></td>
                                                        <td><?php echo $fecha_permiso; ?></td>
                                                        <td><?php echo $tipo_permiso; ?></td>
                                                        <td><?php echo $descuento_permiso; ?></td>
                                                        <td>
                                                            <?php
                                                            echo "
                                                            <a data-toggle='modal' href='#modificar_permiso' 
                                                                onclick='editar(&quot;$id_permiso&quot;,
                                                                                &quot;$nombre_trabajador_permiso&quot;,
                                                                                &quot;$razon_permiso&quot;,
                                                                                &quot;$fecha_permiso&quot;,
                                                                                &quot;$tipo_permiso&quot;,
                                                                                &quot;$descuento_permiso&quot;);'>
                                                                    <i class='fas fa-file-signature'></i>
                                                            </a>
                                                            ";
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo "
                                                            <a data-toggle='modal' href='#eliminar_permiso'
                                                                onclick='eliminar(&quot;$id_permiso&quot;,
                                                                            &quot;$nombre_trabajador_permiso&quot;);'>
                                                                    <i class='fas fa-trash-alt'></i>
                                                            </a>
                                                            ";
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                        <!------- FIN TABLA -------------->
                                        <!------- PAGINACION -------------->
                                        <div id="pagination" class="pagination">
                                            <div class="col first">
                                                <p class="pagination-label">
                                                    Vista <span>1-10</span> of <span>36</span>
                                                </p>
                                            </div>
                                            <div class="col middle">
                                                <a href="#" class="first round">&#8249;&#8249;</a>
                                                <a href="#" class="previous round">&#8249;</a>
                                                <a href="#" class="round btn-page active">1</a>
                                                <a href="#" class="round btn-page">2</a>
                                                <a href="#" class="round btn-page">3</a>
                                                <a href="#" class="round btn-page">4</a>
                                                <a href="#" class="next round">&#8250;</a>
                                                <a href="#" class="last round">&#8250;&#8250;</a>
                                            </div>
                                            <div class="col last">
                                                Show
                                                <select class="cmb-row-count">
                                                    <option value="5">5</option>
                                                    <option value="10" selected>10</option>
                                                    <option value="15">15</option>
                                                </select>
                                                Rows
                                            </div>
                                        </div>
                                        <!------- FIN PAGINACION -------------->
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


<!-- Modales -->

<!-- Editar Permiso Modal -->
<div class="modal fade" id="modificar_permiso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form method="POST" id="form_editar">

                    <input type="hidden" id="id_permiso_edi" name="id_permiso_editar">

                    <div class="row">
                        <div class="col">
                            <label>Trabajador</label>
                            <input type="text" id="nombre_trabajador_edi" class="form-control" name="nombre_trabajador_editar" disabled>
                        </div>

                        <div class="col">
                            <label>Razon</label>
                            <input type="text" id="razon_edi" class="form-control" name="razon_editar" required>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <label>Fecha</label>
                            <input type="date" id="fecha_edi" class="form-control" name="fecha_editar" required>
                        </div>

                        <div class="col">
                            <label>Tipo de permiso</label>
                            <select class="form-control" id="tipo_edi" name="tipo_editar" required>
                                <option value="">Seleccionar tipo de permiso</option>
                                <option value="retardo">Retardo</option>
                                <option value="falta">Falta</option>
                            </select>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <label>Descuento</label>
                            <input type="number" id="descuento_edi" class="form-control" name="descuento_editar">

                        </div>

                        <div class="col">

                        </div>
                    </div>



                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="form_editar" class="btn btn-primary" name="btn_guardar">Guardar</button>
            </div>
        </div>

    </div>
</div>
<!-- ./ Editar Permiso Modal -->



<!-- Eliminar Trabajador Modal -->
<div class="modal fade" id="eliminar_permiso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Permiso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="form_eliminar">
                    <input type="hidden" id="id_permiso_eli" name="id_permiso_eliminar">
                    <div class="row">
                        <div class="col">
                            <label>Seguro que desea eliminar el permiso de</label>
                            <input type="text" class="form-control" id="nombre_trabajador_eli" readonly>
                        </div>

                    </div>
                    <br>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="form_eliminar" class="btn btn-primary" name="btn_eliminar">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<!-- ./ Eliminar Trabajador Modal -->
<!-- Modales -->
<script>
    function editar(id_permiso_php, nombre_trabajador_php, razon_php, fecha_php, tipo_php, descuento_php) {
        document.getElementById('id_permiso_edi').value = id_permiso_php;
        document.getElementById('nombre_trabajador_edi').value = nombre_trabajador_php;
        document.getElementById('razon_edi').value = razon_php;
        document.getElementById('fecha_edi').value = fecha_php;
        document.getElementById('tipo_edi').value = tipo_php;
        document.getElementById('descuento_edi').value = descuento_php;
    }

    function eliminar(id_permiso_php, nombre_trabajador_php) {
        document.getElementById('id_permiso_eli').value = id_permiso_php;
        document.getElementById('nombre_trabajador_eli').value = nombre_trabajador_php;
    }
</script>

<?php include 'footer.php'; ?>
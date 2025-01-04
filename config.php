<?php
$titulo_pagina = "Horarios | Checador Universal";
include 'header.php';
include 'sidebar.php';

if (isset($_POST['btn_guardar'])) {
    $hora = htmlspecialchars($_POST['horarioComida']);

    $sql_editar_incidencias = "UPDATE tipo_incidencias SET 
    nombre='$tipo_editar', tiempo='$tiempo_editar', descuento='$descuento_editar', id_departamento='$departamento_editar'
    WHERE id_incidencia=$id_incidencia_editar";
    $resultado_editar_incidencia = mysqli_query($conexion, $sql_editar_incidencias);

    if ($resultado_editar_incidencia) {
        echo "<script>alert('Editado Correctamente');</script>";
        echo "<script>window.location.replace('config.php');</script>";
    } else {
        echo "<script>alert('Fallo al Editar');</script>";
        echo "<script>window.location.replace('config.php');</script>";
    }
}
?>

<!-- Main Content -->
<div id="content">

    <?php include 'topbar.php'; ?>
    <!--////////////////////////////////////// -->
    <!-- Content Row -->
    <div class="row alta_row">


        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="container">
                <h2>Incidencias</h2>

                <!-- Lista de incidencias -->
                <div class="card">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#horarios">
                            Horarios
                        </a>
                    </div>
                    <div id="horarios" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <form action="configurar_horarios.php" method="POST">
                                        <div class="form-group">
                                            <label for="horarioComida">Horario de Comida</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="horarioComida" name="horarioComida">
                                                <label class="custom-control-label" for="horarioComida">Activar/Desactivar</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3" name="btn_guardar">Guardar Configuración</button>
                                    </form>
                                </div>
                            </div>
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

<!-- Modales -->

<!-- Editar Incidencia Modal -->
<div class="modal fade" id="modificar_incidencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="form_editar">
                    <input id="id_incidencia_edit" type="hidden" name="id_incidencia_editar">
                    <div class="row">
                        <div class="col">
                            <label>Tipo de Incidencia</label>
                            <input id="nombre_incidencia_edit" type="text" class="form-control" name="tipo_editar">
                        </div>
                        <div class="col">
                            <label>Tiempo minutos</label>
                            <input id="tiempo_incidencia_edit" type="number" class="form-control" name="tiempo_editar" min="0" max="120">
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col">
                            <label>Monto de Descuento en Nomina</label>
                            <input id="descuento_incidencia_edit" type="number" class="form-control" name="descuento_editar">
                        </div>
                        <div class="col">
                            <br>
                            <label>Departamento</label>
                            <select class="form-control" name="departamento_editar">
                                <option id="id_departamento_edit" value="">Selecciona Departamento</option>
                                <?php
                                $sql_departamentos = mysqli_query($conexion, "SELECT * FROM departamentos ORDER BY departamento ASC");
                                while ($row_departamentos = mysqli_fetch_array($sql_departamentos, MYSQLI_ASSOC)) {
                                    $id_departamento = $row_departamentos['id'];
                                    $nombre_departamento = $row_departamentos['departamento'];

                                    echo "<option value='$id_departamento'>$nombre_departamento</option>";
                                }
                                ?>
                            </select>
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
<!-- ./ Editar Incidencia Modal -->

<!-- Editar Incidencia Modal -->
<div class="modal fade" id="modificar_incidencia_new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="form_editar">
                    <input id="id_incidencia_edit" type="hidden" name="id_incidencia_editar">
                    <div class="row">
                        <div class="col">
                            <label>Tipo de Incidencia</label>
                            <input id="nombre_incidencia_edit" type="text" class="form-control" name="tipo_editar">
                        </div>
                        <div class="col">
                            <label>Tiempo minutos</label>
                            <input id="tiempo_incidencia_edit" type="number" class="form-control" name="tiempo_editar" min="0" max="120">
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col">
                            <label>Monto de Descuento en Nomina</label>
                            <input id="descuento_incidencia_edit" type="number" class="form-control" name="descuento_editar">
                        </div>
                        <div class="col">
                            <br>
                            <label>Departamento</label>
                            <select class="form-control" name="departamento_editar">
                                <option id="id_departamento_edit" value="">Selecciona Departamento</option>
                                <?php
                                $sql_departamentos = mysqli_query($conexion, "SELECT * FROM departamentos ORDER BY departamento ASC");
                                while ($row_departamentos = mysqli_fetch_array($sql_departamentos, MYSQLI_ASSOC)) {
                                    $id_departamento = $row_departamentos['id'];
                                    $nombre_departamento = $row_departamentos['departamento'];

                                    echo "<option value='$id_departamento'>$nombre_departamento</option>";
                                }
                                ?>
                            </select>
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
<!-- ./ Editar Incidencia Modal -->

<!-- Eliminar Trabajador Modal -->
<div class="modal fade" id="eliminar_incidencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Incidencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="form_eliminar">
                    <input type="hidden" id="id_incidencia_eli" name="id_incidencia_eliminar">
                    <div class="row">
                        <div class="col">
                            <label>Seguro que desea eliminar esta incidencia?</label>
                            <input type="text" class="form-control" id="nombre_incidecia_eli" readonly>
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

<!-- Eliminar Trabajador Modal -->
<div class="modal fade" id="eliminar_incidencia_new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Incidencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="delete_incidencia.php" method="POST" id="form_eliminar_new">
                    <input type="hidden" id="id_incidencia_eli_new" name="id_incidencia_eliminar_new">
                    <div class="col-auto">
                        <label>¿Seguro que desea eliminar esta incidencia?</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" id="nombre_incidecia_eli_new" readonly>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="fecha_eli" readonly>
                        </div>
                    </div>
                    <br>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="form_eliminar_new" class="btn btn-primary" name="btn_eliminar">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<!-- ./ Eliminar Trabajador Modal -->

<!-- /. Modales -->

<?php include 'footer.php'; ?>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"></script>
<script>
    $(document).ready(function() {
        $('#miTabla').DataTable({
            "paging": false,
            "ordering": true,
            "info": false,
            "searching": true,
            "filter": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json" // Establece el idioma a español
            }
        });
    });

    function editar(id_php, nombre_php, tiempo_php, descuento_php, id_departamento) {
        document.getElementById('id_incidencia_edit').value = id_php;
        document.getElementById('nombre_incidencia_edit').value = nombre_php;
        document.getElementById('tiempo_incidencia_edit').value = tiempo_php;
        document.getElementById('descuento_incidencia_edit').value = descuento_php;
        document.getElementById('id_departamento_edit').value = id_departamento;
    }

    function editarNew(id_php, nombre_php, tiempo_php, descuento_php, id_departamento) {
        document.getElementById('id_incidencia_edit').value = id_php;
        document.getElementById('nombre_incidencia_edit').value = nombre_php;
        document.getElementById('tiempo_incidencia_edit').value = tiempo_php;
        document.getElementById('descuento_incidencia_edit').value = descuento_php;
        document.getElementById('id_departamento_edit').value = id_departamento;
    }

    function eliminar(id_php, nombre_php) {
        document.getElementById('id_incidencia_eli').value = id_php;
        document.getElementById('nombre_incidecia_eli').value = nombre_php;
    }

    function eliminarNew(id_php, nombre_php, fecha) {
        document.getElementById('id_incidencia_eli_new').value = id_php;
        document.getElementById('nombre_incidecia_eli_new').value = nombre_php;
        document.getElementById('fecha_eli').value = fecha;
    }
</script>
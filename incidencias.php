<?php
$titulo_pagina = "Incidencias | Checador Universal";
include 'header.php';
include 'sidebar.php';

$sql_tipo_incidencias = "SELECT * FROM tipo_incidencias";
$consulta_tipo_incidencias = mysqli_query($conexion, $sql_tipo_incidencias);

if (isset($_POST['btn_agregar'])) {
    $tipo_agregar = htmlspecialchars($_POST['tipo_agregar']);
    $tiempo_agregar = htmlspecialchars($_POST['tiempo_agregar']);
    $descuento_agregar = htmlspecialchars($_POST['descuento_agregar']);
    $departamento_agregar = htmlspecialchars($_POST['departamento_agregar']);
    $sql_agregar_incidencia = "INSERT INTO tipo_incidencias (nombre, tiempo, descuento, id_departamento) 
    VALUES ('$tiempo_agregar','$tiempo_agregar','$descuento_agregar', '$departamento_agregar')";
    $resultado_agregar_incidencia = mysqli_query($conexion, $sql_agregar_incidencia);
    if ($resultado_agregar_incidencia) {
        echo "<script>alert('Agregado Correctamente');</script>";
        echo "<script>window.location.replace('incidencias.php');</script>";
    } else {
        echo "<script>alert('Fallo al agregar');</script>";
        echo "<script>window.location.replace('incidencias.php');</script>";
    }
}

if (isset($_POST['btn_guardar'])) {
    $id_incidencia_editar = htmlspecialchars($_POST['id_incidencia_editar']);
    $tipo_editar = htmlspecialchars($_POST['tipo_editar']);
    $tiempo_editar = htmlspecialchars($_POST['tiempo_editar']);
    $descuento_editar = htmlspecialchars($_POST['descuento_editar']);
    $departamento_editar = htmlspecialchars($_POST['departamento_editar']);

    $sql_editar_incidencias = "UPDATE tipo_incidencias SET 
    nombre='$tipo_editar', tiempo='$tiempo_editar', descuento='$descuento_editar', id_departamento='$departamento_editar'
    WHERE id_incidencia=$id_incidencia_editar";
    $resultado_editar_incidencia = mysqli_query($conexion, $sql_editar_incidencias);

    if ($resultado_editar_incidencia) {
        echo "<script>alert('Editado Correctamente');</script>";
        echo "<script>window.location.replace('incidencias.php');</script>";
    } else {
        echo "<script>alert('Fallo al Editar');</script>";
        echo "<script>window.location.replace('incidencias.php');</script>";
    }
}


if (isset($_POST['btn_eliminar'])) {
    $id_incidencia_eliminar = htmlspecialchars($_POST['id_incidencia_eliminar']);
    $sql_eliminar_incidecia = "DELETE FROM tipo_incidencias WHERE id_incidencia=$id_incidencia_eliminar";
    $resultado_eliminar_incidencia = mysqli_query($conexion, $sql_eliminar_incidecia);

    if ($resultado_eliminar_incidencia) {
        echo "<script>alert('Eliminado Correctamente');</script>";
        echo "<script>window.location.replace('incidencias.php');</script>";
    } else {
        echo "<script>alert('Fallo al Eliminar');</script>";
        echo "<script>window.location.replace('incidencias.php');</script>";
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
                <div id="accordion">
                    <!-- Agregar Incidencia-->
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link" data-toggle="collapse" href="#Agregar_Incidencia">
                                Agregar Incidencia
                            </a>
                        </div>
                        <!-- Card Content - Collapse -->
                        <div class="collapse" id="Agregar_Incidencia">
                            <div class="card-body">
                                <form action="#" method="POST">

                                    <div class="row">
                                        <div class="col">
                                            <label>Tipo de Incidencia</label>
                                            <input type="text" class="form-control" placeholder="Tipo de Incidencia" name="tipo_agregar">
                                        </div>
                                        <div class="col">
                                            <label>Tiempo</label>
                                            <input type="number" class="form-control" name="tiempo_agregar" min="0" max="120" placeholder="minutos de la incidencia">
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col">
                                            <label>Monto de Descuento en Nomina</label>
                                            <input type="number" class="form-control" name="descuento_agregar" placeholder="monto de descuento en nomina">
                                        </div>
                                        <div class="col">
                                            <label>Departamento</label>
                                            <select class="form-control" name="departamento_agregar" required>
                                                <option value="">Selecciona Departamento</option>
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


                                    <div class="row">
                                        <div class="col">
                                            <label></label>
                                            <button type="submit" class="btn btn-primary mt-3" name="btn_agregar">Agregar</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./ Agregar Incidencia -->

                <!-- Lista de incidencias -->
                <div class="card">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#lista_incidencias">
                            Lista de Incidencias
                        </a>
                    </div>
                    <div id="lista_incidencias" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" style="width:100%" data-pagecount="1">
                                            <thead>
                                                <tr>
                                                    <th>Incidencia</th>
                                                    <th>Tiempo</th>
                                                    <th>Departamento</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row_tipo_incidencias = mysqli_fetch_array($consulta_tipo_incidencias, MYSQLI_ASSOC)) {
                                                    $id_incidencia = $row_tipo_incidencias['id_incidencia'];
                                                    $nombre_incidencia = $row_tipo_incidencias['nombre'];
                                                    $tiempo_incidencia = $row_tipo_incidencias['tiempo'];
                                                    $descuento_incidencia = $row_tipo_incidencias['descuento'];
                                                    $id_departamento_incidencia = $row_tipo_incidencias['id_departamento'];

                                                    $consulta_departamento = mysqli_query($conexion, "SELECT * FROM departamentos WHERE id=$id_departamento_incidencia");
                                                    $row_departamento = mysqli_fetch_assoc($consulta_departamento);
                                                    if (!empty($row_departamento)) {
                                                        $id_departamento = $row_departamento['id'];
                                                        $nombre_departamento = $row_departamento['departamento'];
                                                    } else {
                                                        $id_departamento = 0;
                                                        $nombre_departamento = "Sin Departamento";
                                                    }
                                                ?>
                                                    <tr>
                                                        <td><?php echo $nombre_incidencia; ?></td>
                                                        <td><?php echo $tiempo_incidencia; ?></td>
                                                        <td><?php echo $nombre_departamento; ?></td>
                                                        <td style='text-align:center'>
                                                            <?php
                                                            echo "
                                                                <a data-toggle='modal' href='#modificar_incidencia' 
                                                                    onclick='editar(&quot;$id_incidencia&quot;,
                                                                                    &quot;$nombre_incidencia&quot;,
                                                                                    &quot;$tiempo_incidencia&quot;,
                                                                                    &quot;$descuento_incidencia&quot;,
                                                                                    &quot;$id_departamento&quot;);'>
                                                                    <i class='fas fa-edit'></i>
                                                                </a>
                                                            ";
                                                            ?>
                                                        </td>
                                                        <td style='text-align:center'>
                                                            <?php
                                                            echo " 
                                                                <a data-toggle='modal' href='#eliminar_incidencia'
                                                                    onclick='eliminar(&quot;$id_incidencia&quot;,
                                                                                      &quot;$nombre_incidencia&quot;);'>
                                                                        <i class='fas fa-trash-alt'></i>
                                                                </a>
                                                            ";
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
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

<!-- /. Modales -->

<?php include 'footer.php'; ?>

<script>
    function editar(id_php, nombre_php, tiempo_php, descuento_php, id_departamento) {
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
</script>
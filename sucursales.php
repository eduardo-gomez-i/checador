<?php
$titulo_pagina = "Sucursal | Checador Universal";
include 'header.php';
include 'sidebar.php';

$sql_departamentos = "SELECT * FROM sucursales";
$consulta_departamentos = mysqli_query($conexion, $sql_departamentos);

if (isset($_POST['btn_agregar'])) {
    $departamento_agregar = htmlspecialchars($_POST['departamento_agregar']);
    $sql_agregar_departamento = "INSERT INTO sucursales (sucursal) VALUES ('$departamento_agregar')";
    $resultado_agregar_departamento = mysqli_query($conexion, $sql_agregar_departamento);
    if ($resultado_agregar_departamento) {
        echo "<script>alert('Agregado Correctamente');</script>";
        echo "<script>window.location.replace('sucursales.php');</script>";
    } else {
        echo "<script>alert('Fallo al agregar');</script>";
        echo "<script>window.location.replace('sucursales.php');</script>";
    }
}

if (isset($_POST['btn_guardar'])) {
    $id_departamento_editar = htmlspecialchars($_POST['id_departamento_editar']);
    $departamento_editar = htmlspecialchars($_POST['departamento_editar']);
    $sql_editar_departamento = "UPDATE sucursales SET sucursal='$departamento_editar' WHERE id=$id_departamento_editar";
    $resultado_editar_departamento = mysqli_query($conexion, $sql_editar_departamento);
    if ($resultado_editar_departamento) {
        echo "<script>alert('Editado Correctamente');</script>";
        echo "<script>window.location.replace('sucursales.php');</script>";
    } else {
        echo "<script>alert('Error al Editar');</script>";
        echo "<script>window.location.replace('sucursales.php');</script>";
    }
}


if (isset($_POST['btn_eliminar'])) {
    $id_departameto_eliminar = htmlspecialchars($_POST['id_departamento_eliminar']);
    $sql_eliminar_departamento = "DELETE FROM sucursales WHERE id=$id_departameto_eliminar";
    $resultado_eliminar_departamento = mysqli_query($conexion, $sql_eliminar_departamento);
    if ($resultado_eliminar_departamento) {
        echo "<script>alert('Eliminado Correctamente');</script>";
        echo "<script>window.location.replace('sucursales.php');</script>";
    } else {
        echo "<script>alert('Error al Eliminar');</script>";
        echo "<script>window.location.replace('sucursales.php');</script>";
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
                <h2>Sucursales</h2>
                <div id="accordion">
                    <!-- Agregar Incidencia-->
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link" data-toggle="collapse" href="#Agregar_Incidencia">
                                Agregar Sucursal
                            </a>
                        </div>
                        <!-- Card Content - Collapse -->
                        <div class="collapse" id="Agregar_Incidencia">
                            <div class="card-body">
                                <form action="#" method="POST">

                                    <div class="row">
                                        <div class="col">
                                            <label>Sucursal</label>
                                            <input type="text" class="form-control" placeholder="Nombre del Departamento" name="departamento_agregar" required>
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
                <div class="card mt-4">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#lista_incidencias">
                            Lista de Sucursales
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
                                                    <th>Sucursal</th>
                                                    <th>Total Empleados</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row_departamentos = mysqli_fetch_array($consulta_departamentos, MYSQLI_ASSOC)) {
                                                    $id_departamento = $row_departamentos['id'];
                                                    $nombre_departamento = $row_departamentos['sucursal'];

                                                    $consulta_trabajadores = mysqli_query($conexion, "SELECT * FROM trabajadores WHERE id_sucursal=$id_departamento");
                                                    $total_trabajadores = mysqli_num_rows($consulta_trabajadores);

                                                ?>
                                                    <tr>
                                                        <td><?php echo $nombre_departamento; ?></td>
                                                        <td><?php echo $total_trabajadores; ?></td>
                                                        <td style='text-align:center'>
                                                            <?php
                                                            echo "
                                                                <a data-toggle='modal' href='#modificar_departamento' 
                                                                    onclick='editar(&quot;$id_departamento&quot;,
                                                                                    &quot;$nombre_departamento&quot;);'>
                                                                    <i class='fas fa-edit'></i>
                                                                </a>
                                                            ";
                                                            ?>
                                                        </td>
                                                        <td style='text-align:center'>
                                                            <?php
                                                            echo " 
                                                                <a data-toggle='modal' href='#eliminar_departamento'
                                                                    onclick='eliminar(&quot;$id_departamento&quot;,
                                                                                      &quot;$nombre_departamento&quot;);'>
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
<div class="modal fade" id="modificar_departamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Sucursal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="form_editar">
                    <input type="hidden" id="id_departamento_edit" name="id_departamento_editar">
                    <div class="row">
                        <div class="col">
                            <label>Departamento</label>
                            <input type="text" class="form-control" id="nombre_departamento_edit" name="departamento_editar">
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
<div class="modal fade" id="eliminar_departamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Sucursal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="form_eliminar">
                    <input type="hidden" id="id_departamento_eli" name="id_departamento_eliminar">
                    <div class="row">
                        <div class="col">
                            <label>Seguro que desea eliminar esta sucursal?</label>
                            <input type="text" class="form-control" id="nombre_departamento_eli" readonly>
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
    function editar(id_php, nombre_php) {
        document.getElementById('id_departamento_edit').value = id_php;
        document.getElementById('nombre_departamento_edit').value = nombre_php;
    }

    function eliminar(id_php, nombre_php) {
        document.getElementById('id_departamento_eli').value = id_php;
        document.getElementById('nombre_departamento_eli').value = nombre_php;
    }
</script>
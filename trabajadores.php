<?php
//include 'conex.php';
$titulo_pagina = "Trabajadores | Checador Universal";
include 'header.php';
include 'sidebar.php';

$sql_trabajadores = "SELECT trabajadores.*,sucursales.sucursal  FROM trabajadores 
LEFT JOIN sucursales ON sucursales.id = trabajadores.id_sucursal
ORDER BY nombre ASC";
$consulta_trabajadores = mysqli_query($conexion, $sql_trabajadores);

if (isset($_POST['btn_agregar'])) {
    $nombre_agregar = htmlspecialchars($_POST['nombre_agregar']);
    $direccion_agregar = htmlspecialchars($_POST['direccion_agregar']);
    $telefono_agregar = htmlspecialchars($_POST['telefono_agregar']);
    $genero_agregar = htmlspecialchars($_POST['genero_agregar']);
    $fecha_nacimiento_agregar = htmlspecialchars($_POST['fecha_nacimiento_agregar']);
    $estado_civil_agregar = htmlspecialchars($_POST['estado_civil_agregar']);
    $departamento_agregar = htmlspecialchars($_POST['departamento_agregar']);
    $sucursal_agregar = htmlspecialchars($_POST['sucursal_agregar']);
    $puesto_agregar = htmlspecialchars($_POST['puesto_agregar']);
    $lector_agregar = htmlspecialchars($_POST['lector_agregar']);
    $sueldo_agregar = htmlspecialchars($_POST['sueldo_agregar']);
    $fecha_inicio_agregar = htmlspecialchars($_POST['fecha_inicio_agregar']);
    $tipo_pago_agregar = htmlspecialchars($_POST['tipo_pago_agregar']);

    $sql_insertar_trabajador = "INSERT INTO trabajadores (nombre, direccion, telefono, genero, estado_civil, id_departamento, puesto, sueldo, fecha_ingreso, fecha_nacimiento, tipo_pago, id_sucursal, id_lector, foto) 
    VALUES ('$nombre_agregar','$direccion_agregar','$telefono_agregar','$genero_agregar','$estado_civil_agregar','$departamento_agregar','$puesto_agregar','$sueldo_agregar','$fecha_inicio_agregar','$fecha_nacimiento_agregar', '$tipo_pago_agregar','$sucursal_agregar','$lector_agregar','')";

    $consulta_insertar_trabajar = mysqli_query($conexion, $sql_insertar_trabajador);

    if ($consulta_insertar_trabajar) {
        $ultimo_trabajadador = mysqli_query($conexion, "SELECT id FROM trabajadores ORDER BY id DESC LIMIT 1");
        $row_ultimo_trabajador = mysqli_fetch_assoc($ultimo_trabajadador);
        $id_ultimo = $row_ultimo_trabajador['id'];

        $sql_insertar_lunes = "INSERT INTO horarios_trabajadores 
        (id_trabajador, dia_semana, estado) 
        VALUES ('$id_ultimo', 1, 0)";

        $sql_insertar_martes = "INSERT INTO horarios_trabajadores 
        (id_trabajador, dia_semana, estado) 
        VALUES ('$id_ultimo', 2, 0)";

        $sql_insertar_miercoles = "INSERT INTO horarios_trabajadores 
        (id_trabajador, dia_semana, estado) 
        VALUES ('$id_ultimo', 3, 0)";

        $sql_insertar_jueves = "INSERT INTO horarios_trabajadores 
        (id_trabajador, dia_semana, estado) 
        VALUES ('$id_ultimo', 4, 0)";

        $sql_insertar_viernes = "INSERT INTO horarios_trabajadores 
        (id_trabajador, dia_semana, estado) 
        VALUES ('$id_ultimo', 5, 0)";

        $sql_insertar_sabado = "INSERT INTO horarios_trabajadores 
        (id_trabajador, dia_semana, estado) 
        VALUES ('$id_ultimo', 6, 0)";

        $sql_insertar_domingo = "INSERT INTO horarios_trabajadores 
        (id_trabajador, dia_semana, estado) 
        VALUES ('$id_ultimo', 7, 0)";

        $resultado_lunes = mysqli_query($conexion, $sql_insertar_lunes);
        $resultado_martes = mysqli_query($conexion, $sql_insertar_martes);
        $resultado_miercoles = mysqli_query($conexion, $sql_insertar_miercoles);
        $resultado_jueves = mysqli_query($conexion, $sql_insertar_jueves);
        $resultado_viernes = mysqli_query($conexion, $sql_insertar_viernes);
        $resultado_sabado = mysqli_query($conexion, $sql_insertar_sabado);
        $resultado_domingo = mysqli_query($conexion, $sql_insertar_domingo);

        echo "<script>alert('Agregado Correctamente');</script>";
        echo "<script>window.location.replace('trabajadores.php');</script>";
    } else {
        echo "<script>alert('Fallo al agregar');</script>";
        //echo $sql_insertar_trabajador;
        echo "<script>window.location.replace('trabajadores.php');</script>";
    }
}

if (isset($_POST['btn_guardar'])) {
    $id_trabajador_editar = htmlspecialchars($_POST['id_trabajador_editar']);
    $nombre_editar = htmlspecialchars($_POST['nombre_editar']);
    $direccion_editar = htmlspecialchars($_POST['direccion_editar']);
    $telefono_editar = htmlspecialchars($_POST['telefono_editar']);
    $genero_editar = htmlspecialchars($_POST['genero_editar']);
    $fecha_nacimiento_editar = htmlspecialchars($_POST['fecha_nacimiento_editar']);
    $estado_civil_editar = htmlspecialchars($_POST['estado_civil_editar']);
    $departamento_editar = htmlspecialchars($_POST['departamento_editar']);
    $sucursal_editar = htmlspecialchars($_POST['sucursal_editar']);
    $puesto_editar = htmlspecialchars($_POST['puesto_editar']);
    $lector_editar = htmlspecialchars($_POST['lector_editar']);
    $sueldo_editar = htmlspecialchars($_POST['salario_editar']);
    $fecha_inicio_editar = htmlspecialchars($_POST['fecha_inicio_editar']);
    $tipo_pago_editar = htmlspecialchars($_POST['tipo_pago_editar']);

    // Manejar la imagen subida
    $ruta_imagen = ""; // Variable para almacenar la ruta de la imagen
    if (isset($_FILES['foto_editar']) && $_FILES['foto_editar']['error'] == 0) {
        $nombre_archivo = $_FILES['foto_editar']['name'];
        $ruta_temporal = $_FILES['foto_editar']['tmp_name'];
        $ruta_destino = "./img/perfil/" . $nombre_archivo; // Cambia esto por la ruta donde quieras guardar las imágenes
        if (move_uploaded_file($ruta_temporal, $ruta_destino)) {
            $ruta_imagen = $ruta_destino;
        } else {
            // Manejar errores si la imagen no se pudo mover
        }
    }

    $sql_editar_trabajador = "UPDATE trabajadores SET 
    nombre='$nombre_editar', 
    direccion='$direccion_editar', 
    telefono='$telefono_editar', 
    genero='$genero_editar', 
    estado_civil='$estado_civil_editar', 
    id_departamento='$departamento_editar', 
    id_sucursal='$sucursal_editar', 
    id_lector='$lector_editar', 
    puesto='$puesto_editar', 
    sueldo='$sueldo_editar', 
    tipo_pago='$tipo_pago_editar',
    fecha_ingreso='$fecha_inicio_editar', 
    fecha_nacimiento='$fecha_nacimiento_editar',
    foto='$ruta_imagen'
    WHERE id=$id_trabajador_editar";
    $resultado_editar_trabajador = mysqli_query($conexion, $sql_editar_trabajador);

    if ($resultado_editar_trabajador) {
        echo "<script>alert('Editado Correctamente');</script>";
        echo "<script>window.location.replace('trabajadores.php');</script>";
    } else {
        echo "<script>alert('Error al Editar');</script>";
        echo "<script>window.location.replace('trabajadores.php');</script>";
    }
}


if (isset($_POST['btn_eliminar'])) {
    $id_trabajador_eliminar = htmlspecialchars($_POST['id_trabajador_eliminar']);

    $sql_eliminar_trabajador = "DELETE FROM trabajadores WHERE id=$id_trabajador_eliminar";
    $resultad_eliminar_trabajador = mysqli_query($conexion, $sql_eliminar_trabajador);

    if ($resultad_eliminar_trabajador) {
        echo "<script>alert('Trabajador Eliminado Correctamente');</script>";
        echo "<script>window.location.replace('trabajadores.php');</script>";
    } else {
        echo "<script>alert('Error al eliminar trabajador');</script>";
        echo "<script>window.location.replace('trabajadores.php');</script>";
    }
}

//Actualizar Horarios 


?>
<!------- FIN ESTILO BUSQUEDA -------------->
<!-- Main Content -->
<div id="content">

    <?php include 'topbar.php'; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Trabajadores</h1>


        <!--////////////////////////////////////// -->
        <!-- Content Row -->
        <div class="row alta_row">

            <!-- Alta de Trabajadores -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#ALTAS" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Altas</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="ALTAS">
                    <div class="card-body">
                        <form action="#" method="POST">

                            <div class="row">
                                <div class="col">
                                    <label>Nombre del empleado</label>
                                    <input type="text" class="form-control" placeholder="Nombre del empleado" name="nombre_agregar">
                                </div>

                                <div class="col">
                                    <label>Direccion del empleado</label>
                                    <input type="text" class="form-control" placeholder="Direccion" name="direccion_agregar">
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col">
                                    <label>Genero</label>
                                    <select name="genero_agregar" class="form-control" required>
                                        <option value="">Seleccione Genero</option>
                                        <option value="Hombre">Hombre</option>
                                        <option value="Mujer">Mujer</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label>Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" name="fecha_nacimiento_agregar" name="fecha_nacimiento_agregar">
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col">
                                    <label>Estado Civil</label>
                                    <select name="estado_civil_agregar" class="form-control" required>
                                        <option value="">Seleccione Estado Civil</option>
                                        <option value="Soltero(a)">Soltero(a)</option>
                                        <option value="Casado(a)">Casado(a)</option>
                                        <option value="Viudo(a)">Viudo(a)</option>
                                        <option value="Divorsiado(a)">Divorsiado(a)</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label>Telefono</label>
                                    <input type="tel" class="form-control" placeholder="Telefono" name="telefono_agregar" placeholder="1234567890" pattern="[0-9]{10}">

                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col">
                                    <label>Tipo de Pago</label>
                                    <select name="tipo_pago_agregar" class="form-control" required>
                                        <option value="">Seleccione Tipo de Pago</option>
                                        <option value="mensual">Mensual</option>
                                        <option value="quincenal">Quincenal</option>
                                        <option value="catorcenal">Catorcenal</option>
                                        <option value="semanal">Semanal</option>
                                        <option value="diario">Por Dia</option>
                                        <option value="hora">Por Hora</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label>Salario</label>
                                    <input type="number" class="form-control" placeholder="Salario" name="sueldo_agregar">
                                </div>
                            </div>

                            <br>

                            <div class="row">
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

                                <div class="col">
                                    <label>Puesto</label>
                                    <input type="text" class="form-control" placeholder="Puesto" name="puesto_agregar">
                                </div>

                            </div>

                            <br>

                            <div class="row">
                                <div class="col">
                                    <label>Fecha de Inicio</label>
                                    <input type="date" class="form-control" placeholder="Fecha de Inicio" name="fecha_inicio_agregar">
                                </div>

                                <div class="col">
                                    <label>Sucursal</label>
                                    <select class="form-control" name="sucursal_agregar" required>
                                        <option value="">Selecciona Sucursal</option>
                                        <?php
                                        $sql_sucursales = mysqli_query($conexion, "SELECT * FROM sucursales ORDER BY sucursal ASC");
                                        while ($row_sucursales = mysqli_fetch_array($sql_sucursales, MYSQLI_ASSOC)) {
                                            $id_sucursal = $row_sucursales['id'];
                                            $nombre_sucursal = $row_sucursales['sucursal'];

                                            echo "<option value='$id_sucursal'>$nombre_sucursal</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                
                            </div>

                            <br>

                            <div class="row">
                                <div class="col">
                                    <label>ID lector</label>
                                    <input type="text" class="form-control" placeholder="ID lector" name="lector_agregar">
                                </div>
                                <div class="col">

                                </div>
                            </div>
                            
                            <br>

                            <div class="row">
                                <div class="col">
                                </div>
                                <div class="col">
                                    <label></label>
                                    <button type="reset" class="btn btn-danger mt-3">Limpiar</button>
                                    <button type="submit" class="btn btn-primary mt-3" name="btn_agregar">Agregar</button>
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
                    <h6 class="m-0 font-weight-bold text-primary">Lista de Trabajadores</h6>
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
                                        <table id="miTabla" class="table table-striped table-bordered" style="width:100%" data-pagecount="1">
                                            <thead>
                                                <tr>
                                                    <th onclick="sortTable(0)">ID Lector</th>
                                                    <th onclick="sortTable(1)">Nombre</th>
                                                    <th onclick="sortTable(2)">Genero</th>
                                                    <th onclick="sortTable(3)">Edad</th>
                                                    <th onclick="sortTable(4)">Telefono</th>
                                                    <th onclick="sortTable(5)">Departamento</th>
                                                    <th onclick="sortTable(6)">Sucursal</th>
                                                    <th onclick="sortTable(7)">Tipo Pago</th>
                                                    <th onclick="sortTable(8)">Salario</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row_trabajadores = mysqli_fetch_array($consulta_trabajadores, MYSQLI_ASSOC)) {
                                                    $id_trabajador = $row_trabajadores['id'];
                                                    $nombre_trabajador = $row_trabajadores['nombre'];
                                                    $direccion_trabajador = $row_trabajadores['direccion'];
                                                    $genero_trabajador = $row_trabajadores['genero'];
                                                    $fecha_nacimiento_trabajador = $row_trabajadores['fecha_nacimiento'];
                                                    $estado_civil_trabajador = $row_trabajadores['estado_civil'];
                                                    $telefono_trabajador = $row_trabajadores['telefono'];
                                                    $departamento_trabajador = $row_trabajadores['id_departamento'];
                                                    $sucursal_trabajador = $row_trabajadores['sucursal'];
                                                    $puesto_trabajador = $row_trabajadores['puesto'];
                                                    $salario_trabajador = $row_trabajadores['sueldo'];
                                                    $tarjeta_trabajador = $row_trabajadores['id_lector'];
                                                    $fecha_ingreso_trabajador = $row_trabajadores['fecha_ingreso'];
                                                    $sucursal_id = $row_trabajadores['id_sucursal'];
                                                    $foto = isset($row_trabajadores['foto']) ? $row_trabajadores['foto'] : '';
                                                    $tipo_pago_trabajador = $row_trabajadores['tipo_pago'];


                                                    if ($departamento_trabajador) {
                                                        $consulta_departamento = mysqli_query($conexion, "SELECT * FROM departamentos WHERE id=$departamento_trabajador");
                                                        $row_departamento = mysqli_fetch_assoc($consulta_departamento);
                                                        if (!empty($row_departamento)) {
                                                            $id_departamento_trabajador = $row_departamento['id'];
                                                            $nombre_departamento_trabajador = $row_departamento['departamento'];
                                                        } else {
                                                            $nombre_departamento_trabajador = "Sin Departamento";
                                                        }
                                                    } else {
                                                        $nombre_departamento_trabajador = "Sin Departamento";
                                                    }



                                                    //Calcular Edad
                                                    $cumpleanos = new DateTime($fecha_nacimiento_trabajador);
                                                    $hoy = new DateTime();
                                                    $annos = $hoy->diff($cumpleanos);

                                                    $Edad = $annos->y;

                                                ?>
                                                    <tr>
                                                        <td><?php echo $tarjeta_trabajador; ?></td>
                                                        <td><?php
                                                            echo  "<a data-toggle='modal' href='#modificar_trabajador' 
                                                        onclick='editar(&quot;$id_trabajador&quot;,
                                                                        &quot;$nombre_trabajador&quot;,
                                                                        &quot;$direccion_trabajador&quot;,
                                                                        &quot;$genero_trabajador&quot;,
                                                                        &quot;$fecha_nacimiento_trabajador&quot;,
                                                                        &quot;$estado_civil_trabajador&quot;,
                                                                        &quot;$telefono_trabajador&quot;,
                                                                        &quot;$tipo_pago_trabajador&quot;,
                                                                        &quot;$salario_trabajador&quot;,
                                                                        &quot;$departamento_trabajador&quot;,
                                                                        &quot;$puesto_trabajador&quot;,
                                                                        &quot;$tarjeta_trabajador&quot;,
                                                                        &quot;$fecha_ingreso_trabajador&quot;,
                                                                        &quot;$sucursal_id&quot;,
                                                                        &quot;$foto&quot;);'>$nombre_trabajador</a>";
                                                            ?>
                                                        </td>
                                                        <td><?php echo $genero_trabajador; ?></td>
                                                        <td><?php echo $Edad; ?></td>
                                                        <td><?php echo $telefono_trabajador; ?></td>
                                                        <td><?php echo $nombre_departamento_trabajador; ?></td>
                                                        <td><?php echo $sucursal_trabajador; ?></td>
                                                        <td><?php echo $tipo_pago_trabajador; ?></td>
                                                        <td><?php echo "$" . number_format($salario_trabajador, 2, '.', ',');  ?></td>
                                                        <td>
                                                            <a href="horarios_trabajador.php?id_trabajador=<?php echo $id_trabajador; ?>">
                                                                <i class='fas fa-user-clock'></i>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo "
                                                            <a data-toggle='modal' href='#eliminar_trabajador'
                                                            onclick='eliminar(&quot;$id_trabajador&quot;,
                                                                            &quot;$nombre_trabajador&quot;);'>
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
                                                    Viewing <span>1-10</span> of <span>36</span>
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

<!-- Editar Trabajador Modal -->
<div class="modal fade" id="modificar_trabajador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="#" method="POST" id="form_editar" enctype="multipart/form-data">

                    <input type="hidden" id="id_trabajador" name="id_trabajador_editar">

                    <!-- Agregamos el campo para subir la foto de perfil -->
                    <div class="row">
                        <div class="col">
                            <label>Foto</label>
                            <input type="file" class="form-control" id="foto_editar" name="foto_editar" onchange="previewFoto()">
                        </div>
                    </div>

                    <!-- Vista previa de la foto -->
                    <div class="row mt-3">
                        <div class="col">
                            <label>Vista previa</label>
                            <img id="preview_img" src="#" alt="Vista previa de la foto" style="max-width: 200px; max-height: 200px;">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <label>Nombre del empleado</label>
                            <input type="text" class="form-control" id="nombre_trabajador" name="nombre_editar">
                        </div>
                        <div class="col">
                            <label>Direccion del empleado</label>
                            <input type="text" class="form-control" id="direccion_trabajador" name="direccion_editar">
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <label>Genero</label>
                            <select name="genero_editar" class="form-control" required>
                                <option id="hombre" value="Hombre">Hombre</option>
                                <option id="mujer" value="Mujer">Mujer</option>
                            </select>
                        </div>
                        <div class="col">
                            <label>Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento_trabajador" name="fecha_nacimiento_editar">
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <label>Estado Civil</label>
                            <select name="estado_civil_editar" class="form-control" required>
                                <option id="soltero" value="Soltero(a)">Soltero(a)</option>
                                <option id="casado" value="Casado(a)">Casado(a)</option>
                                <option id="viudo" value="Viudo(a)">Viudo(a)</option>
                                <option id="divorsiado" value="Divorsiado(a)">Divorsiado(a)</option>
                            </select>
                        </div>
                        <div class="col">
                            <label>Telefono</label>
                            <input type="tel" class="form-control" id="telefono_trabajador" name="telefono_editar" pattern="[0-9]{10}">
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <label>Tipo de Pago</label>
                            <select name="tipo_pago_editar" class="form-control" required>
                                <option value="">Seleccione Tipo de Pago</option>
                                <option id="mensual" value="mensual">Mensual</option>
                                <option id="quincenal" value="quincenal">Quincenal</option>
                                <option id="catorcenal" value="catorcenal">Catorcenal</option>
                                <option id="semanal" value="semanal">Semanal</option>
                                <option id="diario" value="diario">Por Dia</option>
                                <option id="hora" value="hora">Por Hora</option>
                            </select>
                        </div>

                        <div class="col">
                            <label>Salario</label>
                            <input type="number" class="form-control" id="salario_trabajador" name="salario_editar">
                        </div>

                    </div>

                    <br>

                    <div class="row">

                        <div class="col">
                            <label>Departamento</label>
                            <select class="form-control" name="departamento_editar">
                                <option id="departamento_trabajador">Selecciona Departamento</option>
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

                        <div class="col">
                            <label>Puesto</label>
                            <input type="text" class="form-control" id="puesto_trabajador" name="puesto_editar">
                        </div>

                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <label>Fecha de Ingreso</label>
                            <input type="date" class="form-control" id="fecha_inicio_trabajador" name="fecha_inicio_editar">
                        </div>
                        <div class="col">
                            <label>Sucursal</label>
                            <select class="form-control" name="sucursal_editar" id="sucursal_editar" name="sucursal_editar">
                                <option value="">Selecciona Sucursal</option>
                                <?php
                                $sql_sucursales = mysqli_query($conexion, "SELECT * FROM sucursales ORDER BY sucursal ASC");
                                while ($row_sucursales = mysqli_fetch_array($sql_sucursales, MYSQLI_ASSOC)) {
                                    $id_sucursal = $row_sucursales['id'];
                                    $nombre_sucursal = $row_sucursales['sucursal'];

                                    echo "<option value='$id_sucursal'>$nombre_sucursal</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>ID lector</label>
                            <input type="text" class="form-control" id="puesto_trabajador" name="lector_editar">
                        </div>
                    </div>

                    <br>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="form_editar" class="btn btn-primary" name="btn_guardar">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- ./ Editar Trabajador Modal -->


<!-- Eliminar Trabajador Modal -->
<div class="modal fade" id="eliminar_trabajador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="form_eliminar">
                    <input type="hidden" id="id_trabajador_del" name="id_trabajador_eliminar">
                    <div class="row">
                        <div class="col">
                            <label>Seguro que desea eliminar este trabajador?</label>
                            <input type="text" class="form-control" id="nombre_trabajador_del" readonly>
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
    function previewFoto() {
        const fotoInput = document.getElementById('foto_editar');
        const previewImg = document.getElementById('preview_img');

        if (fotoInput.files && fotoInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
            };

            reader.readAsDataURL(fotoInput.files[0]);
        } else {
            previewImg.src = "#";
        }
    }
</script>
<script>
    //obtener datos para modificar
    function editar(id_php, nombre_php, direccion_php, genero_php, fecha_nacimiento_php, estado_civil_php, telefono_php, tipo_pago_php, salario_php, departamento_php, puesto_php, tarjeta_php, fecha_de_inicio_php, sucursal_php, foto_php) {
        document.getElementById("id_trabajador").value = id_php;
        document.getElementById("nombre_trabajador").value = nombre_php;
        document.getElementById("direccion_trabajador").value = direccion_php;

        if (genero_php == 'Mujer') {
            document.getElementById("mujer").setAttribute('selected', 0);
        } else {
            document.getElementById("hombre").setAttribute('selected', 0);
        }

        document.getElementById("fecha_nacimiento_trabajador").value = fecha_nacimiento_php;

        if (estado_civil_php == 'Soltero(a)') {
            document.getElementById("soltero").setAttribute('selected', 0);
        } else if (estado_civil_php == 'Casado(a)') {
            document.getElementById("casado").setAttribute('selected', 0);
        } else if (estado_civil_php == 'Viudo(a)') {
            document.getElementById("viudo").setAttribute('selected', 0);
        } else if (estado_civil_php == 'Divorsiado(a)') {
            document.getElementById("divorsiado").setAttribute('selected', 0);
        }
        document.getElementById("telefono_trabajador").value = telefono_php;

        if (tipo_pago_php == 'mensual') {
            document.getElementById("mensual").setAttribute('selected', 0);
        } else if (tipo_pago_php == 'quincenal') {
            document.getElementById("quincenal").setAttribute('selected', 0);
        } else if (tipo_pago_php == 'catorcenal') {
            document.getElementById("catorcenal").setAttribute('selected', 0);
        } else if (tipo_pago_php == 'semanal') {
            document.getElementById("semanal").setAttribute('selected', 0);
        } else if (tipo_pago_php == 'hora') {
            document.getElementById("hora").setAttribute('selected', 0);
        }


        document.getElementById("salario_trabajador").value = salario_php;
        document.getElementById("departamento_trabajador").value = departamento_php;
        document.getElementById("puesto_trabajador").value = puesto_php;
        document.getElementById("fecha_inicio_trabajador").value = fecha_de_inicio_php;
        document.getElementById("sucursal_editar").value = sucursal_php;
        document.getElementById("preview_img").src = foto_php;
    } //fin funcion

    function eliminar(id_php, nombre_php) {
        document.getElementById('id_trabajador_del').value = id_php;
        document.getElementById('nombre_trabajador_del').value = nombre_php;
    }
</script>
<?php include 'footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"></script>

<!-- Agrega la extensión Buttons de DataTables -->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<!-- Agrega los scripts necesarios para exportar a PDF y Excel -->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#miTabla').DataTable({
            "paging": false,
            "ordering": true,
            "info": false,
            "searching": true,
            "filter": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            },
            "buttons": [{
                extend: 'print',
                text: '<i class="fas fa-print"></i> Imprimir',
                className: 'btn btn-primary',
                exportOptions: {
                    columns: ':visible',
                    format: {
                        body: function(data, row, column, node) {
                            if ($(data).is('i') && $(data).hasClass('fas') && $(data).hasClass('fa-')) {
                                return $(data)[0].outerHTML;
                            }
                            return data;
                        }
                    }
                }
            }]
        });

    });
</script>
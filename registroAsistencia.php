<?php
//include 'conex.php';
$titulo_pagina = "Registro de asistencia | Checador Universal";
include 'header.php';
include 'sidebar.php';

$sql_trabajadores = "SELECT trabajadores.*,sucursales.sucursal  FROM trabajadores 
LEFT JOIN sucursales ON sucursales.id = trabajadores.id_sucursal
ORDER BY nombre ASC";
$consulta_trabajadores = mysqli_query($conexion, $sql_trabajadores);

if (isset($_POST['btn_agregar'])) {
    $idTrabajador = htmlspecialchars($_POST['trabajador']);
    $fecha = htmlspecialchars($_POST['fecha']);
    $hora = htmlspecialchars($_POST['hora']);
    $tipo = htmlspecialchars($_POST['tipo']);

    $fecha_hoy = date("Y-m-d");
    
    // Verificar si el empleado tiene configurado ignorar horario de comida para el día de la semana
    $dia_semana = date('N', strtotime($fecha)); // 1=Lunes, 7=Domingo
    $sql_verificar_comida = "SELECT ignorar_horario_comida FROM horarios_trabajadores 
                            WHERE id_trabajador=$idTrabajador AND dia_semana='$dia_semana'";
    $consulta_verificar_comida = mysqli_query($conexion, $sql_verificar_comida);
    $row_comida = mysqli_fetch_assoc($consulta_verificar_comida);
    $ignorar_comida = isset($row_comida['ignorar_horario_comida']) ? $row_comida['ignorar_horario_comida'] : 0;
    
    // Validar si se intenta registrar horario de comida cuando está configurado para ignorarlo
    if (($tipo == "hora_comida_salida" || $tipo == "hora_comida_entrada") && $ignorar_comida == 1) {
        echo "<script>alert('Este empleado tiene configurado ignorar el horario de comida para este día.');</script>";
        echo "<script>window.location.replace('registroAsistencia.php');</script>";
        exit;
    }

    if($tipo == "entrada"){
    $sql_insertar_trabajador = "INSERT INTO asistencia (id_trabajador, hora_entrada, fecha, estado_trabajo, id_incidencia) VALUES ('$idTrabajador','$hora','$fecha', 1, 2)";
    } else {
        if($tipo == "hora_comida_salida"){
            $estado = 2;
        } else if($tipo == "hora_comida_entrada"){
            $estado = 3;
        } else if($tipo == "hora_salida"){
            $estado = 4;
        }
        $sql_insertar_trabajador = "UPDATE asistencia SET $tipo='$hora', estado_trabajo=$estado
        WHERE id_trabajador=$idTrabajador AND fecha='$fecha'";
    }


    $consulta_insertar_trabajar = mysqli_query($conexion, $sql_insertar_trabajador);

    if ($consulta_insertar_trabajar) {

        echo "<script>alert('Agregado Correctamente');</script>";
        echo "<script>window.location.replace('registroAsistencia.php');</script>";
    } else {
        echo "<script>alert('Fallo al agregar');</script>";
        //echo $sql_insertar_trabajador;
        echo "<script>window.location.replace('registroAsistencia.php');</script>";
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
        <h1 class="h3 mb-4 text-gray-800">Registro de asistencia</h1>


        <!-- Lista de Trabajadores -->
        <div class="row alta_row">

            <!-- Alta de Trabajadores -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#ALTAS" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Asistencia</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="ALTAS">
                    <div class="card-body">
                        <form action="#" method="POST">

                            <div class="row">
                                <div class="col">
                                    <label>Nombre del empleado</label>
                                    <select class="form-control" name="trabajador" required>
                                        <option value="">Selecciona un trabajador</option>
                                        <?php
                                        $sql_sucursales = mysqli_query($conexion, "SELECT * FROM sucursales ORDER BY sucursal ASC");
                                        while ($row_trabajadores = mysqli_fetch_array($consulta_trabajadores, MYSQLI_ASSOC)) {
                                            $id_trabajador = $row_trabajadores['id'];
                                            $nombre_trabajador = $row_trabajadores['nombre'];
                                            $tarjeta_trabajador = $row_trabajadores['tarjeta'];

                                            echo "<option value='$id_trabajador'>$nombre_trabajador</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col">
                                    <label>Fecha</label>
                                    <input type="date" class="form-control" placeholder="Fecha de Inicio" name="fecha">
                                </div>
                            </div>

                            <br>

                            <div class="row">
                            <div class="col">
                                    <label>Hora</label>
                                    <input type="time" class="form-control" placeholder="Fecha de Inicio" name="hora">
                                </div>
                                <div class="col">
                                    <label>Tipo de registro</label>
                                    <select class="form-control" name="tipo" required>
                                        <option value="">Selecciona lo que quieres registrar</option>
                                        <option value="entrada">Hora de entrada</option>
                                        <option value="hora_comida_salida">Hora de salida comida</option>
                                        <option value="hora_comida_entrada">Hora de regreso comida</option>
                                        <option value="hora_salida">Hora de salida</option>
                                    </select>
                                </div>

                            </div>

                            <br>

                            <div class="row">
                                <div class="col">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary mt-3" name="btn_agregar">Agregar</button>
                                </div>
                            </div>

                        </form>
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

            reader.onload = function (e) {
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
<?php
$titulo_pagina = "Checador | Checador Universal";
include 'header.php';
include 'sidebar.php';

$hoy = date("d/M/Y");
$hoy_sql = date('Y-m-d');
$hora = date("H:i:s");
$dia = date("w");
//echo "la hora es: ".$hora;

?>
<style>
  /* Estilos para la búsqueda */
  .dataTables_filter input {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
    margin-bottom: 10px;
  }

  /* Estilos para la paginación */
  .dataTables_paginate {
    margin-top: 10px;
  }

  .paginate_button {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px 10px;
    margin: 0 5px;
    cursor: pointer;
  }

  .paginate_button:hover {
    background-color: #f0f0f0;
  }

  .paginate_button.current {
    background-color: #007bff;
    color: #fff;
  }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<!-- Main Content -->
<div id="content">

  <?php include 'topbar.php'; ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Checador en tiempo real-->
    <div>
      <h1 class="h3 mb-4 text-gray-800">Checador en Tiempo Real</h1>
      <div id="accordion">

        <!-- filtros -->
        <div class="card shadow mb-4">
          <!-- Card Header - Accordion -->
          <a href="#Filtros" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>
          </a>
          <!-- Card Content - Collapse -->
          <div class="collapse" id="Filtros">
            <div class="card-body">
              <form id="filtros" name="filtros" action="" method="POST">
                <div class="form-row">
                  <div class="col">
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre">
                  </div>
                  <div class="col">
                    <input type="date" name="desde" class="form-control" placeholder="" value="<?php echo date('Y-m-d'); ?>">
                  </div>

                  <div class="col">
                    <input type="date" name="hasta" class="form-control" placeholder="" value="<?php echo date('Y-m-d'); ?>">
                  </div>
                  <div class="col">
                    <select name="estado" class="form-control" aria-label="Default select example">
                      <option selected>Seleccionar</option>
                      <option value="trabajando">Trabajando</option>
                      <option value="falta">Falta</option>
                      <option value="comiendo">Comiendo</option>
                      <option value="terminada">Jornada terminada</option>
                      <option value="todos">todos</option>
                    </select>
                  </div>
                </div>
              </form>
              <button type="submit" form="filtros" class="btn btn-primary mt-3" name="filtrar">Filtrar</button>
            </div>
          </div>
        </div>
        <!-- fin filtros -->

        <!-- Lista de Asistencias -->
        <div id="filtro" class="card mb-4">
          <div class="card-header">
            <a class="card-link" data-toggle="collapse show" href="#">
              <?php
              if (!empty($_POST['nombre'])) {
                # code...
              } else {
                echo '<h6 class="m-0 font-weight-bold text-primary">Lista de Asistencia ' . $hoy . ' Dia de la semana: ' . $dia . '</h6>';
              }
              ?>

            </a>
          </div>
          <div id="lista_incidencias" class="collapse show" data-parent="#accordion">
            <div class="card-body">
              <div class="table-responsive">

                <table class="table table-striped table-bordered display" id="miTabla" style="width:100%">
                  <thead class="bg-light">
                    <tr>
                      <th onclick="sortTable(0)">Fecha</th>
                      <th onclick="sortTable(1)">Estatus</th>
                      <th onclick="sortTable(2)">ID Usuario</th>
                      <th onclick="sortTable(3)">Nombre</th>
                      <th onclick="sortTable(4)">Departamento</th>
                      <th onclick="sortTable(5)">H. Entrada</th>
                      <th onclick="sortTable(6)">H.S. Comida</th>
                      <th onclick="sortTable(7)">H.R. Comida</th>
                      <th onclick="sortTable(8)">H. Salida</th>
                      <th onclick="sortTable(8)">H. Trabajadas Día</th>
                      <th onclick="sortTable(8)">H. Trabajadas Semana</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    if (!empty($_POST['nombre'])) {
                      $filtro_nombre = $_POST['nombre'];
                    }

                    if (!empty($_POST['desde'])) {
                      $desde = $_POST['desde'];
                      $hasta = $_POST['hasta'];
                    } else {
                      $desde = $hoy_sql;
                      $hasta = $hoy_sql;
                    }

                    $status = null;

                    if (!empty($_POST['estado'])) {
                      if ($_POST['estado'] == 'trabajando') {
                        $status = 1;
                      } else if ($_POST['estado'] == 'falta') {
                        $status = 0;
                      } else if ($_POST['estado'] == 'comiendo') {
                        $status = 2;
                      } else if ($_POST['estado'] == 'terminada') {
                        $status = 4;
                      } else if ($_POST['estado'] == 'todos') {
                        $status = null;
                      }
                    }

                    //codigo nuevo

                    $fecha = $desde;

                    while ($fecha <= $hasta) {
                      // Consulta común sin la suma de horas trabajadas
                      $sql_common = "SELECT trabajadores.id, trabajadores.nombre, trabajadores.foto, departamentos.departamento,
                      asistencia.id_trabajador, asistencia.fecha,
                      asistencia.hora_entrada, asistencia.hora_comida_salida,
                      asistencia.hora_comida_entrada, asistencia.hora_salida, asistencia.estado_trabajo,
                      SEC_TO_TIME(SUM(
                              TIME_TO_SEC(
                                  TIMEDIFF(
                                      COALESCE(hora_salida, COALESCE(hora_comida_entrada, '18:00:00')),
                                      hora_entrada
                                  )
                              )
                          )) AS total_horas_trabajadas_dia,
                      CASE WHEN asistencia.fecha IS NULL THEN 'sin asistencia' ELSE 'con asistencia' END AS estado_asistencia,
                      CASE WHEN incidencias.fecha IS NOT NULL THEN true ELSE false END AS tiene_incidencia";

                      // Subconsulta para calcular las horas trabajadas en la semana
                      $subquery = "(SELECT id_trabajador,
                          SEC_TO_TIME(SUM(
                              TIME_TO_SEC(
                                  TIMEDIFF(
                                      COALESCE(hora_salida, COALESCE(hora_comida_entrada, '18:00:00')),
                                      hora_entrada
                                  )
                              )
                          )) AS total_horas_trabajadas
                      FROM asistencia
                      WHERE WEEKDAY(fecha) >= 0 AND WEEKDAY(fecha) <= 5 AND YEARWEEK(fecha) = YEARWEEK('$fecha')
                      GROUP BY id_trabajador) AS horas_trabajadas";

                      // Unimos la subconsulta con la consulta principal
                      $sql_trabajadores = "$sql_common,
                      horas_trabajadas.total_horas_trabajadas";

                      // Aplicamos las condiciones adicionales según sea necesario
                      $sql_trabajadores .= " FROM trabajadores
                      LEFT JOIN departamentos ON trabajadores.id_departamento = departamentos.id
                      LEFT JOIN asistencia ON trabajadores.id = asistencia.id_trabajador 
                      AND asistencia.fecha='$fecha'
                      LEFT JOIN incidencias ON trabajadores.id = incidencias.idtrabajador
                      AND DATE(asistencia.fecha) = DATE(incidencias.fecha)
                      LEFT JOIN $subquery
                      ON trabajadores.id = horas_trabajadas.id_trabajador";

                      if (isset($status)) {
                        switch ($status) {
                          case 1:
                            $sql_trabajadores .= " WHERE (asistencia.estado_trabajo = 1 OR asistencia.estado_trabajo = 3)";
                            break;
                          case 2:
                            $sql_trabajadores .= " WHERE asistencia.estado_trabajo = 2";
                            break;
                          case 4:
                            $sql_trabajadores .= " WHERE asistencia.estado_trabajo = 4";
                            break;
                          default:
                            $sql_trabajadores .= " WHERE asistencia.estado_trabajo IS NULL";
                            break;
                        }
                      } elseif (!empty($_POST['nombre'])) {
                        $sql_trabajadores .= " WHERE trabajadores.nombre LIKE '%$filtro_nombre%'";
                      }

                      // Ordenamos por nombre
                      $sql_trabajadores .= " GROUP BY trabajadores.id ORDER BY trabajadores.nombre ASC";

                      $lista = mysqli_query($conexion, $sql_trabajadores);

                      if (mysqli_num_rows($lista) > 0) {
                        while ($row = mysqli_fetch_assoc($lista)) {
                          //Declarar variables trabajador
                          $id_trabajador = $row["id"];
                          $nombre_trabajador = $row["nombre"];
                          $foto_trabajador = $row["foto"];
                          $departamento_trabajador = $row["departamento"];
                          $fecha_formateada = date("d/M/y", strtotime($fecha));
                          $hora_entrada = $row["hora_entrada"];
                          $hora_comida_salida = $row["hora_comida_salida"];
                          $hora_comida_entrada = $row["hora_comida_entrada"];
                          $hora_salida = $row["hora_salida"];
                          $estado_trabajo = $row["estado_trabajo"];
                          $estado_asistencia = $row["estado_asistencia"];
                          $horas_trabajadas = $row["total_horas_trabajadas"];
                          $horas_trabajadas_dia = $row["total_horas_trabajadas_dia"];
                          if ($horas_trabajadas_dia) {
                            $time_parts_dia = explode(":", $horas_trabajadas_dia);
                            $hours_dia = $time_parts_dia[0];
                            $minutes_dia = $time_parts_dia[1];

                            $formatted_time_dia = $hours_dia . ":" . $minutes_dia;
                          } else{
                            $formatted_time_dia = '';
                          }
                          $tiene_incidencia = $row["tiene_incidencia"];
                          //var_dump($estado_asistencia);
                          if ($horas_trabajadas) {
                            $time_parts = explode(":", $horas_trabajadas);
                            $hours = $time_parts[0];
                            $minutes = $time_parts[1];
                            $formatted_time = $hours . ":" . $minutes;

                            // Calcular el progreso total en horas
                            $total_hours = $hours + ($minutes / 60);

                            // Establecer el objetivo de horas
                            $goal_hours = 60;

                            // Calcular el porcentaje de progreso
                            $progress_percentage = ($total_hours / $goal_hours) * 100;

                            // Asegurarse de que el porcentaje no exceda el 100%
                            $progress_percentage = min($progress_percentage, 100);
                          } else {
                            $formatted_time = '';
                            $progress_percentage = 0;
                          }
                    ?>
                          <tr>
                            <td><?= $fecha_formateada; ?></td>
                            <td style='text-align:center'>
                              <?php
                              if (is_numeric($estado_trabajo)) {
                                if ($estado_trabajo == 1) {
                                  echo "<button class='btn btn-success'>Trabajando</button>";
                                } elseif ($estado_trabajo == 2) {
                                  echo "<button class='btn btn-warning'>Comiendo</button>";
                                } elseif ($estado_trabajo == 3) {
                                  echo "<button class='btn btn-success'>Trabajando</button>";
                                } elseif ($estado_trabajo == 4) {
                                  echo "<button class='btn btn-primary'>Jornada Terminada</button>";
                                }
                              }

                              if ($estado_asistencia == "sin asistencia") {
                                echo "<button class='btn btn-danger'>Con Falta</button>";
                              }
                              ?>
                            </td>
                            <td><?= $id_trabajador; ?></td>
                            <td>
                              <?php
                              echo '<img src="' . $foto_trabajador . '" alt="" height="45px" class="pr-2">';
                              echo $nombre_trabajador;
                              if ($tiene_incidencia == 1) {
                                echo "**";
                              }
                              ?></td>
                            <td><?= $departamento_trabajador; ?></td>
                            <td><?= $hora_entrada; ?></td>
                            <td><?= $hora_comida_salida; ?></td>
                            <td><?= $hora_comida_entrada; ?></td>
                            <td><?= $hora_salida; ?></td>
                            <td><?= $formatted_time_dia; ?></td>
                            <td>
                              <?= $formatted_time; ?>
                              <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $progress_percentage; ?>%;" aria-valuenow="<?php echo $progress_percentage; ?>" aria-valuemin="0" aria-valuemax="100">
                                  <?php echo number_format($progress_percentage, 2); ?>%
                                </div>
                              </div>
                            </td>
                          </tr>
                    <?php
                        }
                      }
                      //incrementa la fecha
                      $fecha = date('Y-m-d', strtotime($fecha . '+ 1 day'));
                    } //fin del while
                    ?>
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

<!-- Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Crear incidencia</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <p id="modal-data"></p>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modales -->

<script>
  //obtener datos para modificar
</script>

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

    $('#miTabla tbody').on('click', 'tr', function() {

      var rowData = $(this).children("td").map(function() {
        return $(this).text();
      }).get();

      let formulario;
      formulario = `<form action="agregar_incidencia.php" method="POST" class="pt-4">
        <input type="hidden" name="idUsuario" class="form-control" value="${rowData[2]}">
        <div class="row">
            <div class="col">
                <label>Tipo de Incidencia</label>
                <select class="form-control" name="tipo_agregar" required>
                    <option value="permiso">Permiso</option>
                    <option value="enfermedad">Enfermedad</option>
                    <option value="incapacidad ">Incapacidad</option>
                </select>
            </div>
            <div class="col">
                <label>Fecha y hora de la incidencia</label>
                <input type="datetime-local" class="form-control" name="fecha_y_hora_agregar" id="fecha_y_hora_agregar">
            </div>
            <div class="col">
                <label>Fecha y hora del regreso</label>
                <input type="datetime-local" class="form-control" name="fecha_y_hora_regreso" id="fecha_y_hora_regreso">
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col">
                <label>Notas</label>
                <textarea id="notas" name="notas" class="form-control" rows="4" cols="50"></textarea>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <label></label>
                <button type="submit" class="btn btn-primary mt-3" name="btn_agregar">Agregar</button>
            </div>
        </div>

        </form>`;
      $('#modal-data').html("Fecha: " + rowData[0] + "<br>Estado: " + rowData[1] + "<br>Nombre: " + rowData[3] + formulario);
      $('#myModal').modal('show');
      // Obtener el elemento del input de fecha y hora
      const inputFechaHora = document.getElementById('fecha_y_hora_agregar');
      // Obtener la fecha y hora actual en el formato requerido (YYYY-MM-DDTHH:MM)
      var fecha = new Date();
      var offset = fecha.getTimezoneOffset();
      fecha.setMinutes(fecha.getMinutes() - offset);
      const fechaHoraActual = fecha.toISOString().slice(0, 16);

      // Establecer el valor del input de fecha y hora en la fecha y hora actual
      inputFechaHora.value = fechaHoraActual;
    });
  });
</script>
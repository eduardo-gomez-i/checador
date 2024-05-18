<?php
$titulo_pagina = "Reporte de asistencia | Checador Universal";
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<!-- Main Content -->
<div id="content">

  <?php include 'topbar.php'; ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Checador en tiempo real-->
    <div class="container">
      <h1 class="h3 mb-4 text-gray-800">Reporte de asistencia</h1>
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
                    <input type="date" name="desde" class="form-control" placeholder="" value="<?php echo date('Y-m-d'); ?>">
                  </div>

                  <div class="col">
                    <input type="date" name="hasta" class="form-control" placeholder="" value="<?php echo date('Y-m-d'); ?>">
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
              <h6 class="m-0 font-weight-bold text-primary">Reporte de Asistencia</h6>

            </a>
          </div>
          <div id="lista_incidencias" class="collapse show" data-parent="#accordion">
            <div class="card-body">
              <div class="table-responsive">

                <button id="btnPrint" class="btn btn-primary">Imprimir</button>

                <table class="table table-striped table-bordered display" id="miTabla" style="width:100%">
                  <thead class="bg-light">
                    <tr>
                      <th onclick="sortTable(0)">Nombre</th>
                      <th onclick="sortTable(1)">Lunes</th>
                      <th onclick="sortTable(2)">Martes</th>
                      <th onclick="sortTable(3)">Miércoles</th>
                      <th onclick="sortTable(4)">Jueves</th>
                      <th onclick="sortTable(5)">Viernes</th>
                      <th onclick="sortTable(6)">Sábado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    if (!empty($_POST['nombre'])) {
                      $filtro_nombre = $_POST['nombre'];
                    }

                    if (!empty($_POST['desde'])) {
                      $start_date = $_POST['desde'];
                      $end_date = $_POST['hasta'];
                    } else {
                      date_default_timezone_set('America/Mexico_City');

                      // Obtener el timestamp de hoy
                      $hoy_timestamp = strtotime("today");

                      // Obtener el número del día de la semana (1 para lunes, 2 para martes, ..., 7 para domingo)
                      $dia_semana = date('N', $hoy_timestamp);

                      // Calcular el timestamp del lunes de esta semana
                      $lunes_timestamp = strtotime("-" . ($dia_semana - 1) . " days", $hoy_timestamp);

                      // Calcular el timestamp del sábado de esta semana (el sábado es el sexto día, entonces sumamos 5 días)
                      $sabado_timestamp = strtotime("+5 days", $lunes_timestamp);

                      // Formatear las fechas en el formato deseado (por ejemplo, 'Y-m-d')
                      $start_date = date('Y-m-d', $lunes_timestamp);
                      $end_date = date('Y-m-d', $sabado_timestamp);
                    }

                    //codigo nuevo

                    /*if (!empty($_POST['nombre'])) {
                        $sql_trabajadores = "SELECT trabajadores.id, trabajadores.nombre, departamentos.departamento,
                        asistencia.id_trabajador, asistencia.hora_entrada, asistencia.hora_comida_salida,
                        asistencia.hora_comida_entrada, asistencia.hora_salida, asistencia.estado_trabajo, asistencia.fecha,
                        CASE WHEN asistencia.fecha IS NULL THEN 'sin asistencia' ELSE 'con asistencia' END AS estado_asistencia
                        FROM trabajadores
                        LEFT JOIN departamentos ON trabajadores.id_departamento = departamentos.id
                        LEFT JOIN asistencia ON trabajadores.id = asistencia.id_trabajador 
                        AND asistencia.fecha='$fecha'
                        WHERE trabajadores.nombre LIKE '%$filtro_nombre%' ORDER BY trabajadores.nombre ASC";
                      } else {
                        $sql_trabajadores = "SELECT trabajadores.id, trabajadores.nombre, departamentos.departamento,
                        asistencia.id_trabajador, asistencia.hora_entrada, asistencia.hora_comida_salida,
                        asistencia.hora_comida_entrada, asistencia.hora_salida, asistencia.estado_trabajo, asistencia.fecha,
                        CASE WHEN asistencia.fecha IS NULL THEN 'sin asistencia' ELSE 'con asistencia' END AS estado_asistencia
                        FROM trabajadores
                        LEFT JOIN departamentos ON trabajadores.id_departamento = departamentos.id
                        LEFT JOIN asistencia ON trabajadores.id = asistencia.id_trabajador AND asistencia.fecha='$fecha'";
                      }*/

                    $sql_tipo_incidencias_new = "SELECT incidencias.*, trabajadores.nombre  FROM incidencias LEFT JOIN trabajadores ON trabajadores.id = incidencias.idtrabajador WHERE DATE(fecha) BETWEEN \"$start_date\" AND \"$end_date\"";
                    
                    $consulta_tipo_incidencias_new = mysqli_query($conexion, $sql_tipo_incidencias_new);

                    // Definir la consulta para obtener el SQL dinámico
                    $sql_dinamico = "
                    SET @sql = NULL; 
                    SELECT 
                        GROUP_CONCAT(DISTINCT CONCAT( 
                            'MAX(CASE WHEN fecha = ''', 
                            fecha, 
                            ''' THEN hora_entrada ELSE 0 END) AS `', 
                            fecha, 
                            '`' 
                        )) 
                    INTO @sql 
                    FROM 
                        (
                            SELECT DATE('$start_date' + INTERVAL a + b DAY) AS fecha 
                            FROM (
                                SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6
                            ) AS a 
                            CROSS JOIN (
                                SELECT 0 AS b UNION ALL SELECT 10 UNION ALL SELECT 20 UNION ALL SELECT 30 UNION ALL SELECT 40
                            ) AS b 
                            WHERE DATE('$start_date' + INTERVAL a + b DAY) BETWEEN '$start_date' AND '$end_date'
                        ) AS dates; 
                    
                    SET @sql = CONCAT(
                        'SELECT 
                            trabajadores.id, 
                            trabajadores.nombre, 
                            ', 
                            @sql, 
                            ', 
                            horarios_trabajadores.hora_salida,
                            trabajadores.foto
                         FROM 
                            trabajadores 
                         LEFT JOIN 
                            asistencia ON trabajadores.id = asistencia.id_trabajador AND asistencia.fecha BETWEEN \"$start_date\" AND \"$end_date\"
                         LEFT JOIN 
                            horarios_trabajadores ON trabajadores.id = horarios_trabajadores.id_trabajador
                         GROUP BY 
                            trabajadores.id, trabajadores.nombre'
                    ); 
                    
                    PREPARE stmt FROM @sql; 
                    EXECUTE stmt; 
                    DEALLOCATE PREPARE stmt;
                    
                  ";

                    // Ejecutar consulta para obtener el SQL dinámico
                    if ($conexion->multi_query($sql_dinamico)) {
                      do {
                        // Obtener resultado de cada consulta
                        if ($result = $conexion->store_result()) {
                          // Verificar si hay resultados
                          if ($result->num_rows > 0) {

                            // Mostrar los datos
                            $result->data_seek(0); // Volver al inicio del resultado
                            while ($row = $result->fetch_assoc()) {
                              echo "<tr>";
                              echo "<td>"
                                . '<img src="' . $row["foto"] . '" alt="" height="45px" class="pr-2">' .
                                $row["nombre"]
                                . "</td>";
                              $hora_salida = $row["hora_salida"];
                              foreach ($row as $key => $value) {
                                if ($key != "id" && $key != "nombre" && $key != "hora_salida" && $key != "foto") {
                                  if ($value == 0 || $value > "10:00:00") {
                                    echo '<td style="color: red;">' . '<i class="fas fa-times"></i>' . "</td>";
                                  } elseif ($value >= "08:13:00") {
                                    echo '<td style="color: red;">' . $value . "</td>";
                                  } else {
                                    echo '<td> <i class="fas fa-check"></i> </td>';
                                  }
                                }
                              }
                              echo "</tr>";
                            }
                            echo "</table>";
                          } else {
                            echo "No se encontraron resultados.";
                          }
                          $result->free();
                        }
                      } while ($conexion->more_results() && $conexion->next_result());
                    } else {
                      echo "Error: " . $conexion->error;
                    }
                    ?>
                  </tbody>
                </table>
                <!------- FIN TABLA -------------->
              </div>
            </div>
          </div>
          <div class="container mt-2" id="miDiv">
            <div class="row">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%" data-pagecount="1">
                  <thead>
                    <tr>
                      <th>Incidencia</th>
                      <th>Nota</th>
                      <th>Trabajador</th>
                      <th>Fecha</th>
                      <th>Regreso</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($row_tipo_incidencias_new = mysqli_fetch_array($consulta_tipo_incidencias_new, MYSQLI_ASSOC)) {
                      $id_incidencia = $row_tipo_incidencias_new['idincidencias'];
                      $nombre_incidencia = $row_tipo_incidencias_new['nombre'];
                      $tipo_incidencia = $row_tipo_incidencias_new['tipo'];
                      $descuento_incidencia = $row_tipo_incidencias_new['notas'];
                      $fecha = $row_tipo_incidencias_new['fecha'];
                      $fecha_regreso = $row_tipo_incidencias_new['regreso'];
                      $notas = $row_tipo_incidencias_new['notas'];
                    ?>
                      <tr>
                        <td><?php echo $tipo_incidencia; ?></td>
                        <td><?php echo $notas; ?></td>
                        <td><?php echo $nombre_incidencia; ?></td>
                        <td><?php echo $fecha; ?></td>
                        <td><?php echo $fecha_regreso; ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
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
        },
        customize: function(win) {
          $(win.document.body).append('<div id="miDiv">' + $('#miDiv').html() + '</div>'); // Agrega el contenido del div al documento de impresión
        }
      }]
    });

    // Agrega el evento de clic para el botón de imprimir
    $('#btnPrint').on('click', function() {
      table.button('.buttons-print').trigger();
    });

  });
</script>
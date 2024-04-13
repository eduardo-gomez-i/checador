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
                      <th onclick="sortTable(2)">Nombre</th>
                      <th onclick="sortTable(3)">Departamento</th>
                      <th onclick="sortTable(4)">H. Entrada</th>
                      <th onclick="sortTable(5)">H.S. Comida</th>
                      <th onclick="sortTable(6)">H.R. Comida</th>
                      <th onclick="sortTable(7)">H. Salida</th>
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
                      if (isset($status)) {
                        if ($status == 1) {
                          $sql_trabajadores = "SELECT trabajadores.id, trabajadores.nombre, trabajadores.foto, departamentos.departamento,
                        asistencia.id_trabajador, asistencia.hora_entrada, asistencia.hora_comida_salida,
                        asistencia.hora_comida_entrada, asistencia.hora_salida, asistencia.estado_trabajo, asistencia.fecha,
                        CASE WHEN asistencia.fecha IS NULL THEN 'sin asistencia' ELSE 'con asistencia' END AS estado_asistencia
                        FROM trabajadores
                        LEFT JOIN departamentos ON trabajadores.id_departamento = departamentos.id
                        LEFT JOIN asistencia ON trabajadores.id = asistencia.id_trabajador 
                        AND asistencia.fecha='$fecha'
                        WHERE (asistencia.estado_trabajo = 1 OR asistencia.estado_trabajo = 3) ORDER BY trabajadores.nombre ASC";
                        } else if ($status == 2) {
                          $sql_trabajadores = "SELECT trabajadores.id, trabajadores.nombre, trabajadores.foto, departamentos.departamento,
                          asistencia.id_trabajador, asistencia.hora_entrada, asistencia.hora_comida_salida,
                          asistencia.hora_comida_entrada, asistencia.hora_salida, asistencia.estado_trabajo, asistencia.fecha,
                          CASE WHEN asistencia.fecha IS NULL THEN 'sin asistencia' ELSE 'con asistencia' END AS estado_asistencia
                          FROM trabajadores
                          LEFT JOIN departamentos ON trabajadores.id_departamento = departamentos.id
                          LEFT JOIN asistencia ON trabajadores.id = asistencia.id_trabajador 
                          AND asistencia.fecha='$fecha'
                          WHERE asistencia.estado_trabajo = 2 ORDER BY trabajadores.nombre ASC";
                        } else if ($status == 4) {
                          $sql_trabajadores = "SELECT trabajadores.id, trabajadores.nombre, trabajadores.foto, departamentos.departamento,
                            asistencia.id_trabajador, asistencia.hora_entrada, asistencia.hora_comida_salida,
                            asistencia.hora_comida_entrada, asistencia.hora_salida, asistencia.estado_trabajo, asistencia.fecha,
                            CASE WHEN asistencia.fecha IS NULL THEN 'sin asistencia' ELSE 'con asistencia' END AS estado_asistencia
                            FROM trabajadores
                            LEFT JOIN departamentos ON trabajadores.id_departamento = departamentos.id
                            LEFT JOIN asistencia ON trabajadores.id = asistencia.id_trabajador 
                            AND asistencia.fecha='$fecha'
                            WHERE asistencia.estado_trabajo = 4 ORDER BY trabajadores.nombre ASC";
                        } else {
                          $sql_trabajadores = "SELECT trabajadores.id, trabajadores.nombre, trabajadores.foto, departamentos.departamento,
                        asistencia.id_trabajador, asistencia.hora_entrada, asistencia.hora_comida_salida,
                        asistencia.hora_comida_entrada, asistencia.hora_salida, asistencia.estado_trabajo, asistencia.fecha,
                        CASE WHEN asistencia.fecha IS NULL THEN 'sin asistencia' ELSE 'con asistencia' END AS estado_asistencia
                        FROM trabajadores
                        LEFT JOIN departamentos ON trabajadores.id_departamento = departamentos.id
                        LEFT JOIN asistencia ON trabajadores.id = asistencia.id_trabajador 
                        AND asistencia.fecha='$fecha'
                        WHERE asistencia.estado_trabajo IS NULL ORDER BY trabajadores.nombre ASC";
                        }
                      } else if (!empty($_POST['nombre'])) {
                        $sql_trabajadores = "SELECT trabajadores.id, trabajadores.nombre, trabajadores.foto, departamentos.departamento,
                        asistencia.id_trabajador, asistencia.hora_entrada, asistencia.hora_comida_salida,
                        asistencia.hora_comida_entrada, asistencia.hora_salida, asistencia.estado_trabajo, asistencia.fecha,
                        CASE WHEN asistencia.fecha IS NULL THEN 'sin asistencia' ELSE 'con asistencia' END AS estado_asistencia
                        FROM trabajadores
                        LEFT JOIN departamentos ON trabajadores.id_departamento = departamentos.id
                        LEFT JOIN asistencia ON trabajadores.id = asistencia.id_trabajador 
                        AND asistencia.fecha='$fecha'
                        WHERE trabajadores.nombre LIKE '%$filtro_nombre%' ORDER BY trabajadores.nombre ASC";
                      } else {
                        $sql_trabajadores = "SELECT trabajadores.id, trabajadores.nombre, trabajadores.foto, departamentos.departamento,
                        asistencia.id_trabajador, asistencia.hora_entrada, asistencia.hora_comida_salida,
                        asistencia.hora_comida_entrada, asistencia.hora_salida, asistencia.estado_trabajo, asistencia.fecha,
                        CASE WHEN asistencia.fecha IS NULL THEN 'sin asistencia' ELSE 'con asistencia' END AS estado_asistencia
                        FROM trabajadores
                        LEFT JOIN departamentos ON trabajadores.id_departamento = departamentos.id
                        LEFT JOIN asistencia ON trabajadores.id = asistencia.id_trabajador AND asistencia.fecha='$fecha'";
                      }

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
                          //var_dump($estado_asistencia);
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
                            <td>
                              <?php
                              echo '<img src="'.$foto_trabajador.'" alt="" height="45px" class="pr-2">';
                            echo $nombre_trabajador; 
                            ?></td>
                            <td><?= $departamento_trabajador; ?></td>
                            <td><?= $hora_entrada; ?></td>
                            <td><?= $hora_comida_salida; ?></td>
                            <td><?= $hora_comida_entrada; ?></td>
                            <td><?= $hora_salida; ?></td>
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


<!-- Modales -->

<script>
  //obtener datos para modificar
</script>

<?php include 'footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
</script>
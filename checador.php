<?php
$titulo_pagina = "Checador | Checador Universal";
include 'header.php';
include 'sidebar.php';

$hoy = date("d/M/Y");
$hoy_sql = date('Y-m-d');
$hora = date("H:i:s");


$sql_trabajadores = "SELECT * FROM trabajadores ORDER BY nombre ASC";
$consulta_trabajadores = mysqli_query($conexion, $sql_trabajadores);

$sql_incidencias = "SELECT * FROM reglas_incidencias WHERE id_incidencia=1";
$consulta_incidencias = mysqli_query($conexion, $sql_incidencias);
$row_incidencias = mysqli_fetch_assoc($consulta_incidencias);
$tolerancia_row = $row_incidencias['tolerancia'];
$retardo_row = $row_incidencias['retardo'];
$falta_row = $row_incidencias['falta'];

$timestamp_tolerancia = strtotime($tolerancia_row);
$timestamp_retardo = strtotime($retardo_row);
$timestamp_falta = strtotime($falta_row);

$minutos_tolerancia = date('i', $timestamp_tolerancia);
$minutos_retardo = date('i', $timestamp_retardo);
$minutos_falta = date('i', $timestamp_falta);

?>

<!-- Main Content -->
<div id="content">

  <?php include 'topbar.php'; ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Checador en tiempo real-->
    <div class="container">
      <h1 class="h3 mb-4 text-gray-800">Checador en Tiempo Real</h1>
      <div id="accordion">

        <!-- Lista de Asistencias -->
        <div class="card">
          <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#">
              <h6 class="m-0 font-weight-bold text-primary">Lista de Asistencia <?php echo $hoy; ?> </h6>
            </a>
          </div>
          <div id="lista_incidencias" class="collapse show" data-parent="#accordion">
            <div class="card-body">
              <div class="table-responsive">

                <table class="table table-striped table-bordered" style="width:100%">
                  <thead class="bg-light">
                    <tr>
                      <th onclick="sortTable(0)">Estatus</th>
                      <th onclick="sortTable(1)">Nombre</th>
                      <th onclick="sortTable(2)">H. Entrada</th>
                      <th onclick="sortTable(3)">H.S. Comida</th>
                      <th onclick="sortTable(4)">H.R. Comida</th>
                      <th onclick="sortTable(5)">H. Salida</th>
                      <th onclick="sortTable(5)">Reporte</th>

                    </tr>
                  </thead>
                  <tfoot class="bg-light">
                    <th>Estatus</th>
                    <th>Nombre</th>
                    <th>H. Entrada</th>
                    <th>H.S. Comida</th>
                    <th>H.R. Comida</th>
                    <th>H. Salida</th>
                    <th>Reporte</th>
                  </tfoot>
                  <tbody>
                    <?php
                    while ($row_trabajadores = mysqli_fetch_array($consulta_trabajadores, MYSQLI_ASSOC)) {
                      $id_trabajador = $row_trabajadores['id'];
                      $nombre_trabajador = $row_trabajadores['nombre'];
                      $hora_llegada_trabajador = $row_trabajadores['hora_llegada'];
                      $hora_salida_trabajador = $row_trabajadores['hora_salida'];

                      $sql_asistencias = "SELECT * FROM asistencia WHERE id_trabajador=$id_trabajador AND fecha='$hoy_sql'";
                      $consulta_asistencias = mysqli_query($conexion, $sql_asistencias);

                      $row_asistencias = mysqli_fetch_assoc($consulta_asistencias);

                      if (!empty($row_asistencias)) {
                        $hora_entrada_row = $row_asistencias['hora_entrada'];
                        $hora_comida_salida_row = $row_asistencias['hora_comida_salida'];
                        $hora_comida_entrada_row = $row_asistencias['hora_comida_entrada'];
                        $hora_salida_row = $row_asistencias['hora_salida'];

                        if (empty($hora_entrada_row)) {
                          $hora_entrada_row = "sin registro";
                        } else {
                          if ($tolerancia_row != '00:00:00') {
                       
                          } else {
                            $tolerancia_hora_entrada = "sin Tolerancia";
                          }
                        }

                        if (empty($hora_comida_salida_row)) {
                          $hora_comida_salida_row = "sin registro";
                        }

                        if (empty($hora_comida_entrada_row)) {
                          $hora_comida_entrada_row = "sin registro";
                        }

                        if (empty($hora_salida_row)) {
                          $hora_salida_row = "sin registro";
                        }
                      } else {
                        $hora_entrada_row = "sin registro";
                        $hora_comida_salida_row = "sin registro";
                        $hora_comida_entrada_row = "sin registro";
                        $hora_salida_row = "sin registro";
                      }

                    ?>
                      <tr>
                        <td style='text-align:center'>
                          <?php
                          if (!empty($row_asistencias)) {
                            echo "<button class='btn btn-success'>Asistiendo</button>";
                          } else {
                            echo "<button class='btn btn-danger'>Con Falta</button>";
                          }
                          ?>
                        </td>
                        <td><?php echo $nombre_trabajador; ?></td>
                        <td><?php echo $hora_entrada_row; ?></td>
                        <td><?php echo $hora_comida_salida_row; ?></td>
                        <td><?php echo $hora_comida_entrada_row; ?></td>
                        <td><?php echo $hora_salida_row; ?></td>
                        <td>
                          <?php
                          if (!empty($row_asistencias)) {   
                            if ($hora_llegada_trabajador == $hora_entrada_row) {
                              echo "Llego a tiempo: ";
                              echo $hora_llegada_trabajador."=". $hora_entrada_row;
                              echo "<br>Tolerancia: ".$tolerancia_row;
                            } else {
                              echo "No llego a tiempo: ";
                              echo $hora_llegada_trabajador."=". $hora_entrada_row;
                            }
                          } else {
                            echo "Aun no llega";
                          }

                          ?>
                        </td>
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
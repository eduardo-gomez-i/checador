<?php
$titulo_pagina = "Checador | Checador Universal";
include 'header.php';
include 'sidebar.php';

$hoy = date("d/M/Y");
$hoy_sql = date('Y-m-d');
$hora = date("H:i:s");
$dia = date("w");

if (!empty($_POST['nombre'])) {
  $filtro_nombre=$_POST['nombre'];
  $filtro_desde=$_POST['desde'];
  $filtro_hasta=$_POST['hasta'];
  echo "Resultados de: ".$filtro_nombre;
  echo " desde: ".$filtro_desde;
  echo " hasta: ".$filtro_hasta;
  $sql_trabajadores = "SELECT * FROM trabajadores WHERE nombre LIKE '%$filtro_nombre%'";  
}else{
  $sql_trabajadores = "SELECT * FROM trabajadores ORDER BY nombre ASC";
}
$consulta_trabajadores = mysqli_query($conexion, $sql_trabajadores);

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
                      <input type="text" name="nombre" class="form-control" placeholder="Trabajador">
                    </div>
                    <div class="col">
                      <input type="date" name="desde" class="form-control" placeholder="">
                    </div>
                    <div class="col">
                      <input type="date" name="hasta" class="form-control" placeholder="">
                    </div>
                    <!--                                        
                    <div class="col">
                      <select name="estado" class="form-control" aria-label="Default select example">
                        <option selected>Seleccionar</option>
                        <option value="asistencia">Asistencia</option>
                        <option value="2">Falta</option>                        
                        <option value="todos">TODOS</option>
                      </select>
                    </div>
                    -->
                  </div>
                </form>
                <button type="submit" form="filtros" class="btn btn-primary mt-3" name="filtrar">Filtrar</button>
            </div>
          </div>
        </div>
          <!-- fin filtros -->

          <!-- Lista de Asistencias -->        
        <div class="card">
          <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#">
              <h6 class="m-0 font-weight-bold text-primary">Lista de Asistencia <?php echo $hoy." Dia de la semana: ".$dia; ?> </h6>
            </a>
          </div>
          <div id="lista_incidencias" class="collapse show" data-parent="#accordion">
            <div class="card-body">
              <div class="table-responsive">

                <table class="table table-striped table-bordered" style="width:100%">
                  <thead class="bg-light">
                    <tr>
                      <th onclick="sortTable(0)">Fecha</th>
                      <th onclick="sortTable(1)">Estatus</th>
                      <th onclick="sortTable(2)">Nombre</th>
                      <th onclick="sortTable(3)">H. Entrada</th>
                      <th onclick="sortTable(4)">H.S. Comida</th>
                      <th onclick="sortTable(5)">H.R. Comida</th>
                      <th onclick="sortTable(6)">H. Salida</th>
                    </tr>
                  </thead>
                  <!--
                  <tfoot class="bg-light">
                    <th>Estatus</th>
                    <th>Nombre</th>
                    <th>H. Entrada</th>
                    <th>H.S. Comida</th>
                    <th>H.R. Comida</th>
                    <th>H. Salida</th>
                  </tfoot>
                  -->
                  <tbody>
                    <?php
                    while ($row_trabajadores = mysqli_fetch_array($consulta_trabajadores, MYSQLI_ASSOC)) {
                      $id_trabajador = $row_trabajadores['id'];
                      $nombre_trabajador = $row_trabajadores['nombre'];
                      echo " id: ".$id_trabajador;
                      echo " nombre: ".$nombre_trabajador;

                      if (!empty($filtro_nombre)) {
                        $sql_asistencias = "SELECT * FROM asistencia WHERE id_trabajador='$id_trabajador' AND fecha BETWEEN '$filtro_desde' AND '$filtro_hasta'";
                      }else{
                        $sql_asistencias = "SELECT * FROM asistencia WHERE id_trabajador=$id_trabajador AND fecha BETWEEN '$hoy_sql' AND '$hoy_sql'";  
                      }

                      $consulta_asistencias = mysqli_query($conexion, $sql_asistencias);

                      $row_asistencias = mysqli_fetch_assoc($consulta_asistencias);

                      if (!empty($row_asistencias)) {
                        $hora_entrada_row = $row_asistencias['hora_entrada'];
                        $hora_comida_salida_row = $row_asistencias['hora_comida_salida'];
                        $hora_comida_entrada_row = $row_asistencias['hora_comida_entrada'];
                        $hora_salida_row = $row_asistencias['hora_salida'];
                        $estado_trabajo_row = $row_asistencias['estado_trabajo'];
                        $estado_incidencias_row = $row_asistencias['id_incidencia'];
   
                        $tipos_incidencias = mysqli_query($conexion, "SELECT nombre FROM tipo_incidencias WHERE id_incidencia=$estado_incidencias_row");
                        $tipo_incidencia = mysqli_fetch_assoc($tipos_incidencias);

                        if (!empty($tipo_incidencia)) {
                          $nombre_incidencia = $tipo_incidencia['nombre'];
                        }else{
                          $nombre_incidencia = "Sin Incidencia";

                        }

                        if (empty($hora_entrada_row)) {
                          $hora_entrada_row = "sin registro";
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

                      //Horarios del Trabajador
                      $sql_horarios_trabajador = "SELECT * FROM horarios_trabajadores";

                    ?>
                      <tr>
                        <td style='text-align:center'>
                          <?php
                          if (!empty($row_asistencias)) {
                            if ($estado_trabajo_row == 1) {
                              echo "<button class='btn btn-success'>Trabajando</button>";
                            } elseif ($estado_trabajo_row == 2) {
                              echo "<button class='btn btn-warning'>Comiendo</button>";
                            } elseif ($estado_trabajo_row == 3) {
                              echo "<button class='btn btn-success'>Trabajando</button>";
                            } elseif ($estado_trabajo_row == 4) {
                              echo "<button class='btn btn-primary'>Jornada Terminada</button>";
                            }
                          } else {
                            echo "<button class='btn btn-danger'>Con Falta</button>";
                          }
                          ?>
                        </td>
                        <td><?php echo $fecha; ?></td>
                        <td><?php echo $nombre_trabajador; ?></td>
                        <td><?php echo $hora_entrada_row; ?></td>
                        <td><?php echo $hora_comida_salida_row; ?></td>
                        <td><?php echo $hora_comida_entrada_row; ?></td>
                        <td><?php echo $hora_salida_row; ?></td>
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
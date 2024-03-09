<?php
$titulo_pagina = "Checador | Checador Universal";
include 'header.php';
include 'sidebar.php';

$hoy = date("d/M/Y");
$hoy_sql = date('Y-m-d');
$hora = date("H:i:s");
$dia = date("w");
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
              <?php 
              if (!empty($_POST['nombre'])) {
                # code...
              }else{
                echo '<h6 class="m-0 font-weight-bold text-primary">Lista de Asistencia '.$hoy.' Dia de la semana: '.$dia.'</h6>';
              }
              ?>
              
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
                  <tbody>
                    <?php
                    
                    if (!empty($_POST['nombre'])) {
                        $filtro_nombre=$_POST['nombre'];
                        $filtro_desde=$_POST['desde'];
                        $filtro_hasta=$_POST['hasta'];
                        
                        $consulta_id=mysqli_query($conexion,"SELECT id FROM trabajadores WHERE nombre LIKE '%$filtro_nombre%'");
                        $id_trabajador=resultado($consulta_id, 0, "id");                        
                        $sql_asistencias = "SELECT * FROM asistencia WHERE id_trabajador='$id_trabajador' AND fecha BETWEEN '$filtro_desde' AND '$filtro_hasta'";
                      }else{
                        $sql_asistencias = "SELECT * FROM asistencia WHERE fecha BETWEEN '$hoy_sql' AND '$hoy_sql'";  
                      }

                    $datos_tabla = mysqli_query($conexion, $sql_asistencias);

                    if (mysqli_num_rows($datos_tabla) > 0) {
                      // Datos de cada linea
                      while($row = mysqli_fetch_assoc($datos_tabla)) {
                        $id_trabajador=$row["id_trabajador"];
                        $fecha=$row["fecha"];
                        $fecha_formateada=date("d/M/y", strtotime($fecha));
                        $hora_entrada=$row["hora_entrada"];
                        $hora_comida_salida=$row["hora_comida_salida"];
                        $hora_comida_entrada=$row["hora_comida_entrada"];
                        $hora_salida=$row["hora_salida"];
                        $estado_trabajo=$row["estado_trabajo"];
                        $id_incidencia=$row["id_incidencia"];                        
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
                          } else {
                            echo "<button class='btn btn-danger'>Con Falta</button>";
                          }
                          ?>
                        </td>
                      <?php
                      $query_nombre=mysqli_query($conexion,"SELECT nombre FROM trabajadores WHERE id='$id_trabajador'");
                      $nombre_trabajador=resultado($query_nombre, 0, "nombre");
                      ?>                      
                      <td><?= $nombre_trabajador; ?></td>
                      <td><?= $hora_entrada; ?></td>
                      <td><?= $hora_comida_salida; ?></td>
                      <td><?= $hora_comida_entrada; ?></td>
                      <td><?= $hora_salida; ?></td>
                    </tr>
                    <?php
                      }
                    } else {
                      Echo "Sin Resultados";
                    }
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
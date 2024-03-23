<?php
$titulo_pagina = "Inicio | Checador Universal";
include 'header.php';
include 'sidebar.php';
?>

<!-- Main Content -->
<div id="content">

  <?php include 'topbar.php'; ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Panel Checador</h1>
      <a href="#" onclick="window.print();" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Imprimir Reporte</a>
    </div>

    <!--////////////////////////////////////// -->
    <!-- Content Row -->
    <div class="row">
      <!-- TOTAL TRABAJADORES -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"># De Trabajadores</div>
                <?php
                $query = mysqli_query($conexion, "SELECT COUNT(id) as cant_trabajadores FROM trabajadores");
                $total_trabajadores = sql_result($query, 0, "cant_trabajadores");
                ?>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_trabajadores ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- COSTO NOMINA -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Costo Nomina (Mensual)</div>
                <?php
                $query = mysqli_query($conexion, "SELECT SUM(sueldo) as nomina FROM trabajadores");
                $total_nomina = sql_result($query, 0, "nomina");

                //Multiplicado por semana
                $total_nomina = $total_nomina * 4;

                $total_nomina = number_format($total_nomina, 2);
                ?>
                <div class="h5 mb-0 font-weight-bold text-gray-800">$ <?php echo $total_nomina; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- MENSAJES A RH -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Mensajes a RH</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-comments fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- INCIDENCIAS -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Incidencias</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">6</div>
                  </div>
                  <div class="col">
                    <div class="progress progress-sm mr-2">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--////////////////////////////////////// -->

    <!--////////////////////////////////////// -->
    <!-- Content Row -->
    <div class="row">
      <!-- Area Chart -->
      <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Productividad Anual</h6>
            <div class="dropdown no-arrow">
              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Opciones:</div>
                <a class="dropdown-item" href="#">Opcion 1</a>
                <a class="dropdown-item" href="#">Opcion 2</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Opcion 3</a>
              </div>
            </div>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="chart-area">
              <canvas id="myAreaChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      <!-- Pie Chart -->
      <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Grafica de Asistencia</h6>
            <div class="dropdown no-arrow">
              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Opciones:</div>
                <a class="dropdown-item" href="#">Opcion 1</a>
                <a class="dropdown-item" href="#">Opcion 2</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Opcion 3</a>
              </div>
            </div>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
              <canvas id="myPieChart"></canvas>
            </div>
            <div class="mt-4 text-center small">
              <span class="mr-2">
                <i class="fas fa-circle text-success"></i> Puntual
              </span>
              <span class="mr-2">
                <i class="fas fa-circle text-warning"></i> Retardos
              </span>
              <span class="mr-2">
                <i class="fas fa-circle text-danger"></i> Faltas
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--////////////////////////////////////// -->
    <div class="row">
      <!-- Area Chart -->
      <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Trabajadores por departamento</h6>
            <div class="dropdown no-arrow">
              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Opciones:</div>
                <a class="dropdown-item" href="#">Opcion 1</a>
                <a class="dropdown-item" href="#">Opcion 2</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Opcion 3</a>
              </div>
            </div>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div>
              <table class="table table-striped table-bordered display" id="miTabla" style="width:100%">
                <thead class="bg-light">
                  <tr>
                    <th onclick="sortTable(0)">Departamento</th>
                    <th onclick="sortTable(1)">Número de empleados</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  $sql_trabajadores = "SELECT departamentos.departamento, count(trabajadores.id) as contador FROM checador.departamentos
                          LEFT JOIN trabajadores ON trabajadores.id_departamento = departamentos.id
                          GROUP BY departamentos.id";

                  $lista = mysqli_query($conexion, $sql_trabajadores);

                  if (mysqli_num_rows($lista) > 0) {
                    while ($row = mysqli_fetch_assoc($lista)) {
                      //Declarar variables trabajador
                      $nombre_departamento = $row["departamento"];
                      $contador_trabajadores = $row["contador"];
                      //var_dump($estado_asistencia);
                  ?>
                      <tr>
                        <td><?= $nombre_departamento; ?></td>
                        <td><?= $contador_trabajadores; ?></td>
                      </tr>
                  <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Pie Chart -->
      <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Costo de nomina por departamento</h6>
            <div class="dropdown no-arrow">
              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Opciones:</div>
                <a class="dropdown-item" href="#">Opcion 1</a>
                <a class="dropdown-item" href="#">Opcion 2</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Opcion 3</a>
              </div>
            </div>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <div class="pb-2">
            <table class="table table-striped table-bordered display" id="miTabla" style="width:100%">
                <thead class="bg-light">
                  <tr>
                    <th onclick="sortTable(0)">Departamento</th>
                    <th onclick="sortTable(1)">Número de empleados</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  $sql_trabajadores = "SELECT departamentos.departamento, SUM(trabajadores.sueldo) AS suma FROM checador.departamentos
                  LEFT JOIN trabajadores ON trabajadores.id_departamento = departamentos.id
                  GROUP BY departamentos.id";

                  $lista = mysqli_query($conexion, $sql_trabajadores);

                  if (mysqli_num_rows($lista) > 0) {
                    while ($row = mysqli_fetch_assoc($lista)) {
                      //Declarar variables trabajador
                      $nombre_departamento = $row["departamento"];
                      $contador_trabajadores = $row["suma"];
                      //var_dump($estado_asistencia);
                  ?>
                      <tr>
                        <td><?= $nombre_departamento; ?></td>
                        <td><?= $contador_trabajadores ? number_format($contador_trabajadores, 2, '.', ',') : 0; ?></td>
                      </tr>
                  <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include 'footer.php'; ?>
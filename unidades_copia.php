<?php
require_once "conecta_bdd.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Vehiculos | Checador Universal CHK-U v2</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include_once "sidebar.php";?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include_once "navbar.php"; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Vehiculos</h1>

          <!-- Collapsable Card Altas -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#ALTAS" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">Altas</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="ALTAS">
                  <div class="card-body">
                    <form action="/action_page.php">
                      <div class="row">
                        <div class="col">
                          <input type="text" class="form-control" id="modelo" placeholder="Modelo" name="Modelo">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="Placas" name="placas">
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col">
                          <input type="text" class="form-control" id="odometro" placeholder="Odometro Inicial" name="odometro1">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="Servicio cada Kms" name="servicio">
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col">
                          <input type="text" class="form-control" id="tarjeta" placeholder="Tarjeta de circulacion" name="tarjeta">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="Poliza de Seguro" name="seguro">
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col">
                          <label for="fecha_compra">Fecha de Compra: </label>
                          <input type="date" class="form-control" id="fecha_compra" name="fecha_compra">
                          </div>
                          <div class="col">
                          <label for="notas">Notas: </label>
                          <input type="text" class="form-control" id="notas" name="notas">
                        </div>
                      </div>
                      <button type="reset" class="btn btn-secondary mt-3">Reset</button>
                      <button type="submit" class="btn btn-primary mt-3">Enviar</button>
                    </form>
                  </div>
                </div>
              </div>

              <!-- Collapsable Card Lista -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#LISTA" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">Lista</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="LISTA">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-light">
                          <tr>
                            <th>Modelo</th>
                            <th>Placas</th>
                            <th>Odo Inicial</th>
                            <th>Servicio Cada Kms</th>
                            <th>Tja. Circulación</th>
                            <th>Poliza</th>
                          </tr>
                        </thead>
                        <tfoot class="bg-light">
                          <tr>
                            <th>Modelo</th>
                            <th>Placas</th>
                            <th>Odo Inicial</th>
                            <th>Servicio Cada Kms</th>
                            <th>Tja. Circulación</th>
                            <th>Poliza</th>
                          </tr>
                        </tfoot>
                        <tbody>
                          <?php
                            $consulta=mysqli_query($conexion1,"SELECT * FROM unidades");
                            while($datos=mysqli_fetch_assoc($consulta)){
                                $idunidad=$datos['id'];
                                $modelo=$datos['modelo'];
                                $placas=$datos['placas'];
                                $odometro_inicial=$datos['odometro_inicial'];
                                $servicio_cada=$datos['servicio_cada'];
                                $tarjeta_circulacion=$datos['tarjeta_circulacion'];
                                $poliza=$datos['poliza'];
                                //$f_ingreso=date("d-M-Y", strtotime($f_ingreso));
                                echo "<tr>";
                                echo "<td>$modelo</td>
                                      <td>$placas</td>
                                      <td>$odometro_inicial</td>
                                      <td>$servicio_cada</td>
                                      <td>$tarjeta_circulacion</td>
                                      <td>$poliza</td>";
                                echo "<tr>";
                                
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>

                  </div>
                </div>
              </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include_once "footer.php"; ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
      $(document).ready(function() {
          $('#dataTable').dataTable( {
              "language": {
                  "url": "dataTables.spanish.lang"
              }
          } );
      } );
  </script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>

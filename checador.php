<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Checador | Checador Universal CHK-U</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
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
          <h1 class="h3 mb-2 text-gray-800">Checador en Tiempo Real</h1>
          <!--<p class="mb-4">Reporte Actualizado</p>-->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista de Asistencia</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead class="bg-light">
                    <tr>
                      <th>Estatus</th>
                      <th>Nombre</th>
                      <th>Departamento</th>
                      <th>H. Entrada</th>
                      <th>H.S. Comida</th>
                      <th>H.R. Comida</th>
                      <th>H. Salida</th>
                      <th>Hrs. Trabajadas</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tfoot class="bg-light">
                    <tr>
                      <th>Estatus</th>
                      <th>Nombre</th>
                      <th>Departamento</th>
                      <th>H. Entrada</th>
                      <th>H.S. Comida</th>
                      <th>H.R. Comida</th>
                      <th>H. Salida</th>
                      <th>Hrs. Trabajadas</th>
                      <th>Fecha</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                      <td><button class="btn btn-success">01-OK</button></td>
                      <td>Leon Larregui</td>
                      <td>Ventas</td>
                      <td>08:01</td>
                      <td>14:00</td>
                      <td>16:05</td>
                      <td>18:10</td>
                      <td>08:09</td>
                      <td>10/Sep/2020</td>
                    </tr>
                    <tr>
                      <td><button class="btn btn-warning">02-Retardo</button></td>
                      <td>Pepe Aguilar</td>
                      <td>Ventas</td>
                      <td>08:27</td>
                      <td>13:55</td>
                      <td>16:05</td>
                      <td>17:59</td>
                      <td>07:09</td>
                      <td>10/Sep/2020</td>
                    </tr>
                    <tr>
                      <td><button class="btn btn-danger">03-FALTA</button></td>
                      <td>Vicente Fernandez</td>
                      <td>Ventas</td>
                      <td>00:00</td>
                      <td>00:00</td>
                      <td>00:00</td>
                      <td>00:00</td>
                      <td>00:00</td>
                      <td>10/Sep/2020</td>
                    </tr>
                    <tr>
                      <td><button class="btn btn-success">01-OK</button></td>
                      <td>Gael Garcia</td>
                      <td>Ventas</td>
                      <td>08:04</td>
                      <td>14:02</td>
                      <td>16:02</td>
                      <td>18:03</td>
                      <td>08:00</td>
                      <td>10/Sep/2020</td>
                    </tr>
                    <tr>
                      <td><button class="btn btn-success">01-OK</button></td>
                      <td>Enrique Bumbury</td>
                      <td>Ventas</td>
                      <td>08:03</td>
                      <td>14:01</td>
                      <td>15:59</td>
                      <td>18:10</td>
                      <td>08:12</td>
                      <td>10/Sep/2020</td>
                    </tr>
                  </tbody>
                </table>
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

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

  <title>Trabajadores | Checador Universal CHK-U v2</title>

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
          <h1 class="h3 mb-4 text-gray-800">Trabajadores</h1>

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
                          <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="Direccion" name="direccion">
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col">
                          <input type="text" class="form-control" id="telefono" placeholder="Telefono" name="telefono">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="Genero" name="genero">
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col">
                          <input type="text" class="form-control" id="edocivil" placeholder="Estado Civil" name="edocivil">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="Departamento" name="depto">
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col">
                          <input type="number" class="form-control" id="sueldo" placeholder="Sueldo Mensual" name="sueldo">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="Fecha de Inicio" name="entro">
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col">
                          <input type="text" class="form-control" id="hentrada" placeholder="Hora Entrada 00:00" name="hentrada">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="Hora Salida 00:00" name="hsalida">
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
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Genero</th>
                            <th>Edo. Civil</th>
                            <th>Departamento</th>
                            <th>Sueldo</th>
                            <th>Tarjeta</th>
                            <th>F. Ingreso</th>
                          </tr>
                        </thead>
                        <tfoot class="bg-light">
                          <tr>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Genero</th>
                            <th>Edo. Civil</th>
                            <th>Departamento</th>
                            <th>Sueldo</th>
                            <th>Tarjeta</th>
                            <th>F. Ingreso</th>
                          </tr>
                        </tfoot>
                        <tbody>
                          <?php
                            $consulta=mysqli_query($conexion1,"SELECT * FROM trabajadores");
                            while($datos=mysqli_fetch_assoc($consulta)){
                                $idtrabajador=$datos['id'];
                                $nombre=$datos['nombre'];
                                $direccion=$datos['direccion'];
                                $telefono=$datos['telefono'];
                                $genero=$datos['genero'];
                                $edocivil=$datos['edocivil'];
                                $depto=$datos['depto'];
                                $sueldo=$datos['sueldo'];
                                $tarjeta=$datos['tarjeta'];
                                $f_ingreso=$datos['f_ingreso'];
                                $f_ingreso=date("d-M-Y", strtotime($f_ingreso));
                                echo "<tr>";
                                echo "<td>$nombre</td>
                                      <td>$direccion</td>
                                      <td>$telefono</td>
                                      <td>$genero</td>
                                      <td>$edocivil</td>
                                      <td>$depto</td>
                                      <td>$sueldo</td>
                                      <td>$tarjeta</td>
                                      <td>$f_ingreso</td>";
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

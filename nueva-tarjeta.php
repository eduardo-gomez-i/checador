<?php
require_once "conex.php";

//echo "la tarjeta es: ".$_POST['tarjeta'];
if (!empty($_POST['tarjeta'])) {
  $newtarjeta=$_POST['tarjeta'];
  $trabajador=$_POST['trabajador'];
  mysqli_query($conexion, "UPDATE trabajadores SET tarjeta='$newtarjeta' WHERE id='$trabajador'");
  echo "<script>alert('Se agrego la tarjeta');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PAGINA | Checador Universal CHK-U v2</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
          <h1 class="h3 mb-4 text-gray-800">Nueva Tarjeta</h1>

          <!-- Collapsable Card -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#newcard" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">Detectada</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="newcard">
                  <div class="card-body">
                    <form class="form-inline" action="" method="POST">
                      <label for="tarjeta" class="mr-sm-2"># Tarjeta:</label>
                      <?php
                        $query=mysqli_query($conexion, "SELECT * FROM new");
                        $tarjeta=sql_result($query, 0, "tarjeta");
                      ?>                      
                      <input type="text" class="form-control mr-sm-2" id="tarjeta" name="tarjeta" value="<?php echo $tarjeta; ?>" readonly>
                      <label for="trabajador" class="mr-sm-2">Asignar a:</label>
                      <select id="trabajador" class="form-control mr-sm-2" name="trabajador">
                        <?php
                          $consulta=mysqli_query($conexion,"SELECT * FROM trabajadores");
                          echo "<option value='SELECCIONAR'>SELECCIONAR</option>";
                          while($datos=mysqli_fetch_assoc($consulta)){
                              $idtrabajador=$datos['id'];
                              $trabajador=$datos['nombre'];                              
                              echo "<option value='$idtrabajador'>$trabajador</option>";
                          }
                        ?>
                      </select>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
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

</body>

</html>

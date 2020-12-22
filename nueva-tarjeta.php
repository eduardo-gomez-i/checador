<?php
$titulo_pagina = "Nueva Tarjeta | Checador Universal";
include 'header.php';
include 'sidebar.php';

//echo "la tarjeta es: ".$_POST['tarjeta'];
if (!empty($_POST['tarjeta'])) {
  $newtarjeta = $_POST['tarjeta'];
  $trabajador = $_POST['trabajador'];
  mysqli_query($conexion, "UPDATE trabajadores SET tarjeta='$newtarjeta' WHERE id='$trabajador'");
  echo "<script>alert('Se agrego la tarjeta');</script>";
}
?>
<link href="css/sliden-button.css" rel="stylesheet">

<!-- FullCalendar -->
<link href='css/fullcalendar.css' rel='stylesheet' />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!------- FIN ESTILO BUSQUEDA -------------->
<!-- Main Content -->
<div id="content">

  <?php include 'topbar.php'; ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Nueva Tarjeta</h1>

    <!-- Periodo -->
    <div class="row alta_row">

      <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#periodo" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
          <h6 class="m-0 font-weight-bold text-primary">Asignar Tarjeta</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div>
          <div class="card-body">

            <!--Ejemplo tabla con DataTables-->
            <div class="container">

              <form class="form-inline" action="" method="POST">
                <label for="tarjeta" class="mr-sm-2"># Tarjeta:</label>
                <?php
                $query = mysqli_query($conexion, "SELECT * FROM new");
                $tarjeta = sql_result($query, 0, "tarjeta");
                ?>
                <input type="text" class="form-control mr-sm-2" id="tarjeta" name="tarjeta" value="<?php echo $tarjeta; ?>" readonly>
                <label for="trabajador" class="mr-sm-2">Asignar a:</label>
                <select id="trabajador" class="form-control mr-sm-2" name="trabajador">
                  <?php
                  $consulta = mysqli_query($conexion, "SELECT * FROM trabajadores");
                  echo "<option value='SELECCIONAR'>SELECCIONAR</option>";
                  while ($datos = mysqli_fetch_assoc($consulta)) {
                    $idtrabajador = $datos['id'];
                    $trabajador = $datos['nombre'];
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
    </div>
    <!-- Periodo -->


    <!-- Calendario -->

    <!--////////////////////////////////////// -->

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include 'footer.php'; ?>
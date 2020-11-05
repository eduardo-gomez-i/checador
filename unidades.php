<?php
$titulo_pagina = "Vehiculos | Checador Universal";
include 'header.html';
include 'sidebar.php';

$sql_unidades = "SELECT * FROM unidades";
$consulta_unidades = mysqli_query($conexion, $sql_unidades);

if (isset($_POST['btn_agregar'])) {
  $modelo_agregar = htmlspecialchars($_POST['modelo_agregar']);
  $placas_agregar = htmlspecialchars($_POST['placas_agregar']);
  $odometro_agregar = htmlspecialchars($_POST['odometro_agregar']);
  $servicio_agregar = htmlspecialchars($_POST['servicio_agregar']);
  $tarjeta_agregar = htmlspecialchars($_POST['tarjeta_agregar']);
  $poliza_agregar = htmlspecialchars($_POST['poliza_agregar']);
  $fecha_compra_agregar = htmlspecialchars($_POST['fecha_compra_agregar']);
  $notas_agregar = htmlspecialchars($_POST['notas_agregar']);

  $sql_agregar_unidad = "INSERT INTO unidades (modelo, placas, odometro_inicial, servicio_cada, tarjeta_circulacion, poliza, fecha_compra, notas, estado_unidad) 
  VALUES ('$modelo_agregar','$placas_agregar','$odometro_agregar','$servicio_agregar','$tarjeta_agregar','$poliza_agregar','$fecha_compra_agregar','$notas_agregar','disponible')";

  $resultado_agregar_unidad = mysqli_query($conexion, $sql_agregar_unidad);
  if ($resultado_agregar_unidad) {
    echo "<script>alert('Agregado Correctamente');</script>";
    echo "<script>window.location.replace('unidades.php');</script>";
  } else {
    echo "<script>alert('Fallo al agregar');</script>";
    echo "<script>window.location.replace('unidades.php');</script>";
  }
}

if (isset($_POST['btn_guardar'])) {
  $id_unidad_editar = htmlspecialchars($_POST['id_unidad_editar']);
  $modelo_editar = htmlspecialchars($_POST['modelo_editar']);
  $placas_editar = htmlspecialchars($_POST['placas_editar']);
  $odometro_editar = htmlspecialchars($_POST['odometro_editar']);
  $servicio_editar = htmlspecialchars($_POST['servicio_editar']);
  $tarjeta_editar = htmlspecialchars($_POST['tarjeta_editar']);
  $poliza_editar = htmlspecialchars($_POST['poliza_editar']);
  $fecha_compra_editar = htmlspecialchars($_POST['fecha_compra_editar']);
  $notas_editar = htmlspecialchars($_POST['notas_editar']);
  $estado_editar = htmlspecialchars($_POST['estado_editar']);

  $sql_editar_unidad = "UPDATE unidades SET 
  modelo='$modelo_editar', 
  placas='$placas_editar', 
  odometro_inicial='$odometro_editar', 
  servicio_cada='$servicio_editar', 
  tarjeta_circulacion='$tarjeta_editar', 
  poliza='$poliza_editar', 
  fecha_compra='$fecha_compra_editar', 
  notas='$notas_editar',
  estado_unidad='$estado_editar'
  WHERE id='$id_unidad_editar'";
  $resultado_editar_unidad = mysqli_query($conexion, $sql_editar_unidad);
  if ($resultado_editar_unidad) {
    echo "<script>alert('Modificado Correctamente');</script>";
    echo "<script>window.location.replace('unidades.php');</script>";
  } else {
    echo "<script>alert('Fallo al Modificar');</script>";
    //echo $sql_editar_unidad;
    echo "<script>window.location.replace('unidades.php');</script>";
  }
}

if (isset($_POST['btn_eliminar'])) {
  $id_unidad_eliminar = htmlspecialchars($_POST['id_unidad_eliminar']);
  $sql_eliminar_unidad = "DELETE FROM unidades WHERE id=$id_unidad_eliminar";
  $resultado_eliminar_unidad = mysqli_query($conexion, $sql_eliminar_unidad);
  if ($resultado_eliminar_unidad) {
    echo "<script>alert('Eliminado Correctamente');</script>";
    echo "<script>window.location.replace('unidades.php');</script>";
  } else {
    echo "<script>alert('Fallo al eliminar');</script>";
    echo "<script>window.location.replace('unidades.php');</script>";
  }
}
?>

<!-- Main Content -->
<div id="content">

  <?php include 'topbar.php'; ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Vehiculos </h1>


    <!--////////////////////////////////////// -->
    <!-- Content Row -->
    <div class="row alta_row">

      <!-- Alta de Unidad -->
      <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#ALTAS" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
          <h6 class="m-0 font-weight-bold text-primary">Altas</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse" id="ALTAS">
          <div class="card-body">
            <form action="" method="POST">
              <div class="row">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Modelo" name="modelo_agregar">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Placas" name="placas_agregar">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col">
                  <input type="number" class="form-control" placeholder="Odometro Inicial" name="odometro_agregar">
                </div>
                <div class="col">
                  <input type="number" class="form-control" placeholder="Servicio cada Kms" name="servicio_agregar">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Tarjeta de circulacion" name="tarjeta_agregar">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Poliza de Seguro" name="poliza_agregar">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col">
                  <label for="fecha_compra">Fecha de Compra: </label>
                  <input type="date" class="form-control" name="fecha_compra_agregar">
                </div>
                <div class="col">
                  <label for="notas">Notas: </label>
                  <input type="text" class="form-control" placeholder="Notas" name="notas_agregar">
                </div>
              </div>
              <button type="reset" class="btn btn-secondary mt-3">Reset</button>
              <button type="submit" class="btn btn-primary mt-3" name="btn_agregar">Agregar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- ./ Alta de Unidad -->

    <!-- Lista de Unidades -->
    <div class="row alta_row">

      <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#LISTA" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
          <h6 class="m-0 font-weight-bold text-primary">Lista de Unidades</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="LISTA">
          <div class="card-body">

            <!--Ejemplo tabla con DataTables-->
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <div class="table-responsive">

                    <!------- TABLA -------------->
                    <!------- BUSQUEDA -------------->
                    <input type="text" id="myInput" onkeyup="busqueda()" placeholder="Buscar por Placa">
                    <!------- FIN BUSQUEDA -------------->
                    <table id="myTable" class="table table-striped table-bordered" style="width:100%" data-pagecount="1">
                      <thead>
                        <tr>
                          <th onclick="sortTable(0)">ID</th>
                          <th onclick="sortTable(1)">Modelo</th>
                          <th onclick="sortTable(2)">Placas</th>
                          <th onclick="sortTable(3)">Odometro</th>
                          <th onclick="sortTable(4)">Servicio Cada</th>
                          <th onclick="sortTable(5)">Tarjeta de Circulacion</th>
                          <th onclick="sortTable(6)">Poliza</th>
                          <th onclick="sortTable(7)">Fecha Compra</th>
                          <th onclick="sortTable(8)">Notas</th>
                          <th onclick="sortTable(9)">Estado</th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($row_unidades = mysqli_fetch_array($consulta_unidades, MYSQLI_ASSOC)) {
                          $id_unidad = $row_unidades['id'];
                          $nombre_unidad = $row_unidades['modelo'];
                          $placas_unidad = $row_unidades['placas'];
                          $odometro_unidad = $row_unidades['odometro_inicial'];
                          $servicio_cada_unidad = $row_unidades['servicio_cada'];
                          $tarjeta_circulacion_unidad = $row_unidades['tarjeta_circulacion'];
                          $poliza_unidad = $row_unidades['poliza'];
                          $fecha_compra_unidad = $row_unidades['fecha_compra'];
                          $notas_unidad = $row_unidades['notas'];
                          $estado_unidad = $row_unidades['estado_unidad'];

                          echo "
                                <tr>
                                  <td>$id_unidad</td>
                                  <td>$nombre_unidad</td>
                                  <td>$placas_unidad</td>
                                  <td>$odometro_unidad</td>
                                  <td>$servicio_cada_unidad</td>
                                  <td>$tarjeta_circulacion_unidad</td>
                                  <td>$poliza_unidad</td>
                                  <td>$fecha_compra_unidad</td>
                                  <td>$notas_unidad</td>
                                  <td>$estado_unidad</td>
                                  <td>
                                    <a data-toggle='modal' href='#modificar_unidad' 
                                        onclick='editar(&quot;$id_unidad&quot;,
                                                        &quot;$nombre_unidad&quot;,
                                                        &quot;$placas_unidad&quot;,
                                                        &quot;$odometro_unidad&quot;,
                                                        &quot;$servicio_cada_unidad&quot;,
                                                        &quot;$tarjeta_circulacion_unidad&quot;,
                                                        &quot;$poliza_unidad&quot;,
                                                        &quot;$fecha_compra_unidad&quot;,
                                                        &quot;$notas_unidad&quot;,
                                                        &quot;$estado_unidad&quot;);'>
                                      <i class='fas fa-edit'></i>                                        
                                    </a>
                                  </td>
                                  <td>
                                    <a>
                                      <i class='fas fa-truck-moving'></i>
                                    </a>
                                  </td>
                                  <td>
                                    <a data-toggle='modal' href='#eliminar_unidad'
                                        onclick='eliminar(&quot;$id_unidad&quot;,
                                                          &quot;$placas_unidad&quot;);'>
                                      <i class='fas fa-trash-alt'></i>
                                    </a>
                                  </td>
                                </tr>
                                ";
                        }
                        ?>
                      </tbody>
                    </table>
                    <!------- FIN TABLA -------------->
                    <!------- PAGINACION -------------->
                    <div id="pagination" class="pagination">
                      <div class="col first">
                        <p class="pagination-label">
                          Viewing <span>1-10</span> of <span>36</span>
                        </p>
                      </div>
                      <div class="col middle">
                        <a href="#" class="first round">&#8249;&#8249;</a>
                        <a href="#" class="previous round">&#8249;</a>
                        <a href="#" class="round btn-page active">1</a>
                        <a href="#" class="round btn-page">2</a>
                        <a href="#" class="round btn-page">3</a>
                        <a href="#" class="round btn-page">4</a>
                        <a href="#" class="next round">&#8250;</a>
                        <a href="#" class="last round">&#8250;&#8250;</a>
                      </div>
                      <div class="col last">
                        Show
                        <select class="cmb-row-count">
                          <option value="5">5</option>
                          <option value="10" selected>10</option>
                          <option value="15">15</option>
                        </select>
                        Rows
                      </div>
                    </div>
                    <!------- FIN PAGINACION -------------->
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
      <!-- Lista de Unidades -->


    </div>
    <!--////////////////////////////////////// -->

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<!-- Modales -->

<!-- Editar Unidad Modal -->
<div class="modal fade" id="modificar_unidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Unidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="form_editar">
          <input type="hidden" id="id_unidad" name="id_unidad_editar">
          <div class="row">
            <div class="col">
              <label>Modelo: </label>
              <input type="text" class="form-control" id="modelo_unidad" name="modelo_editar">
            </div>
            <div class="col">
              <label>Placas: </label>
              <input type="text" class="form-control" id="placas_unidad" name="placas_editar">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col">
              <label>Odometro: </label>
              <input type="number" class="form-control" id="odometro_unidad" name="odometro_editar">
            </div>
            <div class="col">
              <label>Servicio Cada kms: </label>
              <input type="number" class="form-control" id="servicio_unidad" name="servicio_editar">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col">
              <label>Tarjeta de Circulacion: </label>
              <input type="text" class="form-control" id="tarjeta_unidad" name="tarjeta_editar">
            </div>
            <div class="col">
              <label>Poliza de Seguro</label>
              <input type="text" class="form-control" id="poliza_unidad" name="poliza_editar">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col">
              <label for="fecha_compra">Fecha de Compra: </label>
              <input type="date" class="form-control" id="fecha_compra_unidad" name="fecha_compra_editar">
            </div>
            <div class="col">
              <label for="notas">Notas: </label>
              <input type="text" class="form-control" id="notas_unidad" name="notas_editar">
            </div>
          </div>

          <br>

          <div class="row">
            <div class="col">
              <label>Estado</label>
              <select id="estado_unidad" name="estado_editar" class="form-control" required>
                <option value="disponible">Disponible</option>
                <option value="ocupado">Ocupado</option>
                <option value="descompuesto">Descompuesto</option>
              </select>
            </div>
            <div class="col">

            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" form="form_editar" class="btn btn-primary" name="btn_guardar">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- ./ Editar Unidad Modal -->

<!-- Eliminar Unidad Modal -->
<div class="modal fade" id="eliminar_unidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Unidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="form_eliminar">
          <input type="hidden" id="id_unidad_del" name="id_unidad_eliminar">
          <div class="row">

            <div class="col">
              <label>Seguro que desea eliminar esta unidad?<br> Placa: </label>
              <input type="text" class="form-control" id="placas_unidad_del" name="placas_eliminar" readonly>
            </div>

          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" form="form_eliminar" class="btn btn-primary" name="btn_eliminar">Eliminar</button>
      </div>
    </div>
  </div>
</div>
<!-- ./ Eliminar Unidad Modal -->

<!-- Modales -->

<script>
  //obtener datos para modificar
  function editar(id_php, modelo_php, placas_php, odometro_php, servicio_php, tarjeta_php, poliza_php, fecha_compra_php, notas_php, estado_php) {
    document.getElementById('id_unidad').value = id_php;
    document.getElementById('modelo_unidad').value = modelo_php;
    document.getElementById('placas_unidad').value = placas_php;
    document.getElementById('odometro_unidad').value = odometro_php;
    document.getElementById('servicio_unidad').value = servicio_php;
    document.getElementById('tarjeta_unidad').value = tarjeta_php;
    document.getElementById('poliza_unidad').value = poliza_php;
    document.getElementById('fecha_compra_unidad').value = fecha_compra_php;
    document.getElementById('notas_unidad').value = notas_php;
    document.getElementById('estado_unidad').value = estado_php;
  }

  function eliminar(id_php, placa_php) {
    document.getElementById('id_unidad_del').value = id_php;
    document.getElementById('placas_unidad_del').value = placa_php;

  }
</script>

<?php include 'footer.php'; ?>
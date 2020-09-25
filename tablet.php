<?php

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Checador | PlasticTrade</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <!-- jQuery  arriba para que funcionen los scripts abajo de esto -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
  <!-- ./jQuery -->

  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- contenido tablet -->
    <div class="container-fluid">
      <div style="height: 10px;"></div>
      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card card-secondary">
          <div class="card-header">
            <!--<h3 class="card-title"><a href="" data-card-widget="collapse">Checador Plastic Trade</a></h3>-->
            <h3 class="card-title">Checador Plastic Trade</h3>
            <div class="card-tools">
              <!--<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Minimizar/Maximizar">
              <i class="fas fa-minus"></i></button>-->
              <!--<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Cerrar">
              <i class="fas fa-times"></i></button>-->
            </div>
          </div>

          <!--contenido general del div -->
          <div class="card-body">

            <div class="col-md-12">
              <!-- Widget: user widget style 1 -->
              <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header text-white" style="background: url('dist/img/empresa.jpg') center center;">
                  <!--<h3 class="widget-user-username" id="trabajador">Juan Perez</h3>
                <h5 class="widget-user-desc" id="puesto">Operador</h5>-->
                </div>
                <div class="widget-user-image">
                  <?php if (empty($foto)) {
                    $imagen = "dist/img/plastictrade-logo.png";
                  } else {
                    $imagen = "dist/img/" . $foto . ".jpg";
                  }
                  ?>
                  <img class="img-circle elevation-2" src="<?php echo "imagen"; ?>" alt="Foto del Trabajador">
                </div>
                <div class="card-footer">
                  <p class="widget-user-username text-center"><?php echo "trabajador"; ?> - <?php echo "puesto"; ?><?php if (empty("trabajador")) {
                                                                                                                    echo "PASE SU TARJETA - ";
                                                                                                                  } ?></p>
                  <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">H. Entrada</h5>
                        <span class="description-text"><?php echo "entrada"; ?><?php if (empty($entrada)) {
                                                                                echo "esperando";
                                                                              } ?></span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">H. Salida</h5>
                        <span class="description-text"><?php echo "salida"; ?><?php if (empty($salida)) {
                                                                                echo "esperando";
                                                                              } ?></span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">Hrs Laboradas</h5>
                        <span class="description-text"><?php echo "trabajo_horas"; ?><?php if (empty($trabajo_horas)) {
                                                                                      echo "esperando";
                                                                                    } ?></span>
                      </div>
                      <!-- /.description-block -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div>
                <!--card footer-->
              </div><!-- /.widget-user -->
            </div><!-- col-md-12 -->

            <div class="row">
              <div class="col-md-4">
                <div class="info-box bg-info" style="min-height: 110px">
                  <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Fecha</span>
                    <span style="font-size: 20px; color: #fff;"><?php echo "fechaletra"; ?></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div>
              <!--/col-md-4-->

              <div class="col-md-4">
                <div class="info-box bg-gray-dark">
                  <span class="info-box-icon"><i class="far fa-clock"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Hora Actual</span>
                    <span id="tiempo" style="font-size: 40px; color: #fff;">00:00</span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div>
              <!--/col-md-4-->

              <?php
              if (!empty($salida)) {
                $estatus = "SALIDA";
                $nota = "nos-vemos";
                $estilo = "bg-danger";
                $icono = '<i class="far fa-calendar-check"></i>';
              } elseif (!empty($rcomida)) {
                $estatus = "R. COMIDA";
                $nota = "hola-de-nuevo";
                $estilo = "bg-orange";
                $icono = '<i class="fas fa-utensils"></i>';
              } elseif (!empty($scomida)) {
                $estatus = "S. COMIDA";
                $nota = "buen-provecho";
                $estilo = "bg-yellow";
                $icono = '<i class="fas fa-utensils"></i>';
              } elseif (!empty($entrada)) {
                $estatus = "ENTRADA";
                $nota = "ok";
                $estilo = "bg-success";
                $icono = '<i class="fas fa-user-check"></i>';
              } else {
                $estatus = "NADA";
                $estilo = "bg-purple";
                $icono = '<i class="fas fa-info-circle"></i>';
              }
              if (!empty($nota)) {
                $_SESSION['nota'] = "<script>var nota='" . $nota . "';</script>";
              }
              ?>

              <div class="col-md-4">
                <div class="info-box <?php echo $estilo; ?>">
                  <span class="info-box-icon"><?php echo $icono ?></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Registrando</span>
                    <span style="font-size: 40px; color: #fff;" id="status"><?php echo $estatus; ?></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div>
              <!--/col-md-4-->

            </div><!-- ./row -->

          </div><!-- /.card body -->
          <div class="card-footer">Industria 4.0 - Maquina de Ideas / Jesus Mtz.</div>
        </div><!-- /.card -->

        <!-- botones solo para probar sonidos-->
        <!--<button type="button" class="btn btn-success" onclick="aviso('ok');">OK</button>
        <button type="button" class="btn btn-danger" onclick="aviso('error');">Error</button>
        <button type="button" class="btn btn-info" onclick="aviso('new');">New</button>
        <button type="button" class="btn btn-primary" onclick="actualizar();">Actualizar</button>-->
        <!-- botones solo para probar sonidos-->

      </section><!-- /.content -->
    </div><!-- /.contenido tablet -->
  </div><!-- ./wrapper -->

  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- Toastr Plugin -->
  <script src="plugins/toastr/toastr.min.js"></script>
  <!-- Audio Files-->
  <audio id="beep-ok">
    <source src="dist/sounds/beep-ok.mp3" type="audio/mpeg">
    Tu navegador no soporta reproduccion de audio
  </audio>
  <audio id="beep-error">
    <source src="dist/sounds/beep-error.mp3" type="audio/mpeg">
    Tu navegador no soporta reproduccion de audio
  </audio>
  <audio id="beep-new">
    <source src="dist/sounds/beep-new.mp3" type="audio/mpeg">
    Tu navegador no soporta reproduccion de audio
  </audio>
  <audio id="beep-cambio">
    <source src="dist/sounds/beep-cambio.mp3" type="audio/mpeg">
    Tu navegador no soporta reproduccion de audio
  </audio>
  <audio id="bienvenido">
    <source src="dist/sounds/bienvenido.mp3" type="audio/mpeg">
    Tu navegador no soporta reproduccion de audio
  </audio>
  <audio id="buen-provecho">
    <source src="dist/sounds/buen-provecho.mp3" type="audio/mpeg">
    Tu navegador no soporta reproduccion de audio
  </audio>
  <audio id="hola-de-nuevo">
    <source src="dist/sounds/hola-de-nuevo.mp3" type="audio/mpeg">
    Tu navegador no soporta reproduccion de audio
  </audio>
  <audio id="nos-vemos">
    <source src="dist/sounds/nos-vemos.mp3" type="audio/mpeg">
    Tu navegador no soporta reproduccion de audio
  </audio>
  <audio id="nueva-tarjeta">
    <source src="dist/sounds/nueva-tarjeta.mp3" type="audio/mpeg">
    Tu navegador no soporta reproduccion de audio
  </audio>
  <?php
  echo "<script>var nueva_tarjeta='no';</script>";
  /*echo "<script>var cambio='no';</script>";
  if ($_GET['status'] == "new") {
    echo $_SESSION['nota'];
  } elseif ($_GET['status'] == "waiting") {

    if (!empty($nueva_tarjeta)) {
      echo "<script>var nueva_tarjeta='new';</script>";
    }

    echo "<script>var cambio='cambio';</script>";
    echo $_SESSION['nota'];
  } else {
    echo $_SESSION['nota'];
  }*/
  ?>
  <!-- Script Reloj -->
  <script>
    var tiempo = setInterval(reloj, 1000);

    function reloj() {
      var whatthimeisit = new Date();
      document.getElementById("tiempo").innerHTML = whatthimeisit.toLocaleTimeString();
    }
  </script>
  <!-- Script notificaciones -->
  <script>
    toastr.options = {
      positionClass: 'toast-bottom-center'
    };

    function aviso($tipo) {

      if ($tipo == 'ok') {
        //var beep_ok = document.getElementById("beep-ok");
        var beep_ok = document.getElementById("bienvenido");
        toastr.success('Acceso Correcto');
        beep_ok.play();
        var $tipo = "";
      } //.if

      if ($tipo == 'error') {
        //var beep_error = document.getElementById("beep-error");
        var beep_error = document.getElementById("intente-mas-tarde");
        toastr.error('Error no se pudo registrar');
        beep_error.play();
        var $tipo = "";
      } //.if

      if ($tipo == 'new') {
        //var beep_new = document.getElementById("beep-new");
        var beep_new = document.getElementById("nueva-tarjeta");
        toastr.info('Nueva Tarjeta Detectada');
        beep_new.play();
        var $tipo = "";
      } //.if

      if ($tipo == 'cambio') {
        var beep_cambio = document.getElementById("beep-cambio");
        toastr.error('entrando modo de espera');
        beep_cambio.play();
        var $tipo = "";
      } //.if

      if ($tipo == 'buen-provecho') {
        var scomida = document.getElementById("buen-provecho");
        toastr.success('Buen Provecho');
        scomida.play();
        var $tipo = "";
      } //.if

      if ($tipo == 'hola-de-nuevo') {
        var rcomida = document.getElementById("hola-de-nuevo");
        toastr.success('Hola de nuevo');
        rcomida.play();
        var $tipo = "";
      } //.if

      if ($tipo == 'nos-vemos') {
        var salida = document.getElementById("nos-vemos");
        toastr.info('Nos vemos pronto');
        salida.play();
        var $tipo = "";
      } //.if

    } //fin
  </script>
  <!-- Script Funciones Ajax -->
  <script>
    //funcion que se ejecuta cada x tiempo
    function loop() {
      var looptimer = setInterval(actualizar, 1000);
    } //en milisegundos

    //PETICION AJAX
    function actualizar() {

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("respuesta").innerHTML = this.responseText;
          update_id();
        }
      }

      xmlhttp.open("GET", "checador-request.php?search=new", true);
      xmlhttp.send();
    } //fin de actualizar

    function update_id() {
      var actual = document.getElementById("actual").value;
      var nuevo = document.getElementById("nuevo").value;
      var nota2 = document.getElementById("nota2").value;
      var nueva_tarjeta = document.getElementById("nueva_tarjeta").value;
      var pagina_actual = "<?php echo $pagina_actual; ?>";
      var pagina_espera = "/dashplasti/checador-monitor.php?status=waiting"

      if (nueva_tarjeta == "new") {
        aviso(nueva_tarjeta);
        deletenewcard();
      }

      if (pagina_actual != pagina_espera) {
        if (actual == nuevo) {
          setTimeout(function() {
            top.window.location = 'checador-monitor.php?status=waiting';
          }, 30000);
        }
      }

      if (nuevo != actual) {
        aviso('cambio');
        setTimeout(function() {
          top.window.location = 'checador-monitor.php?status=new';
        }, 500);
      }

      if (nota != nota2) {
        aviso('cambio');
        setTimeout(function() {
          top.window.location = 'checador-monitor.php?status=new';
        }, 500);

      }
    } //fin de update

    function deletenewcard() {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          //donothing
        }
      }
      xmlhttp.open("GET", "checador-request.php?newcard=delete", true);
      xmlhttp.send();
    } //fin delete newcard 

    //control de los avisos
    if (nueva_tarjeta == "new") {
      aviso('new');
      deletenewcard();
    } else if (cambio == "cambio") {
      aviso(cambio);
    } else if (nota) {
      aviso(nota);
    }

    //funcion a ejecutarse al inicio
    //PETICION AJAX
    function inicio() {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("respuesta").innerHTML = this.responseText;
          if (nota == "espera") {
            var nota = document.getElementById("nota2").value;
          }
        }
      }

      xmlhttp.open("GET", "checador-request.php?search=new", true);
      xmlhttp.send();
    } //fin funcion inicio  

    //crea el input con la nota
    function make_input() {
      var input = document.createElement('input');
      input.setAttribute('id', 'nota');
      input.setAttribute('type', 'hidden');
      input.setAttribute('value', nota);
      document.body.appendChild(input);
    }
    make_input();

    //ejecuta una funcion inicial
    setTimeout(function() {
      inicio();
    }, 500); //en milisegundos

    //ejecuta el loop despues de x segundos de iniciar
    setTimeout(function() {
      loop();
    }, 1000); //en milisegundos
  </script>
  <!-- datos comparativos -->
  <input type="text" id="actual" value="<?php echo $xtrabajador; ?>" hidden>
  <div id="respuesta"></div>
</body>

</html>
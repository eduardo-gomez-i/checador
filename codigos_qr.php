<?php
$titulo_pagina = "QR | Checador Universal";

include 'header.html';
include 'sidebar.php';

$API = 'http://localhost:8080/api/';

//set it to writable location, a place for temp generated PNG files
$PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'qr' . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;

//html PNG location prefix
$PNG_WEB_DIR = './vendor/qr/temp/';

include_once "./vendor/qr/qrlib.php";

//ofcourse we need rights to create temp dir
if (!file_exists($PNG_TEMP_DIR))
    mkdir($PNG_TEMP_DIR);


$filename = $PNG_TEMP_DIR . 'test.png';

//processing form input
//remember to sanitize user input in real-life solution !!!
$errorCorrectionLevel = 'H';
if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L', 'M', 'Q', 'H')))
    $errorCorrectionLevel = $_REQUEST['level'];

$matrixPointSize = 5;
if (isset($_REQUEST['size']))
    $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);


?>

<!------- FIN ESTILO BUSQUEDA -------------->
<!-- Main Content -->
<div id="content">

    <?php include 'topbar.php'; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">codigos QR</h1>


        <!--////////////////////////////////////// -->
        <!-- Content Row -->
        <div class="row alta_row">

            <!-- Alta de Trabajadores -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#ALTAS" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">QR departamentos</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="ALTAS">
                    <div class="card-body">


                        <div class="row">
                            <div class="col text-center">
                                <?php

                                if (isset($_REQUEST['data'])) {

                                    //it's very important!
                                    if (trim($_REQUEST['data']) == '')
                                        die('Los datos no pueden estar vacios <a href="?">Atras</a>');

                                    // user data
                                    $filename = $PNG_TEMP_DIR . 'test' . md5($_REQUEST['data'] . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
                                    QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);
                                } else {

                                    //default data
                                    //echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
                                    QRcode::png('Genera tu codigo qr', $filename, $errorCorrectionLevel, $matrixPointSize, 2);
                                }

                                //display generated file
                                echo '<img src="' . $PNG_WEB_DIR . basename($filename) . '" /><hr/>';

                                //config form
                                echo '<form action="codigos_qr.php" method="post">';
                                echo '<select class="form-control" name="departamento_agregar" required>
                                        <option value="">Selecciona Departamento</option>';
                                $sql_departamentos = mysqli_query($conexion, "SELECT * FROM departamentos ORDER BY departamento ASC");
                                while ($row_departamentos = mysqli_fetch_array($sql_departamentos, MYSQLI_ASSOC)) {
                                    $id_departamento = $row_departamentos['id'];
                                    $nombre_departamento = $row_departamentos['departamento'];

                                    echo '<option name="data" value="' . (isset($_REQUEST['data']) ? htmlspecialchars($_REQUEST['data']) : $API . 'departamentos.php/?id_departamento=' . $id_departamento) . '">' . $nombre_departamento . '</option>';
                                }
                                echo '</select>';
                                echo '<input name="level" type="hidden" value="H">';
                                echo '<label class="font-weight-bold m-3">Tamaño:</label>&nbsp;<select name="size" class="form-control">';

                                for ($i = 1; $i <= 10; $i++)
                                    echo '<option value="' . $i . '"' . (($matrixPointSize == $i) ? ' selected' : '') . '>' . $i . '</option>';

                                echo '</select>&nbsp;
                                <input type="submit" class="btn btn-primary form-control" value="Generar"></form><hr/>';
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ./ Alta de Trabajadores -->

        <!-- Lista de Trabajadores -->
        <div class="row alta_row">

            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#LISTA" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">QR unidades</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="LISTA">
                    <div class="card-body">

                        <div class="row">
                            <div class="col text-center">
                                <?php

                                if (isset($_REQUEST['data'])) {

                                    //it's very important!
                                    if (trim($_REQUEST['data']) == '')
                                        die('Los datos no pueden estar vacios <a href="?">Atras</a>');

                                    // user data
                                    $filename = $PNG_TEMP_DIR . 'test' . md5($_REQUEST['data'] . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
                                    QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);
                                } else {

                                    //default data
                                    //echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
                                    QRcode::png('Genera tu codigo qr', $filename, $errorCorrectionLevel, $matrixPointSize, 2);
                                }

                                //display generated file
                                echo '<img src="' . $PNG_WEB_DIR . basename($filename) . '" /><hr/>';

                                //config form
                                echo '<form action="codigos_qr.php" method="post">';
                                echo '<select class="form-control" name="departamento_agregar" required>
                                        <option value="">Selecciona la placa</option>';
                                $sql_departamentos = mysqli_query($conexion, "SELECT id, placas FROM unidades");
                                while ($row_departamentos = mysqli_fetch_array($sql_departamentos, MYSQLI_ASSOC)) {
                                    $id_unidad = $row_departamentos['id'];
                                    $placa = $row_departamentos['placas'];

                                    echo '<option name="data" value="' . (isset($_REQUEST['data']) ? htmlspecialchars($_REQUEST['data']) : $API . 'unidades.php/?id_unidad=' . $id_unidad) . '">' . $placa . '</option>';
                                }
                                echo '</select>';
                                echo '<label class="font-weight-bold m-3">Tamaño:</label>&nbsp;<select name="size" class="form-control">';

                                for ($i = 1; $i <= 10; $i++)
                                    echo '<option value="' . $i . '"' . (($matrixPointSize == $i) ? ' selected' : '') . '>' . $i . '</option>';

                                echo '</select>&nbsp;
                                <input type="submit" class="btn btn-primary form-control" value="Generar"></form><hr/>';
                                ?>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- Lista de Trabajadores -->


        </div>
        <!--////////////////////////////////////// -->
        <!-- Lista de Trabajadores -->
        <div class="row alta_row">

            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#asistencia" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">QR Asistencia</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="asistencia">
                    <div class="card-body">

                        <div class="row">
                            <div class="col text-center">
                                <?php

                                if (isset($_REQUEST['data'])) {

                                    //it's very important!
                                    if (trim($_REQUEST['data']) == '')
                                        die('Los datos no pueden estar vacios <a href="?">Atras</a>');

                                    // user data
                                    $filename = $PNG_TEMP_DIR . 'test' . md5($_REQUEST['data'] . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
                                    QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);
                                } else {

                                    //default data
                                    //echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
                                    QRcode::png('Genera tu codigo qr', $filename, $errorCorrectionLevel, $matrixPointSize, 2);
                                }

                                //display generated file
                                echo '<img src="' . $PNG_WEB_DIR . basename($filename) . '" /><hr/>';

                                //config form
                                echo '<form action="codigos_qr.php" method="post">';

                                    echo '<input type="hidden" name="data" value="' . (isset($_REQUEST['data']) ? htmlspecialchars($_REQUEST['data']) : $API . 'asistencia.php') . '">';
                                
                                echo '<label class="font-weight-bold m-3">Tamaño:</label>&nbsp;<select name="size" class="form-control">';

                                for ($i = 1; $i <= 10; $i++)
                                    echo '<option value="' . $i . '"' . (($matrixPointSize == $i) ? ' selected' : '') . '>' . $i . '</option>';

                                echo '</select>&nbsp;
                                <input type="submit" class="btn btn-primary form-control" value="Generar"></form><hr/>';
                                ?>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
            <!-- Lista de Trabajadores -->


        </div>
        <!--////////////////////////////////////// -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<!-- Modales -->


<!-- Modales -->

<script>
    //obtener datos para modificar
    function editar(id_php, nombre_php, direccion_php, genero_php, fecha_nacimiento_php, estado_civil_php, telefono_php, tipo_pago_php, salario_php, departamento_php, puesto_php, tarjeta_php, fecha_de_inicio_php, hora_llegada_php, hora_salida_php) {

        document.getElementById("id_trabajador").value = id_php;
        document.getElementById("nombre_trabajador").value = nombre_php;
        document.getElementById("direccion_trabajador").value = direccion_php;

        if (genero_php == 'Mujer') {
            document.getElementById("mujer").setAttribute('selected', 0);
        } else {
            document.getElementById("hombre").setAttribute('selected', 0);
        }

        document.getElementById("fecha_nacimiento_trabajador").value = fecha_nacimiento_php;

        if (estado_civil_php == 'Soltero(a)') {
            document.getElementById("soltero").setAttribute('selected', 0);
        } else if (estado_civil_php == 'Casado(a)') {
            document.getElementById("casado").setAttribute('selected', 0);
        } else if (estado_civil_php == 'Viudo(a)') {
            document.getElementById("viudo").setAttribute('selected', 0);
        } else if (estado_civil_php == 'Divorsiado(a)') {
            document.getElementById("divorsiado").setAttribute('selected', 0);
        }
        document.getElementById("telefono_trabajador").value = telefono_php;

        if (tipo_pago_php == 'Mensual') {
            document.getElementById("mensual").setAttribute('selected', 0);
        } else if (tipo_pago_php == 'Quincenal') {
            document.getElementById("quincenal").setAttribute('selected', 0);
        } else if (tipo_pago_php == 'Catorcenal') {
            document.getElementById("catorcenal").setAttribute('selected', 0);
        } else if (tipo_pago_php == 'Semanal') {
            document.getElementById("semanal").setAttribute('selected', 0);
        } else if (tipo_pago_php == 'Hora') {
            document.getElementById("hora").setAttribute('selected', 0);
        }


        document.getElementById("salario_trabajador").value = salario_php;
        document.getElementById("departamento_trabajador").value = departamento_php;
        document.getElementById("puesto_trabajador").value = puesto_php;
        document.getElementById("tarjeta_trabajador").value = tarjeta_php;
        document.getElementById("fecha_inicio_trabajador").value = fecha_de_inicio_php;
        document.getElementById('hora_llegada_trabajador').value = hora_llegada_php;
        document.getElementById('hora_salida_trabajador').value = hora_salida_php;
    } //fin funcion

    function eliminar(id_php, nombre_php) {
        document.getElementById('id_trabajador_del').value = id_php;
        document.getElementById('nombre_trabajador_del').value = nombre_php;
    }
</script>

<?php include 'footer.php'; ?>
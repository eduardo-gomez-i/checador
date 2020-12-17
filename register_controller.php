<?php
require('conex.php');

if ($_POST) {
   
    $email = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    //Busca el email en la base de datos, si este existe, detiene la función
    $q = "  SELECT correo
            FROM usuario
            WHERE correo='$email'";
    $comprobacion_correo = mysqli_num_rows(mysqli_query($conexion, $q));

    if ($comprobacion_correo > 0) {
        die("Error: Ya existe un usuario registrado con el correo " . $email);
    }

    //convierte la contraseña a un hash con las medidas de seguridad default actuales (esto cambia con el tiempo)
    $contrasena = password_hash($contrasena, PASSWORD_BCRYPT);
    
        //SQL para insertar un usuario
        $dml = "INSERT INTO login (nombre, passwd, 	email)
                VALUES ('$usuario','$contrasena', '$email')";
        
        if (mysqli_query($conexion, $dml)) {
            header('Location: login.php');
            die();
        } else {
            echo "Error: " . $dml . "<br>" . mysqli_error($conexion);
        }

}
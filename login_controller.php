<?php
session_start();
require_once('conex.php');

if ($_POST) {
    $correo = $_POST['correo'];
    $password = $_POST['contrasena'];
    //echo $password;
    //Recupera unicamente el password del usuario para poder verificarlo
    $passQuery = "SELECT passwd as passHash, nombre, email
                        FROM login
                        WHERE email='$correo'";

    $resultado = mysqli_query($conexion, $passQuery);

    $passHash = $resultado->fetch_object();

    var_dump($passHash);

    if ($passHash) {
        $_SESSION['nombre'] = $passHash->nombre;
        $_SESSION['email'] = $passHash->email;
        $passHash = $passHash->passHash;
    } else {
        $passHash = "";
    }
    //asigna los permisos del usuario a la sesión
    if (password_verify($password, $passHash)) {
        $_SESSION['activo'] = 1;

        echo $_SESSION['activo'];
        header('Location: index.php');
        die();
    } else {
        header('Location: login.php');
    }
}

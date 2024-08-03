<?php
session_start();
require_once('conex.php');

if ($_POST) {
    $correo = $_POST['correo'];
    $password = $_POST['contrasena'];
    
    // Recupera el password hash del usuario
    $passQuery = "SELECT passwd as passHash, nombre, email FROM login WHERE email=?";
    $stmt = $conexion->prepare($passQuery);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $passHash = $resultado->fetch_object();

    if ($passHash) {
        $_SESSION['nombre'] = $passHash->nombre;
        $_SESSION['email'] = $passHash->email;
        $passHash = $passHash->passHash;
    } else {
        $passHash = "";
    }

    // Verifica la contraseña
    if (password_verify($password, $passHash)) {
        $_SESSION['activo'] = 1;
        header('Location: index.php');
        exit();
    } else {
        // Manejo de error de autenticación
        header('Location: login.php?error=1');
        exit();
    }
}

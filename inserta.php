<?php
session_start();
include 'conex.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibió un código de empleado válido
    if (isset($_POST['id_empleado']) && !empty($_POST['id_empleado'])) {
        $codigo = $_POST['id_empleado'];

        // Consulta preparada para evitar inyección SQL
        $consulta_empleado = mysqli_prepare($conexion, "SELECT id, nombre, puesto FROM trabajadores WHERE id = ?");
        mysqli_stmt_bind_param($consulta_empleado, "s", $codigo);
        mysqli_stmt_execute($consulta_empleado);
        $resultado = mysqli_stmt_get_result($consulta_empleado);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            // Extraer los datos del empleado
            $empleado = mysqli_fetch_assoc($resultado);
            $id_trabajador = $empleado['id'];
            $nombre = $empleado['nombre'];
            $puesto = $empleado['puesto'];

            // Obtener la fecha y hora actual
            $fecha_actual = date('Y-m-d H:i:s');

            // Aquí puedes realizar operaciones adicionales, como registrar la entrada del empleado en otra tabla, etc.
            
            // Usar JavaScript para redirigir después de completar todas las operaciones necesarias
            echo '<script>window.location.href = "tablet.php";</script>';
            exit();
        } else {
            // Manejar caso donde no se encontró el empleado
            echo "Empleado no encontrado.";
        }
    } else {
        // Manejar caso donde no se recibió un código válido
        echo "Código de empleado no válido.";
    }
} else {
    // Manejar caso donde el método de solicitud no es POST
    echo "Acceso no permitido.";
}
?>

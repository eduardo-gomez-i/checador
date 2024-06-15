<?php
session_start();
include 'conex.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibió un código de empleado válido
    if (isset($_POST['id_empleado']) && !empty($_POST['id_empleado'])) {
        $codigo = $_POST['id_empleado'];

        // Realizar la consulta para obtener los datos del empleado por su código
        $consulta_empleado = mysqli_query($conexion, "SELECT id, nombre, puesto FROM trabajadores WHERE id = '$codigo'");

        if ($consulta_empleado && mysqli_num_rows($consulta_empleado) > 0) {
            // Extraer los datos del empleado
            $empleado = mysqli_fetch_assoc($consulta_empleado);
            $id_trabajador = $empleado['id'];
            $nombre = $empleado['nombre'];
            $puesto = $empleado['puesto'];

            // Obtener la fecha y hora actual
            $fecha_actual = date('Y-m-d H:i:s');

            if ($consulta_empleado) {
                // Redirigir a la página principal con el estado de "entrada" para actualizar la interfaz
                header("Location: tablet.php");
                exit();
            } else {
                // Manejar error en la inserción
                echo "Error al marcar la entrada del empleado.";
            }
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

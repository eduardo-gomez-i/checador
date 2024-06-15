<?php
include 'conex.php';

// Verificar si se está recibiendo el parámetro 'term' mediante GET
if (isset($_GET['term'])) {
    $term = $_GET['term'];
    $searchTerm = "%" . $term . "%";

    // Preparar la consulta SQL
    $query = $conexion->prepare("SELECT id, nombre FROM trabajadores WHERE nombre LIKE ?");
    $query->bind_param("s", $searchTerm);

    // Ejecutar la consulta
    if ($query->execute()) {
        // Obtener resultados
        $result = $query->get_result();

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            $employees = array();
            while ($row = $result->fetch_assoc()) {
                $employees[] = array("value" => $row['id'], "label" => $row['nombre']);
            }
            // Devolver datos como JSON
            echo json_encode($employees);
        } else {
            // No se encontraron resultados
            echo json_encode(array()); // Devolver un array vacío
        }
    } else {
        // Error al ejecutar la consulta
        echo json_encode(array("error" => "Error executing query")); // Devolver un JSON con mensaje de error
    }
} else {
    // No se recibió el parámetro 'term'
    echo json_encode(array("error" => "'term' parameter is missing")); // Devolver un JSON con mensaje de error
}
?>

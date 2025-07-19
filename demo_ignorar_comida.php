<?php
// Demo script para mostrar la funcionalidad de ignorar horario de comida
// Este archivo es solo para demostración y puede ser eliminado después de la implementación

include 'config.php';

echo "<h2>Demo: Funcionalidad Ignorar Horario de Comida</h2>";

// Verificar si el campo existe en la base de datos
$sql_check_column = "SHOW COLUMNS FROM horarios_trabajadores LIKE 'ignorar_horario_comida'";
$result_check = mysqli_query($conexion, $sql_check_column);

if (mysqli_num_rows($result_check) > 0) {
    echo "<p style='color: green;'>✅ El campo 'ignorar_horario_comida' existe en la base de datos.</p>";
    
    // Mostrar algunos ejemplos de horarios con la nueva funcionalidad
    $sql_demo = "SELECT t.nombre, ht.dia_semana, ht.hora_llegada, ht.hora_comida_salida, 
                        ht.hora_comida_llegada, ht.hora_salida, ht.ignorar_horario_comida, s.dia
                 FROM horarios_trabajadores ht 
                 JOIN trabajadores t ON t.id = ht.id_trabajador
                 JOIN semana s ON s.id = ht.dia_semana
                 WHERE ht.estado = 1 
                 ORDER BY t.nombre, ht.dia_semana 
                 LIMIT 10";
    
    $result_demo = mysqli_query($conexion, $sql_demo);
    
    if ($result_demo && mysqli_num_rows($result_demo) > 0) {
        echo "<h3>Ejemplos de Horarios:</h3>";
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background-color: #f2f2f2;'>";
        echo "<th>Empleado</th><th>Día</th><th>Llegada</th><th>Comida Salida</th><th>Comida Entrada</th><th>Salida</th><th>Ignora Comida</th>";
        echo "</tr>";
        
        while ($row = mysqli_fetch_assoc($result_demo)) {
            $ignora_comida = $row['ignorar_horario_comida'] == 1 ? 'SÍ' : 'NO';
            $color_fila = $row['ignorar_horario_comida'] == 1 ? 'background-color: #e8f5e8;' : '';
            
            echo "<tr style='$color_fila'>";
            echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($row['dia']) . "</td>";
            echo "<td>" . ($row['hora_llegada'] ?? 'N/A') . "</td>";
            
            if ($row['ignorar_horario_comida'] == 1) {
                echo "<td style='color: green; font-weight: bold;'>Sin horario</td>";
                echo "<td style='color: green; font-weight: bold;'>Sin horario</td>";
            } else {
                echo "<td>" . ($row['hora_comida_salida'] ?? 'N/A') . "</td>";
                echo "<td>" . ($row['hora_comida_llegada'] ?? 'N/A') . "</td>";
            }
            
            echo "<td>" . ($row['hora_salida'] ?? 'N/A') . "</td>";
            echo "<td style='font-weight: bold; color: " . ($row['ignorar_horario_comida'] == 1 ? 'green' : 'blue') . ";'>$ignora_comida</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se encontraron horarios para mostrar.</p>";
    }
    
    // Mostrar estadísticas
    $sql_stats = "SELECT 
                    COUNT(*) as total_horarios,
                    SUM(CASE WHEN ignorar_horario_comida = 1 THEN 1 ELSE 0 END) as con_comida_ignorada,
                    SUM(CASE WHEN ignorar_horario_comida = 0 THEN 1 ELSE 0 END) as con_comida_normal
                  FROM horarios_trabajadores WHERE estado = 1";
    
    $result_stats = mysqli_query($conexion, $sql_stats);
    $stats = mysqli_fetch_assoc($result_stats);
    
    echo "<h3>Estadísticas:</h3>";
    echo "<ul>";
    echo "<li>Total de horarios activos: " . $stats['total_horarios'] . "</li>";
    echo "<li>Horarios sin comida: " . $stats['con_comida_ignorada'] . "</li>";
    echo "<li>Horarios con comida: " . $stats['con_comida_normal'] . "</li>";
    echo "</ul>";
    
} else {
    echo "<p style='color: red;'>❌ El campo 'ignorar_horario_comida' NO existe en la base de datos.</p>";
    echo "<p>Por favor, ejecuta el script SQL: <code>sql/agregar_campo_ignorar_comida.sql</code></p>";
}

echo "<hr>";
echo "<p><strong>Archivos modificados:</strong></p>";
echo "<ul>";
echo "<li>editar_horario.php - Agregado checkbox para ignorar horario de comida</li>";
echo "<li>horarios_trabajador.php - Visualización mejorada</li>";
echo "<li>registroAsistencia.php - Validación de registros de comida</li>";
echo "</ul>";

echo "<p><a href='horarios_trabajador.php?id_trabajador=1'>Ver horarios de un trabajador</a></p>";
echo "<p><a href='registroAsistencia.php'>Ir a registro de asistencia</a></p>";
?>
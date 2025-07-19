# Funcionalidad: Ignorar Horario de Comida

## Descripción
Esta funcionalidad permite configurar empleados que no tienen horario de comida, evitando que se registren horas de salida y entrada de comida para estos trabajadores.

## Instalación

### 1. Ejecutar Script SQL
Primero, ejecuta el siguiente script SQL en tu base de datos para agregar el nuevo campo:

```sql
-- Agregar campo para ignorar horario de comida
ALTER TABLE `horarios_trabajadores` 
ADD COLUMN `ignorar_horario_comida` TINYINT(1) DEFAULT 0 COMMENT 'Si es 1, ignora el horario de comida para este empleado en este día';

-- Actualizar registros existentes donde hora_comida_salida y hora_comida_llegada son NULL
UPDATE `horarios_trabajadores` 
SET `ignorar_horario_comida` = 1 
WHERE `hora_comida_salida` IS NULL AND `hora_comida_llegada` IS NULL AND `estado` = 1;
```

O ejecuta el archivo: `sql/agregar_campo_ignorar_comida.sql`

### 2. Archivos Modificados
Los siguientes archivos han sido modificados para soportar esta funcionalidad:

- `editar_horario.php` - Agregado checkbox para ignorar horario de comida
- `horarios_trabajador.php` - Muestra visualmente cuando se ignora el horario de comida
- `registroAsistencia.php` - Valida que no se registren horas de comida para empleados configurados sin horario de comida

## Uso

### Configurar Empleado sin Horario de Comida
1. Ve a **Trabajadores** → Selecciona un trabajador → Icono de reloj (horarios)
2. Selecciona el día que quieres editar
3. Marca la casilla **"Ignorar horario de comida (empleado sin horario de comida)"**
4. Los campos de hora de comida se ocultarán automáticamente
5. Guarda los cambios

### Visualización
- En la lista de horarios, los días con horario de comida ignorado mostrarán "Sin horario de comida" en color verde
- Los empleados configurados sin horario de comida no podrán registrar horas de salida/entrada de comida

### Registro de Asistencia
- Si intentas registrar hora de comida para un empleado configurado sin horario de comida, el sistema mostrará un mensaje de error
- Solo se podrán registrar: hora de entrada y hora de salida

## Características

- ✅ Configuración por empleado y por día de la semana
- ✅ Validación automática en el registro de asistencia
- ✅ Interfaz intuitiva con ocultación automática de campos
- ✅ Visualización clara en la lista de horarios
- ✅ Compatibilidad con horarios existentes

## Notas Técnicas

- El campo `ignorar_horario_comida` es de tipo TINYINT(1) con valor por defecto 0
- Cuando se activa esta opción, los campos `hora_comida_salida` y `hora_comida_llegada` se establecen como NULL
- La validación se realiza basándose en el día de la semana de la fecha del registro
- El sistema es retrocompatible con registros existentes
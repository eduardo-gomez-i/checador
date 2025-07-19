-- Script para agregar campo ignorar_horario_comida a la tabla horarios_trabajadores
-- Este campo permitirá que algunos empleados no tengan horario de comida

ALTER TABLE `horarios_trabajadores` 
ADD COLUMN `ignorar_horario_comida` TINYINT(1) DEFAULT 0 COMMENT 'Si es 1, ignora el horario de comida para este empleado en este día';

-- Actualizar registros existentes donde hora_comida_salida y hora_comida_llegada son NULL
-- para marcarlos como que ignoran el horario de comida
UPDATE `horarios_trabajadores` 
SET `ignorar_horario_comida` = 1 
WHERE `hora_comida_salida` IS NULL AND `hora_comida_llegada` IS NULL AND `estado` = 1;
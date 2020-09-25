<?php 
SESSION_START();
require_once "conecta_basedatos.php";
$hoy=date("Y-m-d");
$ahorita=date("H:i");
$tarjeta=$_GET['tarjeta'];

if (!empty($tarjeta)) {
	echo "La tarjeta: ".$tarjeta;
	$existe_tarjeta=mysql_result(mysql_query("SELECT COUNT(nombre) AS trabajador FROM trabajadores WHERE tarjeta='$tarjeta'"), 0);
	
	if ($existe_tarjeta == 1) {
		echo " Si existe";
		$consulta=mysql_query("SELECT * FROM trabajadores WHERE tarjeta='$tarjeta'");
	    
		while($campo=mysql_fetch_array($consulta)){
		  $id=$campo['id'];
		  $trabajador=$campo['nombre'];
		  $entrada=$campo['hora_entrada'];
		  $salida=$campo['hora_salida'];
		  $departamento=$campo['departamento'];
		  $puesto=$campo['puesto'];
		}

		$registro=mysql_result(mysql_query("SELECT COUNT(trabajador) AS nombre FROM checador WHERE fecha='$hoy' AND tarjeta='$tarjeta'"), 0);

		if ($registro == 0) {
		echo " Agregando Registro a las: ".$ahorita;
		mysql_query("INSERT INTO checador (trabajador, entrada, asistencia, fecha, tarjeta) VALUES ('$trabajador','$ahorita', 'SI', '$hoy','$tarjeta')");
		mysql_query("UPDATE checador_last SET trabajador='$trabajador', entrada='$ahorita', scomida=NULL, rcomida=NULL, salida=NULL, trabajo_horas=NULL, asistencia='SI', fecha='$hoy', tarjeta='$tarjeta' WHERE id='1'");
		}//si no hay registro

		if ($registro == 1) {
			echo " Actualizando Registro";
			$consulta2=mysql_query("SELECT * FROM checador WHERE fecha='$hoy' AND tarjeta='$tarjeta'");
		    
			while($resultado=mysql_fetch_array($consulta2)){
			 $id=$resultado['id'];
			 $trabajador=$resultado['trabajador'];
			 $entrada=$resultado['entrada'];
			 $scomida=$resultado['scomida'];
			 $rcomida=$resultado['rcomida'];
			 $salida=$resultado['salida'];
			 $trabajo_horas=$resultado['trabajo_horas'];
			 $asistencia=$resultado['asistencia'];
			 $fecha=$resultado['fecha'];			 
			}

			echo " de ".$trabajador;
			if (empty($scomida)) {
				echo " Registrando  horario de comida a las: ".$ahorita;
				mysql_query("UPDATE checador SET scomida='$ahorita' WHERE fecha='$hoy' AND tarjeta='$tarjeta'");
				mysql_query("UPDATE checador_last SET trabajador='$trabajador', entrada='$entrada', scomida='$ahorita', rcomida=NULL, salida=NULL, trabajo_horas=NULL, asistencia='SI', fecha='$hoy', tarjeta='$tarjeta' WHERE id='1'");
			}elseif (empty($rcomida)) {
				echo " Registrando regreso de comida a las: ".$ahorita;
				mysql_query("UPDATE checador SET rcomida='$ahorita' WHERE fecha='$hoy' AND tarjeta='$tarjeta'");
				mysql_query("UPDATE checador_last SET trabajador='$trabajador', entrada='$entrada', scomida='$scomida', rcomida='$ahorita', salida=NULL, trabajo_horas=NULL, asistencia='SI', fecha='$hoy', tarjeta='$tarjeta' WHERE id='1'");
			}elseif (empty($salida)) {
				mysql_query("UPDATE checador SET salida='$ahorita' WHERE fecha='$hoy' AND tarjeta='$tarjeta'");
				mysql_query("UPDATE checador_last SET trabajador='$trabajador', entrada='$entrada', scomida='$scomida', rcomida='$rcomida', salida='$ahorita', trabajo_horas=NULL, asistencia='SI', fecha='$hoy', tarjeta='$tarjeta' WHERE id='1'");
				$lasalida=mysql_result(mysql_query("SELECT salida FROM checador WHERE fecha='$hoy' AND tarjeta='$tarjeta'"), 0);
				
					echo " Registrando salida a las: ".$ahorita;
					echo " Calculando horas trabajadas: ";
					$inicio = $hoy.$entrada;
					$final  = $hoy.$lasalida;

					$fecha_inicio = new DateTime($inicio);//fecha inicial
					$fecha_final  = new DateTime($final);//fecha de cierre

					$intervalo = $fecha_inicio->diff($fecha_final);
					$total_horas_trabajadas=$intervalo->format('%H:%I');
					echo $total_horas_trabajadas;
					
					mysql_query("UPDATE checador SET trabajo_horas='$total_horas_trabajadas' WHERE fecha='$hoy' AND tarjeta='$tarjeta'");
					mysql_query("UPDATE checador_last SET trabajo_horas='$total_horas_trabajadas' WHERE id='1'");
				
			}//registra salida			
		}//actualiza tarjeta
	}//existe tarjeta

	if ($existe_tarjeta == 0) {
		echo " No existe";
		mysql_query("UPDATE newcard SET tarjeta='$tarjeta', conocida='NO'");
	}					
}//si detecta tarjeta

	if (!empty($_GET['limpiar'])) {
		mysql_query("UPDATE checador_last SET 
			trabajador=NULL,
			entrada=NULL,
			scomida=NULL,
			rcomida=NULL,
			salida=NULL,	
			trabajo_horas=NULL,
			asistencia=NULL,
			fecha=NULL,
			tarjeta=NULL
			WHERE id='1'");
		echo "limpado con exito";
	}
?>
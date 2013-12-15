<?php
class Config extends AppModel {
    var $name = 'Config';
	
	function obtenerTrimestre($fecha){
		$separar_fecha = explode(" ",$fecha);
		$fecha = $separar_fecha[0];
		$mes = explode("-",$fecha);
		$mes = $mes[1];
		if ($mes >= 1 && $mes<=3) {
			$trimestre = 1;
		} elseif ($mes >= 4 && $mes<=6) {
			$trimestre = 2;
		} elseif ($mes >= 7 && $mes<=9) {
			$trimestre = 3;
		} elseif ($mes >= 10 && $mes<=12) {
			$trimestre = 4;
		}
		
		return $trimestre;
	}
	
	function obtenerAno($fecha){
		$separar_fecha = explode(" ",$fecha);
		$fecha = $separar_fecha[0];
		$ano = explode("-",$fecha);
		$ano = $ano[0];
		return($ano);
	}
	
	function obtenerMes($fecha){
		$separar_fecha = explode(" ",$fecha);
		$fecha = $separar_fecha[0];
		$mes = explode("-",$fecha);
		$mes = $mes[1];
		return($mes);
	}
	
	function obtenerSemana($fecha){
		$separar_fecha = explode(" ",$fecha);
		$fecha = $separar_fecha[0];
		$dia = explode("-",$fecha);
		$dia = $dia[2];
		if ($dia >= 1 && $dia<=7) {
			$semana = 1;
		} elseif ($dia >= 8 && $dia<=15) {
			$semana = 2;
		} elseif ($dia >= 16 && $dia<=22) {
			$semana = 3;
		} elseif ($dia >= 23 && $dia<=31) {
			$semana = 4;
		}
		
		return $semana;
	}
	
	function obtenerIntervaloFechas($fecha_menor,$fecha_mayor = null) {
		
		if (empty($fecha_mayor)) {

			$hoy = "now";

		} else {

			$hoy = $fecha_mayor;

		}		
		  $diferencia = strtotime($hoy) - strtotime($fecha_menor);

		if($diferencia<60){
			$tiempo = floor($diferencia)." segundos";
		}elseif($diferencia>60 && $diferencia<3600){
			$tiempo = floor($diferencia/60)." minutos'";
		}elseif($diferencia>3600 && $diferencia<86400){
			$tiempo = floor($diferencia/3600)." horas";
		}elseif($diferencia>86400 && $diferencia<2592000){
			$tiempo = floor($diferencia/86400)." días";
		}elseif($diferencia>2592000 && $diferencia<31104000){
			$tiempo = floor($diferencia/2592000)." meses";
		}elseif($diferencia>31104000){
			$tiempo = floor($diferencia/31104000)." años";
		}else{
			$tiempo = "Error";
		}
		//debug($tiempo);
		return($tiempo);
		
	}
	
}
?>
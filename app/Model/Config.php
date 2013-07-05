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
}
?>
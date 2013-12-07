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
		$fecha_menor = new DateTime($fecha_menor); 
		if (empty($fecha_mayor)) {
			$hoy = new DateTime("now");
		} else {
			$hoy = new DateTime($fecha_mayor);
		}		
		$intervalo = $fecha_menor->diff( $hoy );
		$anios = $intervalo->format('%y'); 
		$meses = $intervalo->format('%m'); 
		$dias = $intervalo->format('%d'); 
		$tiempo = '';
		if ( $anios > 0 ) { 
			$tiempo = $anios;
			if ($anios > 1) { 
				$tiempo.='años '; 
			} else {
				$tiempo.='año '; 
			}
        } 
		if ( $meses > 0 ) { 
			$tiempo.= $meses;
			if($meses > 1) {
				$tiempo.='meses ';
			}else{
				$tiempo.= 'mes ';
			}
		}
		if ( $dias > 0 ) { 
			$tiempo.= $dias;
			
			if ($dias > 1) {
				$tiempo.='días';
			} else {
				$tiempo.='día';
			}
			 
		}
		return ($tiempo);
	}
	
}
?>
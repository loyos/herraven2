<?php
class IndexController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('RequestHandler','HighCharts.HighCharts');
	public $uses = array('Cuenta','Abono');
	//public $layout = 'chart.demo';
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index'); // Letting users register themselves
	}
	
    function index() {		
    }
	
	function admin_cuentas_mensual(){
		$cuentas_por_mes = $this->Cuenta->find('all',array(
			'fields' => array('Cuenta.mes'), 
			'group' => array('Cuenta.mes'),
			'order' => array('Cuenta.mes DESC'),
		));
		$numero_meses = count($cuentas_por_mes);
		asort($cuentas_por_mes);
		foreach ($cuentas_por_mes as $cuenta) {
			//$chartData1[] = floatval($cuenta[0]['cuenta']);
			$meses[] = $this->obtenerNombreMes(floatval($cuenta['Cuenta']['mes']));
			$meses_encontrados[] = $cuenta['Cuenta']['mes'];
		
		}
		foreach ($meses_encontrados as $mes) {
			$cuentas_no_pagadas[$mes] = $this->Cuenta->find('all',array(
				'conditions' => array(
					'Cuenta.mes <=' => $mes,
					'OR' => array(
						'Cuenta.mes_pago >' => $mes,
						'Cuenta.mes_pago =' => 0,
					)
					
				),
			));
		}

		foreach ($cuentas_no_pagadas as $mes => $c) {
			$sum = 0;
			foreach ($c as $a) {
				$abonos = $this->Abono->find('all',array(
					'fields' => array('SUM(Abono.abono) as abono' ) ,
					'conditions' => array(
						'Abono.cuenta_id' => $a['Cuenta']['id'],
						'Abono.mes <=' => $mes
					),
					
				));
				if (empty($abonos[0][0]['abono'])) {
					$abonos[0][0]['abono'] = 0;
				}
				//var_dump($abonos); die();
				$sum = $sum+ ($a['Pedido']['cuenta']-$abonos[0][0]['abono']);
			}
			$chartData1[] = $sum;
			// $chartData1[] = floatval($cuenta[0]['cuenta']);
		}


         $chartName = 'Line Chart with Data Labels';

        // anonymous Callback function to format the text of the tooltip
        

        $mychart = $this->HighCharts->create( $chartName, 'line' );

        $this->HighCharts->setChartParams(
                        $chartName,
                        array (
                                'renderTo'				=> 'linewrapper',  // div to display chart inside
                                'chartWidth'				=> 500,
                                'chartHeight'				=> 500,
                                'chartMarginTop' 			=> 60,
                                'chartMarginLeft'			=> 90,
                                'chartMarginRight'			=> 30,
                                'chartMarginBottom'			=> 110,
                                'chartSpacingRight'			=> 10,
                                'chartSpacingBottom'			=> 15,
                                'chartSpacingLeft'			=> 0,
                                'chartAlignTicks'			=> FALSE,
                                'chartTheme'                            => 'grid',

                                'title'					=> '',
                                'subtitle'				=> '',
                                'titleAlign'				=> 'center',
                                'titleFloating'				=> TRUE,
                                'titleStyleFont'			=> '18px Metrophobic, Arial, sans-serif',
                                'titleStyleColor'			=> '#0099ff',
                                'titleX'				=> 20,
                                'titleY'				=> 10,

                                'legendEnabled' 			=> TRUE,
                                'legendLayout'				=> 'horizontal',
                                'legendAlign'				=> 'center',
                                'legendVerticalAlign '			=> 'bottom',
                                'legendItemStyle'			=> array('color' => '#222'),
                                'legendBackgroundColorLinearGradient' 	=> array(0,0,0,25),
                                'legendBackgroundColorStops' 		=> array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),

                                'tooltipEnabled' 			=> TRUE,
                                
                                'xAxisLabelsEnabled' 			=> TRUE,
                                'xAxisLabelsAlign' 			=> 'right',
                                'xAxisLabelsStep' 			=> 1,
                                'xAxislabelsX' 				=> 5,
                                'xAxisLabelsY' 				=> 20,
                                'xAxisCategories'           		=> $meses,

                                'yAxisTitleText' 			=> 'Temperature (°C)',

                                'plotOptionsLineDataLabelsEnabled' 	=> TRUE,
                                'plotOptionsLineEnableMouseTracking' 	=> TRUE,

                                /* autostep options */
                                'enableAutoStep' 			=> FALSE
                        )

            );

        $series1 = $this->HighCharts->addChartSeries();
       
        $series1->addName('Monto que adeudan los clientes')
            ->addData($chartData1);

       
        $mychart->addSeries($series1);
        
	}
	
	function admin_facturacion_mensual(){
		$cuentas_por_mes = $this->Cuenta->find('all',array(
			'fields' => array('Cuenta.mes'), 
			'group' => array('Cuenta.mes'),
			'order' => array('Cuenta.mes DESC'),
		));
		$numero_meses = count($cuentas_por_mes);
		asort($cuentas_por_mes);
		
		foreach ($cuentas_por_mes as $cuenta) {
			//$chartData1[] = floatval($cuenta[0]['cuenta']);
			$meses[] = $this->obtenerNombreMes(floatval($cuenta['Cuenta']['mes']));
			$meses_encontrados[] = $cuenta['Cuenta']['mes'];
		
		}
		
		foreach ($meses_encontrados as $mes) {
			$cuentas[] = $this->Cuenta->find('all',array(
				'conditions' => array(
					'Cuenta.mes' => floatval($mes) 	
				)
			));
		}
		
		foreach ($cuentas as $c) {
			$chartData1[] = count($c);
		}
		
        $chartName = 'Line Chart with Data Labels';
        $mychart = $this->HighCharts->create( $chartName, 'line' );

        $this->HighCharts->setChartParams(
                        $chartName,
                        array (
                                'renderTo'				=> 'linewrapper',  // div to display chart inside
                                'chartWidth'				=> 500,
                                'chartHeight'				=> 500,
                                'chartMarginTop' 			=> 60,
                                'chartMarginLeft'			=> 90,
                                'chartMarginRight'			=> 30,
                                'chartMarginBottom'			=> 110,
                                'chartSpacingRight'			=> 10,
                                'chartSpacingBottom'			=> 15,
                                'chartSpacingLeft'			=> 0,
                                'chartAlignTicks'			=> FALSE,
                                'chartTheme'                            => 'grid',

                                'title'					=> '',
                                'subtitle'				=> '',
                                'titleAlign'				=> 'center',
                                'titleFloating'				=> TRUE,
                                'titleStyleFont'			=> '18px Metrophobic, Arial, sans-serif',
                                'titleStyleColor'			=> '#0099ff',
                                'titleX'				=> 20,
                                'titleY'				=> 10,

                                'legendEnabled' 			=> TRUE,
                                'legendLayout'				=> 'horizontal',
                                'legendAlign'				=> 'center',
                                'legendVerticalAlign '			=> 'bottom',
                                'legendItemStyle'			=> array('color' => '#222'),
                                'legendBackgroundColorLinearGradient' 	=> array(0,0,0,25),
                                'legendBackgroundColorStops' 		=> array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),

                                'tooltipEnabled' 			=> TRUE,
                                
                                'xAxisLabelsEnabled' 			=> TRUE,
                                'xAxisLabelsAlign' 			=> 'right',
                                'xAxisLabelsStep' 			=> 1,
                                'xAxislabelsX' 				=> 5,
                                'xAxisLabelsY' 				=> 20,
                                'xAxisCategories'           		=> $meses,

                                'yAxisTitleText' 			=> 'Temperature (°C)',

                                'plotOptionsLineDataLabelsEnabled' 	=> TRUE,
                                'plotOptionsLineEnableMouseTracking' 	=> TRUE,

                                /* autostep options */
                                'enableAutoStep' 			=> FALSE
                        )

            );

        $series1 = $this->HighCharts->addChartSeries();
       
        $series1->addName('Despachos al mes')
            ->addData($chartData1);

       
        $mychart->addSeries($series1);
        
	}
	
	function admin_cobranza_mensual(){
		$cuentas_por_mes = $this->Cuenta->find('all',array(
			'fields' => array('Cuenta.mes'), 
			'group' => array('Cuenta.mes'),
			'order' => array('Cuenta.mes DESC'),
		));
		$numero_meses = count($cuentas_por_mes);
		asort($cuentas_por_mes);
		
		foreach ($cuentas_por_mes as $cuenta) {
			//$chartData1[] = floatval($cuenta[0]['cuenta']);
			$meses[] = $this->obtenerNombreMes(floatval($cuenta['Cuenta']['mes']));
			$meses_encontrados[] = $cuenta['Cuenta']['mes'];
		
		}
		
		foreach ($meses_encontrados as $mes) {
			$abonos[$mes] = $this->Abono->find('all',array(
				'fields' => array('SUM(Abono.abono) as abono'),
				'conditions' => array(
					'Abono.mes' => floatval($mes) 	
				)
			));
		}
		//var_dump($abonos[10][0][0]);
		foreach ($abonos as $c) {
			if (empty($c[0][0]['abono'])) {
				$c[0][0]['abono'] = 0;
			}
			$chartData1[] = round(floatval($c[0][0]['abono']),2);
		}
		
        $chartName = 'Line Chart with Data Labels';
        $mychart = $this->HighCharts->create( $chartName, 'line' );

        $this->HighCharts->setChartParams(
                        $chartName,
                        array (
                                'renderTo'				=> 'linewrapper',  // div to display chart inside
                                'chartWidth'				=> 500,
                                'chartHeight'				=> 500,
                                'chartMarginTop' 			=> 60,
                                'chartMarginLeft'			=> 90,
                                'chartMarginRight'			=> 30,
                                'chartMarginBottom'			=> 110,
                                'chartSpacingRight'			=> 10,
                                'chartSpacingBottom'			=> 15,
                                'chartSpacingLeft'			=> 0,
                                'chartAlignTicks'			=> FALSE,
                                'chartTheme'                            => 'grid',

                                'title'					=> '',
                                'subtitle'				=> '',
                                'titleAlign'				=> 'center',
                                'titleFloating'				=> TRUE,
                                'titleStyleFont'			=> '18px Metrophobic, Arial, sans-serif',
                                'titleStyleColor'			=> '#0099ff',
                                'titleX'				=> 20,
                                'titleY'				=> 10,

                                'legendEnabled' 			=> TRUE,
                                'legendLayout'				=> 'horizontal',
                                'legendAlign'				=> 'center',
                                'legendVerticalAlign '			=> 'bottom',
                                'legendItemStyle'			=> array('color' => '#222'),
                                'legendBackgroundColorLinearGradient' 	=> array(0,0,0,25),
                                'legendBackgroundColorStops' 		=> array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),

                                'tooltipEnabled' 			=> TRUE,
                                
                                'xAxisLabelsEnabled' 			=> TRUE,
                                'xAxisLabelsAlign' 			=> 'right',
                                'xAxisLabelsStep' 			=> 1,
                                'xAxislabelsX' 				=> 5,
                                'xAxisLabelsY' 				=> 20,
                                'xAxisCategories'           		=> $meses,

                                'yAxisTitleText' 			=> 'Temperature (°C)',

                                'plotOptionsLineDataLabelsEnabled' 	=> TRUE,
                                'plotOptionsLineEnableMouseTracking' 	=> TRUE,

                                /* autostep options */
                                'enableAutoStep' 			=> FALSE
                        )

            );

        $series1 = $this->HighCharts->addChartSeries();
       
        $series1->addName('Cobranza mensual')
            ->addData($chartData1);

       
        $mychart->addSeries($series1);
        
	}
	
	function obtenerNombreMes($mes){
		if ($mes == 1) {
			return('Enero');
		} elseif ($mes == 2) {
			return('Febrero');
		} elseif ($mes == 3) {
			return('Marzo');
		} elseif ($mes == 4) {
			return('Abril');
		} elseif ($mes == 5) {
			return('Mayo');
		} elseif ($mes == 6) {
			return('Junio');
		} elseif ($mes == 7) {
			return('Julio');
		} elseif ($mes == 8) {
			return('Agosto');
		} elseif ($mes == 9) {
			return('Septiembre');
		} elseif ($mes == 10) {
			return('Octubre');
		} elseif ($mes == 11) {
			return('Noviembre');
		} elseif ($mes == 12) {
			return('Diciembre');
		} 
	}
}

?>
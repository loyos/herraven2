<div class="wrap">
	<h1>Estadísticas Mensuales</h1>
	<?php
	echo $this->Html->link('Facturación',array('action' => 'admin_facturacion_mensual'), array('class' => 'boton')).'<b>&nbsp&nbsp&nbsp - &nbsp&nbsp&nbsp';
	if(!empty($facturaciones_actuales)) {
		echo $faturaciones_actuales.'</b>';
	}else {
		echo '0&nbsp&nbsp&nbsp</b>';
	}
	if ($facturacion == 'menor') {
		$val = 'flecha_roja.PNG';
	} else {
		$val = 'flecha_verde.PNG';
	}
	echo $this->Html->image($val,array('width' => '20px'));
	echo '<br><br><br>';
	echo $this->Html->link('Cuentas por cobrar',array('action' => 'admin_cuentas_mensual'), array('class' => 'boton')).'<b>&nbsp&nbsp&nbsp - &nbsp&nbsp&nbsp';
	if(!empty($sum_cuentas_no_pagadas)) {
		echo $sum_cuentas_no_pagadas.'&nbsp&nbsp&nbsp</b>';
	}else {
		echo '0&nbsp&nbsp&nbsp</b>';
	}
	if ($sum_cuentas == 'menor') {
		$val = 'flecha_roja.PNG';
	} else {
		$val = 'flecha_verde.PNG';
	}
	echo $this->Html->image($val,array('width' => '20px'));
	echo '<br><br><br>';
	echo $this->Html->link('Cobranza',array('action' => 'admin_cobranza_mensual'), array('class' => 'boton')).'<b>&nbsp&nbsp&nbsp - &nbsp&nbsp&nbsp';
	if(!empty($abonos_actuales)) {
		echo $abonos_actuales.'&nbsp&nbsp&nbsp</b>';
	}else {
		echo '0&nbsp&nbsp&nbsp</b>';
	}
	if ($cobranza == 'menor') {
		$val = 'flecha_roja.PNG';
	} else {
		$val = 'flecha_verde.PNG';
	}
	echo $this->Html->image($val,array('width' => '20px'));
	?>
</div>
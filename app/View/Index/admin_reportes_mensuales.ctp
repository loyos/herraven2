<div class="wrap">
	<?php
	echo '<h3>'.$this->Html->link('Facturación',array('action' => 'admin_facturacion_mensual'), array('class' => 'boton')).'</h3>';
	echo '<h3>'.$this->Html->link('Cuentas por cobrar',array('action' => 'admin_cuentas_mensual'), array('class' => 'boton')).'</h3>';
	echo '<h3>'.$this->Html->link('Cobranza',array('action' => 'admin_cobranza_mensual'), array('class' => 'boton')).'</h3>';
	?>
</div>
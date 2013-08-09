<div class="wrap">
	<h2>Pago</h2>
	<?php
	echo $this->Form->create('Cuenta');
	echo $this->Form->input('monto',array(
		'label' => 'Monto a pagar'
	));
	echo $this->Form->input('id',array(
		'type' => 'hidden',
		'value' => $id
	));
	echo $this->Form->submit('Pagar',array('class' => 'button'));
	echo $this->Form->end();
	?>
</div>
<div class="wrap">
	<?php
	echo '<h3>Egreso</h3>';
	echo $this->Form->create('Almacencliente');
	echo $this->Form->input('codigo',array(
		'label' => 'Código de caja '
	));
	echo $this->Form->input('articulo_id',array(
		'type' => 'hidden',
		'value' => $articulo_id
	));
	echo $this->Form->input('acabado_id',array(
		'type' => 'hidden',
		'value' => $acabado_id
	));
	echo $this->Form->submit('Egreso',array('class' => 'button'));
	echo $this->Form->end();
	?>
	
</div>
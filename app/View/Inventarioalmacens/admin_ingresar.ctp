<div class="wrap">
	<?php
	echo $this->Form->create('Inventarioalmacen');
	echo $this->Form->input('cajas');
	echo $this->Form->input('acabado_id');
	echo $this->Form->submit('Ingresar', array('class' => 'button'));
	echo $this->Form->end;
	?>
</div>
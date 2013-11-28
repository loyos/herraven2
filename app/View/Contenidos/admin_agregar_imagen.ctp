<div class="wrap">
<?php
	echo '<h1>Agregar nueva imagen</h1>';
	echo $this->Form->create('Contenido', array('type' => 'file'));
	echo $this->Form->file('Imagen.Foto',array(
		'label' => 'Imagen'
	));
	echo $this->Form->submit('Agregar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>
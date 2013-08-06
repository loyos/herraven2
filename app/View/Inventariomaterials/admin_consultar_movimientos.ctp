<div class="wrap">
	<?php
	echo $this->Html->link('Regresar',array('action' => 'admin_movimientos',$materiaprima));
	?>
	<h2>Movimientos de <?php echo $materiaprima?> en el trimestre <?php echo $trimestre ?></h2>
	<?php
	echo $this->element('admin_consultar_movimientos');
	?>
</div>
<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1>Agregar entrada de material</h1>
<?php 
	echo $this->Form->create('Inventariomaterial');
	echo '<table>';
	echo '<tr>';
	echo '<td>Materia prima</td>';
	echo '<td>';
	echo $this->Form->input('materiasprima_id',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Cantidad</td>';
	echo '<td>';
	echo $this->Form->input('cantidad',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo $this->Form->submit('Agregar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>

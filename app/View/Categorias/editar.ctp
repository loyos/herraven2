<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'index'));
?>
<h1><?php echo $titulo ?></h1>
<?php 
	echo $this->Form->create('Categoria');
	echo '<table>';
	echo '<tr>';
	echo '<td>Categoria</td>';
	echo '<td>';
	echo $this->Form->input('descripcion',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Oculto</td>';
	echo '<td>';
	echo $this->Form->input('oculto',array(
		'label' => false,
		'type' => 'select',
		'options' => array(
			'0' => 'No',
			'1' => 'Si'
		),
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	if (!empty($id)) {
		echo $this->Form->input('id',array('type'=>'hidden'));
	}
	echo $this->Form->submit('Agregar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>
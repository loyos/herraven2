<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'editar'));
?>
<h1>Acabados</h1>
<?php 
	if (!empty($acabados)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Oculto</th>
		<th>Acabado</th>
		<th>Descripcion</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($acabados as $a) {
			echo '<tr>';
			echo '<td>';
			if ($a['Acabado']['oculto'] == 1){
				$value = 'Si';
			} else {
				$value = 'No';
			}
			echo $value;
			echo '</td>';
			echo '<td>'.$a['Acabado']['acabado'].'</td>';
			echo '<td>'.$a['Acabado']['descripcion'].'</td>';
			echo '<td>'.$this->Html->link('Editar',array(
				'action' => 'editar',$a['Acabado']['id'])).'<br>';
			if ($eliminar_cat[$a['Acabado']['id']] == 0){
				echo $this->Html->link('Eliminar',array('action' => 'eliminar',$a['Acabado']['id'])).'<br>';
			}
			echo 
			'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
?>
</div>


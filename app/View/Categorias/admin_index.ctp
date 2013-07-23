<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'));
?>
<h1>Categorias</h1>
<?php 
	if (!empty($categorias)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Oculto</th>
		<th>Categoria</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($categorias as $c) {
			echo '<tr>';
			echo '<td>';
			if ($c['Categoria']['oculto'] == 1){
				$value = 'Si';
			} else {
				$value = 'No';
			}
			echo $value;
			echo '</td>';
			echo '<td>'.$c['Categoria']['descripcion'].'</td>';
			echo '<td>'.$this->Html->link('Editar',array(
				'action' => 'admin_editar',$c['Categoria']['id'])).'<br>';
			if ($eliminar_cat[$c['Categoria']['id']] == 0){
				echo $this->Html->link('Eliminar',array('action' => 'admin_eliminar',$c['Categoria']['id']),
					array(),
					'Estás seguro que deseas eliminar?').'<br>';
			}
			echo '</tr>';
		}
		echo '</table>';
	}
?>
</div>

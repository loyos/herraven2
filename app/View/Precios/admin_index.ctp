<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'));
?>
<h1>Lista de Precios</h1>
<?php 
	if (!empty($precios)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Lista</th>
		<th>Ganancia con respecto a la lista base</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($precios as $p) {
			echo '<tr>';
			echo '<td>'.$p['Precio']['descripcion'].'</td>';
			echo '<td>'.$p['Precio']['ganancia'].'%</td>';
			echo '<td>';
			if ($p['Precio']['id'] != 1) {
			echo $this->Html->link('Editar',array('action' => 'admin_editar',$p['Precio']['id'])).'<br>';
			echo $this->Html->link('Eliminar',array('action' => 'admin_eliminar',$p['Precio']['id'])).'<br>';
			}
			echo $this->Html->link('Ver',array('action' => 'admin_ver',$p['Precio']['id'])).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
?>
</div>

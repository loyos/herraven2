<div class="wrap">
	<div class = "search">
		<?php
			echo $this->Html->link('Regresar',array('action' => 'admin_listar_subcategorias',$precio['Precio']['id']));
			echo $this->Form->create('Precio');
			if (!empty($this->data['Precio']['acabado_id'])) {
				$value = $this->data['Precio']['acabado_id'];
			} else {
				$value = 0;
			}
			echo $this->Form->input('acabado_id',array('value' => $value));
			echo $this->Form->submit('Buscar',array('class' => 'button'));
		?>
	</div>
<h1><?php echo $precio['Precio']['descripcion']?></h1>
<?php
if (!empty($acabado_seleccionado)) {
?>
<?php 
	if (!empty($precio_articulo)) {
	echo '<table  class="tabla_ver">';
	echo '<tr>';
		echo '<th>Codigo</th>';
		echo '<th>Precio</th>';
		echo '<th>Pz. por Caja</th>';
		echo '<th>Precio Caja</th>';
	echo '</tr>';
	foreach ($precio_articulo as $a){
		echo '<tr>';
		echo '<th>'.$a['codigo'].'</th>';
		echo '<td>';
		echo $this->Herra->format_number($a['precio']);
		echo '</td>';
		echo '<td>'.$a['cantidad'].'</td>';
		echo '<td>'.$this->Herra->format_number($a['cantidad']*$a['precio']).'</td>';
		echo '</tr>';
		echo '<tr>';
	}
	echo '</table>';
	} else {
		echo '<h3>No hay artículos con este acabado</h3>';
	}
} else {
	echo 'Selecciona un acabado';
}
	// echo '<h2>Precios de materias prima</h2>';
	// echo '<table  class="tabla_ver">';
	// foreach ($precio_materia as $mp){
		// echo '<tr>';
		// echo '<th>'.$mp['materia'].'</th>';
		// echo '<td>';
		// echo 'Bs. '.number_format($mp['precio'],'0', ',', '.');
		// echo '</td>';
		// echo '</tr>';
		// echo '<tr>';
	// }
	// echo '</table>';
?>
</div>

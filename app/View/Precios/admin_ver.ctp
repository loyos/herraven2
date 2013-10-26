<div class="wrap">
	<?php 
	if (empty($subcat)) {
		$subcat = 0;
	}
	echo $this->Html->link('Regresar',array('action' => 'admin_listar_subcategorias',$precio['Precio']['id'])); 
	if (empty($acabado_seleccionado)) {
		$acabado_seleccionado = 10000;
	}
	echo '<br>';
	echo $this->Html->link('Ver Reporte',array('action' => 'admin_ver',$id,$cat,$acabado_seleccionado,$subcat,'ext' => 'pdf'),array('target'=>'_blank'));
	?>
	
	<div class = "search">
		<?php
			echo $this->Form->create('Precio');
			if (!empty($this->data['Precio']['acabado_id'])) {
				$value = $this->data['Precio']['acabado_id'];
			} else {
				$value = 'Nada';
			}
			echo $this->Form->input('acabado_id',array('value' => $value,'label' => 'Selecciona un acabado'));
			echo $this->Form->submit('Buscar',array('class' => 'button'));
		?>
	</div>
<h1><?php echo $precio['Precio']['descripcion']?></h1>
<?php
if (!empty($acabado_seleccionado)) {
	if (!empty($acabado['Acabado']['acabado'])) {
		echo '<h3>('.$acabado['Acabado']['acabado'].')</h3><br>';
	} else {
		echo '<h3>(Sin Acabado)</h3><br>';
	}
?>
<?php 
	if (!empty($precio_articulo)) {
	echo '<table  style="width:100%" class="tabla_index">';
	echo '<tr>';
		echo '<th>Codigo</th>';
		echo '<th>Precio</th>';
		echo '<th>Pz. por Caja</th>';
		echo '<th>Precio Caja</th>';
	echo '</tr>';
	foreach ($precio_articulo as $a){
		echo '<tr>';
		echo '<td>'.$a['codigo'].'</td>';
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

<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_listar_subcategorias',$precio['Precio']['id']));
?>
<h1><?php echo $precio['Precio']['descripcion']?></h1>
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
		echo 'Bs. '.number_format($a['precio'], 0, ',', '.');
		echo '</td>';
		echo '<td>'.$a['cantidad'].'</td>';
		echo '<td>Bs. '.number_format($a['cantidad']*$a['precio'], 0, ',', '.').'</td>';
		echo '</tr>';
		echo '<tr>';
	}
	echo '</table>';
	} else {
		echo '<h3>No hay artículos en esta categoria</h3>';
	}
?>

<?php 
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

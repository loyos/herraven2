<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'));
?>
<h1>Lista de precio: <?php echo $precio['Precio']['descripcion']?></h1>
<?php 
	echo '<h2>Precios de articulos</h2>';
	echo '<table  class="tabla_ver">';
	foreach ($precio_articulo as $a){
		echo '<tr>';
		echo '<th>'.$a['articulo'].'</th>';
		echo '<td>';
		echo 'Bs. '.number_format($a['precio'], 0, ',', '.');
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
	}
	echo '</table>';
?>
<?php 
	echo '<h2>Precios de materias prima</h2>';
	echo '<table  class="tabla_ver">';
	foreach ($precio_materia as $mp){
		echo '<tr>';
		echo '<th>'.$mp['materia'].'</th>';
		echo '<td>';
		echo 'Bs. '.number_format($mp['precio'],'0', ',', '.');
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
	}
	echo '</table>';
?>
</div>

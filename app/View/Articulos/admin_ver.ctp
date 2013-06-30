<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'));
?>
<h1>Artículo</h1>
<?php 
	echo '<table  class="tabla_ver">';
	echo '<tr>';
	echo '<th>Imagen</th>';
	echo '<td>';
	echo $this->Html->image('articulos/'.$articulo['Articulo']['imagen'],array('width'=>'100px'));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Articulo</th>';
	echo '<td>';
	echo $articulo['Articulo']['descripcion'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Código</th>';
	echo '<td>';
	echo $articulo['Articulo']['codigo'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Cantidad por cajas</th>';
	echo '<td>';
	echo $articulo['Articulo']['cantidad_por_caja'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Oculto</th>';
	echo '<td>';
	if ($articulo['Articulo']['oculto'] == 1){
		$oculto = 'Si';
	} else {
		$oculto = 'No';
	}
	echo $oculto;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Subcategoria</th>';
	echo '<td>';
	echo $articulo['Subcategoria']['descripcion'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Materias prima</th>';
	echo '<td>';
	foreach ($articulo['Materiasprima'] as $m){
		echo $m['descripcion'].' cantidad: '.$m['ArticulosMateriasprima']['cantidad'].'<br>';
	}
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Costo de producción</th>';
	echo '<td>';
	echo $articulo['Articulo']['costo_produccion'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Margen de ganancia</th>';
	echo '<td>';
	echo $articulo['Articulo']['margen_ganancia'];
	echo '</td>';
	echo '</tr>';
	echo '</table>';
?>
</div>

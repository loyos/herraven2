<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'));
?>
<h1>Artículos</h1>
<?php 
	if (!empty($articulos)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Artículo</th>
		<th>Categoria</th>
		<th>Subcategoria</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($articulos as $c) {
			echo '<tr>';
			echo '<td>'.$c['Articulo']['descripcion'].'</td>';
			echo '<td>'.$c['Subcategoria']['Categoria']['descripcion'].'</td>';
			echo '<td>'.$c['Subcategoria']['descripcion'].'</td>';
			echo '<td>'.$this->Html->link('Editar',array('action' => 'admin_editar',$c['Articulo']['id'])).'<br>'.$this->Html->link('Eliminar',array('action' => 'admin_eliminar',$c['Articulo']['id'])).'<br>'.$this->Html->link('Ver',array('action' => 'admin_ver',$c['Articulo']['id'])).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
?>
</div>
<div class="wrap">
<?php
echo $this->Html->link('<<Regresar',array('action' => 'subcategoria_articulo'));
echo '<br>';
echo $this->Html->link('Agregar',array('action' => 'admin_editar',$cat_id,null,$sub_id));
?>
<h1>Artículos</h1>
<?php 
echo '<b>Linea</b>: '.$linea['Categoria']['descripcion'].'<br>';
if (!empty($subcategoria['Subcategoria']['descripcion'])){
	echo '<b>Categoria</b>: '.$subcategoria['Subcategoria']['descripcion'].'<br>';
}
echo '<br>';
	if (!empty($articulos)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Código</th>
		<th>Linea</th>
		<th>Categoria</th>
		<th>Descripcion</th>
		<th>Precio Venta</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($articulos as $c) {
			echo '<tr>';
			echo '<td>'.$c['Articulo']['codigo'].'</td>';
			echo '<td>'.$c['Subcategoria']['Categoria']['descripcion'].'</td>';
			echo '<td>'.$c['Subcategoria']['descripcion'].'</td>';
			echo '<td>'.$c['Articulo']['descripcion'].'</td>';
			echo '<td style= "text-align: center;"> Bs. '. number_format($precio[$c['Articulo']['id']], 0, ',', '.').'</td>';
			echo '<td>'.$this->Html->link('Editar',array('action' => 'admin_editar',$cat_id,$c['Articulo']['id'],$sub_id)).'<br>'.$this->Html->link('Eliminar',array('action' => 'admin_eliminar',$c['Articulo']['id']),array(),'¿Estás seguro que deseas eliminar?').'<br>'.$this->Html->link('Ver',array('action' => 'admin_ver',$c['Articulo']['id'],$cat_id,$sub_id)).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
?>
</div>

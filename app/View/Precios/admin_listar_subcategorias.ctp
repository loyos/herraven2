<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'));
?>
<?php
foreach ($categorias as $cat) {
	echo '<div class="listado_categoria">';
		echo $this->Html->link($cat['Categoria']['descripcion'], array('action' => 'admin_ver',$id,$cat['Categoria']['id']));
	echo '</div>';
	echo '<br>';
	echo '<div class="listado_subcategoria">';
	foreach ($cat['Subcategoria'] as $sub) {	
		echo $this->Html->link($sub['descripcion'], array('action' => 'admin_ver',$cat['Categoria']['id'],$id,$sub['id']));
		echo '<br>';
	}
	echo '</div>';
	echo '<br>';
}

?>

</div>
<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'editar'));
?>
<h1>Subcategorias (Nota: en las imágenes sale "Categorias" pero me parece mas lógico que diga subcategorias, aqui también esta acabado, lo estoy colocando en otra vista distinta para tener mas orden, pero cualquier cosa se pasa para aca y ya)</h1>
<?php 
	if (!empty($subcategorias)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Oculto</th>
		<th>Categoria</th>
		<th>SubCategoria</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($subcategorias as $c) {
			echo '<tr>';
			echo '<td>';
			if ($c['Subcategoria']['oculto'] == 1){
				$value = 'Si';
			} else {
				$value = 'No';
			}
			echo $value;
			echo '</td>';
			echo '<td>'.$c['Categoria']['descripcion'].'</td>';
			echo '<td>'.$c['Subcategoria']['descripcion'].'</td>';
			echo '<td>'.$this->Html->link('Editar',array(
				'action' => 'editar',$c['Subcategoria']['id'])).'<br>';
			if ($eliminar_cat[$c['Subcategoria']['id']] == 0){
				echo $this->Html->link('Eliminar',array('action' => 'eliminar',$c['Subcategoria']['id'])).'<br>';
			}
			echo $this->Html->link('Ver',array('action' => 'ver',$c['Subcategoria']['id'])).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
?>
</div>


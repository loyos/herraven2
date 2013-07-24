<div class="wrap">
<?php 
	echo $this->element('search');
	if (!empty($articulos)){
	
		echo '<div class = "ejecutar">';
		echo $this->Form->create('Articulo', array(
				'url' => array('action' => 'admin_ver_forecast')
			));
		echo $this->Form->submit('Ejecutar', array('class' => 'button'));
		echo $this->Form->end;
		echo '</div>';
		?>
		<table>
			<tr>
			<th>Seleccionar</th>
			<th>Articulo</th>
			<th>Linea</th>
			<th>Categoria</th>
			<th>Cajas</th>
			<th>Acabado</th>
			</tr>
		<?php
		foreach ($articulos as $a){
			?>
			<tr>
				<td><?php echo $this->Form->input('seleccionar',array(
						'name' => 'cantidad['.$a['Articulo']['id'].']',
						'type' => 'checkbox',
						'label' => false,
					));?> 
				</td>
				<td><?php echo $a['Articulo']['descripcion'] ?></td>
				<td><?php echo $a['Subcategoria']['Categoria']['descripcion'] ?></td>
				<td><?php echo $a['Subcategoria']['descripcion'] ?></td>
				<td><?php echo $this->Form->input('cajas',array(
						'name' => 'cajas['.$a['Articulo']['id'].']',
						'label' => false,
					));?> 
				</td>
				<td><?php 
					if (!empty($acabados[$a['Articulo']['id']])){
						echo $this->Form->input('acabado_id',array(
							'name' => 'acabados['.$a['Articulo']['id'].']',
							'type' => 'select',
							'label' => false,
							'options' => $acabados[$a['Articulo']['id']]
						));
					} else {
						echo 'No hay acabados asociados';
					}
					?> 
				</td>
			</tr>
			<?php
		}
	} 
?>
</div>
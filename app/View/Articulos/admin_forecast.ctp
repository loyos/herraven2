<div class="wrap">
<?php 
	if (!empty($articulos)){
		echo $this->Form->create('Articulo');
		echo $this->Form->submit('Ejecutar', array('class' => 'button'));
		echo $this->Form->end;
		?>
		<table>
			<tr>
			<th>Seleccionar</th>
			<th>Articulo</th>
			<th>Categoria</th>
			<th>Subcategoria</th>
			<th>Cajas</th>
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
			</tr>
			<?php
		}
	} elseif (!empty($articulos_mp)) {
		echo $this->Html->link('Regresar',array('action' => 'admin_forecast'));
		foreach ($articulos_mp as $a_mp) {
			?>
			<h2><?php echo $a_mp[0]['Articulo'].' Num de cajas'.$a_mp[0]['cajas'];?></h2>
			<table>
			<tr>
				<th>Materia prima</th>
				<th>Cantidad necesitada</th>
			</tr>
			<?php
			foreach ($a_mp as $a) {
				?>
				<tr>
					<td><?php echo $a['Materiasprima'] ?></td>
					<td><?php echo $a['cantidad'] ?></td>
				</tr>
				<?php
			}
			?>
			</table>
			<?php
		}
	}
?>
</div>
<div class="wrap">
<div class="categoria_catalogo">
	<?php echo $this->Html->link($subcategoria['Categoria']['descripcion'],array('action' => 'subcategoria_catalogo')); ?>
</div>
<div class= "subcategoria_catalogo">
	<?php echo $subcategoria['Subcategoria']['descripcion'] ?>
</div>
<?php
echo $this->Form->create('Pedido');
if (!empty($info_articulos)) {
foreach ($info_articulos as $a) { ?>
<div class="articulo_catalogo">
	<div class="imagen_catalogo">
		<?php echo $this->Html->image('articulos/'.$a['imagen'],array('height' => '120px;'));?>
	</div>
	<div class="info_catalogo">
		<table>
			<tr>
				<td>				
					Bs. <?php echo number_format($a['precio'], 0, ',', '.') ?>
					<br>
					Precio unitario
				</td>
				<td></td>
				<td>
					<?php
					echo '<b>' .$a['codigo']. '</b><br>';					
					
					echo $this->Form->input('cantidad',array(
						'type' => 'select',
						'options' => $cantidad_de_cajas,
						'name' => 'cantidad['.$a['id'].']'
					));
					//echo '<br>';
					echo $this->Form->input('acabado_id',array(
						'name' => 'acabado['.$a['id'].']'
					));
					?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo 'Bs. '. number_format($a['precio']*$a['cantidad_por_caja'], 0, ',', '.');
					echo '<br>';
					echo 'Precio de caja';
					
					?>
				</td>
				<td>
					<?php echo $a['cantidad_por_caja'];
					echo '<br>';
					echo 'Pz. caja';
					?>
				</td>
				<td>
					<?php
						echo $this->Form->input('activo',array(
							'value' => 0,
							'type' => 'hidden',
							'name' => 'activo['.$a['id'].']',
							'id' => $a['id'],
						));
						echo $this->Form->submit('Pedir',array('class' => 'button boton_catalogo', 'onclick' => 'activar('.$a['id'].')'));
						echo $this->Form->end();
						echo '<span class="descripcion_catalogo">' .$a['articulo']. '</span>';	
					?>
				</td>
			</tr>
		</table>
	</div>

</div>
<?php
} 
} else {
	echo "No hay artículos en esta categoria";
}
?>
</div>
<script>
	function activar(id){
		val = $('input#'+id).val('1');
	}
</script>
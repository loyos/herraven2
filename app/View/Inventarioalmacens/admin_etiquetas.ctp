<div class="wrap">
	<?php
	//echo $this->Html->link('Imprimir',array_merge($this->params['pass'], array('print')), array('target' => uniqid(), 'class' => 'print'));
	foreach ($cajas as $a) {
		echo '<div class="etiqueta">';
		?>
		<table style="width:100%">
			<tr>
				<td style="width:200px"><?php echo $this->Html->image('logo.jpg', array('width' => '100px','height' => '100px'))?></td>
				<td style="text-align:right">
				<?php
				echo '<div class="codigo_caja">';
				echo $a['Caja']['codigo'];
				echo '</div>';
				echo $a['Inventarioalmacen']['fecha'];
				?>
				</td>
			</tr>
			<tr>
				<td>
					<?php
					echo '<div class="codigo_caja">';
					echo $a['Inventarioalmacen']['Articulo']['codigo'];
					echo '<br>';
					echo $a['Inventarioalmacen']['Acabado']['acabado'];
					echo '</div>';
					?>
				</td>
				<td  style="text-align:right">
					<?php 
					echo '<div class="codigo_caja">';
					echo $a['Inventarioalmacen']['Articulo']['cantidad_por_caja'].'Pz.';
					echo '</div>';
					?>
				</td>
			</tr>
		</table>
		<?php
		echo '</div>';
	}
	?>
</div>
<script>
  // $(document).ready(function() {
  // window.print()
// });
</script>
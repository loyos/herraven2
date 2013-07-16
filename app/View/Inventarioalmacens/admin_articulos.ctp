<div class="wrap">
	<?php
	if (!empty($articulos)) { 
		echo '<table style="margin-left:35px;">';
		$i = 1;
		foreach ($articulos as $a) {
			if ($i ==1 || ($i-1)%2 == 0 ){
				echo '<tr>';
			}
		?>
		<td style="width:420px;">
			<table>
				<tr>
					<td><?php echo $this->Html->image('articulos/'.$a['Articulo']['imagen'],array('width' => '150px')); ?></td>
					<td style="text-align:center">
						<span style="font-weight:bold"><?php echo $a['Articulo']['descripcion']; ?></span>
						<br>
						<span style="font-weight:bold"><?php echo $a['Articulo']['codigo']; ?></span>
						<br>
						<?php echo $a['Articulo']['cantidad_por_caja'].' pz'; ?>
						<br>
						<?php echo $this->Html->link('Ingreso',array('action' => 'admin_ingresar',$a['Articulo']['id']));?>
					</td>
				</tr>
			</table>
		</td>
		<?php	
			if ($i%2 == 0 ){
				echo '</tr>';
			}
			$i++;
		}
		echo '</table>';
	}
	?>
</div>
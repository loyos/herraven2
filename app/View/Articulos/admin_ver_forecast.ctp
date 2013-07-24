<div class="wrap">
<?php 
if (!empty($articulos_mp)) {
		echo $this->Html->link('Regresar',array('action' => 'admin_forecast'));
		foreach ($articulos_mp as $a_mp) {
			?>
			<h2><?php echo $a_mp[0]['Articulo'].' Num de cajas: '.$a_mp[0]['cajas'];?></h2>
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
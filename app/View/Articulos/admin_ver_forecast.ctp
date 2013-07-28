<div class="wrap">
<?php 
if (!empty($articulos_mp)) {
		echo $this->Html->link('Regresar',array('action' => 'admin_forecast'));
		foreach ($articulos_mp as $a_mp) {
			?>
			<h2><?php echo $a_mp[0]['Articulo'].'  '.$a_mp[0]['acabado'].'  '.$a_mp[0]['cajas'].'cajas  '.$a_mp[0]['piezas'],'pz';?></h2>
			<table>
			<?php
			foreach ($a_mp as $a) {
				?>
				<tr>
					<td><?php echo $a['Materiasprima'] ?></td>
					<td><?php echo $a['cantidad'].$a['unidad'] ?></td>
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
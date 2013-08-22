<div class="wrap">
<?php 
echo '<h1>Forecast</h1>';
if (!empty($articulos_mp)) {
		echo $this->Html->link('Regresar',array('action' => 'admin_forecast'));
		echo '<br>';
		echo $this->Form->button('Ver pdf',array('onclick' => 'window.print()', 'class' => 'link'));
		foreach ($articulos_mp as $a_mp) {
			?>
			<h2><?php echo $a_mp[0]['Articulo'].'  '.$a_mp[0]['acabado'].'  '.$a_mp[0]['cajas'].'cajas  '.$a_mp[0]['piezas'],'pz';?></h2>
			<table>
			<?php
			foreach ($a_mp as $a) {
				?>
				<tr>
					<td><?php echo $a['Materiasprima'] ?></td>
					<td><?php echo number_format($a['cantidad'],2,',','.').' '.$a['unidad'] ?></td>
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
<script>
  function imprimir() {
  window.print()
});
</script>
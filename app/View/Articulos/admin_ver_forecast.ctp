<div class="wrap">
<?php 
echo '<div style="float:left">';
echo $this->Html->link('Regresar',array('action' => 'admin_forecast'));
echo '</div>';
echo '<div style="float:right">';
echo $this->Form->button('Ver reporte',array('onclick' => 'window.print()', 'class' => 'link'));
echo '</div>';
echo '<h1>Forecast</h1>';
if (!empty($articulos_mp)) {
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
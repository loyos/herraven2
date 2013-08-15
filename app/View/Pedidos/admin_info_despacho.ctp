<div class="wrap">
	<?php
	echo '<div>';
	echo $this->Html->link($this->Html->image('imprimir.jpg'),array(''.$pedido['Pedido']['id']), array('onclick' => 'window.print()', 'escape' => false));
	echo $this->Html->link('Finalizar',array('action' => 'admin_pedidos'));
	echo '</div>';
	echo '<div class="etiqueta" style="min-width:385px; max-height:100%">';
		echo '<div class="fecha_etiqueta">';
		echo $hoy;
		echo '</div>';
		echo '<div class="info_egreso">';
		echo '<span style="font-size:20px">';
		echo 'Cliente: '.$pedido['Cliente']['denominacion_legal'];
		echo '<br>';
		echo 'Pedido: '.$pedido['Pedido']['num_pedido'];
		echo '<br>';
		echo 'Nº de Factura: '.$pedido['Pedido']['factura'];
		echo '</span>';
		echo '<br><br>';
		echo $pedido['Articulo']['codigo'].' ';
		if (!empty($pedido['Acabado']['acabado'])) {
			echo $pedido['Acabado']['acabado'];
		}
		echo '<br>';
		echo $pedido['Pedido']['cantidad_cajas'].'caja(s) / '. $pedido['Pedido']['cantidad_cajas']* $pedido['Articulo']['cantidad_por_caja'].' pz.';
		echo '<br><br><br><br><br>';
		echo 'Retirado por:';
		echo '<HR width=70% align="center" style="margin-left:80px;">';
		echo '</div>';
	echo '</div>';
	?>
</div>
<script>
  function imprimir() {
  window.print()
});
</script>
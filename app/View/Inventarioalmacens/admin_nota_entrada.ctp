<div class="wrap">
<?php
	echo $this->Html->link($this->Html->image('imprimir.jpg'),array(''.$cajas[0]['Inventarioalmacen']['id']), array('onclick' => 'window.print()', 'escape' => false));
	echo $this->Html->link('Finalizar',array('action' => 'admin_agregar'));
?>
<div class="logo_izquierdo">
	<?php echo $this->Html->image('logo-herraven.jpg',array('width'=>'120px'))?>
</div>
<div class="titulo_nota" style="width:263px">
	ENTRADA AL ALMACÉN
</div>
<div class="info1_nota">
	<div class="info1_izquierda">
		<?php echo '<span class="titulos_notas_grandes">ENTRADA Nº:</span> '.$cajas[0]['Inventarioalmacen']['numero']; ?>
		<br>
		<?php echo '<span class="titulos_notas_grandes">FECHA Y HORA:</span> '.$hoy; ?>
	</div>
</div>
<br><br>
<div class="datos_nota" style="margin-top:70px">
	<table border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;">
		<tr>
			<th>ARTICULO</th>
			<th>Nº DE CAJAS</th>
			<th>CANT. POR CAJA</th>
			<th>CANTIDAD TOTAL</th>
		</tr>
		<tr>
			<td><?php
			$numero_cajas = count($cajas);
			echo $cajas[0]['Inventarioalmacen']['Articulo']['codigo'];
			if (!empty($cajas[0]['Inventarioalmacen']['Acabado']['acabado'])) {
				echo ' '.$cajas[0]['Inventarioalmacen']['Acabado']['acabado'];
			}
			?>
			</td>
			<td>
			<?php echo $numero_cajas; ?>
			</td>
			<td>
			<?php echo $cajas[0]['Inventarioalmacen']['Articulo']['cantidad_por_caja']?>
			</td>
			<td>
			<?php echo $numero_cajas* $cajas[0]['Inventarioalmacen']['Articulo']['cantidad_por_caja']?>
			</td>
		</tr>
	</table>
	<br><br><b>Cod.Cajas:</b><br>
	<table border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;">
		<?php
			$i = 0;
			foreach ($cajas as $caja) {
				if ($i == 0 || $i+1 % 5 == 0) {
					echo '<tr>';
				}
				echo '<td style="padding:5px;">'.$caja['Caja']['codigo'].'</td>';
				if (($i+1)% 5 == 0) {
					echo '</tr>';
				}
				$i++;
			}
		?>
	</table>
</div>
<div class="footer_nota_despacho">
	Recibido por: <br><br><br>
	<?php echo'<HR width=30% style="margin-left:0px;">';?>
	<br><br>
	<div class="footer_nota">
	HERRAJES Y ACCESORIOS HERRAVEN, S.A. J-30800588-6
	<BR>
	Calle 2, Zona Industrial, Edificio Maury, piso PB, local B, Urbanización Palo Verde, Estado Miranda
	<br>
	Telefax: +58-212-761-40-62
	</div>
</div>
	<?php
	//var_dump($pedido);
	// echo '<div>';
	// echo $this->Html->link($this->Html->image('imprimir.jpg'),array(''.$pedido['Pedido']['id']), array('onclick' => 'window.print()', 'escape' => false));
	// echo $this->Html->link('Finalizar',array('action' => 'admin_pedidos'));
	// echo '</div>';
	// echo '<div class="etiqueta" style="min-width:385px; max-height:100%">';
		// echo '<div class="fecha_etiqueta">';
		// echo $hoy;
		// echo '</div>';
		// echo '<div class="info_egreso">';
		// echo '<span style="font-size:20px">';
		// echo 'Cliente: '.$pedido['Cliente']['denominacion_legal'];
		// echo '<br>';
		// echo 'Pedido: '.$pedido['Pedido']['num_pedido'];
		// echo '<br>';
		// echo 'Nº de Factura: '.$pedido['Pedido']['factura'];
		// echo '</span>';
		// echo '<br><br>';
		// echo $pedido['Articulo']['codigo'].' ';
		// if (!empty($pedido['Acabado']['acabado'])) {
			// echo $pedido['Acabado']['acabado'];
		// }
		// echo '<br>';
		// echo $pedido['Pedido']['cantidad_cajas'].'caja(s) / '. $pedido['Pedido']['cantidad_cajas']* $pedido['Articulo']['cantidad_por_caja'].' pz.';
		// echo '<br><br><br><br><br>';
		// echo 'Retirado por:';
		// echo '<HR width=70% align="center" style="margin-left:80px;">';
		// echo '</div>';
	// echo '</div>';
	?>
</div>
<script>
  function imprimir() {
  window.print()
});
</script>
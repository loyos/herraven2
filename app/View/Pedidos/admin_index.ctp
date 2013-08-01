<div class="wrap">
<h2>Pedidos</h2>
<?php if (!empty($pedidos)) { ?>
	<table>
		<tr>
			<th></th>
			<th>Fecha</th>
			<th>Nº de Pedido</th>
			<th>Cliente</th>
			<th>Articulo</th>
			<th>Acabado</th>
			<th>Cajas</th>
			<th>Cantidad</th>
			<th>Estatus</th>
		</tr>
		<?php foreach ($pedidos as $p) { ?>
			<tr>
				<td><?php if ($status[$p['Pedido']['id']] == 'Disponible') {
					echo $this->Html->link('Ejecutar',array('action' => 'admin_ejecutar_pedido',$p['Pedido']['id']));
				} ?></td>
				<td><?php echo $p['Pedido']['fecha'] ?></td>
				<td><?php echo $p['Pedido']['num_pedido'] ?></td>
				<td><?php echo $p['Cliente']['denominacion_legal'] ?></td>
				<td><?php echo $p['Articulo']['codigo'] ?></td>
				<td><?php echo $p['Acabado']['acabado'] ?></td>
				<td><?php echo $p['Pedido']['cantidad_cajas'] ?></td>
				<td><?php echo $p['Pedido']['cantidad_cajas'] * $p['Articulo']['cantidad_por_caja'] ?></td>
				<td><?php echo $status[$p['Pedido']['id']] ?></td>
			</tr>
		<?php } ?>
	</table>
<?php }?>
</div>

<div class="wrap">
<h2>Pedidos</h2>
<?php if (!empty($pedidos)) { ?>
	<table>
		<tr>
			<th></th>
			<th>Fecha</th>
			<th>Nº de Pedido</th>
			<th>Factura</th>
			<th>Cliente</th>
			<th>Articulo</th>
			<th>Acabado</th>
			<th>Cajas</th>
			<th>Cantidad</th>
			<th>Estatus</th>
		</tr>
		<?php foreach ($pedidos as $p) { 
				if(!empty($status[$p['Pedido']['id']])) { ?>
				<tr>
					<td><?php if ($status[$p['Pedido']['id']] == 'En progreso') {
						echo $this->Html->link('Ejecutar',array('action' => 'admin_pedido_terminado',$p['Pedido']['id']));
					} ?></td>
					<td><?php $fecha = explode(' ',$p['Pedido']['fecha']);echo $fecha[0]; ?></td>
					<td><?php echo $p['Pedido']['num_pedido'] ?></td>
					<td><?php echo $p['Pedido']['factura'] ?></td>
					<td><?php echo $p['Cliente']['denominacion_legal'] ?></td>
					<td><?php echo $p['Articulo']['codigo'] ?></td>
					<td><?php echo $p['Acabado']['acabado'] ?></td>
					<td><?php echo $p['Pedido']['cantidad_cajas'] ?></td>
					<td><?php echo $p['Pedido']['cantidad_cajas'] * $p['Articulo']['cantidad_por_caja'] ?></td>
					<td><?php echo $status[$p['Pedido']['id']] ?></td>
				</tr>
		<?php   } 
			}?>
	</table>
<?php }?>
</div>

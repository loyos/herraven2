<div class="wrap">

<?php echo $this->element('search_pedidos'); ?>

<h2>Pedidos</h2>

<?php if (!empty($pedidos)) { ?>
	<table width= '100%'>
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
				<td>
				<?php 
				if ($status[$p['Pedido']['id']] != 'Despachado') {
					echo $this->Html->link('Cancelar/',array('action' => 'admin_cancelar',$p['Pedido']['id'],'admin_pedidos'));
					echo $this->Html->link('Eliminar',array('action' => 'admin_eliminar',$p['Pedido']['id'],'admin_pedidos'));
				}
				if ($status[$p['Pedido']['id']] == 'Preparado') {
					echo '<br>'.$this->Html->link('/Ejecutar',array('action' => 'admin_ejecutar_despacho',$p['Pedido']['id']));
				} 
				if ($status[$p['Pedido']['id']] == 'Progreso-Despacho') {
					echo '<br>';
					echo $this->Html->link('Ejecutar despacho',array('action' => 'admin_pedido_terminado',$p['Pedido']['id']));
				}
				?></td>
				<td><?php $fecha = explode(' ',$p['Pedido']['fecha']);echo $fecha[0]; ?></td>
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
<?php } else {
	echo '<h2>No hay pedidos registrados</h2>';
	}?>
</div>

<div class="wrap">
<?php 
echo $this->Html->link('<<Regresar',array('action' => 'admin_inventario'));
echo '<br>Nota: los códigos en rojo son las cajas que todavia están en el almacén<br>';
?>
<div class="info_izquierda">
	<table>
		<tr>
			<th>Número de cajas</th>
			<th>Artículo</th>
			<th>Acabado</th>
			<th>Pz. por caja</th>
		</tr>
		<tr>
			<td><?php echo $num_cajas ?></td>
			<td><?php echo $articulo['Articulo']['codigo'] ?></td>
			<?php if (!empty($acabado['Acabado']['acabado'])) { ?>
			<td><?php echo $acabado['Acabado']['acabado'] ?></td>
			<?php } else { ?>
				<td>Sin acabado</td>
			<?php }?>
			<td><?php echo $articulo['Articulo']['cantidad_por_caja'] ?></td>
		</tr>
	</table>
</div>
<?php
echo '<br><br>';
echo '<table class="consulta_cajas">';
echo '<tr>';
echo '<th>Número</th>';
echo '<th>Fecha de ingreso</th>';
echo '<th>Código</th>';
echo '</tr>';
$count = 1;
foreach ($cajas as $c){
	echo '<tr>';
	echo '<td>'.$count.'</td>';
	echo '<td>'.$c['Inventarioalmacen']['fecha'].'</td>';
	if (empty($c['Pedido'])){
		echo '<td style="font-weight:bold; color:red;">'.$c['Caja']['codigo'].'</td>';
	} else{
		echo '<td style="font-weight:bold">'.$c['Caja']['codigo'].'</td>';
	}
	echo '</tr>';
	$count++;
}
?>
</div>
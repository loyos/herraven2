<div class="wrap">
<?php 
echo $this->Html->link('<<Regresar',array('action' => 'admin_inventario'));
echo '<table>';
echo '<tr>';
echo '<th>Código de cajas</th>';
echo '</tr>';
foreach ($cajas as $c){
	if (empty($c['Pedido'])){
		echo '<tr>';
		echo '<td>'.$c['Caja']['codigo'].'</td>';
		echo '</tr>';
	}
}
?>
</div>
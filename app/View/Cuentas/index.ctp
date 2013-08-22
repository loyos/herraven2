<div class="wrap">
<h1>Cuentas</h1>
<?php 
	if (!empty($cuentas)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Fecha</th>
		<th>Nº de pedido</th>
		<th>Nº de Factura</th>
		<th>Monto total</th>
		<th>Monto abonado</th>
		<th>Monto restante</th>
		<th>Status</th>
		</tr>
		<?php
		foreach($cuentas as $c) {
			echo '<tr>';
			if(!empty($c['Cuenta']['deposito'])){
				$saldo = $c['Pedido']['cuenta']-$c['Cuenta']['deposito'];
			} else {
				$saldo = $c['Pedido']['cuenta'];
			}
			$fecha = explode(' ',$c['Pedido']['fecha']);
			echo '<td>'.$fecha[0].'</td>';
			echo '<td>'.$c['Pedido']['num_pedido'].'</td>';
			echo '<td>'.$c['Pedido']['factura'].'</td>';
			echo '<td>'.$this->Herra->format_number($c['Pedido']['cuenta']).'</td>';
			$abono = $c['Pedido']['cuenta']-$saldo;
			echo '<td>'.$this->Herra->format_number($abono).'</td>';
			echo '<td>'.$this->Herra->format_number($saldo).'</td>';
			echo '<td>'.$c['Cuenta']['status'].'</td>';
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo 'No hay cuentas pendientes';
	}
?>
</div>

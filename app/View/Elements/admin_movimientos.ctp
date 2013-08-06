<?php
if (!empty($entradas)) {
	?>
	<br>
	<table class="tabla_index" style="clear: left;">
	<tr>
	<th>Trimestre</th>
	<th>Saldo incial</th>
	<th>Total entradas</th>
	<th>Total salidas</th>
	<th>Saldo al cierre</th>
	<th>Acciones</th>
	</tr>
	<?php
	foreach($entradas as $key => $m) {
		if (!empty($m[0]['SUM(`Inventariomaterial`.`cantidad`)'])) {
			$entrada = $m[0]['SUM(`Inventariomaterial`.`cantidad`)'];
		} else {
			$entrada = 0;
		}
		if (!empty($salidas[$key][0]['SUM(`Inventariomaterial`.`cantidad`)'])) {
			$salida = $salidas[$key][0]['SUM(`Inventariomaterial`.`cantidad`)'];
		} else {
			$salida = 0;
		}
		if (!empty($entradas[$key-1])) {
			
			if (!empty($entradas[$key-1][0]['SUM(`Inventariomaterial`.`cantidad`)'])) {
				$e_inicial = $entradas[$key-1][0]['SUM(`Inventariomaterial`.`cantidad`)'];
			} else {
				$e_inicial = 0;
			}
			if (!empty($salidas[$key-1][0]['SUM(`Inventariomaterial`.`cantidad`)'])) {
				$s_inicial = $salidas[$key-1][0]['SUM(`Inventariomaterial`.`cantidad`)'];
			} else {
				$s_inicial = 0;
			}
			$saldo_inicial = floatval($e_inicial)-floatval($s_inicial);
		} else {
			$saldo_inicial = 'Sin registrar';
		}
		if ($m['Inventariomaterial']['trimestre'] == $trimestre) {
			$saldo = $entrada-$salida;
			$saldo = $saldo.' (Trimestre en curso)';
		}
		$saldo = $entrada-$salida;
		echo '<tr>';
		echo '<td>'.$m['Inventariomaterial']['trimestre'].'</td>';
		echo '<td>'.$saldo_inicial.'</td>';
		echo '<td>'.$entrada.'</td>';
		echo '<td>'.$salida.'</td>';
		echo '<td>'.$saldo.'</td>';
		echo '<td>'.$this->Html->link('Consultar',array('action' => 'admin_consultar_movimientos',$entradas[0]['Materiasprima']['descripcion'],$m['Inventariomaterial']['trimestre'],$ano)).'</td>';
		echo '</tr>';
	}
	echo '</table>';
} else {
	echo 'No hay movimientos registrados';
}
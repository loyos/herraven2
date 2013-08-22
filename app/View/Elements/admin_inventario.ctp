<table class="tabla_index">
	<tr>
	<th>Nombre</th>
	<th>Unidad</th>
	<th>Total entradas</th>
	<th>Total salidas</th>
	<th>Saldo</th>
	</tr>
	<?php
	foreach($materiasprima as $m) {
		if (!empty( $entradas_materia[$m['Materiasprima']['id']][0][0]['SUM(`Inventariomaterial`.`cantidad`)'])) {
			$entrada1 = $entradas_materia[$m['Materiasprima']['id']][0][0]['SUM(`Inventariomaterial`.`cantidad`)'] ;
			$entrada = number_format($entrada1,2,',','.');
		} else {
			$entrada1 = 0;
			$entrada = 0;
		}
		if (!empty($salidas_materia[$m['Materiasprima']['id']][0][0]['SUM(`Inventariomaterial`.`cantidad`)'])){
			$salida1 = $salidas_materia[$m['Materiasprima']['id']][0][0]['SUM(`Inventariomaterial`.`cantidad`)'];
			$salida = number_format($salida1,2,',','.');
		} else {
			$salida1 = 0;
			$salida = 0;
		}
		$saldo = $entrada1 -$salida1;
		$saldo = number_format($saldo,2,',','.');
		echo '<tr>';
		echo '<td>'.$m['Materiasprima']['descripcion'].'</td>';
		echo '<td>'.$m['Materiasprima']['unidad'].'</td>';
		echo '<td>'.$entrada.'</td>';
		echo '<td>'.$salida.'</td>';
		echo '<td>'.$saldo.'</td>';
		echo '</tr>';
	}
	echo '</table>';
	?>
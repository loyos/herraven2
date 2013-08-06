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
			$entrada = $entradas_materia[$m['Materiasprima']['id']][0][0]['SUM(`Inventariomaterial`.`cantidad`)'] ;
		} else {
			$entrada = 0;
		}
		if (!empty($salidas_materia[$m['Materiasprima']['id']][0][0]['SUM(`Inventariomaterial`.`cantidad`)'])){
			$salida = $salidas_materia[$m['Materiasprima']['id']][0][0]['SUM(`Inventariomaterial`.`cantidad`)'];
		} else {
			$salida = 0;
		}
		$saldo = $entrada -$salida;
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
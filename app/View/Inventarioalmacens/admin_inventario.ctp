<div class="wrap">
<h1>Inventario Almacén</h1>
<?php 
	if (!empty($articulos)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Articulo</th>
		<th>Acabado</th>
		<th>Total entradas (cajas)</th>
		<th>Total salidas (cajas)</th>
		<th>Saldo</th>
		</tr>
		<?php
		foreach($entradas_articulo as $key => $articulo) {
			foreach ($articulo as $a){
				if (!empty($a[0]['SUM(`Inventarioalmacen`.`cajas`)'])) {
					$entrada = $a[0]['SUM(`Inventarioalmacen`.`cajas`)'];
				} else {
					$entrada = 0;
				}
				$salida = 0;
				if (!empty($salidas_articulo[$key])) {
					foreach ($salidas_articulo[$key] as $s) {
						if ($s['Inventarioalmacen']['acabado_id'] == $a['Inventarioalmacen']['acabado_id']){
							if (!empty($s[0]['SUM(`Inventarioalmacen`.`cajas`)'])){
								$salida =  $s[0]['SUM(`Inventarioalmacen`.`cajas`)'];
							}
						}			
					}
				}
				$saldo = $entrada -$salida;
				echo '<tr>';
				echo '<td>'.$key.'</td>';
				echo '<td>'.$a['Acabado']['acabado'].'</td>';
				echo '<td>'.$entrada.'</td>';
				echo '<td>'.$salida.'</td>';
				echo '<td>'.$saldo.'</td>';
				echo '</tr>';
			}
		}
		echo '</table>';
	}
?>
</div>
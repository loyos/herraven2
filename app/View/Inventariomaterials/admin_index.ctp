<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'));
?>
<h1>Inventario Materias prima</h1>
<?php 
	if (!empty($info)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Año</th>
		<th>Trimestre</th>
		<th>Nombre</th>
		<th>Unidad</th>
		<th>Total entradas</th>
		<th>Total salidas</th>
		<th>Saldo</th>
		</tr>
		<?php
		foreach($info as $m) {
			echo '<tr>';
			echo '<td>'.$m['ano'].'</td>';
			echo '<td>'.$m['trimestre'].'</td>';
			echo '<td>'.$m['materia'].'</td>';
			echo '<td>'.$m['unidad'].'</td>';
			echo '<td>'.$m['entradas'].'</td>';
			echo '<td>'.$m['salidas'].'</td>';
			echo '<td>'.$m['saldo'].'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
?>
</div>

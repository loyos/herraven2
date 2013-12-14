<h1>División</h1>
<?php
echo '<table style="text-align:left;">';
	echo '<tr>';
		echo '<th>División</th>';
		echo '<td>'.$division['Division']['numero'].'</td>';
	echo '</tr>'; 
	echo '<tr>';
		echo '<th>Nombre</th>';
		echo '<td>'.$division['Division']['nombre'].'</td>';
	echo '</tr>'; 
	echo '<tr>';
		echo '<th>Gerente divisional</th>';
		echo '<td>'.$division['User']['nombre'].' '.$division['User']['apellido'].'</td>';
	echo '</tr>'; 
	echo '<tr>';
		echo '<th>Unidades</th>';
		echo '<td>'.$sum_unidades.'</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<th>Personal</th>';
		echo '<td>'.$personal.'</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<th>Descripcion</th>';
		echo '<td>'.$division['Division']['descripcion'].'</td>';
	echo '</tr>';
echo '</table>';
echo '<br><br>';
//Tabla departamentos
if (!empty($departamentos)) {
	echo '<table  class="tabla_index">';
	echo '<tr>';
	echo '<th>Departamento</th>';
	echo '<th>Nombre</th>';
	echo '<th>Jefe departamental</th>';
	echo '</tr>';
	foreach ($departamentos as $d){
		echo '<tr>';
		echo '<td>';
		echo $d['Departamento']['numero'];
		echo '</td>';
		echo '<td>';
		echo $d['Departamento']['nombre'];
		echo '</td>';
		echo '<td>';
		echo $d['User']['nombre'].' '.$d['User']['apellido'];
		echo '</td>';
		echo '</tr>';
	}
	echo '</table>';
	echo '<br><br>';
	foreach ($departamentos as $d) {
		echo '<table  class="tabla_index">';
		echo '<tr>';
		echo '<th>Departamento</th>';
		echo '<th>Unidad</th>';
		echo '<th>Nombre</th>';
		echo '<th>Jefe Unidad</th>';
		echo '</tr>';
		foreach ($d['Unidad'] as $u) {
				echo '<tr>';
				echo '<td>';
				echo $d['Departamento']['numero'];
				echo '</td>';
				echo '<td>';
				echo $u['numero'];
				echo '</td>';
				echo '<td>';
				echo $u['nombre'];
				echo '</td>';
				echo '<td>';
				echo $u['User']['nombre'].' '.$u['User']['apellido'];
				echo '</td>';
				echo '</tr>';
		}
		echo '</table>';
		echo '<br><br>';
		foreach ($d['Unidad'] as $u) {
				echo '<table  class="tabla_index">';
				echo '<tr>';
				echo '<th>Unidad</th>';
				echo '<th>Jefe Unidad</th>';
				echo '<th>Miembros</th>';
				echo '<th>Puesto</th>';
				echo '</tr>';
				foreach ($u['Miembro'] as $m) {
						echo '<tr>';
						echo '<td>';
						echo $u['numero'];
						echo '</td>';
						echo '<td>';
						echo $u['User']['nombre'].' '.$u['User']['apellido'];
						echo '</td>';
						echo '<td>';
						echo $m['User']['nombre'].' '.$m['User']['apellido'];
						echo '</td>';
						echo '<td>';
						echo $m['puesto'];
						echo '</td>';
						echo '</tr>';
				}
				echo '</table>';
				echo '<br><br>';
		}
	}
}
?>
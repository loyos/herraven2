<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1>Miembro del Personal</h1>
<?php 
	echo '<table  class="tabla_ver">';
	echo '<tr>';
	echo '<th>Foto</th>';
	echo '<td>';
	echo $this->Html->image($miembro['User']['imagen'],array('width' => '100px'));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Username</th>';
	echo '<td>';
	echo $miembro['User']['username'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Nombre y apellido</th>';
	echo '<td>';
	echo $miembro['User']['nombre'].' '.$miembro['User']['apellido'];;	
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Email</th>';
	echo '<td>';
	echo $miembro['User']['email'];;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Fecha de nacimiento</th>';
	echo '<td>';
	$date = new DateTime($miembro['Miembro']['fecha_nacimiento']);
	echo $date->format('d-m-Y');
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Edad</th>';
	echo '<td>';
	echo $edad;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Telefono</th>';
	echo '<td>';
	echo $miembro['Miembro']['telefono'];
	if (!empty($miembro['Miembro']['celular'])) {
		echo ' / '.$miembro['Miembro']['celular'];
	}
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Dirección</th>';
	echo '<td>';
	echo $miembro['Miembro']['direccion'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Personas de contacto</th>';
	echo '<td>';
	echo $miembro['Miembro']['contacto1'];
	if (!empty($miembro['Miembro']['contacto2'])) {
		echo ' / '.$miembro['Miembro']['contacto2'];
	}
	if (!empty($miembro['Miembro']['contacto3'])) {
		echo ' / '.$miembro['Miembro']['contacto3'];
	}
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Fecha de ingreso</th>';
	echo '<td>';
	$date = new DateTime($miembro['Miembro']['fecha_ingreso']);
	echo $date->format('d-m-Y');
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Tiempo de trabajo</th>';
	echo '<td>';
	echo $tiempo_trabajo;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Puesto</th>';
	echo '<td>';
	echo $miembro['Miembro']['puesto'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Unidad</th>';
	echo '<td>';
	if (!empty($miembro['Miembro']['unidad_id'])) {
		echo $miembro['Unidad']['nombre'];
	} else {
		echo 'No asignada';
	}
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Departamento</th>';
	echo '<td>';
	if (!empty($miembro['Unidad']['departamento_id'])) {
		echo $miembro['Unidad']['Departamento']['nombre'];
	} else {
		echo 'No asignado';
	}
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>DIvisión</th>';
	echo '<td>';
	if (!empty($miembro['Unidad']['Departamento']['division_id'])) {
		echo $miembro['Unidad']['Departamento']['Division']['nombre'];
	} else {
		echo 'No asignada';
	}
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>IQ</th>';
	echo '<td>';
	echo $miembro['Miembro']['IQ'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Fecha del IQ test</th>';
	echo '<td>';
	$date = new DateTime($miembro['Miembro']['fecha_IQ']);
	echo $date->format('d-m-Y');
	echo '</td>';
	echo '</tr>';
	if (!empty($miembro['Miembro']['imagen_test'])){
		echo '<tr>';
		echo '<th>Imagen IQ test</th>';
		echo '<td>';
		echo $this->Html->image($miembro['User']['imagen_test'],array('width' => '100px'));
		echo '</td>';
		echo '</tr>';
	}
	echo '<tr>';
	echo '<th>Estudios</th>';
	echo '<td>';
	echo $miembro['Miembro']['estudios'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Anotaciones médicas</th>';
	echo '<td>';
	echo $miembro['Miembro']['anotaciones_medicas'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Observaciones</th>';
	echo '<td>';
	echo $miembro['Miembro']['observaciones'];
	echo '</td>';
	echo '</tr>';
	echo '</table>';
?>
</div>

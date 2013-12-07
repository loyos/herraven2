<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
?>
<h1>Miembros del Personal</h1>
<?php 
	if (!empty($miembros)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Nombre y Apellido</th>
		<th>Puesto</th>
		<th>Unidad</th>
		<th>Depto.</th>
		<th>Div.</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($miembros as $u) {
			echo '<tr>';
			echo '<td>'.$u['User']['nombre'].' '.$u['User']['apellido'].'</td>';
			echo '<td>'.$u['Miembro']['puesto'].'</td>';
			if (!empty($u['Unidad']['nombre'])) {
				$val = $u['Unidad']['nombre'];
			} else {
				$val = 'Unidad no asignada';
			}
			echo '<td>'.$val.'</td>';
			if (!empty($u['Unidad']['Departamento']['nombre'])) {
				$val = $u['Unidad']['Departamento']['nombre'];
			} else {
				$val = 'Departamento no asignado';
			}
			echo '<td>'.$val.'</td>';
			if (!empty($u['Unidad']['Departamento']['Division']['nombre'])) {
				$val = $u['Unidad']['Departamento']['Division']['nombre'];
			} else {
				$val = 'Division no asignada';
			}
			echo '<td>'.$val.'</td>';
			echo '<td>'.$this->Html->link('Editar',array(
				'action' => 'admin_editar',$u['Miembro']['id']),array('class'=>'boton_accion')).'<br>'.$this->Html->link('Eliminar',array('action' => 'admin_eliminar',$u['Miembro']['id']),array('class'=>'boton_accion'),'¿Estás seguro que deseas eliminar?').'<br>'.
				$this->Html->link('Ver',array('action' => 'admin_ver',$u['Miembro']['id']),array('class'=>'boton_accion')).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<h3>No hay personal registrado </h3>';
	}
?>
</div>

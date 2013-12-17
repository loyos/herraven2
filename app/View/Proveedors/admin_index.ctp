<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
?>
<h1>Proveedores</h1>
<?php 
	if (!empty($proveedores)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Denom. Legal</th>
		<th>Representante</th>
		<th>Telefono</th>
		<th>Email representante</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($proveedores as $u) {
			echo '<tr>';
			echo '<td>'.$u['Proveedor']['denominacion_legal'].'</td>';
			echo '<td>'.$u['Proveedor']['representante'].'</td>';
			echo '<td>'.$u['Proveedor']['telefono'].'</td>';
			echo '<td>'.$u['Proveedor']['email_representante'].'</td>';
			echo '<td style = "line-height: 21px;">'.$this->Html->link('Editar',array(
				'action' => 'admin_editar',$u['Proveedor']['id']),array('class'=>'boton_accion')).' '.$this->Html->link('Eliminar',array('action' => 'admin_eliminar',$u['Proveedor']['id']),array('class'=>'boton_accion'),'¿Estás seguro que deseas eliminar?').' '.$this->Html->link('Ver',array('action' => 'admin_ver',$u['Proveedor']['id']),array('class'=>'boton_accion')).'<br>'.$this->Html->link('Herramientas',array(
				'action' => 'admin_agregar_herramientas',$u['Proveedor']['id']),array('class'=>'boton_accion')).'<br>'.$this->Html->link('Insumos',array(
				'action' => 'admin_agregar_insumos',$u['Proveedor']['id']),array('class'=>'boton_accion')).'<br>'.$this->Html->link('Materia prima',array(
				'action' => 'admin_agregar_materiasprima',$u['Proveedor']['id']),array('class'=>'boton_accion')).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<h3>No hay proveedores registrados </h3>';
	}
?>
</div>

<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'editar'));
?>
<h1>Usuarios</h1>
<?php 
	if (!empty($usuarios)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Username</th>
		<th>Nombre y Apellido</th>
		<th>Email</th>
		<th>Rol</th>
		<th>Cliente</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($usuarios as $u) {
			echo '<tr>';
			echo '<td>'.$u['User']['username'].'</td>';
			echo '<td>'.$u['User']['nombre'].' '.$u['User']['apellido'].'</td>';
			echo '<td>'.$u['User']['email'].'</td>';
			echo '<td>'.$u['User']['rol'].'</td>';
			echo '<td>'.$u['Cliente']['denominacion_legal'].'</td>';
			echo '<td>'.$this->Html->link('Editar',array(
				'action' => 'editar',$u['User']['id'])).'<br>'.$this->Html->link('Eliminar',array('action' => 'eliminar',$u['User']['id'])).'<br>'.
				$this->Html->link('Ver',array('action' => 'ver',$u['User']['id'])).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
?>
</div>

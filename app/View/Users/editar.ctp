<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'index'));
?>
<h1><?php echo $titulo ?></h1>
<?php 
	echo $this->Form->create('User');
	echo '<table>';
	echo '<tr>';
	echo '<td>Usuario</td>';
	echo '<td>';
	echo $this->Form->input('username',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Contraseña</td>';
	echo '<td>';
	echo $this->Form->input('password',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Email</td>';
	echo '<td>';
	echo $this->Form->input('email',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Nombre</td>';
	echo '<td>';
	echo $this->Form->input('nombre',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Apellido</td>';
	echo '<td>';
	echo $this->Form->input('apellido',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Rol</td>';
	echo '<td>';
	echo $this->Form->input('rol',array(
		'label' => false,
		'type' => 'select',
		'options' => $roles,
		'id' => 'rol_usuario'
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<div id="div_roles">';
	echo '<div id="div_rol_admin" style="display:none">';
		echo '<table>';
		echo '<tr>';
		echo '<td>Admin usuario</td>';
		echo '<td>';
		echo $this->Form->input('admin_usuario',array(
			'type' => 'checkbox',
			'label' => false
		));
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Admin catálogo</td>';
		echo '<td>';
		echo $this->Form->input('admin_catalogo',array(
			'type' => 'checkbox',
			'label' => false
		));
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Admin materia prima</td>';
		echo '<td>';
		echo $this->Form->input('admin_materia_prima',array(
			'type' => 'checkbox',
			'label' => false
		));
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Admin almacén</td>';
		echo '<td>';
		echo $this->Form->input('admin_almacen',array(
			'type' => 'checkbox',
			'label' => false
		));
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Admin pedidos</td>';
		echo '<td>';
		echo $this->Form->input('admin_pedidos',array(
			'type' => 'checkbox',
			'label' => false
		));
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Admin materia prima</td>';
		echo '<td>';
		echo $this->Form->input('admin_despachos',array(
			'type' => 'checkbox',
			'label' => false
		));
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Admin almacebes clientes</td>';
		echo '<td>';
		echo $this->Form->input('admin_almacenes_clientes',array(
			'type' => 'checkbox',
			'label' => false
		));
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Admin reportes</td>';
		echo '<td>';
		echo $this->Form->input('admin_reportes',array(
			'type' => 'checkbox',
			'label' => false
		));
		echo '</td>';
		echo '</tr>';
		echo '</table>';
	echo '</div>';
	echo '<div id="div_rol_cliente">';
	echo '<table>';
	echo '<tr>';
		echo '<td>Cliente perfil</td>';
		echo '<td>';
		echo $this->Form->input('cliente_perfil',array(
			'type' => 'checkbox',
			'label' => false
		));
		echo '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>Cliente catálogo</td>';
		echo '<td>';
		echo $this->Form->input('cliente_catalogo',array(
			'type' => 'checkbox',
			'label' => false
		));
		echo '</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>Cliente almacén</td>';
		echo '<td>';
		echo $this->Form->input('cliente_almacen',array(
			'type' => 'checkbox',
			'label' => false
		));
		echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '</div>';
	echo '</div>';
	echo '<table>';
	echo '<tr>';
	echo '<td>Cliente</td>';
	echo '<td>';
	echo $this->Form->input('cliente_id',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	if (!empty($id)) {
		echo $this->Form->input('id',array('type'=>'hidden'));
	}
	echo $this->Form->submit('Agregar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>
<script>
funciones_rol();
$('#rol_usuario').change(function() {
  funciones_rol();
});
function funciones_rol() {
	rol = $('#rol_usuario').val();
	if (rol == 'admin') {
		$('#div_rol_cliente').css('display','none');
		$('#div_rol_admin').css('display','block');
	} else if (rol == 'cliente') {
		$('#div_rol_admin').css('display','none');
		$('#div_rol_cliente').css('display','block');
	}
}
</script>
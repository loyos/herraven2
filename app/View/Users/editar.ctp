<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'));
?>
<h1><?php echo $titulo ?></h1>
<div id="cambiar_pass" style="text-decoration:underline; cursor:pointer">
	Cambiar password
</div>
<?php 
	echo $this->Form->create('User',array('type' => 'file'));
	echo '<table>';
	echo '<tr>';
	echo '<td>Usuario</td>';
	echo '<td>';
	echo $this->Form->input('username',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<table id="password" style="display:none">';
	echo '<tr>';
	echo '<td>Contraseña vieja</td>';
	echo '<td>';
	echo $this->Form->input('password_old',array(
		'label' => false,
		'type' => 'password'
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Contraseña nueva</td>';
	echo '<td>';
	echo $this->Form->input('password_new',array(
		'label' => false,
		'type' => 'password'
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Confirmar contraseña</td>';
	echo '<td>';
	echo $this->Form->input('password_confirm',array(
		'label' => false,
		'type' => 'password'
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<table>';
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
	echo '<td>Imagen</td>';
	echo '<td>';
	echo $this->Form->input('Foto',array(
		'label' => false,
		'type' => 'file'
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
$('#cambiar_pass').click(function() {
  $('#password').toggle('slow', function() {
    // Animation complete.
  });
});
</script>
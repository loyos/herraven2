<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1><?php echo $titulo ?></h1>
<?php 
	echo $this->Form->create('Miembro',array('type' => 'file','onSubmit' => 'return checkSize();'));
	echo '<table>';
	echo '<tr>';
	echo '<td>Username</td>';
	echo '<td>';
	echo $this->Form->input('User.username',array(
		'label' => false
	));
	echo '</td>';
	if (empty($id)) {
		echo '<td>Contraseña</td>';
		echo '<td>';
		echo $this->Form->input('User.password',array(
			'label' => false
		));
		echo '</td>';
	} else {
		echo '<td></td><td></td>';
	}
	echo '</tr>';
	echo '<tr>';
	echo '<td>Nombre</td>';
	echo '<td>';
	echo $this->Form->input('User.nombre',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Apellido</td>';
	echo '<td>';
	echo $this->Form->input('User.apellido',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Email</td>';
	echo '<td>';
	echo $this->Form->input('User.email',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Foto</td>';
	echo '<td>';
	echo $this->Form->input('User.Foto',array(
		'label' => false,
		'type' => 'file',
		'id' =>'upload_imagen'
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Telefono</td>';
	echo '<td>';
	echo $this->Form->input('telefono',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Celular</td>';
	echo '<td>';
	echo $this->Form->input('celular',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Direccion</td>';
	echo '<td>';
	echo $this->Form->input('direccion',array(
		'label' => false,
	));
	echo '</td>';
	echo '<td>Estudios</td>';
	echo '<td>';
	echo $this->Form->input('estudios',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Contacto 1</td>';
	echo '<td>';
	echo $this->Form->input('contacto1',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Contacto 2</td>';
	echo '<td>';
	echo $this->Form->input('contacto2',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Puesto</td>';
	echo '<td>';
	echo $this->Form->input('puesto',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Fecha de nacimiento</td>';
	echo '<td>';
	echo $this->Form->input('fecha_nacimiento',array(
		'label' => false,
		'dateFormat' => 'DMY',
		'minYear' => date('Y') - 70,
		
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Fecha de ingreso</td>';
	echo '<td>';
	echo $this->Form->input('fecha_ingreso',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>IQ</td>';
	echo '<td>';
	echo $this->Form->input('IQ',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Fecha último IQ</td>';
	echo '<td>';
	echo $this->Form->input('fecha_IQ',array(
		'label' => false,
	));
	echo '</td>';
	echo '<td>Imagen IQ test</td>';
	echo '<td>';
	echo $this->Form->input('Test',array(
		'label' => false,
		'type' => 'file',
		'id' =>'upload_imagen'
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Anotaciones medicas</td>';
	echo '<td>';
	echo $this->Form->input('anotaciones_medicas',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Observaciones</td>';
	echo '<td>';
	echo $this->Form->input('observaciones',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	if (!empty($id)) {
		echo $this->Form->input('id',array('type'=>'hidden'));
	}
	if (!empty($user_id)) {
		echo $this->Form->input('User.id',array('type'=>'hidden','value'=>$user_id));
	}
	echo $this->Form->submit('Guardar', array('class' => 'button'));
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
		$('.cliente').css('display','none');
		$('.cliente_label').css('display','none');
		inputs = $('#div_rol_cliente input');
		$('.cliente').val(0);
		$.each( inputs, function( key, value ) {
			$(this).val(0);
			$(this).attr('checked',false);
		});
	} else if (rol == 'cliente') {
		$('#div_rol_admin').css('display','none');
		$('#div_rol_cliente').css('display','block');
		$('.cliente').css('display','block');
		$('.cliente_label').css('display','block');
		inputs = $('#div_rol_admin input');
		$.each( inputs, function( key, value ) {
			$(this).val(0);
			$(this).attr('checked',false);
		});
	}
}

$( "input[type=checkbox]" ).on( "click",function(){
	$(this).val(1);
	$(this).attr('checked',true);
});

function checkSize() {
	var max_img_size = 1803600;
	var input2 = document.getElementById("upload_imagen");
  
    if(input2.files && input2.files.length == 1)
    {           
        if (input2.files[0].size > max_img_size) 
        {
			var clon = $("#upload_imagen").clone(); 
			$("#upload_imagen").replaceWith(clon);
            alert("Las imágenes no pueden superar 1.8 MB");
            return false;
        }
    }
	
    
}
</script>
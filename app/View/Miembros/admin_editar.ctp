<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
if (empty($titulo)){
	$titulo = 'Miembro del Personal';
}
?>
<h1><?php echo $titulo ?></h1>
<?php 
	echo $this->Form->button('Usuario/No Usuario',array('class'=>'boton','id'=>'usuario'));
	echo $this->Form->create('Miembro',array('type' => 'file','onSubmit' => 'return checkSize();'));
	if (!empty($this->data['User']['username']) && $this->data['User']['username'] != 'no_usuario') {
		$display = '';
		$value = 1;
	} else {
		$display = 'none';
		$value = 0;
	}
	echo $this->Form->input('es_usuario',array('type'=>'hidden','value'=>$value,'id'=>'es_usuario'));
	echo '<table>';
	echo '<tr id="username_miembro" style="display:'.$display.'">';
	echo '<td>Username</td>';
	echo '<td>';
	echo $this->Form->input('User.username',array(
		'label' => false,
		'id' => 'username'
	));
	echo '</td>';
	if (empty($id)) {
		echo '<td>Contraseña</td>';
		echo '<td>';
		echo $this->Form->input('User.password',array(
			'label' => false,
			'id' => 'contrasena'
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
	echo '<h3>Contacto 1</h3>';
	echo '<table>';
	echo '<tr>';
	echo '<td>Nombre</td>';
	echo '<td>';
	echo $this->Form->input('contacto1',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Parentesco</td>';
	echo '<td>';
	echo $this->Form->input('parentesco1',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Telefono 1</td>';
	echo '<td>';
	echo $this->Form->input('tlf1_contacto1',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Telefono 2</td>';
	echo '<td>';
	echo $this->Form->input('tlf2_contacto1',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<h3>Contacto 2</h3>';
	echo '<table>';
	echo '<tr>';
	echo '<td>Nombre</td>';
	echo '<td>';
	echo $this->Form->input('contacto2',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Parentesco</td>';
	echo '<td>';
	echo $this->Form->input('parentesco2',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Telefono 1</td>';
	echo '<td>';
	echo $this->Form->input('tlf1_contacto2',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Telefono 2</td>';
	echo '<td>';
	echo $this->Form->input('tlf2_contacto2',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<h3>Contacto 1</h3>';
	echo '<table>';
	echo '<tr>';
	echo '<td>Nombre</td>';
	echo '<td>';
	echo $this->Form->input('contacto3',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Parentesco</td>';
	echo '<td>';
	echo $this->Form->input('parentesco3',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Telefono 1</td>';
	echo '<td>';
	echo $this->Form->input('tlf1_contacto3',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Telefono 2</td>';
	echo '<td>';
	echo $this->Form->input('tlf2_contacto3',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	if (!empty($id)) {
		echo $this->Form->input('id',array('type'=>'hidden'));
	}
	if (!empty($id_user)) {
		echo $this->Form->input('User.id',array('type'=>'hidden','value'=>$id_user));
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
$("#usuario").click(function() {
 
  $("#username_miembro").toggle();
  if($("#username_miembro").is(":visible")){
	 $("#username").val('');
	$("#es_usuario").val(1);
  } else {
	 $("#username").val('.');
	$("#es_usuario").val(0);
  }
});
</script>
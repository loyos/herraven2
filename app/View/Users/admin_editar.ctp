<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1><?php echo $titulo ?></h1>
<?php 
	echo $this->Form->create('User',array('type' => 'file','onSubmit' => 'return checkSize();'));
	echo '<table>';
	echo '<tr>';
	echo '<td>Usuario</td>';
	echo '<td>';
	echo $this->Form->input('username',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	if (empty($id)) {
		echo '<tr>';
		echo '<td>Contraseña</td>';
		echo '<td>';
		echo $this->Form->input('password',array(
			'label' => false
		));
		echo '</td>';
		echo '</tr>';
	}
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
		echo '<tr>';
		echo '<td>Admin web</td>';
		echo '<td>';
		echo $this->Form->input('admin_web',array(
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
	echo '<td class="cliente_label">Cliente</td>';
	if (!empty($this->data['User']['cliente_id'])){
		$value = $this->data['User']['cliente_id'];
	} else {
		$value = 0;
	}
	echo '<td>';
	echo $this->Form->input('cliente_id',array(
		'label' => false,
		'class' => 'cliente',
		'value' => $value
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Imagen</td>';
	echo '<td>';
	echo $this->Form->input('Foto',array(
		'label' => false,
		'type' => 'file',
		'id' =>'upload_imagen'
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
	} else {
		$('#div_rol_admin').css('display','none');
		$('#div_rol_cliente').css('display','none');
		inputs = $('#div_rol_admin input');
		$.each( inputs, function( key, value ) {
			$(this).val(0);
			$(this).attr('checked',false);
		});
		inputs = $('#div_rol_cliente input');
		$('.cliente').val(0);
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
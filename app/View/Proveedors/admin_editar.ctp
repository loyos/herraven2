<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
if (empty($titulo)){
	$titulo = 'Proveedor';
}
?>
<h1><?php echo $titulo ?></h1>
<?php 
	echo $this->Form->create('Proveedor',array('type' => 'file'));
	echo '<table>';
	echo '<tr>';
	echo '<td>Denom. Legal</td>';
	echo '<td>';
	echo $this->Form->input('denominacion_legal',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Teléfono</td>';
	echo '<td>';
	echo $this->Form->input('telefono',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Rif</td>';
	echo '<td>';
	echo $this->Form->input('rif',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Teléfono</td>';
	echo '<td>';
	echo $this->Form->input('telefono2',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Representante</td>';
	echo '<td>';
	echo $this->Form->input('representante',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Fax</td>';
	echo '<td>';
	echo $this->Form->input('fax',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Ciudad</td>';
	echo '<td>';
	echo $this->Form->input('ciudad',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Email de representante</td>';
	echo '<td>';
	echo $this->Form->input('email_representante',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td></td>';
	echo '<td>';
	echo '</td>';
	echo '<td>Sitio Web</td>';
	echo '<td>';
	echo $this->Form->input('we',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Dirección</td>';
	echo '<td>';
	echo $this->Form->input('direccion',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Descripción</td>';
	echo '<td>';
	echo $this->Form->input('descripcion',array(
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
</script>
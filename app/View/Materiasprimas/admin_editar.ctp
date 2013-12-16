<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1><?php echo $titulo ?></h1>
<?php 
	echo $this->Form->create('Materiasprima');
	echo '<table>';
	echo '<tr>';
	echo '<td>Materia prima</td>';
	echo '<td>';
	echo $this->Form->input('descripcion',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Precio en lista base</td>';
	echo '<td>';
	if (empty($precio_b)) {
		$precio_b = null;
	}
	echo $this->Form->input('precio',array(
		'label' => false,
		'value' => $precio_b
	));
	echo '</td>';
	
	echo '</tr>';
	echo '<tr>';
	echo '<td>División</td>';
	echo '<td>';
	if (empty($id_division)){
		$id_division = 0;
	}
	echo $this->Form->input('division_id',array(
		'label' => false,
		'id' => 'division',
		'value' => $id_division
	));
	echo '</td>';
	echo '<td>Unidad</td>';
	echo '<td>';
	echo $this->Form->input('unidad',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	if (empty($id_departamento)){
		$id_departamento = 0;
	}
	echo '<tr>';
	echo '<td>Departamento</td>';
	echo '<td>';
	echo $this->Form->input('departamento_id',array(
		'label' => false,
		'id' => 'departamento',
		'value' => $id_departamento
	));
	echo '</td>';
	echo '<td></td>';
	echo '<td>';
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	if (empty($id_unidad)){
		$id_unidad = 0;
	}
	echo '<td>Unidad</td>';
	echo '<td>';
	echo $this->Form->input('unidad_id',array(
		'label' => false,
		'id' => 'unidad',
		'value' => $id_unidad
	));
	echo '</td>';
	echo '<td></td>';
	echo '<td>';
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
$('#division').change(function(){
	division_change();
});

$('#departamento').change(function(){
	departamento_change();
});

function division_change(){
	division = $('#division').val();
	if (division > 0) {
		$.ajax({
			type: "POST",
			url: '<?php echo FULL_BASE_URL.'/materiasprimas/buscar_departamentos.json' ?>',
			//url: '<?php echo FULL_BASE_URL.'/'.basename(dirname(APP)).'/materiasprimas/buscar_departamentos.json' ?>',
			data: { division: division},
			dataType: "json"
		}).done(function( msg ) {
			$('#departamento option').remove();
			$('#unidad option').remove();
			$('#departamento').append($("<option></option>").attr("value", 0).text('Selecciona un departamento'));
			$.each(msg, function(i,a){
				$('#departamento').append($("<option></option>").attr("value", a.Departamento.id).text(a.Departamento.nombre));
			});
		});
	} else {
		$('#departamento option').remove();
		$('#departamento').append($("<option></option>").attr("value", 0).text('Selecciona un departamento'));	
	} 
}

function departamento_change(){
	departamento = $('#departamento').val();
	if (departamento > 0) {
		$.ajax({
			type: "POST",
			url: '<?php echo FULL_BASE_URL.'/materiasprimas/buscar_departamentos.json' ?>',
			//url: '<?php echo FULL_BASE_URL.'/'.basename(dirname(APP)).'/materiasprimas/buscar_unidades.json' ?>',
			data: { departamento: departamento},
			dataType: "json"
		}).done(function( msg ) {
			$('#unidad option').remove();
			$('#unidad').append($("<option></option>").attr("value", 0).text('Selecciona una unidad'));
			$.each(msg, function(i,a){
				$('#unidad').append($("<option></option>").attr("value", a.Unidad.id).text(a.Unidad.nombre));
			});
		});
	} else {
		$('#unidad option').remove();
		$('#unidad').append($("<option></option>").attr("value", 0).text('Selecciona una unidad'));	
	} 
}
</script>
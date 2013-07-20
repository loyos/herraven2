<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'));
$materias = array();
?>
<h1><?php echo $titulo?></h1>
<?php 
	echo $this->Form->create('Articulo', array('type' => 'file'));
	echo '<table>';
	echo '<tr>';
	echo '<td>Categoria</td>';
	echo '<td>';
	echo $this->Form->input('categoria_id',array(
			'label' => false,
			'id' => 'categoria'
		));
	echo '</td>';
	echo '<td>Subcategoria</td>';
	echo '<td>';
	echo $this->Form->input('subcategoria_id',array(
		'label' => false,
		'id' => 'subcategoria'
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Código</td>';
	echo '<td>';
	echo $this->Form->input('codigo',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Descripción</td>';
	echo '<td>';
	echo $this->Form->input('descripcion',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Cantidad por cajas</td>';
	echo '<td>';
	echo $this->Form->input('cantidad_por_caja',array(
		'label' => false,
	));
	echo '</td>';
	echo '<td>Imagen</td>';
	echo '<td>';
	echo $this->Form->file('Foto',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Oculto</td>';
	echo '<td>';
	echo $this->Form->input('oculto',array(
		'label' => false,
		'type' => 'checkbox'
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<h2>Materia prima</h2>';
	echo '<table>';
	for ($i=0;$i<=9;$i++){
		if (!empty($valor_mp[$i])){
			$value_m = $valor_mp[$i];
		} else {
			$value_m = null;
		}
		if (!empty($valor_cant[$i])){
			$value_c = $valor_cant[$i];
		} else {
			$value_c = null;
		}
		echo '<tr>';
		echo '<td>';
		echo $this->Form->input('materiasprima_id',array(
			'name' => 'materias[]',
			'value' => $value_m
		));
		echo '</td>';
		echo '<td>';
		echo $this->Form->input('cantidad',array(
			'name' => 'cantidad[]',
			'value' => $value_c
		));
		echo '</td>';
		echo '</tr>';
	}
	echo '</table>';
	echo '<h2>Acabados</h2>';
	echo '<table>';
	echo '<tr>';
	foreach ($acabados as $acabado) {
		echo '<td>';
		echo $this->Form->input($acabado['Acabado']['descripcion'],array(
			'type' => 'checkbox',
			'id' => $acabado['Acabado']['id'],
			'class' => 'check_acabado',
			'desc' => $acabado['Acabado']['descripcion']
		));
		echo '</td>';
	}
	echo '</tr>';
	echo '</table>';
	echo '<div id="acabados_articulo">';
	echo '<table id ="tabla_materias_acabado" style="display:none">';
	echo '<tr>';
	echo '<td class="titulo_tabla">';
	echo '</td>';
	echo '</tr>';
	// echo $this->Form->input('id_acabados',array(
		// 'name' => 'id_acabados',
		// 'id' => 'id_acabado',
		// 'type' => 'hidden'
	// ));
	for ($i=0;$i<=3;$i++){
		echo '<tr>';
		echo '<td>';
		echo $this->Form->input('materiasprima_id',array(
			'name' => 'materia_acabado',
		));
		echo '</td>';
		echo '<td>';
		echo $this->Form->input('cantidad',array(
			'name' => 'cantidad_acabado',
		));
		echo '</td>';
		echo '</tr>';
	}
	echo '</table>';
	echo '</div>';
	echo '<h2>Ganancia</h2>';
	echo '<table>';
	echo '<tr>';
	echo '<td>Costo de producción (en %)</td>';
	echo '<td>';
	if (empty($this->data['Articulo']['costo_produccion'])) {
		$value_cp = $costo_produccion;
	} else {
		$value_cp = $this->data['Articulo']['costo_produccion'];
	}
	echo $this->Form->input('costo_produccion',array(
		'label' => false,
		'value' => $value_cp
	));
	echo '</td>';
	echo '<td>Margen de ganancia</td>';
	echo '<td>';
	echo $this->Form->input('margen_ganancia',array(
		'label' => false
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
$(document).ready(function() {
	buscar_subcat();
	buscar_acabados();
})
$('#categoria').change(function(){
	buscar_subcat();
});
function buscar_subcat() {
	var cat_id = $('#categoria').val();
	$.ajax({
		type: "POST",
		url: "buscar_subcat.json",
		data: { cat_id: cat_id },
		dataType: "json"
	}).done(function( msg ) {
		// alert( "Data Saved: " + msg[1].Genero.nombre);
		$('#subcategoria option').remove();
		$('#subcategoria').append($("<option></option>").attr("value", '').text('Selecciona una subcategoria'));
		$.each(msg, function(i,a){	
			$('#subcategoria').append($("<option selected=selected ></option>").attr("value", a.Subcategoria.id).text(a.Subcategoria.descripcion)); 
		});
	});
}

$(".check_acabado").change(function() {
	agregar_acabado(this)
});

function buscar_acabados(){
	$.each($('.check_acabado'), function(index, value) {
		if ($(value).is(':checked')){
			agregar_acabado(value);
		}
	});
}

function agregar_acabado(el){
		if ($(el).is(':checked')) {
		titulo = $(el).attr('desc');
		$('#tabla_materias_acabado .titulo_tabla').html(titulo);
		nuevo = $('#tabla_materias_acabado').clone().appendTo('#acabados_articulo').css('display','block');
		id_check = $(el).attr('id');
		nuevo.attr('id','tabla_'+id_check);
		selects = $('#tabla_'+id_check).find('select');
		//$('#id_acabado').val($('#id_acabado').val()+','+id_check);
		$.each(selects, function(index, value) {
			if ($(value).attr('name') == 'materia_acabado') {
				$(value).attr('name','materia_acabado_'+id_check+'[]');
			}
		});
		inputs = $('#tabla_'+id_check).find('input');
		$.each(inputs, function(index, value) {
			if ($(value).attr('name') == 'cantidad_acabado') {
				$(value).attr('name','cantidad_acabado_'+id_check+'[]');
			}
		});
	} else {
		id_check = $(el).attr('id');
		$('#tabla_'+id_check).remove();
	}
}
</script>
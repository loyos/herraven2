<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'));
$materias = array();
?>
<h1><?php echo $titulo?></h1>
<?php 
	if (!empty($this->data['Articulo']['subcategoria_id'])) {
		$subcategoria_id = $this->data['Articulo']['subcategoria_id'];
	} else {
		$subcategoria_id = 0;
	}
	echo $this->Form->create('Articulo', array('type' => 'file'));
	echo '<table>';
	echo '<tr>';
	echo '<td>Linea</td>';
	echo '<td>';
	echo $this->Form->input('categoria_id',array(
			'label' => false,
			'id' => 'categoria'
		));
	echo '</td>';
	echo '<td>Categoria</td>';
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
	echo '<h2>Materias prima Básicas</h2>';
	echo '<table>';
	for ($i=0;$i<=($numero_materias-1);$i++){
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
			'value' => $value_m,
			'label' => false
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
		if(!empty($array_acabados)) {
			if (in_array($acabado['Acabado']['id'],$array_acabados)){
				$checked = true;
			} else {
				$checked = false;
			}
		} else {
			$checked = false;
		}
		echo '<td>';
		echo $this->Form->input($acabado['Acabado']['acabado'],array(
			'type' => 'checkbox',
			'id' => $acabado['Acabado']['id'],
			'class' => 'check_acabado',
			'desc' => $acabado['Acabado']['acabado'],
			'checked' => $checked
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
	if (!empty($valores)) {
		$aux = 0;
		foreach ($valores['materia_acabado'] as $key => $m_a) {
			echo '<table id ="tabla_'.$key.'">';
			echo '<tr>';
			echo '<td class="titulo_tabla">';
			echo $m_a['acabado'][0];
			echo '</td>';
			echo '</tr>';
			for ($i=0;$i<=3;$i++){
				if (!empty($m_a['id'][$i])) {
					$valor_m = $m_a['id'][$i];
				} else {
					$valor_m = null;
				}
				if (!empty($valores['cantidad_acabado'][$key][$i])) {
					$valor_c = $valores['cantidad_acabado'][$key][$i];
				} else {
					$valor_c = null;
				}
				echo '<tr>';
				echo '<td>';
				echo $this->Form->input('materiasprima_id',array(
					'name' => 'materia_acabado_'.$key.'[]',
					'value' => $valor_m
				));
				echo '</td>';
				echo '<td>';
				echo $this->Form->input('cantidad',array(
					'name' => 'cantidad_acabado_'.$key.'[]',
					'value' => $valor_c
				));
				echo '</td>';
				echo '</tr>';
			}
			echo '</table>';
			$aux++;
		}
	}
	echo '</div>';
	echo '<h2>Costo de producción</h2>';
	echo '<table>';
	echo '<tr>';
	echo '<td>';
	if (empty($this->data['Articulo']['costo_produccion'])) {
		$value_cp = $costo_produccion;
	} else {
		$value_cp = $this->data['Articulo']['costo_produccion'];
	}
	echo $this->Form->input('costo_produccion',array(
		'label' => false,
		'value' => $value_cp,
		'class' => 'input_pequeno'
	));
	echo '</td>';
	echo '<td>(% sobre el costo de la materia prima)</td>';
	echo '</tr>';
	echo '</table>';
	echo '<h2>Ganancia</h2>';
	echo '<table>';
	echo '<tr>';
	echo '<td>';
	echo $this->Form->input('margen_ganancia',array(
		'label' => false,
		'class' => 'input_pequeno'
	));
	echo '</td>';
	echo '<td>(% margen de ganancia)</td>';
	echo '</tr>';
	echo '</table>';
	echo '<h2>Precio final</h2>';
	echo '<div id="precio_final">';
	echo '</div>';
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
	var cate_id = $('#categoria').val();
	$.ajax({
		type: "POST",
		url: '<?php echo FULL_BASE_URL.'/articulos/buscar_subcat.json' ?>',
		//url: '<?php echo FULL_BASE_URL.'/'.basename(dirname(APP)).'/articulos/buscar_subcat.json' ?>',
		data: { cat_id: cate_id },
		dataType: "json"
	}).done(function( msg ) {
		// alert( "Data Saved: " + msg[1].Genero.nombre);
		$('#subcategoria option').remove();
		$('#subcategoria').append($("<option></option>").attr("value", '').text('Selecciona una subcategoria'));
		$.each(msg, function(i,a){	
			if (<?php echo $subcategoria_id?> == a.Subcategoria.id) {
				$('#subcategoria').append($("<option selected=selected ></option>").attr("value", a.Subcategoria.id).text(a.Subcategoria.descripcion)); 
			}
			$('#subcategoria').append($("<option ></option>").attr("value", a.Subcategoria.id).text(a.Subcategoria.descripcion)); 
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
		id_check = $(el).attr('id');
		if ($('#tabla_'+id_check).length) { 
			if ($(el).is(':checked')) {
			}else{
				$('#tabla_'+id_check).remove();
			}
		} else {
			if ($(el).is(':checked')) {
			titulo = $(el).attr('desc');
			$('#tabla_materias_acabado .titulo_tabla').html(titulo);
			nuevo = $('#tabla_materias_acabado').clone().appendTo('#acabados_articulo').css('display','block');
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
}
</script>
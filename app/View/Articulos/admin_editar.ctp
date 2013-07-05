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
	echo '<td>Subcategoria</td>';
	echo '<td>';
	echo $this->Form->input('subcategoria_id',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Código</td>';
	echo '<td>';
	echo $this->Form->input('codigo',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Descripción</td>';
	echo '<td>';
	echo $this->Form->input('descripcion',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Cantidad por cajas</td>';
	echo '<td>';
	echo $this->Form->input('cantidad_por_caja',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Imagen</td>';
	echo '<td>';
	echo $this->Form->file('Foto',array(
		'label' => false
	));
	echo '</td>';
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
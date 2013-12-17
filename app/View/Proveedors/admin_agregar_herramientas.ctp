<div class='wrap'>
<h1>Herramientas</h1>
<?php 
if(!empty($herramientas_proveedor)){
	echo '<table class="tabla_index">';
	echo '<tr>';
	echo '<th>Herramienta</th>';
	echo '<th>Lote</th>';
	echo '<th>Acciones</th>';
	echo '</tr>';
	foreach ($herramientas_proveedor as $h) {
		echo '<tr>';
		echo '<td>'.$h['Herramienta']['nombre'].'</td>';
		echo '<td>'.$h['Lote']['nombre'].'</td>';
		echo '<td>'.$this->Html->link('Eliminar',array('action'=>'admin_eliminar_herramienta',$id,$h['Herramienta']['id']),array('class'=>'boton_accion')).'</td>';
		echo '</tr>';
	}
	echo '</table>';
} else {
	echo '<h3>No hay herramientas asociadas a este proveedor</h3>';
}
echo '<h3>Agregar Herramienta</h3>';
echo $this->Form->create('HerramientasProveedor');
echo $this->Form->input('herramienta_id');
echo $this->Form->input('proveedor_id',array('value'=>$id,'type'=>'hidden'));
echo $this->Form->submit('Agregar', array('class' => 'button'));
echo $this->Form->end;
?>
</div>
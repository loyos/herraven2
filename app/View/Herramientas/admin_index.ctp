<div class='wrap'>
<?php echo $this->Html->link('Agregar herramienta',array('action'=>'admin_editar'),array('class'=>'boton'));?>
<h1>Herramientas</h1>
<?php
if (!empty($herramientas)) {
	echo '<table class="tabla_index">';
	echo '<tr>';
	echo '<th>Herramienta</th>';
	echo '<th>Lote</th>';
	echo '<th>Acciones</th>';
	echo '</tr>';
	foreach ($herramientas as $l) {
		echo '<tr>';
		echo '<td>'.$l['Herramienta']['nombre'].'</td>';
		echo '<td>'.$l['Lotesherramienta']['nombre'].'</td>';
		echo '<td>'.$this->Html->link('Editar',array('action'=>'admin_editar',$l['Herramienta']['id']),array('class'=>'boton_accion')).' '.$this->Html->link('Eliminar',array('action'=>'admin_eliminar',$l['Herramienta']['id']),array('class'=>'boton_accion')).'</td>';
		echo '</tr>';
	}
	echo '<table>';
} else {
	echo '<h3>No hay herramientas registradas</h3>';
}
?>
</div>
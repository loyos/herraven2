<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'));
?>
<h1>Lista de precio: <?php echo $precio['Precio']['descripcion']?></h1>
<?php 
	echo '<table  class="tabla_ver">';
	foreach ($precio_materia as $mp){
		echo '<tr>';
		echo '<th>'.$mp['materia'].'</th>';
		echo '<td>';
		echo $mp['precio'];
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
	}
	echo '</table>';
?>
</div>

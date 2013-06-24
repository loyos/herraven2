<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'editar'));
?>
<h1>Clientes</h1>
<?php 
	if (!empty($clientes)) {
		?>
		<table class="tabla_index">
		<tr>
		<th st>Denominacion Legal</th>
		<th>Representante</th>
		<th>Telefono</th>
		<th>Email representante</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($clientes as $c) {
			echo '<tr>';
			echo '<td>'.$c['Cliente']['denominacion_legal'].'</td>';
			echo '<td>'.$c['Cliente']['representante'].'</td>';
			echo '<td>'.$c['Cliente']['telefono_uno'].'</td>';
			echo '<td>'.$c['Cliente']['email_representante'].'</td>';
			echo '<td>'.$this->Html->link('Editar',array('action' => 'editar',$c['Cliente']['id'])).'<br>'.$this->Html->link('Eliminar',array('action' => 'eliminar',$c['Cliente']['id'])).'<br>'.$this->Html->link('Ver',array('action' => 'ver',$c['Cliente']['id'])).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
?>
</div>

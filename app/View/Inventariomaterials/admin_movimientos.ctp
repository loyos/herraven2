<div class="wrap">
<h1>Movimientos de Materia Prima</h1>
<?php 
	echo $this->Form->create('Inventariomaterial');
	if (!empty($id_m)) {
		$value = $id_m;
	} else {
		$value = 0;
	}
	echo $this->Form->input('materiasprima_id',array(
		'value' => $value
	));
	echo $this->Form->submit('Buscar',array('class' => 'button'));
	echo $this->Form->end();
	if (!empty($id_m)) {
		?>
		<div class="subtitulo_movimientos">
		<h2>Movimientos de <?php echo $entradas[0]['Materiasprima']['descripcion'] ?></h2>
		</div>
		<div class="ano_movimientos">
			<table>
				<tr>
					<td><b><u>Año</u></b></td><td><b><u>Unidad</b></u></td>
				</tr>
				<tr>
					<td style="text-align:center"><?php echo $ano?> </td>
					<td style="text-align:center"><?php echo $entradas[0]['Materiasprima']['unidad'] ?></td>
				</tr>
			</table>
		</div>
		<?php
		echo $this->element('admin_movimientos');
	} else {
		echo 'Escoge una materia prima para observar sus movimientos';
	}
?>
</div>

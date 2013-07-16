<div class="wrap">
	<?php
	if (!empty($categorias)) {
		echo '<h2>Selecciona la categoria y subcategoria del producto</h2>';
		echo $this->Form->create();
		echo '<table>';
		echo '<tr>';
		echo '<td>Categorias</td>';
		echo '<td>';
		echo $this->Form->input('categoria_id',array(
			'label' => false,
			'id' => 'categoria'
		));
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Subcategoria</td>';
		echo '<td>';
		echo $this->Form->input('subcategoria_id',array(
			'label' => false,
			'id' => 'subcategoria'
		));
		echo '</td>';
		echo '</tr>';
		echo '</table>';
		echo $this->Form->submit('Buscar articulos', array('class' => 'button'));
		echo $this->Form->end;
	} elseif (!empty($articulos)) { 
		echo '<table style="margin-left:35px;">';
		$i = 1;
		foreach ($articulos as $a) {
			if ($i ==1 || ($i-1)%2 == 0 ){
				echo '<tr>';
			}
		?>
		<td style="width:420px;">
			<table>
				<tr>
					<td><?php echo $this->Html->image('articulos/'.$a['Articulo']['imagen'],array('width' => '150px')); ?></td>
					<td style="text-align:center">
						<span style="font-weight:bold"><?php echo $a['Articulo']['descripcion']; ?></span>
						<br>
						<span style="font-weight:bold"><?php echo $a['Articulo']['codigo']; ?></span>
						<br>
						<?php echo $a['Articulo']['cantidad_por_caja'].' pz'; ?>
						<br>
						<?php echo $this->Html->link('Ingreso',array('action' => 'admin_ingresar',$a['Articulo']['id']));?>
					</td>
				</tr>
			</table>
		</td>
		<?php	
			if ($i%2 == 0 ){
				echo '</tr>';
			}
			$i++;
		}
		echo '</table>';
	}
	?>
</div>
<script>
$(document).ready(function() {
	buscar_subcat();
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
</script>
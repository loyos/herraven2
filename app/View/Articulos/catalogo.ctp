<div class="wrap">
<div class="categoria_catalogo">
	<?php echo $this->Html->link($subcategoria['Categoria']['descripcion'],array('action' => 'subcategoria_catalogo')); ?>
</div>
<div class= "subcategoria_catalogo">
	<?php echo $subcategoria['Subcategoria']['descripcion'] ?>
</div>
<?php
echo $this->Form->create('Pedido');
if (!empty($info_articulos)) {
foreach ($info_articulos as $a) { ?>
<div class="articulo_catalogo">
	<div class="imagen_catalogo fotos">
		<?php 
		echo $this->Html->link(
			$this->Html->image('articulos/'.$a['imagen'], array("height" => "120px",'class'=>'prim')),
			"../img/articulos/".$a['imagen'],
			array('escape' => false, 'class="fancybox primera"')
		);
		?>
	</div>
	<div class="info_catalogo">
		<table style="width: 80%;">
			<tr>
				<td>				
					Bs. <?php echo number_format($a['precio'], 0, ',', '.') ?>
					<br>
					Precio unitario
				</td>
				<td></td>
				<td>
					<?php
					echo '<b>' .$a['codigo']. '</b><br>';					
					
					echo $this->Form->input('cantidad',array(
						'type' => 'select',
						'options' => $cantidad_de_cajas,
						'name' => 'cantidad['.$a['id'].']'
					));
					//echo '<br>';
					if (!empty($acabado_articulo[$a['id']])){
						echo $this->Form->input('acabado_id',array(
							'name' => 'acabado['.$a['id'].']',
							'type' => 'select',
							'label' => false,
							'options' => $acabado_articulo[$a['id']],
							'id' => $a['id'],
							'class' => 'acabados_catalogo'
						));
						echo '<span class="descripcion_acabado_'.$a['id'].'">'.$acabado_descripcion[$a['id']].'</span>';
					} else {
						echo 'No hay acabados asociados';
					}
					?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo 'Bs. '. number_format($a['precio']*$a['cantidad_por_caja'], 0, ',', '.');
					echo '<br>';
					echo 'Precio de caja';
					
					?>
				</td>
				<td>
					<?php echo $a['cantidad_por_caja'];
					echo '<br>';
					echo 'Pz. caja';
					?>
				</td>
				<td>
					<?php
						echo $this->Form->input('activo',array(
							'value' => 0,
							'type' => 'hidden',
							'name' => 'activo['.$a['id'].']',
							'id' => 'activo_'.$a['id'],
						));
						echo $this->Form->submit('Pedir',array('class' => 'button boton_catalogo', 'onclick' => 'activar('.$a['id'].')'));
						echo $this->Form->end();
						echo '<span class="descripcion_catalogo">' .$a['articulo']. '</span>';	
					?>
				</td>
			</tr>
		</table>
	</div>

</div>
<?php
} 
} else {
	echo "No hay artículos en esta categoria";
}
?>
</div>
<script>
function activar(id){
	
	val = $('input#activo_'+id).val('1');
}

$( ".acabados_catalogo" ).change(function() {
	acabado_id = $(this).val();
	id = $(this).attr('id');
	$.ajax({
		type: "POST",
		url: '<?php echo FULL_BASE_URL.'/articulos/buscar_acabado.json' ?>',
		//url: '<?php echo FULL_BASE_URL.'/'.basename(dirname(APP)).'/articulos/buscar_acabado.json' ?>',
		data: { acabado_id: acabado_id },
		dataType: "json"
	}).done(function( msg ) {
		$('span.descripcion_acabado_'+id).html(msg);		
	});

});

$(document).ready(function() {
	var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
	var is_firefox = navigator.userAgent.indexOf("Firefox") != -1;
	
	$('.fancybox').fancybox();
	
	$('.fotos a').mouseenter(function() {
		$(this).find('.prim').css('opacity','0.5');
		if (is_chrome) {
			// $(this).append('<?php echo $this->Html->image('icon_zoom.png',array('class'=>'zoom','style' => "position:absolute;",'width'=>'50px','height'=>'50px'))?>');
				} else 
			if(is_firefox) {
				// $(this).append('<img src="img/icon_zoom.png" alt="" width="50px" height="50px" class = "zoom" style= "position:absolute;margin-top:70px; margin-left:-120px;"/>');
			}
	});
	$('a.primera').mouseleave(function() {
		$(this).find('.prim').css('opacity','1');
		//$('.zoom').remove();
	});
});
</script>
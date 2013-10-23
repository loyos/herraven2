<div class="wrap">
<?php // echo $this->Herra->format_number(); ?>
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
			array('escape' => false, 'class="fancybox primera"','data-fancybox-group' => $a['imagen'])
		);
		if(!empty($a['imagen1'])) { 
		echo $this->Html->link(
			$this->Html->image('articulos/'.$a['imagen1'], array('style'=>'display:none')),
			"../img/articulos/".$a['imagen1'],
			array('escape' => false, 'class'=>"fancybox",'data-fancybox-group' => $a['imagen'],)
		);?>

		<?php
		}
		if(!empty($a['imagen2'])) { 
			echo $this->Html->link(
				$this->Html->image('articulos/'.$a['imagen2'], array('style'=>'display:none')),
				"../img/articulos/".$a['imagen2'],
				array('escape' => false, 'class'=>"fancybox",'data-fancybox-group' => $a['imagen'],)
			);?>

			<?php
		}
		?>
	</div>
	<div class="info_catalogo">
		<table style="width: 80%;">
			<tr>
				<td style = "width: 100px;">
					<?php 
					
					echo  '<b> Código ' .$a['codigo']. '</b><br><br>';
					?>
					<span class="precio_<?php echo $a['id']?>" >
					<?php
					echo 'Precio unitario';
					if (!empty($precio[$a['id']])){?>
						<?php echo $this->Herra->format_number($precio[$a['id']]);
					} else { ?>
						<?php echo $this->Herra->format_number($a['precio']);
					}
					?>
					</span>
				</td>
				<td style = "width: 100px;"></td>
				<td style = "width: 400px;">
					<?php					
					echo $this->Form->input('cantidad',array(
						'type' => 'select',
						'options' => $cantidad_de_cajas,
						'name' => 'cantidad['.$a['id'].']',
						'label' => 'Cantidad: '
					));
					//echo '<br>';
					if (!empty($acabado_articulo[$a['id']])){
						echo $this->Form->input('acabado_id',array(
							'name' => 'acabado['.$a['id'].']',
							'type' => 'select',
							'label' => 'Acabado: ',
							'options' => $acabado_articulo[$a['id']],
							'id' => $a['id'],
							'class' => 'acabados_catalogo'
						));
						if (!empty($acabado_descripcion[$a['id']])){
							echo '<span class="descripcion_acabado_'.$a['id'].'"><br> Descripción del acabado: '.$acabado_descripcion[$a['id']].'</span>';
						}
					} else {
						echo 'No hay acabados asociados';
					}
					?>
				</td>
			</tr>
			<tr>
				<td class="precio_caja_<?php echo $a['id']?>" name="<?php echo $a['cantidad_por_caja']?>" style = "width: 100px;">
					<?php
					echo 'Precio de caja';
					if (!empty($precio[$a['id']])){?>
						<?php echo $this->Herra->format_number($precio[$a['id']]*$a['cantidad_por_caja']);
					} else { ?>
						<?php echo $this->Herra->format_number($a['precio']*$a['cantidad_por_caja']);
					}
					
					?>
				</td>
				<td style = "width: 100px;">
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
						echo '<span class="descripcion_catalogo"> Descripción artículo: ' .$a['articulo']. '</span>';
						echo $this->Form->submit('Pedir',array('class' => 'button boton_catalogo', 'onclick' => 'activar('.$a['id'].')'));
						echo $this->Form->end();
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
	}). error(function( msg ) {
		$('span.descripcion_acabado_'+id).html('');		
	}) ;
	calcula_precio_acabado(acabado_id,id);
});

function calcula_precio_acabado(acabado_id,id) {
	$.ajax({
		type: "POST",
		url: '<?php echo FULL_BASE_URL.'/articulos/precio_total.json' ?>',
		//url: '<?php echo FULL_BASE_URL.'/'.basename(dirname(APP)).'/articulos/precio_total.json' ?>',
		data: {id:id,acabado_id: acabado_id },
		dataType: "json"
	}).done(function( msg ) {
		precio = addCommas(msg.toFixed(2));
		$('span.precio_'+id).html('Precio unitario<br>' + 'Bs.'+precio);
		cajas = $('td.precio_caja_'+id).attr('name');
		n_cajas =  addCommas((msg*cajas).toFixed(2));
		$('td.precio_caja_'+id).html('Precio caja <br>' + 'Bs.'+n_cajas);
	});
}

function addCommas(nStr)
{
	nStr += '';
	nStr = nStr.replace('.',',');
	x = nStr.split(',');
	x1 = x[0];
	x2 = x.length > 1 ? ',' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + '.' + '$2');
	}
	return x1 + x2;
}

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
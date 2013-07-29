<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index',$cat_id,$sub_id));
?>
<h1>Artículo</h1>
<?php 
	echo '<table  class="tabla_ver">';
	echo '<tr>';
	echo '<th>Imagen</th>';
	echo '<td>';
	echo $this->Html->link(
			$this->Html->image('articulos/'.$articulo['Articulo']['imagen'], array("width" => "100px",'class'=>'prim')),
			"../img/articulos/".$articulo['Articulo']['imagen'],
			array('escape' => false, 'class="fancybox primera"')
	);
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Articulo</th>';
	echo '<td>';
	echo $articulo['Articulo']['codigo'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Descripción</th>';
	echo '<td>';
	echo $articulo['Articulo']['descripcion'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Cantidad por cajas</th>';
	echo '<td>';
	echo $articulo['Articulo']['cantidad_por_caja'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Oculto</th>';
	echo '<td>';
	if ($articulo['Articulo']['oculto'] == 1){
		$oculto = 'Si';
	} else {
		$oculto = 'No';
	}
	echo $oculto;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Subcategoria</th>';
	echo '<td>';
	echo $articulo['Subcategoria']['descripcion'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Materias prima</th>';
	echo '<td>';
	foreach ($articulo['Materiasprima'] as $m){
		echo $m['descripcion'].' cantidad: '.$m['ArticulosMateriasprima']['cantidad'].'<br>';
	}
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Costo de producción</th>';
	echo '<td>';
	echo $articulo['Articulo']['costo_produccion'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Margen de ganancia</th>';
	echo '<td>';
	echo $articulo['Articulo']['margen_ganancia'];
	echo '</td>';
	echo '</tr>';
	echo '</table>';
?>
</div>
<script>
	function activar(id){
		val = $('input#'+id).val('1');
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
	});});
</script>
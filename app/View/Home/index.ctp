<div id="banner-fade">

<!-- start Basic Jquery Slider -->
<ul class="bjqs">
	<?php 
		foreach($imagenes as $img){
			echo "<li>";
				 echo $this->Html->image('home/'.$img['Imagen']['imagen']);
			echo "</li>";
		}
	?>
</ul>
<!-- end Basic jQuery Slider -->
</div>

<div class = "footer_acomodado">
	<div class = "texto_footer">
		© Herrajes y Accesorios Herraven s.a. Todos los derechos reservados. RIF J-30800588-6
	</div>
</div>

<script>
jQuery(document).ready(function($) {
    $('#banner-fade').bjqs({
        'height' : 400,
        'width' : 900,
        'responsive' : true,
		'nexttext' : '',
		'prevtext' : '',
		'showmarkers' : false
    });
});
</script>

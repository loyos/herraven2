<script>
	// $('.footer_acomodado').css( "bottom", "0" );
</script>

<div class = "wrap_contenido">

	<?php
		echo $contenido['Contenido']['contenido'];
		if(!empty($contenido['Contenido']['video'])){
		$link = explode( '/', $contenido['Contenido']['video'] );
		$codigo_video = end($link);
	?>
	<div class = "video">
		<iframe src="//player.vimeo.com/video/<?php echo $codigo_video;?>" width="300" height="180" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
	</div>
	<?php } ?>

</div>

<div class = "footer_contenido">
	<div class = "texto_footer">
		© Herrajes y Accesorios Herraven s.a. Todos los derechos reservados. RIF J-30800588-6
	</div>
</div>
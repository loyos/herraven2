<script>
	// $('.footer_acomodado').css( "bottom", "0" );
</script>

<div class = "wrap_contenido">
	<div class = "wrap_izquierda">
	<?php
		if(!empty($contenido['Contenido']['titulo'])){ ?>
			<div class = "wrap_titulo">
			<?php
				echo $contenido['Contenido']['titulo']; 
			?>
			</div>
		<?php	
		}
		
		echo $contenido['Contenido']['contenido'];
		if(!empty($contenido['Contenido']['video'])){
		$link = explode( '/', $contenido['Contenido']['video'] );
		$codigo_video = end($link);
	?>
	
	<?php } ?>

	</div>
	<div class = "video">
		<?php if(!empty($contenido['Contenido']['video'])){ ?>
			<iframe src="//player.vimeo.com/video/<?php echo $codigo_video;?>" width="300" height="180" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		<?php }else if(!empty($contenido['Contenido']['imagen'])){
			echo $this->Html->image(('contenido/'. $contenido['Contenido']['imagen']), array('width' => '300'));
		} ?>
	</div>
	<div class = "push"> 	</div>
</div>
<div class = "footer_contenido">
	<div class = "texto_footer">
		© Herrajes y Accesorios Herraven s.a. Todos los derechos reservados. RIF J-30800588-6
	</div>
</div>
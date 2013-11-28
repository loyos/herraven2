<div id="banner-fade">

<!-- start Basic Jquery Slider -->
<ul class="bjqs">
	<li>
		<?php echo $this->Html->image('fabrica1.jpg'); ?>
	</li>
	<li>
		<?php echo $this->Html->image('fabrica2.jpg'); ?>
	</li>
	<li>
		<?php echo $this->Html->image('fabrica3.jpg'); ?>
	</li>
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

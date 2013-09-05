<div id="banner-fade">

<!-- start Basic Jquery Slider -->
<ul class="bjqs">
	<li>
		<?php echo $this->Html->image('belt.jpg', array('width' => '120px;', 'height' => '100px;')); ?>
	</li>
	<li>
		<?php echo $this->Html->image('loy.jpg', array('width' => '120px;', 'height' => '100px;')); ?>
	</li>
</ul>
<!-- end Basic jQuery Slider -->
</div>

<script>
jQuery(document).ready(function($) {
    $('#banner-fade').bjqs({
        'height' : 400,
        'width' : 700,
        'responsive' : true,
		'nexttext' : '',
		'prevtext' : ''
    });
});
</script>

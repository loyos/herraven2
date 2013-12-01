<div class = "main_menu">
<ul>
	<?php foreach($menu as $m){ 
		if($m['Contenido']['alias'] == 'home'){
			?><!-- <li><?php 
			// echo $this->Html->link($m['Contenido']['alias'],array('controller' => 'home','action'=>'index'));
			?></li> -->
			<?php
		}else {
	?>
		<li>
			<?php echo $this->Html->link($m['Contenido']['alias'],array('controller' => 'home','action'=>'contenido', $m['Contenido']['id'])); ?>
		</li>
	<?php }
	}
	?>
	<!-- <li>
		<?php // echo $this->Html->link('Contacto',array('controller' => 'home','action'=>'contacto')); ?>
	</li> -->
	<li>
		<?php echo $this->Html->link('Area Reservada',array('controller' => 'users','action'=>'login')); ?>
	</li>
	
</ul>
</div>
<?php //debug($menu); ?>
<script>
	
	$('.option').click(function() {
		$(this).siblings().removeClass('selected');
		$(this).addClass('selected');
		console.debug($(this).siblings().children());
		$(this).siblings().children().find('li').hide();
		$(this).find('ul').fadeIn();
		$(this).find('li').fadeIn();
    });
	// $('.active').removeClass();
	$('.active a').css("color", '#d7e4e8');
	$('.inactive a').css("color", '#FFF');
	$('.inactive a').hover(
	  function () {
		$(this).css("color", '#d7e4e8');
	  },
	  function () {
		$(this).css("color", '#FFF');
	  }
	);
	$('.active').children().show();
		
</script>
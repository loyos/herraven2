<div class = "main_menu">

<ul>
	<li>
		<?php echo $this->Html->link('Home',array('controller' => 'home','action'=>'index')); ?>
	</li>
	<li>
		<?php echo $this->Html->link('Empresa',array('controller' => 'home','action'=>'contenido')); ?>
	</li>
	<li>
		<?php echo $this->Html->link('Proceso Productivo',array('controller' => 'home','action'=>'contenido')); ?>
	</li>
	<li>
		<?php echo $this->Html->link('Contacto',array('controller' => 'home','action'=>'contenido')); ?>
	</li>
	<li>
		<?php echo $this->Html->link('Área Reservada',array('controller' => 'users','action'=>'login')); ?>
	</li>
</ul>
</div>
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
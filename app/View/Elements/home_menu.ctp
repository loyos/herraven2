<div class = "main_menu">

<ul>
	<li>
		Home
	</li>
	<li>
		Empresa
	</li>
	<li>
		Proceso Productivo
	</li>
	<li>
		Contacto
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
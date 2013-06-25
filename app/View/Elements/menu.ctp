<div class = "menu">
<ul>
	<li>
		Clientes y usuarios
		<ul>
			<li><?php echo $this->Html->link('Cliente',array('controller' => 'clientes', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link('Usuario',array('controller' => 'users', 'action' => 'index')); ?></li>
			
		</ul>
	</li>
	<li>
		Menu 2
		<ul>
			<li>Sub menu 2.1</li>
			<li>Sub menu 2.2</li>
			<li>Sub menu 2.3</li>
		</ul>
	</li>
	<li>Menu 3</li>
	<li>Menu 4</li>
</ul>
</div>

<script>
	
	$('li').click(function() {
		$('li').children().fadeOut();
		$(this).find('ul').fadeIn();
    });
		
</script>
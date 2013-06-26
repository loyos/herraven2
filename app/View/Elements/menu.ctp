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
		Categorias
		<ul>
			<li><?php echo $this->Html->link('Categorias',array('controller' => 'categorias', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link('Subcategorias',array('controller' => 'subcategorias', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link('Acabados',array('controller' => 'acabados', 'action' => 'index')); ?></li>
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
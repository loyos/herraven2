<div class = "menu">
<ul>
	<li class = "option">
		Clientes y usuarios
		<ul>
			<li class = "children"><?php echo $this->Html->link('Cliente',array('controller' => 'clientes', 'action' => 'index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Usuario',array('controller' => 'users', 'action' => 'index')); ?></li>
			
		</ul>
	</li>
	<li class = "option">
		Categorias
		<ul>
			<li class = "children"><?php echo $this->Html->link('Categorias',array('controller' => 'categorias', 'action' => 'index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Subcategorias',array('controller' => 'subcategorias', 'action' => 'index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Acabados',array('controller' => 'acabados', 'action' => 'index')); ?></li>
		</ul>
	</li>
	<li class = "option">Artículos
		<ul>
			<li class = "children"><?php echo $this->Html->link('Articulos',array('controller' => 'articulos', 'action' => 'index')); ?></li>
		</ul></li>
	<li class = "option">Menu 4</li>
</ul>
</div>
<script>
	
	$('.option').click(function() {
		$(this).siblings().removeClass('selected');
		$(this).addClass('selected');
		$(this).siblings().children().hide();
		$(this).find('ul').fadeIn();
    });
		
</script>
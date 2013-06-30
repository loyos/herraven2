<div class = "menu">
<ul>
	<li class = "option">
		Clientes y usuarios
		<ul>
			<li class = "children"><?php echo $this->Html->link('Cliente',array('controller' => 'clientes', 'action' => 'admin_index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Usuario',array('controller' => 'users', 'action' => 'admin_index')); ?></li>
			
		</ul>
	</li>
	<li class = "option">
		Categorias
		<ul>
			<li class = "children"><?php echo $this->Html->link('Categorias',array('controller' => 'categorias', 'action' => 'admin_index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Subcategorias',array('controller' => 'subcategorias', 'action' => 'admin_index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Acabados',array('controller' => 'acabados', 'action' => 'admin_index')); ?></li>
		</ul>
	</li>
	<li class = "option">Artículos
		<ul>
			<li class = "children"><?php echo $this->Html->link('Articulos',array('controller' => 'articulos', 'action' => 'admin_index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Materia prima',array('controller' => 'materiasprimas', 'action' => 'admin_index')); ?></li>
		</ul></li>
	<li class = "option">Lista de precios
		<ul>
			<li class = "children"><?php echo $this->Html->link('Lista de precios',array('controller' => 'precios', 'action' => 'admin_index')); ?></li>
		</ul>
	</li>
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
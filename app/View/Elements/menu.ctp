<div class = "menu">
<ul>
	<?php if ($admin_usuario){ ?>
	<li class = "option">
		Clientes y usuarios
		<ul>
			<li class = "children"><?php echo $this->Html->link('Cliente',array('controller' => 'clientes', 'action' => 'admin_index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Usuario',array('controller' => 'users', 'action' => 'admin_index')); ?></li>
			
		</ul>
	</li>
	<?php } ?>
	<?php if ($admin_catalogo){ ?>
	<li class = "option">
		Categorias
		<ul>
			<li class = "children"><?php echo $this->Html->link('Categorias',array('controller' => 'categorias', 'action' => 'admin_index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Subcategorias',array('controller' => 'subcategorias', 'action' => 'admin_index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Acabados',array('controller' => 'acabados', 'action' => 'admin_index')); ?></li>
		</ul>
	</li>
	<?php } ?>
	<?php if ($admin_catalogo){ ?>
	<li class = "option">Artículos
		<ul>
			<li class = "children"><?php echo $this->Html->link('Articulos',array('controller' => 'articulos', 'action' => 'admin_index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Materia prima',array('controller' => 'materiasprimas', 'action' => 'admin_index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Inventario Materia prima',array('controller' => 'inventariomaterials', 'action' => 'admin_index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Forecast',array('controller' => 'articulos', 'action' => 'admin_forecast')); ?></li>
		</ul>
	</li>
	<?php } ?>
	<?php if ($admin_catalogo){ ?>
	<li class = "option">Lista de precios
		<ul>
			<li class = "children"><?php echo $this->Html->link('Lista de precios',array('controller' => 'precios', 'action' => 'admin_index')); ?></li>
		</ul>
	</li>
	<?php } ?>
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
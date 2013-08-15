<div class = "menu">
<ul>
	
	<?php 
	if (!empty($user_id)){?>
	<li class = "option">
		<?php echo $this->Html->link('Perfil',array('controller' => 'users','action'=>'index')); ?>
	</li>
	<?php 
	if ($admin_usuario){ ?>
	<li class = "option">
		Usuarios
		<ul>
			<li class = "children"><?php echo $this->Html->link('Usuario',array('controller' => 'users', 'action' => 'admin_index')); ?></li>
			
		</ul>
	</li>
	<li class = "option">
		Clientes
		<ul>
			<li class = "children"><?php echo $this->Html->link('Cliente',array('controller' => 'clientes', 'action' => 'admin_index')); ?></li>
		</ul>
	</li>
	<?php } ?>
	<?php if ($admin_catalogo){ ?>
	<li class = "option">
		Lineas
		<ul>
			<li class = "children"><?php echo $this->Html->link('Linea',array('controller' => 'categorias', 'action' => 'admin_index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Categorias',array('controller' => 'subcategorias', 'action' => 'admin_index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Acabados',array('controller' => 'acabados', 'action' => 'admin_index')); ?></li>
		</ul>
	</li>
	<?php } ?>
	<?php if ($admin_catalogo){ ?>
	<li class = "option">Artículos
		<ul>
			<li class = "children"><?php echo $this->Html->link('Articulos',array('controller' => 'articulos', 'action' => 'subcategoria_articulo')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Lista de precios',array('controller' => 'precios', 'action' => 'admin_index')); ?></li>
		</ul>
	</li>
	<?php } ?>
	<?php if ($admin_catalogo){ ?>
	<li class = "option">Materias prima
		<ul>
			<li class = "children"><?php echo $this->Html->link('Materia prima',array('controller' => 'materiasprimas', 'action' => 'admin_index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Inventario',array('controller' => 'inventariomaterials', 'action' => 'admin_index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Movimientos',array('controller' => 'inventariomaterials', 'action' => 'admin_movimientos')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Forecast',array('controller' => 'articulos', 'action' => 'admin_forecast')); ?></li>
		</ul>
	</li>
	<?php } ?>
	<?php if ($admin_almacen){ ?>
	<li class = "option">Almacén
		<ul>
			<li class = "children"><?php echo $this->Html->link('Ingreso',array('controller' => 'inventarioalmacens', 'action' => 'admin_agregar')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Egresos',array('controller' => 'pedidos', 'action' => 'admin_index')); ?></li>
			<li class = "children"><?php echo $this->Html->link('Inventario',array('controller' => 'inventarioalmacens', 'action' => 'admin_inventario'));?></li>
			<li class = "children"><?php echo $this->Html->link('Movimientos',array('controller' => 'inventarioalmacens', 'action' => 'admin_movimientos'));?></li>
		</ul>
	</li>
	<?php } ?>
	<li class = "option"><?php echo $this->Html->link('Catálogo',array('controller' => 'articulos', 'action' => 'subcategoria_catalogo')); ?></li>
	<ul>
			<li class = "children"></li>
	</ul>
	<?php
	}
	?>
	<?php if ($admin_despachos){ ?>
	<li class = "option"><?php echo $this->Html->link('Pedidos',array('controller' => 'pedidos', 'action' => 'admin_pedidos')); ?>
	</li>
	<?php } 
	if ($admin_cuentas) { ?>
		<li class = "option"><?php echo $this->Html->link('Cuentas',array('controller' => 'cuentas', 'action' => 'admin_index')); ?>
		</li>
	<?php
		}
	?>
	
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
		
</script>
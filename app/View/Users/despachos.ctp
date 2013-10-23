<div class = "wrap">
	<?php foreach($pedidos as $p){ ?>
	<div class = "articulo_catalogo" style = " padding-bottom: 20px;">
		<div class = "imagen_catalogo fotos" style="text-align:center">
			<?php
			// debug($pedidos);
				echo '<div class="codigo_pedido">';
				echo $p['Articulo']['codigo'];
				echo '</div>';
				echo $this->Html->image('articulos/'.$p['Articulo']['imagen'], array("height" => "120px",'class'=>'prim'));
			
		?>
		</div>
		<div class = "info_catalogo" style = "float: left;">
			<table style = "width: 600px">
				<tr>
					<th>
						Descripción
					</th>
					<th>
						Status
					</th>
					<th>
						Cantidad de Cajas
					</th>
					<th>
						Fecha
					</th>
					<th>
						Acabado
					</th>
					<th>
						Piezas por Caja
					</th>
				</tr>
					<td style = "text-align: center">
						<?php echo $p['Articulo']['descripcion'] ?>
					</td>
					<td style = "text-align: center">
						<?php echo $p['Pedido']['status'] ?>
					</td>
					<td style = "text-align: center">
						<?php echo $p['Pedido']['cantidad_cajas'] ?>
					</td>
					<td style = "text-align: center">
						<?php echo $p['Pedido']['fecha'] ?>
					</td>
					<td style = "text-align: center">
						<?php 
						if (!empty($p['Acabado']['acabado'])) {
							echo $p['Acabado']['acabado'];
						} else {
							echo 'Sin acabado';
						}
						?>
					</td>
					<td style = "text-align: center">
						<?php echo $p['Articulo']['cantidad_por_caja'] ?>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<?php } ?>
</div>	
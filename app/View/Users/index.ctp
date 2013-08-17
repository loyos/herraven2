<?php  //debug($usuario); ?>
<div class="wrap">
	<div class = "perfil">
		<div class = "perfil_arriba">
			<div class = "foto">
				<?php echo $this->Html->image('users/'. $usuario['User']['imagen'], array('width' => '120px;', 'height' => '100px;')); ?>
			</div>
			<div class = "username">
				<?php echo $usuario['User']['nombre'].' '. $usuario['User']['apellido'].' <span>('. $usuario['User']['username']. ')</span> '; ?>
			</div>
			<div class = "editar_perfil">
			<?php 		
				echo $this->Html->link('Editar',array('action' => 'editar',$usuario['User']['id']));
			?>
			</div>
		</div>
		<div class = "perfil_abajo">
			<table>
				<tr>
					<td>
						<span> Denominación Legal: </span>
					</td>
					<td>
						<?php echo $usuario['Cliente']['denominacion_legal']; ?>
					</td>
				</tr>
				<tr>
					<td>
						<span> RIF: </span>
					</td>
					<td>
						<?php echo $usuario['Cliente']['rif']; ?>
					</td>
				</tr>
				<tr>
					<td>
						<span> Representante: </span> 
					</td>
					<td>
						<?php echo $usuario['Cliente']['representante']; ?>
					</td>
				</tr>
				<tr>
					<td>
						<span> Ciudad: </span> 
					</td>
					<td>
						<?php echo $usuario['Cliente']['ciudad']; ?>
					</td>
				</tr>
				<tr>
					<td>
						<span>Dirección:</span> 
					</td>
					<td>
						<?php echo $usuario['Cliente']['direccion']; ?>
					</td>
				</tr>
				<tr>
					<td>
						<span>Teléfonos: </span>
					</td>
					<td>
						<?php echo $usuario['Cliente']['telefono_uno'].' / '. $usuario['Cliente']['telefono_uno']; ?>
					</td>
				</tr>
				<tr>
					<td>
						<span>Email Representante: </span>
					</td>
					<td>
						<?php echo $usuario['Cliente']['email_representante']; ?>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
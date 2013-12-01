<div class="wrap_contenido">
	<div class = "login">
		<?php
		echo $this->Session->flash('auth');
		echo $this->Form->create('User');
		echo '<table><tr><td>';
		echo 'Nombre de Usuario:';
		echo '</td><td>';
		echo $this->Form->input('username',array(
			'label' => false
		));
		echo '</td><tr><td>';
		echo 'Password:</td><td>';
		echo $this->Form->input('password',array(
			'label' => false
		));
		echo '</td></tr></table><br>';
		echo $this->Form->submit('Entrar', array('class' => 'button'));
		echo $this->Form->end;
		echo "<br>";
		echo $this->Html->link('¿Olvidaste tu contraseña?',array('controller' => 'users', 'action' => 'reset_password'));
		?>
	</div>
</div>

<div class = "footer_contenido">
	<div class = "texto_footer">
		© Herrajes y Accesorios Herraven s.a. Todos los derechos reservados. RIF J-30800588-6
	</div>
</div>
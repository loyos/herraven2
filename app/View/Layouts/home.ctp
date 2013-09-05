<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<?php
	echo $this->Html->meta('icon');
	echo $this->Html->css('style');
	echo $this->Html->css('bjqs');
	echo $this->Html->css('demo');
	echo $this->Html->css('fancybox/jquery.fancybox');
	echo $this->Html->css('fancybox/jquery.fancybox-buttons');
	echo $this->Html->css('fancybox/jquery.fancybox-thumbs');
	echo $this->Html->script('jquery-2.0.2.min');
	echo $this->Html->script('fancybox/jquery.fancybox');	
	echo $this->Html->script('fancybox/jquery.fancybox-buttons');	
	echo $this->Html->script('fancybox/jquery.fancybox-thumbs');	
	echo $this->Html->script('fancybox/jquery.fancybox-media');	
	echo $this->Html->script('fancybox/jquery.mousewheel-3.0.6.pack');
	echo $this->Html->script('bjqs-1.3.min');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
</head>
<body>		
	<div id="container" class = "home_body">
		<div class = "main_header">
			<div class = "home_menu">
				<div class = "main_titulo">
					Herraven
				</div>
				<div class = "main_subtitulo">
					fábrica
				</div>
				<?php echo $this->element('home_menu'); ?>
			</div>
		</div>
		<div id="content" class = "contenido">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<div class="home_footer">
		<div class = "footer_content">
			Derechos reservados - Herraven 2013 - Política de Privacidad - Desarrollado por gente chévere
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
<script>
$(document).ready(function() {
	$('#flashMessage').delay(2000).fadeOut(2000);
 });
	
</script>
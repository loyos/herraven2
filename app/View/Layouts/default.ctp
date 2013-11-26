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

<script>

  </script>

	<?php echo $this->Html->charset(); ?>
	<title>
		
	</title>
	<link href='http://fonts.googleapis.com/css?family=Kameron' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  
	<?php	
	echo $this->Html->meta('icon');
	echo $this->Html->css('style');
	echo $this->Html->css('fancybox/jquery.fancybox');
	echo $this->Html->css('fancybox/jquery.fancybox-buttons');
	echo $this->Html->css('fancybox/jquery.fancybox-thumbs');
	echo $this->Html->script('jquery-2.0.2.min');
	echo $this->Html->script('fancybox/jquery.fancybox');	
	echo $this->Html->script('fancybox/jquery.fancybox-buttons');	
	echo $this->Html->script('fancybox/jquery.fancybox-thumbs');	
	echo $this->Html->script('fancybox/jquery.fancybox-media');	
	echo $this->Html->script('fancybox/jquery.mousewheel-3.0.6.pack');
	echo $this->Html->script('jquery-ui-1.10.3.custom.min');
	echo $this->Html->script('tiny_mce');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
	
	<script>
		
		 // $(document).tooltip();
		 
		  $(function() {
    $( document ).tooltip({
      position: {
        my: "center bottom+80",
        at: "center top",
        using: function( position, feedback ) {
          $( this ).css( position );
          $( "<div>" )
        }
      }
    });
  });
	
	</script>
	
	<style>
 
  .ui-tooltip {
    padding: 10px 20px;
    color: white;
    border-radius: 10px;
    font: bold 14px "Helvetica Neue", Sans-Serif;
    // text-transform: uppercase;
    box-shadow: 0 0 7px black;
	background: #515669;
  }
  </style>
</head>
<body>
	<div class="header">
		<div class = "title">
			
		</div>
		<div class = 'user-header'>
			<?php echo $this->Html->link($username, array('controller' => 'users', 'action' => 'index'), array('title' => 'Ver Perfil de Usuario'))  ?>
		</div>
		<div class="logout">
		<?php 
		if (!empty($user_id)) {
			echo $this->Html->link($this->Html->image('close.png', array('width' => '30px', 'title' => 'Cerrar Sesión')),array(
				'controller' => 'users',
				'action' => 'logout',
			), array('escape' => false));
			// echo $this->Html->image('close.png', array('width' => '30px'));
		}
		?>
		</div>
	</div>
	
	<div class = "menu_container">
		<?php echo $this->element('menu'); ?>
	</div>
	
	<div id="container">
		
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		
	</div>
	<?php echo $this->element('sql_dump'); ?>
	<div id="footer" class = "footer_interno">
		<div class = "footer_interno_content">
			© Herrajes y Accesorios Herraven s.a. Todos los derechos reservados. RIF J-30800588-6
 		</div>
	</div>
</body>
</html>
<script>
$(document).ready(function() {
	$('#flashMessage').delay(2000).fadeOut(2000);
 });
	
</script>
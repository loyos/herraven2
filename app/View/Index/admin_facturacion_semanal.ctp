<div class="wrap">
	<?php echo $this->Html->link('Regresar',array('action' => 'admin_reportes_semanales'),array('class'=>'boton')); ?>
	<h1>Facturación semanal</h1>
	
	<div id="areawrapper" style="display: block; float: left; width:90%;  text-align:center"></div>
    <div class="clear"></div>	
	
	<?php echo $this->HighCharts->render('Chart Area'); ?>

</div>
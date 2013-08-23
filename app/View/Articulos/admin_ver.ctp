<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index',$cat_id,$sub_id));
echo '<br>';
echo $this->Html->link('Ver reporte',array('action' => 'admin_ver',$id,$cat_id,$sub_id,'ext' => 'pdf'),array('target'=>'_blank'));
echo $this->element('admin_ver_articulo');
?>

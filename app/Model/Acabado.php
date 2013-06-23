<?php
class Acabado extends AppModel {
    var $name = 'Acabado';
	
	public $hasMany = array(
		'Inventarioalmacen' => array(
			'className'  => 'Inventarioalmacen',
			'foreignKey'    => 'acabado_id',
		),
		'Pedido' => array(
			'className'  => 'Pedido',
			'foreignKey'    => 'acabado_id',
		)
    );
}
?>
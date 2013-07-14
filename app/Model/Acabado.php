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
	var $validate = array(
        'acabado' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vac�o.'
		),
		'descripcion' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vac�o.'
		),
    );
}
?>
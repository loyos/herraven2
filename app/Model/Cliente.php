<?php
class Cliente extends AppModel {
    var $name = 'Cliente';
	
	public $belongsTo = array(
        'Precio' => array(
            'className'    => 'Precio',
            'foreignKey'   => 'precio_id'
        ),
    );
	
	public $hasMany = array(
		'Pedido' => array(
			'className'  => 'Pedido',
			'foreignKey'    => 'cliente_id',
		),
		'User' => array(
			'className'  => 'User',
			'foreignKey'    => 'cliente_id',
		),
    );
}



?>
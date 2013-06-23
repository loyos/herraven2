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
		'Usuario' => array(
			'className'  => 'Usuario',
			'foreignKey'    => 'cliente_id',
		),
    );
}



?>
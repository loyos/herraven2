<?php
class Inventarioalmacen extends AppModel {
    var $name = 'Inventarioalmacen';

	public $belongsTo = array(
        'Articulo' => array(
            'className'    => 'Articulo',
            'foreignKey'   => 'articulo_id'
        ),
		'Acabado' => array(
			'className'    => 'Acabado',
            'foreignKey'   => 'acabado_id'
		),
		'Pedido' => array(
			'className'    => 'Pedido',
            'foreignKey'   => 'pedido_id'
		)
    );
	
	public $hasMany = array(
        'Caja' => array(
            'className'  => 'Caja',
			'foreignKey'    => 'inventarioalmacen_id',
        )
    );
}



?>
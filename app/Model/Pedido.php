<?php
class Pedido extends AppModel {
    var $name = 'Pedido';
	
	public $belongsTo = array(
        'Articulo' => array(
            'className'    => 'Articulo',
            'foreignKey'   => 'articulo_id'
        ),
		'Cliente' => array(
            'className'    => 'Cliente',
            'foreignKey'   => 'cliente_id'
        ),
		'Acabado' => array(
            'className'    => 'Acabado',
            'foreignKey'   => 'acabado_id'
        ),
    );
	
	
	var $hasAndBelongsToMany = array(
        'Caja' =>
            array('className'            => 'Caja',
                 'joinTable'              => 'cajas_pedidos',
                 'foreignKey'             => 'pedido_id',
                 'associationForeignKey'  => 'caja_id',
            )
    );
}



?>
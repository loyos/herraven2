<?php
class Caja extends AppModel {
    var $name = 'Caja';
	
   public $belongsTo = array(
        'Inventarioalmacen' => array(
            'className'    => 'Inventarioalmacen',
            'foreignKey'   => 'inventarioalmacen_id'
        ),
    );
	
	var $hasAndBelongsToMany = array(
        'Pedido' =>
            array('className'            => 'Pedido',
                 'joinTable'              => 'cajas_pedidos',
                 'foreignKey'             => 'caja_id',
                 'associationForeignKey'  => 'pedido_id',
            )
    );
}



?>
<?php
class Precio extends AppModel {
    var $name = 'Precio';
	
	public $hasMany = array(
		'Cliente' => array(
			'className'  => 'Cliente',
			'foreignKey'    => 'pedido_id',
		)
    );
	
	var $hasAndBelongsToMany = array(
        'Materiasprima' =>
            array('className'            => 'Materiasprima',
                 'joinTable'              => 'materiasprimas_precios',
                 'foreignKey'             => 'precio_id',
                 'associationForeignKey'  => 'materiasprima_id',
            )
    );
}



?>
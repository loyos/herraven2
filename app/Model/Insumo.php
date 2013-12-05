<?php
class Insumo extends AppModel {
    var $name = 'Insumo';
	
   public $belongsTo = array(
        'Unidad' => array(
            'className'    => 'Unidad',
            'foreignKey'   => 'unidad_id'
        ),
		'Lote' => array(
            'className'    => 'Lote',
            'foreignKey'   => 'lote_id'
        ),
    );
	
	var $hasAndBelongsToMany = array(
        'Proveedor' =>
            array('className'            => 'Proveedor',
                 'joinTable'              => 'insumos_proveedors',
                 'foreignKey'             => 'insumo_id',
                 'associationForeignKey'  => 'proveedor_id',
        ),
    );
}



?>
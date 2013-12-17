<?php
class Herramienta extends AppModel {
    var $name = 'Herramienta';
	
	public $belongsTo = array(
		'Lotesherramienta' => array(
            'className'    => 'Lotesherramienta',
            'foreignKey'   => 'lotesherramienta_id'
        ),
    );
	
	public $hasAndBelongsToMany = array(
        'Proveedor' =>
            array('className'            => 'Proveedor',
                 'joinTable'              => 'herramientas_proveedors',
                 'foreignKey'             => 'herramienta_id',
                 'associationForeignKey'  => 'proveedor_id',
        ),
    );
}
?>
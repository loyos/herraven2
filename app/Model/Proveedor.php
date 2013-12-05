<?php
class Proveedor extends AppModel {
    var $name = 'Proveedor';
	
	var $hasAndBelongsToMany = array(
        'Herramienta' =>
            array('className'            => 'Herramienta',
                 'joinTable'              => 'herramientas_proveedors',
                 'foreignKey'             => 'proveedor_id',
                 'associationForeignKey'  => 'herramienta_id',
        ),
		'Insumo' =>
            array('className'            => 'Insumo',
                 'joinTable'              => 'insumos_proveedors',
                 'foreignKey'             => 'proveedor_id',
                 'associationForeignKey'  => 'insumo_id',
        ),
		'Materiasprima' =>
            array('className'            => 'Materiasprima',
                 'joinTable'              => 'materiasprimas_proveedors',
                 'foreignKey'             => 'proveedor_id',
                 'associationForeignKey'  => 'materiasprima_id',
        ),
    );
}
?>
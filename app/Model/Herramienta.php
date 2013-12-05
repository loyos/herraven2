<?php
class Herramienta extends AppModel {
    var $name = 'Herramienta';
	
	var $hasAndBelongsToMany = array(
        'Proveedor' =>
            array('className'            => 'Proveedor',
                 'joinTable'              => 'herramientas_proveedors',
                 'foreignKey'             => 'herramienta_id',
                 'associationForeignKey'  => 'proveedor_id',
        ),
    );
}
?>
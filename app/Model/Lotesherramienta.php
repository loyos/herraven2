<?php
class Lotesherramienta extends AppModel {
    var $name = 'Lotesherramienta';
	
	public $hasMany = array(
        'Herramienta' => array(
            'className'  => 'Herramienta',
			'foreignKey'    => 'lote_id',
        )
    );
	
	public $belongsTo = array(
        'Unidad' => array(
            'className'    => 'Unidad',
            'foreignKey'   => 'unidad_id'
        ),
    );
	
}



?>
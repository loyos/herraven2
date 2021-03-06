<?php
class Lote extends AppModel {
    var $name = 'Lote';
	
	public $hasMany = array(
        'Insumo' => array(
            'className'  => 'Insumo',
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
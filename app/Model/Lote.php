<?php
class Lote extends AppModel {
    var $name = 'Lote';
	
	public $hasMany = array(
        'Unidad' => array(
            'className'  => 'Unidad',
			'foreignKey'    => 'lote_id',
        )
    );
	
}



?>
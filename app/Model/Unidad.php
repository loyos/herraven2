<?php
class Unidad extends AppModel {
    var $name = 'Unidad';
	
	public $hasMany = array(
        'Insumo' => array(
            'className'  => 'Insumo',
			'foreignKey'    => 'unidad_id',
        ),
		'Materiasprima' => array(
            'className'  => 'Materiasprima',
			'foreignKey'    => 'unidad_id',
        ),
    );
	
	 public $belongsTo = array(
        'User' => array(
            'className'    => 'User',
            'foreignKey'   => 'user_id'
        ),
		'Departamento' => array(
            'className'    => 'Departamento',
            'foreignKey'   => 'departamento_id'
        ),
    );
	
}



?>
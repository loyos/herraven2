<?php
class Departamento extends AppModel {
    var $name = 'Departamento';
	
	public $hasMany = array(
        'Unidad' => array(
            'className'  => 'Unidad',
			'foreignKey'    => 'departamento_id',
        )
    );
	
	 public $belongsTo = array(
        'User' => array(
            'className'    => 'User',
            'foreignKey'   => 'user_id'
        ),
		'Division' => array(
            'className'    => 'Division',
            'foreignKey'   => 'division_id'
        ),
    );
	
}



?>
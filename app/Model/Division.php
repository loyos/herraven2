<?php
class Division extends AppModel {
    var $name = 'Division';
	
	public $hasMany = array(
        'Departamento' => array(
            'className'  => 'Departamento',
			'foreignKey'    => 'division_id',
        )
    );
	
	public $belongsTo = array(
        'User' => array(
            'className'    => 'User',
            'foreignKey'   => 'user_id'
        ),
    );
	
}



?>
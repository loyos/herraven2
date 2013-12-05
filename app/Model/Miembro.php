<?php
class Miembro extends AppModel {
    var $name = 'Miembro';
	
	 public $belongsTo = array(
        'User' => array(
            'className'    => 'User',
            'foreignKey'   => 'user_id'
        ),
		'Unidad' => array(
            'className'    => 'Unidad',
            'foreignKey'   => 'unidad_id'
        ),
    );
	
}



?>
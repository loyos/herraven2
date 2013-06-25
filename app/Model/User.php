<?php
class User extends AppModel {
    var $name = 'User';
	
	public $belongsTo = array(
        'Cliente' => array(
            'className'    => 'Cliente',
            'foreignKey'   => 'cliente_id'
        ),
    );
	
	public static $roles = array(
		'cliente' => 'Cliente',
		'admin' => 'Administrador'
	);
}



?>
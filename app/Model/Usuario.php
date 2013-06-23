<?php
class Usuario extends AppModel {
    var $name = 'Usuario';
	
	public $belongsTo = array(
        'Cliente' => array(
            'className'    => 'Cliente',
            'foreignKey'   => 'cliente_id'
        ),
    );
}



?>
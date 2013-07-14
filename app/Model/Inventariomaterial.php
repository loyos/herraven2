<?php
class Inventariomaterial extends AppModel {
    var $name = 'Inventariomaterial';

	public $belongsTo = array(
        'Materiasprima' => array(
            'className'    => 'Materiasprima',
            'foreignKey'   => 'materiasprima_id'
        ),
    );
	
	var $validate = array( 
		'cantidad' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
    ); 
}



?>
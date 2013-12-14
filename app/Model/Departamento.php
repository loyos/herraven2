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
	
	var $validate = array( 
		'user_id' => array(
			'required' => array(
				'rule' => array('no_empty_jefe'),
				'message' => 'Este campo no puede quedar vacío.g'
			)
		),
		
		'nombre' => array(
			'not_empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo no puede quedar vacío.'
			), 
		),
		
		'descripcion' => array(
			'not_empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo no puede quedar vacío.'
			), 
		),
		
		'numero' => array(
			'not_empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo no puede quedar vacío.'
			), 
		),
	);
	
	function no_empty_jefe($data){ 
		if($data["user_id"] != 0) {
			return true;
		} 
		return false;
	}
}



?>
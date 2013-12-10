<?php
class User extends AppModel {
    var $name = 'User';
	
	public $belongsTo = array(
        'Cliente' => array(
            'className'    => 'Cliente',
            'foreignKey'   => 'cliente_id'
        ),
    );
	
	public $hasMany = array(
        'Unidad' => array(
            'className'  => 'Unidad',
			'foreignKey'    => 'user_id',
        ),
		'Miembro' => array(
            'className'  => 'Miembro',
			'foreignKey'    => 'user_id',
        ),
		'Departamento' => array(
            'className'  => 'Departamento',
			'foreignKey'    => 'user_id',
        ),
		'Division' => array(
            'className'  => 'Division',
			'foreignKey'    => 'user_id',
        )
    );
	
	public static $roles = array(
		'cliente' => 'Cliente',
		'admin' => 'Administrador'
	);
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}
	
	var $validate = array(
        'username' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo no puede quedar vacío.'
			),
			'unico' => array(
				'rule' => 'isUnique',
				'message' => 'Este nombre de usuario ya ha sido asignado.'
			)
		),
		'password' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'email' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'nombre' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'apellido' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'rol' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'cliente_id' => array(
			'rule' => 'notEmpty_f',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'imagen' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
    );
	
	function notEmpty_f($field){
		if ($this->data['User']['rol'] == 'cliente') {
			if (empty($field['cliente_id'])) {
				return false;
			}
			return true;
		}
		return true;
	}
}



?>
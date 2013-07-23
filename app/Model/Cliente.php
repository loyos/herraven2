<?php
class Cliente extends AppModel {
    var $name = 'Cliente';
	
	public $belongsTo = array(
        'Precio' => array(
            'className'    => 'Precio',
            'foreignKey'   => 'precio_id'
        ),
    );
	
	public $hasMany = array(
		'Pedido' => array(
			'className'  => 'Pedido',
			'foreignKey'    => 'cliente_id',
		),
		'User' => array(
			'className'  => 'User',
			'foreignKey'    => 'cliente_id',
		),
    );
	
	 var $validate = array(
        'denominacion_legal' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vac�o.'
		),
		'rif' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vac�o.'
		),
		'representante' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vac�o.'
		),
		'ciudad' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vac�o.'
		),
		'direccion' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vac�o.'
		),
		'direccion_despacho' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vac�o.'
		),
		'telefono_uno' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vac�o.'
		),
		'email_representante' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vac�o.'
		),
		'precio_id' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vac�o.'
		),
		'codigo_uno' => array(
			'rule' => 'notEmpty',
			'message' => 'Debes colocar un c�digo, por ejemplo 0212.'
		),
    );
}



?>
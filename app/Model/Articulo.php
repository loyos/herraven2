<?php
class Articulo extends AppModel {
    var $name = 'Articulo';
	
	public $belongsTo = array(
        'Subcategoria' => array(
            'className'    => 'Subcategoria',
            'foreignKey'   => 'subcategoria_id'
        ),
    );
	
	public $hasMany = array(
		'Inventarioalmacen' => array(
			'className'  => 'Inventarioalmacen',
			'foreignKey'    => 'articulo_id',
		),
		'Pedido' => array(
			'className'  => 'Pedido',
			'foreignKey'    => 'articulo_id',
		)
    );
	
	var $hasAndBelongsToMany = array(
        'Materiasprima' =>
            array('className'            => 'Materiasprima',
                 'joinTable'              => 'articulos_materiasprimas',
                 'foreignKey'             => 'articulo_id',
                 'associationForeignKey'  => 'materiasprima_id',
            )
    );
	
	var $validate = array( 
		'cantidad_por_caja' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vac�o.'
		),
		'descripcion' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vac�o.'
		),
		'imagen' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vac�o.'
		),
		'codigo' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vac�o.'
		),
    ); 
}

function multiple_materia(){
	var_dump($this->data);die();
}


?>
<?php
class Materiasprima extends AppModel {
    var $name = 'Materiasprima';
	
	var $hasAndBelongsToMany = array(
        'Articulo' =>
            array('className'            => 'Articulo',
                 'joinTable'              => 'articulos_materiasprimas',
                 'foreignKey'             => 'materiasprima_id',
                 'associationForeignKey'  => 'articulo_id',
        ),
		// 'Precio' =>
            // array('className'            => 'Precio',
                 // 'joinTable'              => 'materiasprimas_precios',
                 // 'foreignKey'             => 'materiasprima_id',
                 // 'associationForeignKey'  => 'precio_id',
        // ),
    );
	
	public $hasMany = array(
        'Inventariomaterial' => array(
            'className'  => 'Inventariomaterial',
			'foreignKey'    => 'materiasprima_id',
        )
    );
	
	var $validate = array( 
		'unidad' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'descripcion' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'precio' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
    ); 
}
?>
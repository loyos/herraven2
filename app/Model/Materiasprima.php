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
		'Acabado' =>
            array('className'            => 'Acabado',
                 'joinTable'              => 'acabados_materiasprimas',
                 'foreignKey'             => 'materiasprima_id',
                 'associationForeignKey'  => 'acabado_id',
        ),
		'Proveedor' =>
            array('className'            => 'Proveedor',
                 'joinTable'              => 'materiasprimas_proveedors',
                 'foreignKey'             => 'materiasprima_id',
                 'associationForeignKey'  => 'proveedor_id',
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
	
	public $belongsTo = array(
        'Unidad' => array(
            'className'    => 'Unidad',
            'foreignKey'   => 'unidad_id'
        ),
    );
	
	var $validate = array( 
		'unidad' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'descripcion' => array(
			'not_empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo no puede quedar vacío.'
			),
			'unico' => array(
				'rule' => 'isUnique',
				'message' => 'Esta materia prima ya existe.'
			)
		),
		'precio' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		)
    ); 
}
?>
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
			'message' => 'Este campo no puede quedar vacío.'
		),
		'descripcion' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'imagen' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'codigo' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
    );
	
	function calcular_precio($id){
	
		$precio_materias = 0;
		$costo_produccion = 0;
		$costo_total = 0;
		$margen_ganancia = 0;
		$precio_total = 0;
		
		$articulo = $this->find('first', array(
			'conditions' => array(
				'Articulo.id' => $id
			)
		));
		
		foreach($articulo['Materiasprima'] as $art){
			$precio_materias = $precio_materias + $art['precio']*$art['ArticulosMateriasprima']['cantidad'];
		}
		$costo_produccion = $precio_materias * ($articulo['Articulo']['costo_produccion']/100);
		$costo_total = $precio_materias + $costo_produccion;
		$margen_ganancia = $costo_total * ($articulo['Articulo']['margen_ganancia']/100);
		$precio_total = $costo_total + $margen_ganancia;
		
		return(round($precio_total));
		
	}	
}

?>
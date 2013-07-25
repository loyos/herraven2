<?php
class Articulo extends AppModel {
    var $name = 'Articulo';
	public $actsAs = array('Search.Searchable');
	
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
			'not_empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo no puede quedar vacío.'
			), 
			'mayor_a_cero' => array(
				'rule' => array('comparison', '>=', 0),
				'message' => 'El número de cajas debe ser mayor a 0'
			)
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
	
	// aqui se configura el filtro
	
	public $filterArgs = array(
		// 'descripcion' => array('type' => 'subquery', 'method' => 'forecast')
		'descripcion' => array('type' => 'like', 'field' => 'Subcategoria.descripcion'),
		// 'descripcion' => array('type' => 'subquery', 'method' => 'forecast', 'field' => 'descripcion'),
		// 'wachu' => array('type' => 'like', 'field' => 'Categoria.descripcion'),
	);
	
	public function forecast($data = array()){
	
		debug($data);
		$tag = $data['descripcion'];
		$query = $this->getQuery('all', array(
            'conditions' => array('Articulo.descripcion LIKE'  => '%'. $tag .'%' ),
			'contain' => array('Subcategoria')
        ));
		
		//die();
		debug($query);
        return $query;
	}
	
	public function forecast2($data = array()){
		debug($data);
		
		$query_sub = $this->find('all', array(
            'conditions' => array('Subcategoria.descripcion LIKE'  => '%'. $data['descripcion_sub'] .'%' ),
        ));
		die();
		debug($query_sub);
        return $query_sub;
	}
	
	function calcular_precio($id, $ganancia = null){
	
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
		
		if(empty($ganancia)){
			foreach($articulo['Materiasprima'] as $art){
				$precio_materias = $precio_materias + $art['precio']*$art['ArticulosMateriasprima']['cantidad'];
			}
		}else{
			foreach($articulo['Materiasprima'] as $art){
				$precio_materias = $precio_materias + ($art['precio']+$art['precio']*($ganancia/100))*$art['ArticulosMateriasprima']['cantidad'];
			}
		}
		$costo_produccion = $precio_materias * ($articulo['Articulo']['costo_produccion']/100);
		$costo_total = $precio_materias + $costo_produccion;
		$margen_ganancia = $costo_total * ($articulo['Articulo']['margen_ganancia']/100);
		$precio_total = $costo_total + $margen_ganancia;
		
		// debug($precio_total);
		// die();
		
		return(round($precio_total));
		
	}	
}

?>
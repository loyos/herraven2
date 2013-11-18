<?php
class Pedido extends AppModel {
    var $name = 'Pedido';
	
	public $actsAs = array('Search.Searchable');
	
	public $belongsTo = array(
        'Articulo' => array(
            'className'    => 'Articulo',
            'foreignKey'   => 'articulo_id'
        ),
		'Cliente' => array(
            'className'    => 'Cliente',
            'foreignKey'   => 'cliente_id'
        ),
		'Acabado' => array(
            'className'    => 'Acabado',
            'foreignKey'   => 'acabado_id'
        ),
    );
	
	public $hasMany = array(
		'CajasPedido' => array(
			'className'  => 'CajasPedido',
			'foreignKey'    => 'pedido_id',
		),
    );
	
	var $hasAndBelongsToMany = array(
        'Caja' =>
            array('className'            => 'Caja',
                 'joinTable'              => 'cajas_pedidos',
                 'foreignKey'             => 'pedido_id',
                 'associationForeignKey'  => 'caja_id',
            )
    );
	
	public $filterArgs = array(
		'status' => array('type' => 'query', 'method' => 'orConditions'),
		//'denominacion_legal' => array('type' => 'like', 'field' => 'Cliente.denominacion_legal'),
		'acabado' => array('type' => 'like', 'field' => 'Acabado.acabado'),
		'cliente' => array('type' => 'like', 'field' => 'Pedido.cliente_id'),
	);
	
	public function orConditions($data = array()) {
        $status = $data['status'];
		if($status == 'Pendiente'){
			$cond = array(
					$this->alias . '.status !=' => array('Despachado', 'Cancelado'),
				);
		} else {
			$cond = array(
					$this->alias . '.status LIKE' => '%' . $status . '%',
				);
		}
        return $cond;
    }
	
	public function numero_semana($fecha = null){  // funcion que calcula semana del ano
													// la semana empieza los jueves, termina los miercoles.
		
		// $fecha = $this->find('first');
		// debug($fecha['Pedido']['fecha']);
		// $fecha = strtotime($fecha['Pedido']['fecha']);
		// $fecha = strtotime('2013-09-5');
		
		$fecha = strtotime($fecha);
		$dia_semana = date( "N", $fecha);  // numero de dia en la semana
		$n_semana = date( "W", $fecha);  // numero de la semana
		if($dia_semana == '1' || $dia_semana == '2' || $dia_semana == '3'){
			$n_semana = $n_semana - 1; 
		}
		return $n_semana;
	}
	
}



?>
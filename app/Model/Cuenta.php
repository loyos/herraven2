<?php
class Cuenta extends AppModel {
    var $name = 'Cuenta';
	public $actsAs = array('Search.Searchable');
	
	public $belongsTo = array(
        'Pedido' => array(
            'className'    => 'Pedido',
            'foreignKey'   => 'pedido_id'
        ),
    );
	
	public $filterArgs = array(
		// 'descripcion' => array('type' => 'subquery', 'method' => 'forecast')
		'cliente' => array('type' => 'like', 'field' => 'Pedido.cliente_id'),
		// 'descripcion' => array('type' => 'subquery', 'method' => 'forecast', 'field' => 'descripcion'),
		// 'wachu' => array('type' => 'like', 'field' => 'Categoria.descripcion'),
	);

}



?>
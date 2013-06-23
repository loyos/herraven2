<?php
class Cuenta extends AppModel {
    var $name = 'Cuenta';
	
	public $belongsTo = array(
        'Pedido' => array(
            'className'    => 'Pedido',
            'foreignKey'   => 'pedido_id'
        ),
    );

}



?>
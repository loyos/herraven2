<?php
class Categoria extends AppModel {
    var $name = 'Categoria';
	
	public $hasMany = array(
        'Subcategoria' => array(
            'className'  => 'Subcategoria',
			'foreignKey'    => 'categoria_id',
        )
    );
}



?>
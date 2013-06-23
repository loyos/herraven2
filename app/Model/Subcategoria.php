<?php
class Subcategoria extends AppModel {
    var $name = 'Subcategoria';
	
   public $belongsTo = array(
        'Categoria' => array(
            'className'    => 'Categoria',
            'foreignKey'   => 'categoria_id'
        ),
    );
	public $hasMany = array(
        'Articulo' => array(
            'className'  => 'Articulo',
			'foreignKey'    => 'subcategoria_id',
        )
    );
}



?>
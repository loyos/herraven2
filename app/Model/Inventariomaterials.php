<?php
class Inventariomaterial extends AppModel {
    var $name = 'Inventariomaterial';

	public $belongsTo = array(
        'Materiasprima' => array(
            'className'    => 'Materiasprima',
            'foreignKey'   => 'materiasprima_id'
        ),
    );
}



?>
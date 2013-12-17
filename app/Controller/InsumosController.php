<?php
App::uses('CakeEmail', 'Network/Email');
class InsumosController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop');
	var $uses = array('User','Lote','Config','Insumo','Departamento');
	
	 public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('editar','login','logout','reset_password'); // Letting users register themselves
	}
	
	function admin_index_lotes() {
		$lotes = $this->Lote->find('all');
		$this->set(compact('lotes'));
	}
	
}

?>
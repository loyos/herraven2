<?php

class HomeController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'contenido'); // Letting users register themselves
	}
	
    function index() {
		// $debug($this->layout = 'hola');
		$this->layout = 'home';
    }
	
	function contenido($id){
		$this->layout = 'home';
	}
}

?>
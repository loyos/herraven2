<?php

class IndexController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index'); // Letting users register themselves
	}
	
    function index() {
		
    }
}

?>
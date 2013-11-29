<?php

class HomeController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('RequestHandler');
	var $uses = array('Contenido','Imagen');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'contenido', 'contacto'); // Letting users register themselves
	}
	
    function index() {
		// $debug($this->layout = 'hola');
		$this->layout = 'home';
		$menu = $this->Contenido->find('all');
		$imagenes = $this->Imagen->find('all');
		$this->set(compact('menu','imagenes'));
    }
	
	function contenido($id = null){
		$this->layout = 'home';
		$contenido = $this->Contenido->find('first', array('conditions' => array(
			'id' => $id
		))); // esto podria colocarse en app controller, pero como son solo dos acciones
		$menu = $this->Contenido->find('all');
		$this->set(compact('menu','contenido')); // me dio flojera jejeje
		
	}
	
	function contacto(){
		$this->layout = 'home';
		$menu = $this->Contenido->find('all'); // esto podria colocarse en app controller, pero como son solo dos acciones
		$this->set(compact('menu')); // me dio flojera jejeje
	}
}

?>
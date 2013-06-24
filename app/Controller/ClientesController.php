<?php

class ClientesController extends AppController {
    
	public $helpers = array ('Html','Form');
	
    function index() {
		$clientes = $this->Cliente->find('all');
		$this->set(compact('clientes'));
    }
	
	function editar($id = null) {
		if (!empty($this->data)) {
			$this->Cliente->save($this->data);
			$this->redirect(array('action' => 'index'));
		} elseif (!empty($id)) {
			$this->data = $this->Cliente->findById($id);
		}
		$this->set(compact('id'));
	}
	
	function eliminar($id) {
		$this->Cliente->delete($id);
		$this->redirect(array('action' => 'index'));
	}
	
	function ver($id) {
		$cliente = $this->Cliente->findById($id);
		$this->set(compact('cliente'));
	}
}

?>
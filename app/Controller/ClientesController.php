<?php

class ClientesController extends AppController {
    
	public $helpers = array ('Html','Form');
	var $uses = array('Cliente','Precio');
	
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
			$titulo = 'Editar';
		} else {
			$titulo = 'Agregar';
		}
		$precios = $this->Precio->find('list',array(
			'fields' => array('id','descripcion')
		));
		$this->set(compact('id','titulo','precios'));
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
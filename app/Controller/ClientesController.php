<?php

class ClientesController extends AppController {
    
	public $helpers = array ('Html','Form');
	var $uses = array('Cliente','Precio');
	
    function admin_index() {
		$clientes = $this->Cliente->find('all');
		$this->set(compact('clientes'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			if ($this->Cliente->save($this->data)) {
				$this->Session->setFlash("Los datos se guardaron con éxito");
				$this->redirect(array('action' => 'admin_index'));
			}
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
	
	function admin_eliminar($id) {
		$this->Cliente->delete($id);
		$this->Session->setFlash("El cliente se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_ver($id) {
		$cliente = $this->Cliente->findById($id);
		$this->set(compact('cliente'));
	}
}

?>
<?php

class ContenidosController extends AppController {
    
	public $helpers = array ('Html','Form','Herra');
	var $uses = array('Contenido');
	
    function admin_index() {
		$contenidos = $this->Contenido->find('all');
		$this->set(compact('contenidos'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)){
			$this->Contenido->save($this->data);
			$this->Session->setFlash("El contenido se guardó con éxito");
			$this->redirect(array('action' => 'admin_index'));
		}
		if (!empty($id)) {
			$this->data = $this->Contenido->findById($id);
			//var_dump($this->data);
			$titulo = 'Editar';
		} else {
			$titulo = 'Agregar';
		}
		$this->set(compact('id','titulo'));
	}
	
	function admin_eliminar($id) {
		$this->Contenido->delete($id);
		$this->Session->setFlash("El contenido se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
}

?>
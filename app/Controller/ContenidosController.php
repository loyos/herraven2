<?php

class ContenidosController extends AppController {
    
	public $helpers = array ('Html','Form','Herra');
	var $uses = array('Contenido','Imagen');
	public $components = array('Session','JqImgcrop','RequestHandler', 'Search.Prg');
	
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
	
	function admin_home() {
		$imagenes = $this->Imagen->find('all');
		$this->set(compact('imagenes'));
	}
	
	function admin_agregar_imagen(){
		if (!empty($this->data)) {
			$data = $this->data;
			if (!empty($this->data['Imagen']['Foto']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['Imagen']['Foto'], 'img/home', '')) {
					$data['Imagen']['imagen'] = $this->data['Imagen']['Foto']['name'];
					$this->Imagen->save($data);
					$this->Session->setFlash("Se agrego una imagen con éxito");
					$this->redirect(array('action' => 'admin_home'));
				}
			}
		}
	}
	
	function admin_eliminar_imagen($id) {
		$this->Imagen->delete($id);
		$this->Session->setFlash("La imagen eliminó con éxito");
		$this->redirect(array('action' => 'admin_home'));
	}
}

?>
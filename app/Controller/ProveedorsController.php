<?php
App::uses('CakeEmail', 'Network/Email');
class ProveedorsController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop');
	var $uses = array('User','Herramienta','Config','Proveedor','MateriasPrima','Insumo','HerramientasProveedor','InsumosProveedor','MateriasprimasProveedor');
	
	 public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('editar','login','logout','reset_password'); // Letting users register themselves
	}
	
    function admin_index() {
		$proveedores = $this->Proveedor->find('all',array(
			'recursive' => 2
		));
		//debug($proveedores);
		$this->set(compact('proveedores'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			$data = $this->data;
			if ($this->Proveedor->validates()) {	
				if ($this->Proveedor->save($data,array('validate' => 'first'))) {	
					$this->Session->setFlash("Los datos se guardaron con éxito");
					$this->redirect(array('action' => 'admin_index'));
				}
			} else {
				$titulo = '';
			}
		} 
		if (!empty($id)) {
			$this->data = $this->Proveedor->findById($id);
			$titulo = 'Editar proveedor';
		} else {
			$titulo = 'Agregar proveedor';
		}
		
		$this->set(compact('id','titulo'));
	}
	
	function admin_eliminar($id) {
		$this->Proveedor->delete($id);
		//Busco en las tablas asociadas al proveedor
		$herramientas = $this->HerramientasProveedor->find('all',array(
			'conditions' => array(
				'HerramientasProveedor.proveedor_id' => $id
			)
		));
		foreach ($herramientas as $i){
			$this->HerramientasProveedor->delete($i['HerramientasProveedor']['id']);
		}
		
		$insumos = $this->InsumosProveedor->find('all',array(
			'conditions' => array(
				'InsumosProveedor.proveedor_id' => $id
			)
		));
		foreach ($insumos as $i){
			$this->InsumosProveedor->delete($i['InsumosProveedor']['id']);
		}
		
		$materias = $this->MateriasprimasProveedor->find('all',array(
			'conditions' => array(
				'MateriasprimasProveedor.proveedor_id' => $id
			)
		));
		foreach ($materias as $i){
			$this->InsumosProveedor->delete($i['MateriasprimasProveedor']['id']);
		}
		
		$this->Session->setFlash("El miembro del personal se elimino con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_ver($id) {
		$proveedor = $this->Proveedor->findById($id);
		$this->set(compact('proveedor'));
	}
}

?>
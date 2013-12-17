<?php
App::uses('CakeEmail', 'Network/Email');
class ProveedorsController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop');
	var $uses = array('User','Herramienta','Config','Proveedor','Materiasprima','Insumo','HerramientasProveedor','InsumosProveedor','MateriasprimasProveedor','Herramienta','Insumo');
	
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
		$this->HerramientasProveedor->deleteAll(array(
			'HerramientasProveedor.proveedor_id' => $id
		));
		$this->InsumosProveedor->deleteAll(array(
			'InsumosProveedor.proveedor_id' => $id
		));
		$this->MateriasprimasProveedor->deleteAll(array(
			'MateriasprimasProveedor.proveedor_id' => $id
		));
		
		$this->Session->setFlash("El proveedor se elimino con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_ver($id) {
		$proveedor = $this->Proveedor->findById($id);
		$this->set(compact('proveedor'));
	}
	
	function admin_agregar_herramientas($id){
		if (!empty($this->data)){
			$this->HerramientasProveedor->save($this->data);
			$this->Session->setFlash("Se agregó una herramienta");
			$this->redirect(array('action' => 'admin_agregar_herramientas',$this->data['HerramientasProveedor']['proveedor_id']));
		}
		$herramientas_proveedor = $this->Proveedor->find('first',array(
			'conditions' => array(
				'Proveedor.id' => $id
			),
			'recursive' => 2
		));

		$herr[] = 0;
		foreach ($herramientas_proveedor['Herramienta'] as $h) {
			$herr[]=$h['id'];
		}
		$herramientas = $this->Herramienta->find('list',array(
			'fields' => array('Herramienta.id','Herramienta.nombre'),
			'conditions' => array(
				'NOT' => array( 'Herramienta.id' => $herr)
			)
		));
		$this->set(compact('herramientas_proveedor','herramientas','id'));
	}
	
	function admin_eliminar_herramienta($id,$h_id) {
		//Eliminar la relacion con el proveedor
		$herramientas_proveedores = $this->HerramientasProveedor->find('first',array(
			'conditions' => array(
				'HerramientasProveedor.herramienta_id' => $h_id,
				'HerramientasProveedor.proveedor_id' => $id,
			)
		));
		$this->HerramientasProveedor->delete($herramientas_proveedores['HerramientasProveedor']['id']);
		$this->Session->setFlash("La herramienta se eliminó con éxito");
		$this->redirect(array('action' => 'admin_agregar_herramientas',$id));
	}
	
	function admin_agregar_insumos($id){
		if (!empty($this->data)){
			$this->InsumosProveedor->save($this->data);
			$this->Session->setFlash("Se agregó un insumo");
			$this->redirect(array('action' => 'admin_agregar_insumos',$this->data['InsumosProveedor']['proveedor_id']));
		}
		$insumos_proveedor = $this->Proveedor->find('first',array(
			'conditions' => array(
				'Proveedor.id' => $id
			),
			'recursive' => 2
		));

		$herr[] = 0;
		foreach ($insumos_proveedor['Insumo'] as $h) {
			$herr[]=$h['id'];
		}
		$insumos = $this->Insumo->find('list',array(
			'fields' => array('Insumo.id','Insumo.nombre'),
			'conditions' => array(
				'NOT' => array( 'Insumo.id' => $herr)
			)
		));
		$this->set(compact('insumos_proveedor','insumos','id'));
	}
	
	function admin_eliminar_insumo($id,$h_id) {
		//Eliminar la relacion con el proveedor
		$insumos_proveedores = $this->InsumosProveedor->find('first',array(
			'conditions' => array(
				'InsumosProveedor.insumo_id' => $h_id,
				'InsumosProveedor.proveedor_id' => $id,
			)
		));
		$this->InsumosProveedor->delete($insumos_proveedores['InsumosProveedor']['id']);
		$this->Session->setFlash("El insumo se eliminó con éxito");
		$this->redirect(array('action' => 'admin_agregar_insumos',$id));
	}
	
	function admin_agregar_materiasprima($id){
		if (!empty($this->data)){
			$this->MateriasprimasProveedor->save($this->data);
			$this->Session->setFlash("Se agregó una materia prima");
			$this->redirect(array('action' => 'admin_agregar_materiasprima',$this->data['MateriasprimasProveedor']['proveedor_id']));
		}
		$materias_proveedor = $this->Proveedor->find('first',array(
			'conditions' => array(
				'Proveedor.id' => $id
			),
			'recursive' => 2
		));

		$mat[] = 0;
		foreach ($materias_proveedor['Materiasprima'] as $h) {
			$mat[]=$h['id'];
		}
		$materiasprimas = $this->Materiasprima->find('list',array(
			'fields' => array('Materiasprima.id','Materiasprima.descripcion'),
			'conditions' => array(
				'NOT' => array( 'Materiasprima.id' => $mat)
			)
		));
		$this->set(compact('materias_proveedor','materiasprimas','id'));
	}
	
	function admin_eliminar_materiasprima($id,$h_id) {
		//Eliminar la relacion con el proveedor
		$materias_proveedores = $this->MateriasprimasProveedor->find('first',array(
			'conditions' => array(
				'MateriasprimasProveedor.materiasprima_id' => $h_id,
				'MateriasprimasProveedor.proveedor_id' => $id,
			)
		));
		$this->MateriasprimasProveedor->delete($materias_proveedores['MateriasprimasProveedor']['id']);
		$this->Session->setFlash("El insumo se eliminó con éxito");
		$this->redirect(array('action' => 'admin_agregar_materiasprima',$id));
	}
}

?>
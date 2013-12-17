<?php
App::uses('CakeEmail', 'Network/Email');
class HerramientasController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	var $uses = array('User','Lotesherramienta','Config','Herramienta','Departamento','Division','Unidad','HerramientasProveedor');
	
	 public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('editar','login','logout','reset_password'); // Letting users register themselves
	}
	
	function admin_index_lotes() {
		$lotes = $this->Lotesherramienta->find('all');
		$this->set(compact('lotes'));
	}
	
	function admin_editar_lote($id=null){
		$titulo = 'Lote de Herramientas';
		if (!empty($this->data)) {
			$this->Lotesherramienta->save($this->data);
			$this->Session->setFlash("Los datos se guardaron con éxito");
			$this->redirect(array('action' => 'admin_index_lotes'));
		}
		if (!empty($id)) {
			$this->data = $this->Lotesherramienta->findById($id);
			$titulo = 'Editar Lote de Herramientas';
			
			//Busco si tiene unidad para llenar los campos depto y division
			if (!empty($this->data['Lotesherramienta']['unidad_id'])) {
				$unidad = $this->Unidad->findById($this->data['Lotesherramienta']['unidad_id']);
				$id_unidad = $this->data['Lotesherramienta']['unidad_id'];
				$id_departamento = $unidad['Unidad']['departamento_id'];
				$id_division = $unidad['Departamento']['division_id'];
				$unidads = $this->Unidad->find('list',array(
					'fields' => array('Unidad.id','Unidad.nombre'),
					'conditions' => array('Unidad.departamento_id' => $id_departamento )
				));
				$departamentos = $this->Departamento->find('list',array(
					'fields' => array('Departamento.id','Departamento.nombre'),
					'conditions' => array('Departamento.division_id' => $id_division )
				));
			}
		} else {
			$titulo = 'Agregar Lote de Herramientas';
		}
		
		$divisions = $this->Division->find('list',array(
			'fields' => array('Division.id','Division.nombre'),
			'conditions' => array('Division.id <>' => 1 )
		));
		$divisions[0] = 'Escoge una división';
		$this->set(compact('id','titulo','divisions','departamentos','unidads','id_division','id_departamento','id_unidad'));
	}
	
	function buscar_departamentos(){
		$departamento = $this->Departamento->find('all', array(
			'conditions' => array('Departamento.division_id' => $_POST['division']),
		));
		$this->autoRender = false;
		$this->RequestHandler->respondAs('json');
		echo json_encode($departamento);
	}
	
	function buscar_unidades(){
		$unidad = $this->Unidad->find('all', array(
			'conditions' => array('Unidad.departamento_id' => $_POST['departamento']),
		));
		$this->autoRender = false;
		$this->RequestHandler->respondAs('json');
		echo json_encode($unidad);
	}
	
    function admin_index() {
		$herramientas = $this->Herramienta->find('all');
		$this->set(compact('herramientas'));
    }
	
	function admin_editar($id = null) {	
		$titulo = 'Herramienta';
		if (!empty($this->data)) {
			$this->Herramienta->save($this->data);
			$this->Session->setFlash("Los datos se guardaron con éxito");
			$this->redirect(array('action' => 'admin_index'));
		}
		if (!empty($id)) {
			$this->data = $this->Herramienta->findById($id);
			$titulo = 'Editar Herramienta';
		} else {
			$titulo = 'Agregar Herramienta';
		}
		$lotesherramientas = $this->Lotesherramienta->find('list',array(
			'fields'=> array('Lotesherramienta.id','Lotesherramienta.nombre')
		));
		$this->set(compact('id','titulo','lotesherramientas'));
	}
	
	function admin_eliminar($id) {
		$this->Herramienta->delete($id);
		//Borra de la tabla herramientas_proveedores
		$herramientas_proveedores = $this->HerramientasProveedor->find('all',array(
			'conditions' => array(
				'HerramientasProveedor.herramienta_id' => $id
			)
		));
		foreach ($herramientas_proveedores as $h){
			$this->HerramientasProveedor->delete($h['HerramientasProveedor']['id']);
		}
		$this->Session->setFlash("La herramienta se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_eliminar_lote($id) {
		$this->Lotesherramienta->delete($id);
		
		//Borrar las herramientas del lote
		$herramientas = $this->Herramienta->find('all',array(
			'conditions' => array('Herramienta.lotesherramienta_id' => $id)
		));
		$aux[]=0;
		foreach ($herramientas as $h) {
			$this->Herramienta->delete($h['Herramienta']['id']);
			$aux[] = $h['Herramienta']['id'];
		}
		
		//Eliminar la relacion con los proveedores
		$herramientas_proveedores = $this->HerramientasProveedor->find('all',array(
			'conditions' => array(
				'HerramientasProveedor.herramienta_id' => $aux
			)
		));
		foreach ($herramientas_proveedores as $h){
			$this->HerramientasProveedor->delete($h['HerramientasProveedor']['id']);
		}
		$this->Session->setFlash("El lote se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index_lotes'));
	}
	
	function admin_ver($id) {
		$departamento = $this->Departamento->find('first',array(
			'conditions' => array(
				'Departamento.id' => $id
			),
			'contain' => array('Unidad'),
			'recursive' => 2
		));
		$unidades = count($departamento['Unidad']);
		$personal = 0;
		foreach ($departamento['Unidad'] as $u) {
			$personal = $personal + count($u['Miembro']);
		}
		$this->set(compact('unidades','personal','departamento'));
	}
}

?>
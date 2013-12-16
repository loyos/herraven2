<?php

class MateriasprimasController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	public $uses = array('Materiasprima','MateriasprimasPrecio','Precio','Division','Departamento','Unidad');
	
    function admin_index() {
		$materias = $this->Materiasprima->find('all');
		foreach ($materias as $m) {
			if (empty($m['Articulo'])){
				$borrar[$m['Materiasprima']['id']] = 1;
			} else {
				$borrar[$m['Materiasprima']['id']] = 0;
			}
		}
		//var_dump($materias);die();
		$this->set(compact('materias','precios','borrar'));
    }
	
	function admin_editar($id = null) {
		$titulo = "";
		if (!empty($this->data)) {
			$data = $this->data;
			$i = 0;
			if ($this->Materiasprima->save($data)) {
				$this->Session->setFlash("Los datos se guardaron con éxito");
				$this->redirect(array('action' => 'admin_index'));
			}
		} 
		if (!empty($id)) {
			$titulo = "Editar";
			$this->data = $this->Materiasprima->findById($id);
			//Si tiene unidad asignada busco el departamento y division
			if (!empty($this->data['Materiasprima']['unidad_id'])) {
				$unidad = $this->Unidad->findById($this->data['Materiasprima']['unidad_id']);
				$id_unidad = $this->data['Materiasprima']['unidad_id'];
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
			$titulo = "Agregar";
		}
		$divisions = $this->Division->find('list',array(
			'fields' => array('Division.id','Division.nombre'),
			'conditions' => array('Division.id <>' => 1 )
		));
		$divisions[0] = 'Escoge una división';
		$this->set(compact('id','titulo','divisions','id_unidad','id_departamento','id_departamento','id_division','unidads','departamentos'));
	}
	
	function admin_eliminar($id) {
		$this->Materiasprima->delete($id);
		$this->MateriasprimasPrecio->deleteAll(array(
			'materiasprima_id' => $id
		));
		$this->Session->setFlash("La materia prima se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index'));
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
}

?>
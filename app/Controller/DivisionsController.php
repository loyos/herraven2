<?php
App::uses('CakeEmail', 'Network/Email');
class DivisionsController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop');
	var $uses = array('User','Miembro','Config','Unidad','Departamento','Division');
	
	 public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('editar','login','logout','reset_password'); // Letting users register themselves
	}
	
    function admin_index() {
		$divisiones = $this->Division->find('all',array(
			'recursive' => 3,
			'conditions' => array('Division.id <>' => 1 )
		));
		$this->set(compact('divisiones'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			$data = $this->data;
			$this->Division->save($data);
			
			//Ubico en que division se van a colocar los departamentos
			$data['Departamento']['division_id'] =  $this->Division->id;
			
			//Eliminar las unidades que estaban asociadas
			$unidad_departamentos = $this->Unidad->find('all',array(
				'conditions' => array('Unidad.departamento_id' => $data['Unidad']['departamento_id'])
			)); 
			foreach ($unidad_departamentos as $m){
				$update = array('Unidad'=>array(
					'id' => $m['Unidad']['id'],
					'departamento_id' => 1
				));
				$this->Unidad->save($update);
			}
			
			if (!empty($this->data['unidad1'])) {
				$data['Unidad']['id'] = $data['unidad1'];
				$this->Unidad->save($data);
			}
			if (!empty($this->data['unidad2']) && ($this->data['unidad2'] != $this->data['unidad1'])) {
				$data['Unidad']['id'] = $data['unidad2'];
				$this->Unidad->save($data);
			}
			if (!empty($this->data['unidad3']) && ($this->data['unidad2'] != $this->data['unidad3']) && ($this->data['unidad3'] != $this->data['unidad1'])) {
				$data['Unidad']['id'] = $data['unidad3'];
				$this->Unidad->save($data);
			}
			if (!empty($this->data['unidad4']) && ($this->data['unidad4'] != $this->data['unidad1']) && ($this->data['unidad4'] != $this->data['unidad2']) && ($this->data['unidad4'] != $this->data['unidad3'])) {
				$data['Unidad']['id'] = $data['unidad4'];
				$this->Unidad->save($data);
			}
			if (!empty($this->data['unidad5']) && ($this->data['unidad5'] != $this->data['unidad1']) && ($this->data['unidad5'] != $this->data['unidad2']) && ($this->data['unidad5'] != $this->data['unidad3']) && ($this->data['unidad5'] != $this->data['unidad4'])) {
				$data['Unidad']['id'] = $data['unidad5'];
				$this->Unidad->save($data);
			}
			$this->Session->setFlash("Los datos se guardaron con éxito");
			$this->redirect(array('action' => 'admin_index'));
		} elseif (!empty($id)) {
			$this->data = $this->Division->findById($id);
			$titulo = 'Editar Division';
		} else {
			$titulo = 'Agrega una Division';
		}
		
		$users_busqueda = $this->User->find('all',array(
			'fields' => array('User.id','User.nombre ','User.apellido'),
			'conditions' => array('User.rol' => 'jefe_division')
		));
		$departamentos = $this->Departamento->find('list',array(
			'fields' => array('Departamento.id','Departamento.nombre'), 
			'conditions' => array(
				'Departamento.division_id' => array(1,$id),
				'Departamento.id <>' => 1
			)
		));
		$departamentos[0] = '';
		
		foreach ($users_busqueda as $u) {
			$users[$u['User']['id']] =  $u['User']['nombre'].' '.$u['User']['apellido'];
		}
		
		$departamentos_en_divisiones = $this->Departamento->find('all',array(
			'fields' => array('Departamento.id','Departamento.nombre '), 
			'conditions' => array('Departamento.division_id' => $id)
		));
		$departamento1 = 0;
		$departamento2 = 0;
		$departamento3 = 0;
		
		$i = 1;
		foreach($departamentos_en_divisiones as $mu) {
			if ($i==1){
				$departamento1 = $mu['Departamento']['id'];
			} elseif ($i==2){
				$departamento2 = $mu['Departamento']['id'];
			} elseif ($i==3){
				$departamento3 = $mu['Departamento']['id'];
			} 
			$i++;
		}
		$this->set(compact('id','titulo','users','departamentos','departamento1','departamento2','departamento3'));
	}
	
	function admin_eliminar($id) {
		$this->Departamento->delete($id);
		$this->Session->setFlash("El departamento se elimino con éxito");
		$this->redirect(array('action' => 'admin_index'));
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
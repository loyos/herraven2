<?php
App::uses('CakeEmail', 'Network/Email');
class UnidadsController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop');
	var $uses = array('User','Miembro','Config','Unidad');
	
	 public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('editar','login','logout','reset_password'); // Letting users register themselves
	}
	
    function admin_index() {
		$unidades = $this->Unidad->find('all',array(
			'recursive' => 3,
			'conditions' => array('Unidad.id <>' => 1 )
		));
		$this->set(compact('unidades'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			//var_dump($this->data);die();
			$data = $this->data;
			if (empty($data['Unidad']['id'])) {
				$data['Unidad']['departamento_id'] = 1;
			}
			$validando_miembros = true;
			if (!empty($this->data['miembro1'])) {
				if (($this->data['miembro1'] == $this->data['miembro2']) || ($this->data['miembro1'] == $this->data['miembro3']) || ($this->data['miembro1'] == $this->data['miembro4'])){
					$validando_miembros = false;
				}
			} 
			if (!empty($this->data['miembro2'])) {
				if (($this->data['miembro1'] == $this->data['miembro2']) || ($this->data['miembro2'] == $this->data['miembro3']) || ($this->data['miembro2'] == $this->data['miembro4'])){
					$validando_miembros = false;
				}
			} 
			if (!empty($this->data['miembro3'])) {
				if (($this->data['miembro1'] == $this->data['miembro3']) || ($this->data['miembro2'] == $this->data['miembro3']) || ($this->data['miembro3'] == $this->data['miembro4'])){
					$validando_miembros = false;
				}
			} 
			if (!empty($this->data['miembro4'])) {
				if (($this->data['miembro1'] == $this->data['miembro4']) || ($this->data['miembro4'] == $this->data['miembro3']) || ($this->data['miembro2'] == $this->data['miembro4']) ){
					$validando_miembros = false;
				}
			} 
			if ($validando_miembros){
				if ($this->Unidad->save($data,array('validate' => 'first'))){
				
					//Ubico en que unidad se van a colocar los miembros
					$data['Miembro']['unidad_id'] =  $this->Unidad->id;
					
					//Eliminar los miembros que estaban asociados
					$miembros_unidad = $this->Miembro->find('all',array(
						'conditions' => array('Miembro.unidad_id' => $data['Miembro']['unidad_id'])
					)); 
					foreach ($miembros_unidad as $m){
						$update = array('Miembro'=>array(
							'id' => $m['Miembro']['id'],
							'unidad_id' => 1
						));
						$this->Miembro->save($update);
					}
					
					if (!empty($this->data['miembro1'])) {
						$miembro = $this->Miembro->findById($data['miembro1']);
						$data['Miembro']['id'] = $data['miembro1'];
						$this->Miembro->save($data);
					}
					if (!empty($this->data['miembro2']) && ($this->data['miembro2'] != $this->data['miembro1'])) {
						$data['Miembro']['id'] = $data['miembro2'];
						$this->Miembro->save($data);
					}
					if (!empty($this->data['miembro3']) && ($this->data['miembro2'] != $this->data['miembro3']) && ($this->data['miembro3'] != $this->data['miembro1'])) {
						$data['Miembro']['id'] = $data['miembro3'];
						$this->Miembro->save($data);
					}
					if (!empty($this->data['miembro4']) && ($this->data['miembro4'] != $this->data['miembro1']) && ($this->data['miembro4'] != $this->data['miembro2']) && ($this->data['miembro4'] != $this->data['miembro3'])) {
						$data['Miembro']['id'] = $data['miembro4'];
						$this->Miembro->save($data);
					}
					$this->Session->setFlash("Los datos se guardaron con éxito");
					$this->redirect(array('action' => 'admin_index'));
				} 
			} else {
					$this->data = $this->Unidad->findById($id);
					$titulo = 'Editar unidad';
					$this->Session->setFlash("Los miembros no pueden ser iguales");
			}
		} elseif (!empty($id)) {
			$this->data = $this->Unidad->findById($id);
			$titulo = 'Editar unidad';
		} else {
			$titulo = 'Agrega una unidad';
		}
		
		$users_busqueda = $this->User->find('all',array(
			'fields' => array('User.id','User.nombre ','User.apellido'),
			'conditions' => array('User.rol' => 'jefe_unidad')
		));
		$miembros_busqueda = $this->Miembro->find('all',array(
			'fields' => array('Miembro.id','User.nombre ','User.apellido'), 
			'conditions' => array('Miembro.unidad_id' => array(1,$id))
		));
		$miembros[0] = '';
		foreach ($miembros_busqueda as $u) {
			$miembros[$u['Miembro']['id']] =  $u['User']['nombre'].' '.$u['User']['apellido'];
		}
		foreach ($users_busqueda as $u) {
			$users[$u['User']['id']] =  $u['User']['nombre'].' '.$u['User']['apellido'];
		}
		
		//Buscando miembros asignados
		$miembros_en_unidad = $this->Miembro->find('all',array(
			'fields' => array('Miembro.id','User.nombre ','User.apellido'), 
			'conditions' => array('Miembro.unidad_id' => $id)
		));
		$miembro1 = '';
		$miembro2 = '';
		$miembro3 = '';
		$miembro4 = '';
		$i = 1;
		foreach($miembros_en_unidad as $mu) {
			if ($i==1){
				$miembro1 = $mu['Miembro']['id'];
			} elseif ($i==2){
				$miembro2 = $mu['Miembro']['id'];
			} elseif ($i==3){
				$miembro3 = $mu['Miembro']['id'];
			} elseif ($i==4){
				$miembro4 = $mu['Miembro']['id'];
			} 
			$i++;
		}
		$this->set(compact('id','titulo','users','miembros','miembro1','miembro2','miembro3','miembro4'));
	}
	
	function admin_eliminar($id) {
		$this->Unidad->delete($id);
		$this->Session->setFlash("La unidad se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_ver($id) {
		$unidad = $this->Unidad->find('first',array(
			'conditions' => array(
				'Unidad.id' => $id
			),
			'contain' => array('Miembro'),
			'recursive' => 1
		));
		$personal = count($unidad['Miembro']);
		$this->set(compact('unidad','personal'));
	}
}

?>
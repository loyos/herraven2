<?php

class InventariomaterialsController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop');
	public $uses = array('Inventariomaterial','Config','Materiasprima');
	
    function admin_index() {
		$materiasprima = $this->Materiasprima->find('all');
		$ano = date ("Y");
		foreach ($materiasprima as $materias) {
			$entradas_materia[$materias['Materiasprima']['id']] = $this->Inventariomaterial->find('all',array(
				'fields' => array('SUM(Inventariomaterial.cantidad)'),
				'conditions' => array(
					'Inventariomaterial.materiasprima_id' => $materias['Materiasprima']['id'],
					'Inventariomaterial.tipo' => 'entrada',
					'Inventariomaterial.ano' => $ano
				)
			));
			$salidas_materia[$materias['Materiasprima']['id']] = $this->Inventariomaterial->find('all',array(
				'fields' => array('SUM(Inventariomaterial.cantidad)'),
				'conditions' => array(
					'Inventariomaterial.materiasprima_id' => $materias['Materiasprima']['id'],
					'Inventariomaterial.tipo' => 'salida',
					'Inventariomaterial.ano' => $ano 
				)
			));
		} 
		$this->set(compact('ano','entradas_materia','salidas_materia','materiasprima'));
	}
	
	function admin_movimientos() {
		$ano = date ("Y");
		if (!empty($this->data)) {
			$id_m = $this->data['Inventariomaterial']['materiasprima_id'];
			$hoy = date('Y-m-d H:i:s');
			$trimestre = $this->Config->obtenerTrimestre($hoy);
			$entradas = $this->Inventariomaterial->find('all',array(
				'fields' => array('Inventariomaterial.trimestre','SUM(Inventariomaterial.cantidad)','Materiasprima.descripcion','Materiasprima.unidad'),
				'conditions' => array(
					'Inventariomaterial.materiasprima_id' => $id_m,
					'Inventariomaterial.tipo' => 'entrada',
					'Inventariomaterial.ano' => $ano
				),
				'group' => array('Inventariomaterial.trimestre'),
				'order' => array('Inventariomaterial.trimestre')
			));
			$salidas = $this->Inventariomaterial->find('all',array(
				'fields' => array('Inventariomaterial.trimestre','SUM(Inventariomaterial.cantidad)'),
				'conditions' => array(
					'Inventariomaterial.materiasprima_id' => $id_m,
					'Inventariomaterial.tipo' => 'salida',
					'Inventariomaterial.ano' => $ano
				),
				'group' => array('Inventariomaterial.trimestre')
			));
			$this->set(compact('id_m','entradas','salidas','trimestre','ano'));
		}
		
		$materiasprimas = $this->Materiasprima->find('list',array(
			'fields' => array('id','descripcion')
		));
		$materiasprimas[0] = 'Selecciona una materia prima';
		$this->set(compact('materiasprimas'));
	}
	
	function admin_editar() {
		if (!empty($this->data)) {
			$data = $this->data;
			$hoy = date('Y-m-d H:i:s');
			$data['Inventariomaterial']['trimestre'] = $this->Config->obtenerTrimestre($hoy);
			$data['Inventariomaterial']['ano'] = $this->Config->obtenerAno($hoy);
			$data['Inventariomaterial']['tipo'] = 'entrada';
			if ($this->Inventariomaterial->save($data)) {
				$this->Session->setFlash("El ingreso de materia prima se realizó con éxito");
				$this->redirect(array('action' => 'admin_index'));
			}
		} 
		
		$materiasprimas_all = $this->Materiasprima->find('all',array(
			'fields' => array('id','descripcion','unidad')
		));
		foreach ($materiasprimas_all as $m) {
			$materiasprimas[$m['Materiasprima']['id']] = $m['Materiasprima']['descripcion'].' ('.$m['Materiasprima']['unidad'].')';
		}
		$this->set(compact('materiasprimas'));
	}
	
	function admin_eliminar($id) {
		$this->Materiasprima->delete($id);
		$this->MateriasprimasPrecio->deleteAll(array(
			'materiasprima_id' => $id
		));
		$this->redirect(array('action' => 'admin_index'));
	}
	
	
}

?>
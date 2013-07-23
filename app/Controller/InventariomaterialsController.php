<?php

class InventariomaterialsController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop');
	public $uses = array('Materiasprima','Inventariomaterial','Config');
	
    function admin_index() {
		$combinaciones = $this->Inventariomaterial->find('all',array(
			'fields' => array('DISTINCT Inventariomaterial.ano,DISTINCT Inventariomaterial.trimestre,DISTINCT Inventariomaterial.materiasprima_id'),
		));
		foreach ($combinaciones as $c){
			$materiales[]= $this->Inventariomaterial->find('all',array(
				'conditions' => array(
					'ano' => $c['Inventariomaterial']['ano'],
					'trimestre' => $c['Inventariomaterial']['trimestre'],
					'materiasprima_id' => $c['Inventariomaterial']['materiasprima_id']
				)
			));
		}
		$count_entrada = 0;
		$count_salidas = 0;
		foreach ($materiales as $m) {
			foreach ($m as $a){
				if ($a['Inventariomaterial']['tipo'] == 'entrada'){
					$count_entrada = $count_entrada+$a['Inventariomaterial']['cantidad'];
				} else {
					$count_salidas = $count_salidas +$a['Inventariomaterial']['cantidad'];
				}
			}
			$materia = $this->Materiasprima->find('first',array('conditions' => array('Materiasprima.id' => $m[0]['Inventariomaterial']['materiasprima_id'])));
			$nombre_materia = $materia['Materiasprima']['descripcion'];
			$unidad = $materia['Materiasprima']['unidad'];
			$saldo = $count_entrada-$count_salidas;
			$info[] = array(
				'trimestre' => $m[0]['Inventariomaterial']['trimestre'],
				'ano' => $m[0]['Inventariomaterial']['ano'],
				'materia' =>$nombre_materia,
				'unidad' => $unidad,
				'entradas' => $count_entrada,
				'salidas' => $count_salidas,
				'saldo' => $saldo
			);
			$count_entrada = 0;
			$count_salidas = 0;
		}
		$this->set(compact('info'));
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
		
		$materiasprimas = $this->Materiasprima->find('list',array(
			'fields' => array('id','descripcion')
		));
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
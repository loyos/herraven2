<?php

class MateriasprimasController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop');
	public $uses = array('Materiasprima','MateriasprimasPrecio','Precio');
	
    function admin_index() {
		$materias = $this->Materiasprima->find('all');
		foreach ($materias as $m) {
			if (empty($m['Articulo'])){
				$borrar[$m['Materiasprima']['id']] = 1;
			} else {
				$borrar[$m['Materiasprima']['id']] = 0;
			}
			// foreach($m['Precio'] as $p){
				// if ($p['id'] == 1){
					// $precios[$m['Materiasprima']['id']] = $p['MateriasprimasPrecio']['precio'];
				// }
			// }
		}
		//var_dump($materias);die();
		$this->set(compact('materias','precios','borrar'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			$data = $this->data;
			$i = 0;
			$this->Materiasprima->save($data);
			// $id = $this->Materiasprima->id;
			// $precios = $this->Precio->find('all');
			// $this->MateriasprimasPrecio->deleteAll(array(
				// 'materiasprima_id' => $id
			// ));
			// foreach ($precios as $lista) {
				// if (empty($lista['Precio']['ganancia'])){
					// $p = $this->data['Materiasprima']['precio'];
				// } else {
					// $p = $this->data['Materiasprima']['precio'] + ($this->data['Materiasprima']['precio']*($lista['Precio']['ganancia']/100));
				// }
				
				// $data_p = array(
					// 'precio_id' => $lista['Precio']['id'],
					// 'materiasprima_id' => $id,
					// 'precio' => $p
				// );
				// $this->MateriasprimasPrecio->saveAll($data_p);
			// }
			$this->redirect(array('action' => 'admin_index'));
		} elseif (!empty($id)) {
			$titulo = "Editar";
			$this->data = $this->Materiasprima->findById($id);
			// $precio_b = $this->MateriasprimasPrecio->find('first',array(
				// 'conditions' => array(
					// 'materiasprima_id' => $id,
					// 'precio_id' => '1'
				// )
			// ));
			// $precio_b = $precio_b['MateriasprimasPrecio']['precio'];
		} else {
			$titulo = "Agregar";
		}
		
		$this->set(compact('id','titulo'));
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
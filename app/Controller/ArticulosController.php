<?php

class ArticulosController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	public $uses = array('Articulo','Subcategoria','Materiasprima','ArticulosMateriasprima','Config','Categoria');
	
    function admin_index() {
		$articulos = $this->Articulo->find('all',array(
			'recursive' => 2
		));
		$this->set(compact('articulos'));
    }
	
	function admin_editar($id = null) {
		$titulo = "";
		if (!empty($this->data)) {
			$guardo = true;
			$data = $this->data;
			if (!empty($this->data['Articulo']['Foto']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['Articulo']['Foto'], 'img\articulos', '')) {
					$data['Articulo']['imagen'] = $this->data['Articulo']['Foto']['name'];
				}
			}
			$i = 0;
			$a = 0;
			foreach($this->data['materias'] as $m){
				if (!empty($m) && !empty($this->data['cantidad'][$a])){
					$hay_materias[] = 'si';
				}
				$a++;
			}
			if (!empty($hay_materias)){
				if ($this->Articulo->save($data)) {
					$id = $this->Articulo->id;
					$this->ArticulosMateriasprima->deleteAll(array(
						'articulo_id' => $id
					));
					foreach($this->data['materias'] as $m){
						if (!empty($m)){
							$existe = $this->ArticulosMateriasprima->find('first',array(
								'conditions' => array(
									'articulo_id' => $id,
									'materiasprima_id' => $m
								)
							));
							if (empty($existe)) {
								$data_m = array(
									'articulo_id' => $id,
									'materiasprima_id' => $m,
									'cantidad' => $this->data['cantidad'][$i]
								);
								if ($this->ArticulosMateriasprima->saveAll($data_m)) {
									$guardo = true;
								} else {
									$guardo = false;
								}
							}
							$i++;
							
						} 
					}
					//die("sd");
					if ($guardo){
					$this->redirect(array('action' => 'admin_index'));
					}
				} 
			} else {
				$this->Session->setFlash("El articulo debe tener por lo menos una materia prima asociada");
			}
		} elseif (!empty($id)) {
			$titulo = "Editar";
			$this->data = $this->Articulo->findById($id);
			$materiales = $this->ArticulosMateriasprima->find('all',array(
				'conditions' => array(
					'articulo_id' => $id
				)
			));
			foreach ($materiales as $mat) {
				$valor_mp[] = $mat['ArticulosMateriasprima']['materiasprima_id'];
				$valor_cant[] = $mat['ArticulosMateriasprima']['cantidad'];
			}
		} else {
			$titulo = "Agregar";
		}
		$costo_produccion = $this->Config->find('first');
		$costo_produccion = $costo_produccion['Config']['costo_produccion'];
		$categorias = $this->Categoria->find('list',array(
			'fields' => array('id','descripcion')
		));
		$materiasprimas[0] = '';
		$materiasprimas_busqueda= $this->Materiasprima->find('all',array(
			'fields' => array('id','descripcion','unidad')
		));
		foreach ($materiasprimas_busqueda as $mp) {
			$materiasprimas[$mp['Materiasprima']['id']] =  $mp['Materiasprima']['descripcion'].' ('.$mp['Materiasprima']['unidad'].')';
		}
		$this->set(compact('id','titulo','materiasprimas','valor_mp','valor_cant','costo_produccion','categorias'));
	}
	
	function buscar_subcat() {
		$this->loadModel('Subcategoria');
		$subcat = $this->Subcategoria->find('all', array(
			'conditions' => array('Subcategoria.categoria_id' => $_POST['cat_id'])
		));
		$this->autoRender = false;
		$this->RequestHandler->respondAs('json');
		echo json_encode($subcat);
	}
	
	function admin_eliminar($id) {
		$this->Articulo->delete($id);
		$this->ArticulosMateriasprima->deleteAll(array(
			'articulo_id' => $id
		));
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_ver($id) {
		$articulo = $this->Articulo->findById($id);
		$this->set(compact('articulo'));
	}
	
	function admin_forecast(){
		if (!empty($this->data)) {
			$data = $this->data;
			foreach ($data['cantidad'] as $key => $value){
				if ($value == 1){
					$cajas = $data['cajas'][$key];
					$articulo = $this->Articulo->findById($key);
					foreach ($articulo['Materiasprima'] as $mp){
						$datos = array (
							'Articulo' => $articulo['Articulo']['descripcion'],
							'Materiasprima' => $mp['descripcion'],
							'cantidad' =>  $mp['ArticulosMateriasprima']['cantidad'] * $articulo['Articulo']['cantidad_por_caja'] * $cajas,
							'cajas' => $cajas
						);
						$articulos_mp[$key][]= $datos;
					}
				}
			}
			$this->set(compact('articulos_mp'));
		} else {
			$articulos = $this->Articulo->find('all',array(
				'link' => array('Subcategoria' => 'Categoria'),
				'recursive' => 2
			));
			$this->set(compact('articulos'));
		}
	}
}

?>
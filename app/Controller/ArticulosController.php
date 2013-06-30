<?php

class ArticulosController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop');
	public $uses = array('Articulo','Subcategoria','Materiasprima','ArticulosMateriasprima','Config');
	
    function admin_index() {
		$articulos = $this->Articulo->find('all',array(
			'recursive' => 2
		));
		$this->set(compact('articulos'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			$data = $this->data;
			if (!empty($this->data['Articulo']['Foto']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['Articulo']['Foto'], 'img\articulos', '')) {
					$data['Articulo']['imagen'] = $this->data['Articulo']['Foto']['name'];
				}
			}
			$i = 0;
			$this->Articulo->save($data);
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
						$this->ArticulosMateriasprima->saveAll($data_m);
					}
					$i++;
				}
			}
			
			//die("sd");
			$this->redirect(array('action' => 'admin_index'));
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
		$subcategorias = $this->Subcategoria->find('list',array(
			'fields' => array('id','descripcion')
		));
		$materiasprimas[0] = '';
		$materiasprimas= $materiasprimas + $this->Materiasprima->find('list',array(
			'fields' => array('id','descripcion')
		));
		$this->set(compact('id','subcategorias','titulo','materiasprimas','valor_mp','valor_cant','costo_produccion'));
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
}

?>
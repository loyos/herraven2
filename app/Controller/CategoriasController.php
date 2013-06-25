<?php

class CategoriasController extends AppController {
    
	public $helpers = array ('Html','Form');
	var $uses = array('Categoria','Subcategoria','Articulo');
	
    function index() {
		$categorias = $this->Categoria->find('all',array(
			'contain' => array('Subcategoria')
		));
		foreach ($categorias as $cat) {
			if (!empty($cat['Subcategoria'])){
				foreach($cat['Subcategoria'] as $sub) {
					$articulos = $this->Articulo->find('all',array(
						'conditions' => array('Articulo.subcategoria_id' => $sub['id'])
					));
					if (!empty($articulos)) {
						$eliminar_cat[$cat['Categoria']['id']] = 1;
					} else {
						$eliminar_cat[$cat['Categoria']['id']] = 0;
					}
					
				}
			} else {
				$eliminar_cat[$cat['Categoria']['id']] = 0;
			}
		}
	
		$this->set(compact('categorias','eliminar_cat'));
    }
	
	function editar($id = null) {
		if (!empty($this->data)) {
			$this->Categoria->save($this->data);
			$this->redirect(array('action' => 'index'));
		} elseif (!empty($id)) {
			$this->data = $this->Categoria->findById($id);
			$titulo = 'Editar Categoria';
		} else {
			$titulo = 'Agregar Categoria';
		}
		$this->set(compact('id','titulo'));
	}
	
	function eliminar($id) {
		$this->Categoria->delete($id);
		$this->redirect(array('action' => 'index'));
	}

}

?>
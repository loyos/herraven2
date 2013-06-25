<?php

class SubcategoriasController extends AppController {
    
	public $helpers = array ('Html','Form');
	var $uses = array('Subcategoria','Articulo','Categoria');
	
    function index() {
		$subcategorias = $this->Subcategoria->find('all',array(
			'contain' => array('Articulo')
		));
		foreach ($subcategorias as $cat) {
			if (!empty($cat['Articulo'])){
					$articulos = $this->Articulo->find('all',array(
						'conditions' => array('Articulo.subcategoria_id' => $cat['Subcategoria']['id'])
					));
					if (!empty($articulos)) {
						$eliminar_cat[$cat['Subcategoria']['id']] = 1;
					} else {
						$eliminar_cat[$cat['Subcategoria']['id']] = 0;
					}
			} else {
				$eliminar_cat[$cat['Subcategoria']['id']] = 0;
			}
		} 
		$this->set(compact('subcategorias','eliminar_cat'));
    }
	
	function editar($id = null) {
		if (!empty($this->data)) {
			$this->Subcategoria->save($this->data);
			$this->redirect(array('action' => 'index'));
		} elseif (!empty($id)) {
			$this->data = $this->Subcategoria->findById($id);
			$titulo = 'Editar';
		} else {
			$titulo = 'Agregar';
		}
		$categorias = $this->Categoria->find('list',array(
			'fields' => array('id','descripcion')
		));
		$categorias[0] = '';
		$this->set(compact('id','titulo','categorias'));
	}
	
	function eliminar($id) {
		$this->Subcategoria->delete($id);
		$this->redirect(array('action' => 'index'));
	}
	
}

?>
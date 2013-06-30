<?php

class AcabadosController extends AppController {
    
	public $helpers = array ('Html','Form');
	var $uses = array('Subcategoria','Articulo','Categoria','Acabado','Pedido');
	
    function admin_index() {
		$acabados = $this->Acabado->find('all',array(
			'contain' => array('Pedido')
		));
		foreach ($acabados as $a) {
			if (!empty($a['Pedido'])){
				$eliminar_cat[$a['Acabado']['id']] = 1;
			} else {
				$eliminar_cat[$a['Acabado']['id']] = 0;
			}
		} 
		$this->set(compact('acabados','eliminar_cat'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			$this->Acabado->save($this->data);
			$this->redirect(array('action' => 'admin_index'));
		} elseif (!empty($id)) {
			$this->data = $this->Acabado->findById($id);
			$titulo = 'Editar';
		} else {
			$titulo = 'Agregar';
		}
		$this->set(compact('id','titulo'));
	}
	
	function admin_eliminar($id) {
		$this->Acabado->delete($id);
		$this->redirect(array('action' => 'admin_index'));
	}
	
}

?>
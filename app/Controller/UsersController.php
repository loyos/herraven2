<?php

class UsersController extends AppController {
    
	public $helpers = array ('Html','Form');
	var $uses = array('User','Cliente');
	
    function index() {
		$usuarios = $this->User->find('all');
		$this->set(compact('usuarios'));
    }
	
	function editar($id = null) {
		if (!empty($this->data)) {
			$this->User->save($this->data);
			$this->redirect(array('action' => 'index'));
		} elseif (!empty($id)) {
			$this->data = $this->User->findById($id);
			$titulo = 'Editar Usuario';
		} else {
			$titulo = 'Agrega Usuario';
		}
		$clientes = $this->Cliente->find('list',array(
			'fields' => array('id','denominacion_legal')
		));
		$clientes[0] = '';
		$roles = array(
			'cliente' => 'Cliente',
			'admin' => 'Administrador'
		);
		$this->set(compact('id','titulo','clientes','roles'));
	}
	
	function eliminar($id) {
		$this->User->delete($id);
		$this->redirect(array('action' => 'index'));
	}
	
	function ver($id) {
		$usuario = $this->User->findById($id);
		$funciones = '';
		if ($usuario['User']['rol'] == 'admin') {
			if ($usuario['User']['admin_usuario'] == 1) {
				$funciones = $funciones.'Admin usuario ';
			} 
			if ($usuario['User']['admin_catalogo'] == 1) {
				$funciones = $funciones.'Admin catálogo ';
			} 
			if ($usuario['User']['admin_materia_prima'] == 1) {
				$funciones = $funciones.'Admin materia prima ';
			} 
			if ($usuario['User']['admin_almacen'] == 1) {
				$funciones = $funciones.'Admin almacén ';
			} 
			if ($usuario['User']['admin_pedidos'] == 1) {
				$funciones = $funciones.'Admin pedidos ';
			} 
			if ($usuario['User']['admin_despachos'] == 1) {
				$funciones = $funciones.'Admin despachos ';
			} 
			if ($usuario['User']['admin_cuentas'] == 1) {
				$funciones = $funciones.'Admin cuentas ';
			} 
			if ($usuario['User']['admin_almacenes_clientes'] == 1) {
				$funciones = $funciones.'Admin clientes ';
			} 
			if ($usuario['User']['admin_reportes'] == 1) {
				$funciones = $funciones.'Admin reportes ';
			}
		} elseif ($usuario['User']['rol'] == 'cliente') {
			if ($usuario['User']['cliente_perfil'] == 1) {
				$funciones = $funciones.'Cliente perfil ';
			} 
			if ($usuario['User']['cliente_catalogo'] == 1) {
				$funciones = $funciones.'Cliente catálogo ';
			} 
			if ($usuario['User']['cliente_almacen'] == 1) {
				$funciones = $funciones.'Cliente almacén ';
			} 
		}
		$this->set(compact('usuario','funciones'));
	}
}

?>
<?php

class UsersController extends AppController {
    
	public $helpers = array ('Html','Form');
	var $uses = array('User','Cliente');
	
	 public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('editar','login','logout'); // Letting users register themselves
	}
	
	public function login() {
		if ($this->Auth->User('id')) {
			$this->redirect(array(
				'controller' => 'index',
				'action' => 'index'
 			));
		}
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect(array(
						'controller' => 'index',
						'action' => 'index'
					));
			} else {
				$this->Session->setFlash(__('El o nombre de usuario o contraseña son invalidos, vuelve a intentarlo'));
			}
		}
	}
	
	public function logout() {
		$this->Auth->logout();
		$this->redirect(array('controller' => 'users', 'action'=>'login'));
	}
	
    function admin_index() {
		$usuarios = $this->User->find('all');
		$this->set(compact('usuarios'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			if ($this->User->save($this->data,array('validate' => 'first'))) {
				$this->Session->setFlash("Los datos se guardaron con éxito");
				$this->redirect(array('action' => 'admin_index'));
			} else {
				$titulo = '';
			}
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
	
	function admin_eliminar($id) {
		$this->User->delete($id);
		$this->Session->setFlash("El usuario se elimino con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_ver($id) {
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
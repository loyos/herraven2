<?php
App::uses('CakeEmail', 'Network/Email');
class UsersController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop');
	var $uses = array('User','Cliente','Pedido','Contenido');
	
	 public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('editar','login','logout','reset_password'); // Letting users register themselves
	}
	
	function index(){
		$user = $this->Auth->User('id');
		$usuario = $this->User->findById($user);
		$this->set(compact('usuario'));
	}
	
	public function login() {
		$menu = $this->Contenido->find('all');
		$this->set(compact('menu'));		
		$this->layout = 'home';
		
		if ($this->Auth->User('id')) {
			$this->redirect(array(
				'controller' => 'users',
				'action' => 'index'
 			));
		}
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect(array(
						'controller' => 'users',
						'action' => 'index'
					));
			} else {
				$this->Session->setFlash(__('El nombre de usuario o contraseña son inválidos, vuelve a intentarlo'), 'login_flash');
			}
		}
	}
	
	public function pedidos(){
		$cliente_id = $this->Auth->user('cliente_id');
		$pedidos = $this->Pedido->find('all', array(
			'conditions' => array(
				'cliente_id' => $cliente_id,
				'status !=' => 'Despachado'
			)
		));
		
		$pedidos_pendientes = $this->Pedido->find('all', array(
			'conditions' => array(
				'cliente_id' => $cliente_id,
				'status !=' => array('Despachado', 'Cancelado'),
			)
		));
		
		$this->set(compact('pedidos','pedidos_pendientes'));
	}
	
	public function despachos(){
		$cliente_id = $this->Auth->user('cliente_id');
		$pedidos = $this->Pedido->find('all', array(
			'conditions' => array(
				'cliente_id' => $cliente_id,
				'status' => 'Despachado'
			)
		));
		// debug($pedidos);
		$this->set(compact('pedidos'));
	}
	
	public function logout() {
		$this->Auth->logout();
		$this->redirect(array('controller' => 'users', 'action'=>'login'));
	}
	
    function admin_index() {
		$usuarios = $this->User->find('all',array(
			'conditions' => array('User.usuario' => 1)
		));
		$this->set(compact('usuarios'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			$data = $this->data;
			if (!empty($this->data['User']['Foto']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['User']['Foto'], 'img/users', '')) {
					$data['User']['imagen'] = $this->data['User']['Foto']['name'];
				}
			} elseif (!empty($id)) {
				$u = $this->User->findById($id);
				$data['User']['imagen'] = $u['User']['imagen'];
			}
			if (!empty($data['User']['imagen'])) {
				if ($this->User->save($data,array('validate' => 'first'))) {
					$this->Session->setFlash("Los datos se guardaron con éxito");
					$this->redirect(array('action' => 'admin_index'));
				} else {
					$titulo = '';
				}
			} else {
				$this->Session->setFlash("Debes seleccionar una foto");
				$this->redirect(array('action' => 'admin_editar',$id));
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
			'admin' => 'Administrador',
			'jefe_unidad' => 'Jefe Unidad',
			'jefe_departamento' => 'Jefe Departamento',
			'jefe_division' => 'Jefe División',
		);
		$this->set(compact('id','titulo','clientes','roles'));
	}

	function editar($id) {
		if (!empty($this->data)) {
			$data = $this->data;
			if (!empty($this->data['User']['password_new'])){
				if (!empty($this->data['User']['password_old']) && !empty($this->data['User']['password_confirm'])) {
					$usuario = $this->User->findById($id);
					if (Security::hash($data['User']['password_old'], null, true) == $usuario['User']['password']) {
						if ($data['User']['password_new'] == $data['User']['password_confirm']) {
							$data['User']['password'] = $data['User']['password_new'];
						} else {
							$this->Session->setFlash("La confirmación de contraseña fue incorrecta");
							$this->redirect(array('action' => 'editar',$id));
						}
					} else {
						$this->Session->setFlash("La contraseña actual es incorrecta");
						$this->redirect(array('action' => 'editar',$id));
					}
				} else {
					$this->Session->setFlash("Faltan datos para cambiar la contraseña");
					$this->redirect(array('action' => 'editar',$id));
				}
			}
			if (!empty($this->data['User']['Foto']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['User']['Foto'], 'img/users', '')) {
					$data['User']['imagen'] = $this->data['User']['Foto']['name'];
				}
			}
			if ($this->User->save($data,array('validate' => 'first'))) {
				$this->Session->setFlash("Los datos se guardaron con éxito");
				$this->redirect(array('action' => 'index'));
			} else {
				$titulo = '';
			}
		} 
		
		$this->data = $this->User->findById($id);
		$titulo = 'Edita tu perfil'; 
		
		$this->set(compact('id','titulo'));
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
	
	function reset_password(){
		$menu = $this->Contenido->find('all');
		$this->set(compact('menu'));		
		$this->layout = 'home';
		
		if (!empty($this->data)) {
			$existe = $this->User->find('first',array(
				'conditions' => array('User.username' => $this->data['User']['username'])
			));
			if (!empty($existe)){
				$clave = $this->generaPass();
				$username = $existe['User']['username'];
				$nombre = $existe['User']['nombre'];
				$apellido = $existe['User']['apellido'];
				$update = array('User'=>array(
					'id' => $existe['User']['id'],
					'password' => $clave
				));
				$this->User->save($update);
				$Email = new CakeEmail();
				$Email->from(array('me@example.com' => 'Herraven.com'));
				$Email->emailFormat('html');
				$Email->to($existe['User']['email']);
				$Email->subject('Nueva clave');
				$Email->template('cambiar_password');
				$Email->viewVars(compact('username','apellido','nombre','clave'));
				$Email->send();
				$this->Session->setFlash('En breve recibirás un correo para restablecer tu contraseña');
				$this->redirect(array('controller'=>'users', 'action'=>'login'));
			} else {
				$this->Session->setFlash('No existe un usuario registrado con este username', 'login_flash');
				$this->redirect(array('action' => 'reset_password'));
			}
		}
	}
	
	function generaPass(){
		$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$longitudCadena=strlen($cadena);
		$pass = "";
		$longitudPass=10;
		for($i=1 ; $i<=$longitudPass ; $i++){
			$pos=rand(0,$longitudCadena-1);
			$pass .= substr($cadena,$pos,1);
		}
		return $pass;
	}
}

?>
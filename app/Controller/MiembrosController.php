<?php
App::uses('CakeEmail', 'Network/Email');
class MiembrosController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop');
	var $uses = array('User','Miembro','Config');
	
	 public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('editar','login','logout','reset_password'); // Letting users register themselves
	}
	
    function admin_index() {
		$miembros = $this->Miembro->find('all',array(
			'recursive' => 3
		));
		$this->set(compact('miembros'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			$data = $this->data;
			if (!empty($this->data['User']['Foto']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['User']['Foto'], 'img/users', '')) {
					$data['User']['imagen'] = $this->data['User']['Foto']['name'];
				}
			} elseif (!empty($id)) {
				$m = $this->Miembro->findById($id);
				$u = $this->User->findById($m['Miembro']['user_id']);
				$data['User']['imagen'] = $u['User']['imagen'];
			}
			if (!empty($data['User']['imagen'])) {
				if (!empty($this->data['Miembro']['Test']['name'])) {
					if ($this->JqImgcrop->uploadImage($this->data['Miembro']['Test'], 'img/users/test', '')) {
						$data['Miembro']['imagen_test'] = $this->data['Miembro']['Test']['name'];
					}
				}
				if ($this->Miembro->save($data,array('validate' => 'only'))) {	
					if ($this->User->save($data,array('validate' => 'first'))) {	
						$user_id = $this->User->id;
						$data['Miembro']['user_id'] = $user_id;
						$this->Miembro->save($data);
						$this->Session->setFlash("Los datos se guardaron con éxito");
						$this->redirect(array('action' => 'admin_index'));
					}
				} else {
					$titulo = '';
				}
			} else {
				$this->Session->setFlash("Debes seleccionar una foto");
				$this->redirect(array('action' => 'admin_editar',$id));
			}
		} elseif (!empty($id)) {
			$this->data = $this->Miembro->findById($id);
			$m = $this->Miembro->findById($id);
			$u = $this->User->findById($m['Miembro']['user_id']);
			$user_id = $u['User']['id'];
			$titulo = 'Editar miembro del personal';
		} else {
			$titulo = 'Agrega un miembro al personal';
		}
		
		$this->set(compact('id','titulo','user_id'));
	}
	
	function admin_eliminar($id) {
		$this->Miembro->delete($id);
		$this->Session->setFlash("El miembro del personal se elimino con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_ver($id) {
		$miembro = $this->Miembro->find('first',array(
			'conditions' => array(
				'Miembro.id' => $id
			),
			'recursive' => 3
		));
		$tiempo_trabajo = $this->Config->obtenerIntervaloFechas($miembro['Miembro']['fecha_ingreso']);
		$edad = $this->Config->obtenerIntervaloFechas($miembro['Miembro']['fecha_nacimiento']);
		$edad = explode(" ", $edad);
		$edad = $edad[0];
		$this->set(compact('miembro','tiempo_trabajo','edad'));
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
<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'users', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			'authorize' => array('controller'),
        )
		
    );
	function beforeFilter() { 	
		$this->Auth->authorize = 'Controller'; 
		$user_id = $this->Auth->user('id');
		$role = $this->Auth->user('role');
		$rol = $this->Auth->user('rol');
		Security::setHash('md5');
		$this->Auth->allow('*');
		
		$admin_usuario = false;
		$admin_catalogo = false;
		$admin_materia_prima = false;
		$admin_almacen = false;
		$admin_pedidos = false;
		$admin_despachos = false;
		$admin_cuentas = false;
		$admin_almacenes_clientes = false;
		$admin_reportes = false;
		$cliente_perfil = false;
		$cliente_almacen = false;
		$cliente_catalogo = false;
		
		if ($this->Auth->user('admin_usuario') == 1) {
			$admin_usuario = true;
		} 
		if ($this->Auth->user('admin_catalogo') == 1) {
			$admin_catalogo = true;
		} 
		if ($this->Auth->user('admin_materia_prima') == 1) {
			$admin_materia_prima = true;
		} 
		if ($this->Auth->user('admin_almacen') == 1) {
			$admin_almacen = true;
		} 
		if ($this->Auth->user('admin_pedidos') == 1) {
			$admin_pedidos = true;
		} 
		if ($this->Auth->user('admin_despachos') == 1) {
			$admin_despachos = true;
		} 
		if ($this->Auth->user('admin_cuentas') == 1) {
			$admin_cuentas = true;
		} 
		if ($this->Auth->user('admin_almacenes_clientes') == 1) {
			$admin_almacenes_clientes = true;
		} 
		if ($this->Auth->user('admin_reportes') == 1) {
			$admin_reportes = true;
		} 
		if ($this->Auth->user('cliente_perfil') == 1) {
			$cliente_perfil = true;
		} 
		if ($this->Auth->user('cliente_almacen') == 1) {
			$cliente_almacen = true;
		} 
		if ($this->Auth->user('cliente_catalogo') == 1) {
			$cliente_catalogo = true;
		} 
		$this->set(compact('admin_usuario','admin_catalogo','admin_materia_prima','admin_almacen','admin_pedidos','admin_despachos','admin_cuentas','admin_almacenes_clientes','admin_reportes','cliente_perfil','cliente_almacen','cliente_catalogo','user_id','rol'));
		
	}
	public function isAuthorized($user=null) {
		if (strpos($this->action,'admin') === false) {
				return true;
		} else {
			if (isset($user['rol']) && $user['rol'] === 'admin') {
				return true;
			} else {
				return false;
			}
		}
	}
}

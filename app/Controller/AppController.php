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
            'logoutRedirect' => array('controller' => 'index', 'action' => 'index'),
			'authorize' => array('controller'),
        )
		
    );
	function beforeFilter() { 	
		//var_dump($this->Auth->logoutRedirect); debug.die("dfdf");
		$this->Auth->authorize = 'Controller'; 
		$user_id = $this->Auth->user('id');
		$role = $this->Auth->user('role');
		Security::setHash('md5');
		$this->Auth->allow('*');
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

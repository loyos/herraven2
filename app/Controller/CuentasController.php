<?php

class CuentasController extends AppController {
    
	public $helpers = array ('Html','Form','Herra');
	var $uses = array('Cuenta','Config','User');
	public $components = array('Search.Prg');
	public $presetVars = true; // using the model configuration
	public $paginate = array();
	
	
    function admin_index() {
	
		$this->Prg->commonProcess();
		$parametros = $this->Prg->parsedParams();
		if($parametros){   // si viene con datos para el buscador, esto es para trabajar el buscador
											// sin una vista auxiliar como viene en el manual!! parece que sirve
		
		$this->paginate['conditions'] = $this->Cuenta->parseCriteria($this->Prg->parsedParams());
		$this->loadModel('Cuenta');
		$this->paginate['recursive'] = 2;
		$cuentas = $this->paginate();
		
		}else{
		
			$cuentas = $this->Cuenta->find('all',array(
				'recursive' => 2
			));
			$count = 0;
			foreach ($cuentas as $c){
				$ano = $this->Config->obtenerAno($c['Pedido']['fecha']);
				$cuentas[$count]['Pedido']['num_pedido'] = $cuentas[$count]['Pedido']['num_pedido'].$ano[2].$ano[3];
				$count++;
			}
		}
		$this->loadModel('Cliente');
		$clientes = $this->Cliente->find('list', array(
			'fields' => array('Cliente.id', 'Cliente.denominacion_legal')
		));
		$this->set(compact('cuentas', 'clientes'));
    }
	
	 function index() {
		$user_id = $this->Auth->user('id');
		$usuario = $this->User->findById($user_id);
		$cuentas = $this->Cuenta->find('all',array(
			'conditions' => array(
				'Pedido.cliente_id' => $usuario['User']['cliente_id']
			),
			'recursive' => 2
		));
		$count = 0;
		foreach ($cuentas as $c){
			$ano = $this->Config->obtenerAno($c['Pedido']['fecha']);
			$cuentas[$count]['Pedido']['num_pedido'] = $cuentas[$count]['Pedido']['num_pedido'].$ano[2].$ano[3];
			$count++;
		}
		$this->set(compact('cuentas'));
    }
	
	function admin_pagar($id) {
		if (!empty($this->data)) {
			$id = $this->data['Cuenta']['id'];
			$cuenta = $this->Cuenta->findById($id);
			$deposito = $this->data['Cuenta']['monto']+$cuenta['Cuenta']['deposito'];
			$total = $cuenta['Pedido']['cuenta'];
			if ($total == $deposito) {
				$update = array(
				'Cuenta' => array(
					'id' => $id,
					'deposito' => $deposito,
					'status' => 'Pagado'
				)
			);
			} elseif ($deposito > $total) {
				$this->Session->setFlash('El pago supera el monto restante');
				$this->redirect(array('action' => 'admin_pagar',$id));
			} else {
				$update = array(
					'Cuenta' => array(
						'id' => $id,
						'deposito' => $deposito
					)
				);
			}
			$this->Cuenta->save($update);
			$this->Session->setFlash('El pago se realizó con éxito');
			$this->redirect(array('action' => 'admin_index'));
		}
		$this->set(compact('id'));
	}
}

?>
<?php

class AlmacenclientesController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	public $uses = array('Almacencliente','Inventarioalmacen','CajasPedido','Inventariomaterial','Config','Categoria','Articulo','Acabado','Caja','Subcategoria','User');
	
	
	function index(){
		$user_id = $this->Auth->user('id');
		$user = $this->User->findById($user_id);
		$cliente_id = $user['User']['cliente_id'];
		$almacen = $this->Almacencliente->find('all',array(
			'conditions' => array('Pedido.cliente_id' => $cliente_id),

		));
		foreach ($almacen as $a) {
			$articulos_almacen[] = $a['Almacencliente']['articulo_id']; 
		}
		$articulos = $this->Articulo->find('all',array(
			'conditions' => array('Articulo.id' => $articulos_almacen)
		));
		$acabados = $this->Acabado->find('all');
		$ano = date ("Y");
		foreach ($articulos as $a) {
			$entradas_articulo[$a['Articulo']['codigo']] = $this->Almacencliente->find('all',array(
				'fields' => array('SUM(Almacencliente.cajas)','acabado_id','Acabado.acabado','Almacencliente.articulo_id'),
				'conditions' => array(
					'Almacencliente.articulo_id' => $a['Articulo']['id'],
					'Almacencliente.tipo' => 'entrada',
				),
				'group' => array('Almacencliente.acabado_id')
			));
			$salidas_articulo[$a['Articulo']['codigo']] = $this->Almacencliente->find('all',array(
				'fields' => array('SUM(Almacencliente.cajas)','acabado_id'),
				'conditions' => array(
					'Almacencliente.articulo_id' => $a['Articulo']['id'],
					'Almacencliente.tipo' => 'salida',
				),
				'group' => array('Almacencliente.acabado_id')
			));
		} 
		$articulos = $this->Articulo->find('list',array(
			'fields' => array('id','cantidad_por_caja')
		));
		$this->set(compact('entradas_articulo','salidas_articulo','articulos','acabados'));
	}
	
	function egreso($articulo_id, $acabado_id) {
		if (!empty($this->data)) {
			$articulo_id = $this->data['Almacencliente']['articulo_id'];
			$acabado_id = $this->data['Almacencliente']['acabado_id'];
			if (empty($this->data['Almacencliente']['codigo'])) {
				$this->Session->setFlash('Debes colocar el código de la caja');
				$this->redirect(array('action' =>'egreso',$articulo_id,$acabado_id));
			}
			$user_id = $this->Auth->user('id');
			$user = $this->User->findById($user_id);
			$cliente_id = $user['User']['cliente_id'];
			$almacen = $this->Almacencliente->find('all',array(
				'conditions' => array('Pedido.cliente_id' => $cliente_id),

			));
			foreach ($almacen as $a) {
				$pedidos_almacen[] = $a['Almacencliente']['pedido_id']; 
			}
			$caja = $this->CajasPedido->find('first',array(
				'conditions' => array(
					'Caja.codigo' => $this->data['Almacencliente']['codigo'],
					'CajasPedido.pedido_id' => $pedidos_almacen,
					'Pedido.articulo_id' => $articulo_id,
					'Pedido.acabado_id' => $acabado_id,
				),
				'link' => array('Caja','Pedido')
			));
			if (empty($caja)) {
				$this->Session->setFlash('Código inválido');
				$this->redirect(array('action' =>'egreso',$articulo_id,$acabado_id));
			} 
			$existe_caja = $this->Almacencliente->find('first',array(
				'conditions' => array('Almacencliente.caja_id' => $caja['Caja']['id'])
			));
			if (empty($existe_caja)) {
				$hoy = date('Y-m-d H:i:s');
				$data = array(
					'Almacencliente' => array(
						'tipo' => 'salida',
						'articulo_id'=> $articulo_id,
						'cajas' => 1,
						'acabado_id' => $acabado_id,
						'mes' => $this->Config->obtenerMes($hoy),
						'caja_id' => $caja['Caja']['id']
					)
				);
				$this->Almacencliente->save($data);
				$this->Session->setFlash('El egreso se realizó con éxito');
				$this->redirect(array('action' =>'index'));
			} else {
				$this->Session->setFlash('La caja ya ha sido egresada del almacén');
				$this->redirect(array('action' =>'egreso',$articulo_id,$acabado_id));
			}
		}
		$this->set(compact('articulo_id','acabado_id'));
	}

}

?>
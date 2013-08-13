<?php

class PedidosController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','Search.Prg');
	public $uses = array('Pedido','Articulo','Subcategoria','Materiasprima','ArticulosMateriasprima','Config','Inventarioalmacen','CajasPedido','Caja','Cuenta');
    public $presetVars = true; // using the model configuration
	public $paginate = array();

	
    function admin_index() {
		$pedidos = $this->Pedido->find('all',array(
			'recursive' => 2
		));
		$count = 0;
		foreach ($pedidos as $p) {
			$entradas = 0;
			$salidas = 0;
			$ano = $this->Config->obtenerAno($p['Pedido']['fecha']);
			$pedidos[$count]['Pedido']['num_pedido'] = $pedidos[$count]['Pedido']['num_pedido'].$ano[2].$ano[3];
			if(!empty($p['Articulo']['Inventarioalmacen'])) {
				foreach ($p['Articulo']['Inventarioalmacen'] as $ia) {
					if ($ia['tipo'] == 'entrada' && $ia['acabado_id'] == $p['Pedido']['acabado_id']) {
						$entradas = $entradas + $ia['cajas'];
					} elseif ($ia['tipo'] == 'salida' && $ia['acabado_id'] == $p['Pedido']['acabado_id']) {
						$salidas = $salidas + $ia['cajas'];
					}
				}
				$saldo = $entradas - $salidas;
				if ($saldo >= $p['Pedido']['cantidad_cajas'] && $p['Pedido']['status'] == 'pendiente') {
					$status[$p['Pedido']['id']] = 'Disponible';
				} elseif ($saldo <= $p['Pedido']['cantidad_cajas'] && $p['Pedido']['status'] == 'pendiente') {
					$status[$p['Pedido']['id']] = 'No disponible';
				} else {
					$status[$p['Pedido']['id']] = $p['Pedido']['status'];
				}
			} else {
				if ($p['Pedido']['status'] == 'pendiente') {
					$status[$p['Pedido']['id']] = 'No disponible';
				} else {
					$status[$p['Pedido']['id']] = $p['Pedido']['status'];
				}
			}
			$count++;
		}
		$this->set(compact('status','pedidos'));
    }
	
	function admin_pedidos() {
		
		$this->Prg->commonProcess();
		$parametros = $this->Prg->parsedParams();
		if ($parametros){
			$this->paginate['conditions'] = $this->Pedido->parseCriteria($this->Prg->parsedParams());
			// $this->loadModel('Genero');
			$this->paginate['recursive'] = 2;
			$pedidos = $this->paginate();
		}else{
			$pedidos = $this->Pedido->find('all',array(
				'recursive' => 2
			));
		}
			$count = 0;
			foreach ($pedidos as $p) {
				$entradas = 0;
				$salidas = 0;
				$ano = $this->Config->obtenerAno($p['Pedido']['fecha']);
				$pedidos[$count]['Pedido']['num_pedido'] = $pedidos[$count]['Pedido']['num_pedido'].$ano[2].$ano[3];
				if ($p['Pedido']['status'] != 'Preparado' || $p['Pedido']['status'] != 'Progreso-Despacho') {
					if(!empty($p['Articulo']['Inventarioalmacen'])) {
						foreach ($p['Articulo']['Inventarioalmacen'] as $ia) {
							if ($ia['tipo'] == 'entrada' && $ia['acabado_id'] == $p['Pedido']['acabado_id']) {
								$entradas = $entradas + $ia['cajas'];
							} elseif ($ia['tipo'] == 'salida' && $ia['acabado_id'] == $p['Pedido']['acabado_id']) {
								$salidas = $salidas + $ia['cajas'];
							}
						}
						$saldo = $entradas - $salidas;
						if ($saldo >= $p['Pedido']['cantidad_cajas'] && $p['Pedido']['status'] == 'pendiente') {
							$status[$p['Pedido']['id']] = 'Disponible';
						} elseif ($saldo <= $p['Pedido']['cantidad_cajas'] && $p['Pedido']['status'] == 'pendiente') {
							$status[$p['Pedido']['id']] = 'No disponible';
						} else {
							$status[$p['Pedido']['id']] = $p['Pedido']['status'];
						}
					} else {
						if ($p['Pedido']['status'] == 'pendiente') {
							$status[$p['Pedido']['id']] = 'No disponible';
						} else {
							$status[$p['Pedido']['id']] = $p['Pedido']['status'];
						}
					}
				} else {
					$status[$p['Pedido']['id']] = $p['Pedido']['status'];
				}
				$count++;
			}
			
		$this->loadModel('Acabado');
		$acabados = $this->Acabado->find('list', array(
			'fields' => array('Acabado.acabado', 'Acabado.acabado')
		));
		$acabados = array_merge(array('Todos'), $acabados);
		$this->set(compact('status','pedidos', 'acabados'));
    }
	
	function admin_despachos() {
		$pedidos = $this->Pedido->find('all',array(
			'recursive' => 2
		));
		$count = 0;
		foreach ($pedidos as $p) {
			$entradas = 0;
			$salidas = 0;
			$ano = $this->Config->obtenerAno($p['Pedido']['fecha']);
			$pedidos[$count]['Pedido']['num_pedido'] = $pedidos[$count]['Pedido']['num_pedido'].$ano[2].$ano[3];
			if ($p['Pedido']['status'] == 'Despachado' || $p['Pedido']['status'] == 'Cancelado' ) {
				$status[$p['Pedido']['id']] = $p['Pedido']['status'];
			} elseif ($p['Pedido']['status'] == 'Progreso-Despacho') {
				$status[$p['Pedido']['id']] = 'En progreso';
			}
			$count++;
		}
		$this->set(compact('status','pedidos'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			$data = $this->data;
			if (!empty($this->data['Articulo']['Foto']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['Articulo']['Foto'], 'img\articulos', '')) {
					$data['Articulo']['imagen'] = $this->data['Articulo']['Foto']['name'];
				}
			}
			$i = 0;
			$this->Articulo->save($data);
			$id = $this->Articulo->id;
			$this->ArticulosMateriasprima->deleteAll(array(
				'articulo_id' => $id
			));
			foreach($this->data['materias'] as $m){
				if (!empty($m)){
					$existe = $this->ArticulosMateriasprima->find('first',array(
						'conditions' => array(
							'articulo_id' => $id,
							'materiasprima_id' => $m
						)
					));
					if (empty($existe)) {
						$data_m = array(
							'articulo_id' => $id,
							'materiasprima_id' => $m,
							'cantidad' => $this->data['cantidad'][$i]
						);
						$this->ArticulosMateriasprima->saveAll($data_m);
					}
					$i++;
				}
			}
			
			//die("sd");
			$this->Session->setFlash("Los datos se guardaron con éxito");
			$this->redirect(array('action' => 'admin_index'));
		} elseif (!empty($id)) {
			$titulo = "Editar";
			$this->data = $this->Articulo->findById($id);
			$materiales = $this->ArticulosMateriasprima->find('all',array(
				'conditions' => array(
					'articulo_id' => $id
				)
			));
			foreach ($materiales as $mat) {
				$valor_mp[] = $mat['ArticulosMateriasprima']['materiasprima_id'];
				$valor_cant[] = $mat['ArticulosMateriasprima']['cantidad'];
			}
		} else {
			$titulo = "Agregar";
		}
		$costo_produccion = $this->Config->find('first');
		$costo_produccion = $costo_produccion['Config']['costo_produccion'];
		$subcategorias = $this->Subcategoria->find('list',array(
			'fields' => array('id','descripcion')
		));
		$materiasprimas[0] = '';
		$materiasprimas= $materiasprimas + $this->Materiasprima->find('list',array(
			'fields' => array('id','descripcion')
		));
		$this->set(compact('id','subcategorias','titulo','materiasprimas','valor_mp','valor_cant','costo_produccion'));
	}
	
	
	function admin_ver($id) {
		$articulo = $this->Articulo->findById($id);
		$this->set(compact('articulo'));
	}
	
	function admin_forecast(){
		if (!empty($this->data)) {
			$data = $this->data;
			foreach ($data['cantidad'] as $key => $value){
				if ($value == 1){
					$cajas = $data['cajas'][$key];
					$articulo = $this->Articulo->findById($key);
					foreach ($articulo['Materiasprima'] as $mp){
						$datos = array (
							'Articulo' => $articulo['Articulo']['descripcion'],
							'Materiasprima' => $mp['descripcion'],
							'cantidad' =>  $mp['ArticulosMateriasprima']['cantidad'] * $articulo['Articulo']['cantidad_por_caja'] * $cajas,
							'cajas' => $cajas
						);
						$articulos_mp[$key][]= $datos;
					}
				}
			}
			$this->set(compact('articulos_mp'));
		} else {
			$articulos = $this->Articulo->find('all',array(
				'link' => array('Subcategoria' => 'Categoria'),
				'recursive' => 2
			));
			$this->set(compact('articulos'));
		}
	}
	
	function admin_ejecutar_pedido($id) {
		if (!empty($this->data)) {
			$pedido_id = $this->data['Pedido']['id'];
			$this->redirect(array('action' => 'admin_asignar_cajas',$pedido_id));	
		}
		$pedido = $this->Pedido->findById($id);
		$this->set(compact('pedido','id'));
	}
	
	function admin_ejecutar_despacho($id) {
		if (!empty($this->data)){
			if (!empty($this->data['Pedido']['factura'])) {
				$pedido = $this->Pedido->findById($this->data['Pedido']['id']);
				$hoy = date('Y-m-d H:i:s');
				$update_pedido = array(
					'Pedido' => array(
						'id' => $this->data['Pedido']['id'],
						'status' => 'Progreso-Despacho',
						'factura' => $this->data['Pedido']['factura'],
						'fecha' => $hoy
					)
				);
				$this->Pedido->save($update_pedido);
				$this->redirect(array('action' => 'admin_pedidos'));	
			} else {
				$this->Session->setFlash('Se debe introducir un número de factura');
			}
		}
		$pedido = $this->Pedido->findById($id);
		$this->set(compact('pedido','id'));
	}
	
	function admin_pedido_terminado($id) {
		$pedido = $this->Pedido->findById($id);
		$hoy = date('Y-m-d H:i:s');
		$update_pedido = array(
			'Pedido' => array(
				'id' => $id,
				'status' => 'Despachado',
				'fecha' => $hoy
			)
		);
		$this->Pedido->save($update_pedido);
		
		//Crear cuenta
		$cuenta = array(
			'Cuenta' => array(
			'pedido_id' => $id,
			'status' =>'Vigente',
		));
		$this->Cuenta->save($cuenta);
		$this->Session->setFlash('El pedido ha sido despachado y se creo una cuenta');
		$this->redirect(array('action' => 'admin_despachos'));	
	}
	
	function admin_asignar_cajas($pedido_id) {
		$cantidad = $this->Pedido->findById($pedido_id);
		$cantidad = $cantidad['Pedido']['cantidad_cajas'];
		if (!empty($this->data)) {
			$data = $this->data;
			foreach ($data['codigo'] as $c) {
				if (!empty($c)) {
					$count = 0;
					 foreach ($data['codigo'] as $d) {
						  $count += substr_count( $d, $c);
					 }
					if ($count > 1){
						$this->Session->setFlash("Cajas repetidas");
						$this->redirect(array('action' => 'admin_asignar_cajas',$pedido_id));
					}
					$caja = $this->Caja->find('first',array(
						'conditions' => array('Caja.codigo'=>$c)
					));
					if (empty($caja)) {
						$this->Session->setFlash("No existe una caja con el código ".$c);
						$this->redirect(array('action' => 'admin_asignar_cajas',$pedido_id));
					} else {
						$existe_codigo = $this->CajasPedido->find('first',array(
							'conditions' => array('CajasPedido.caja_id' => $caja['Caja']['id'])
						));
						if (!empty($existe_codigo)){
							$this->Session->setFlash("El código ".$c." ya ha sido asignado");
							$this->redirect(array('action' => 'admin_asignar_cajas',$pedido_id));
						} else {
							$buscar_en_inventario = $this->Inventarioalmacen->find('first',array(
								'conditions' => array(
									'Inventarioalmacen.id' => $caja['Caja']['inventarioalmacen_id']
								)
							));
							$articulo_id = $buscar_en_inventario['Inventarioalmacen']['articulo_id'];
							$acabado_id = $buscar_en_inventario['Inventarioalmacen']['acabado_id'];
							$pedido  = $this->Pedido->findById($pedido_id);
							if ($articulo_id != $pedido['Pedido']['articulo_id'] || $acabado_id != $pedido['Pedido']['acabado_id']) {
								$this->Session->setFlash("El código ".$c.' no contiene los articulos relacionados con este pedido');
								$this->redirect(array('action' => 'admin_asignar_cajas',$pedido_id));
							}
							$cajas_pedidos[] = array(
								'caja_id' => $caja['Caja']['id'],
								'pedido_id' => $pedido_id,
							);
						}
					}
				} else {
					$this->Session->setFlash("Debe ingresar todas las cajas");
					$this->redirect(array('action' => 'admin_asignar_cajas',$pedido_id));
				}
			}
			if($this->CajasPedido->saveAll($cajas_pedidos)){
				$pedido = $this->Pedido->findById($pedido_id);
				$hoy = date('Y-m-d H:i:s');
				$data = array(
					'Inventarioalmacen' => array(
						'tipo' => 'salida',
						'articulo_id'=> $pedido['Articulo']['id'],
						'cajas' => $pedido['Pedido']['cantidad_cajas'],
						'acabado_id' => $pedido['Pedido']['acabado_id'],
						'pedido_id' => $pedido_id,
						'mes' => $this->Config->obtenerMes($hoy),
					)
				);
				$this->Inventarioalmacen->save($data);
				$update_pedido = array(
					'Pedido' => array(
						'id' => $pedido_id,
						'status' => 'Preparado',
					)
				);
				$this->Pedido->save($update_pedido);
				$this->Session->setFlash('Pedido agregado con exito');
				$this->redirect(array('action' => 'admin_index'));
			}
			//var_dump($this->data); die();
		}
		$this->set(compact('cantidad'));
	}
	
	function admin_eliminar($id,$action) {
		$s = $this->Pedido->deleteAll(array('Pedido.id' => $id));
		$this->Session->setFlash('El pedido se borró con éxito');
		$this->redirect(array('action' =>$action));
	}
	
	function admin_cancelar($id,$action) {
		$update = array('Pedido' => array(
			'id' => $id,
			'status' => 'Cancelado'
		));
		$this->Pedido->save($update);
		$this->CajasPedido->deleteAll(array('CajasPedido.pedido_id' => $id),false);
		$this->Session->setFlash('El pedido se canceló con éxito');
		$this->redirect(array('action' =>$action));
	}
}

?>
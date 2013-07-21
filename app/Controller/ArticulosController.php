<?php

class ArticulosController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	public $uses = array('Articulo','Subcategoria','Materiasprima','ArticulosMateriasprima','Config','Categoria','Precio','Pedido','Acabado','AcabadosMateriasprima');
	
    function admin_index() {
		$articulos = $this->Articulo->find('all',array(
			'recursive' => 2
		));
		$this->set(compact('articulos'));
    }
	
	function admin_editar($id = null) {
		$titulo = "";
		if (!empty($this->data)) {
			$guardo = true;
			$data = $this->data;
			if (!empty($this->data['Articulo']['Foto']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['Articulo']['Foto'], 'img/articulos', '')) {
					$data['Articulo']['imagen'] = $this->data['Articulo']['Foto']['name'];
				}
			}
			$i = 0;
			$a = 0;
			$hay_materias = 0;
			foreach($this->data['materias'] as $m){
				if (!empty($m) && !empty($this->data['cantidad'][$a])){
					$hay_materias = $hay_materias + 1;
				}
				$a++;
			}
			if ( $hay_materias > 0 ){
				if ($this->Articulo->save($data)) {
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
								if ($this->ArticulosMateriasprima->saveAll($data_m)) {
									$guardo = true;
								} else {
									$guardo = false;
								}
							}
							$i++;
						} 
					}
					$precio = $this->Articulo->calcular_precio($id);
					$precio_arreglo = array('Articulo' => array(
						'precio' => $precio,
						'id' => $id
					));
					$this->Articulo->save($precio_arreglo);

					//Guardando los acabados
					$this->AcabadosMateriasprima->deleteAll(array(
						'articulo_id' => $id
					));
					foreach ($this->data as $k => $d) {
						if (strpos($k,'materia_acabado_') === false) {
						
						}else {
							$id_acabado = explode('_',$k);
							$id_acabado = $id_acabado[2];
							$count = 0;
							foreach($d as $a) {
								if ($a != 0) {
									$data_n = array(
										'articulo_id' => $id,
										'acabado_id' => $id_acabado,
										'cantidad' => $this->data['cantidad_acabado_'.$id_acabado][$count],
										'materiasprima_id' => $a
									);
									$this->AcabadosMateriasprima->create();
									if ($this->AcabadosMateriasprima->saveAll($data_n)) {
										$guardo = true;
									} else {
										$guardo = false;
									}
								}
								$count++;
							}
						}
					}
					
					if ($guardo){
					$this->Session->setFlash("El articulo ha sido guardado exitósamente");
					$this->redirect(array('action' => 'admin_index'));
					}
				} 
			} else {
				$this->Session->setFlash("El articulo debe tener por lo menos una materia prima asociada");
			}
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
			
			//Editar de acabado
			$acabados_asociados = $this->AcabadosMateriasprima->find('all',array(
				'fields' => array('DISTINCT acabado_id'),
				'conditions' => array('AcabadosMateriasprima.articulo_id' => $id)
			));
			if (!empty($acabados_asociados)) {
				foreach ($acabados_asociados as $as) {	
					$array_acabados[] = $as['AcabadosMateriasprima']['acabado_id'];
				} 
				foreach ($array_acabados as $id_a) {
				$materias_asociadas = $this->AcabadosMateriasprima->find('all',array(
					'conditions' => array(
						'AcabadosMateriasprima.articulo_id' => $id,
						'AcabadosMateriasprima.acabado_id' =>$id_a
					),
				));
				//var_dump($materias_asociadas);
				foreach ($materias_asociadas as $m_a) {
					$nombre_acabado = $this->Acabado->findById($m_a['AcabadosMateriasprima']['acabado_id']);
					$valores['materia_acabado'][$id_a]['acabado'][] = $nombre_acabado['Acabado']['descripcion'];
					$valores['materia_acabado'][$id_a]['id'][] = $m_a['AcabadosMateriasprima']['materiasprima_id'];
					$valores['cantidad_acabado'][$id_a][] = $m_a['AcabadosMateriasprima']['cantidad'];
				}
			}
			}
			
			//var_dump($valores); die();
			
		} else {
			$titulo = "Agregar";
		}
		$costo_produccion = $this->Config->find('first');
		$costo_produccion = $costo_produccion['Config']['costo_produccion'];
		$categorias = $this->Categoria->find('list',array(
			'fields' => array('id','descripcion')
		));
		$materiasprimas[0] = '';
		$materiasprimas_busqueda= $this->Materiasprima->find('all',array(
			'fields' => array('id','descripcion','unidad')
		));
		foreach ($materiasprimas_busqueda as $mp) {
			$materiasprimas[$mp['Materiasprima']['id']] =  $mp['Materiasprima']['descripcion'].' ('.$mp['Materiasprima']['unidad'].')';
		}
		$acabados = $this->Acabado->find('all');
		$this->set(compact('id','titulo','materiasprimas','valor_mp','valor_cant','costo_produccion','categorias','acabados','array_acabados','valores'));
	}
	
	function buscar_subcat() {
		$this->loadModel('Subcategoria');
		$subcat = $this->Subcategoria->find('all', array(
			'conditions' => array('Subcategoria.categoria_id' => $_POST['cat_id'])
		));
		$this->autoRender = false;
		$this->RequestHandler->respondAs('json');
		echo json_encode($subcat);
	}
	
	function admin_eliminar($id) {
		$this->Articulo->delete($id);
		$this->ArticulosMateriasprima->deleteAll(array(
			'articulo_id' => $id
		));
		$this->redirect(array('action' => 'admin_index'));
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
					if (!empty($data['acabados'][$key])) {
						$materias_acabado = $this->AcabadosMateriasprima->find('all',array(
							'conditions' => array(
								'AcabadosMateriasprima.acabado_id' => $data['acabados'][$key],
								'AcabadosMateriasprima.articulo_id' => $key
							)
						));
						foreach ($materias_acabado as $ma){
							$nombre_materia = $this->Materiasprima->findById($ma['AcabadosMateriasprima']['materiasprima_id']);
							$datos = array (
								'Articulo' => $articulo['Articulo']['descripcion'],
								'Materiasprima' => $nombre_materia['Materiasprima']['descripcion'],
								'cantidad' =>  $ma['AcabadosMateriasprima']['cantidad'] * $articulo['Articulo']['cantidad_por_caja'] * $cajas,
								'cajas' => $cajas
							);
							$articulos_mp[$key][]= $datos;
						}
					}
				}
			}
			$this->set(compact('articulos_mp'));
		} else {
			$articulos = $this->Articulo->find('all',array(
				'link' => array('Subcategoria' => 'Categoria'),
				'recursive' => 2
			));
			$articulos_con_acabado = $this->AcabadosMateriasprima->find('all',array(
				'group' => array('AcabadosMateriasprima.articulo_id')
			));
			foreach ($articulos_con_acabado as $a_c_a) {
				$busca_acabados = $this->AcabadosMateriasprima->find('all',array(
					'conditions' => array('AcabadosMateriasprima.articulo_id' => $a_c_a['AcabadosMateriasprima']['articulo_id']),
					'group' => array('AcabadosMateriasprima.acabado_id')
				));
				foreach($busca_acabados as $a) {
					$acabados_array[] = $a['AcabadosMateriasprima']['acabado_id'];
					//$arreglo_acabados[$a['AcabadosMateriasprima']['articulo_id']]
				}
				$acabados[$a_c_a['AcabadosMateriasprima']['articulo_id']] = $this->Acabado->find('list', array(
					'fields' => array('id','descripcion'),
					'conditions' => array('Acabado.id' => $acabados_array)
				));
			}
			$this->set(compact('articulos','acabados'));
		}
	}
	
	function subcategoria_catalogo(){
		$categorias = $this->Categoria->find('all',array(
			'contain' => array('Subcategoria')
		));
		$this->set(compact('categorias'));
	}
	
	function catalogo($sub_id) {
		if (!empty($this->data)){
			$data = $this->data;
			foreach ($data['activo'] as $key => $d) {
				if ($d == '1'){
					$articulo_id = $key;
				}
			}
			$cantidad = $data['cantidad'][$articulo_id];
			$acabado = $data['acabado'][$articulo_id]; 
			$cliente_id = $this->Auth->User('Cliente.id');
			$nuevo_pedido = array('Pedido' => array(
				'cliente_id' => $cliente_id,
				'status' => 'pendiente',
				'articulo_id' => $articulo_id,
				'cantidad_cajas' => $cantidad,
				'acabado_id' => $acabado,
			));
			$this->Pedido->save($nuevo_pedido);
			//var_dump($nuevo_pedido);die();
			$this->Session->setFlash('El pedido esta siendo procesado');
		}
		$subcategoria = $this->Subcategoria->find('first',array(
			'conditions' => array('Subcategoria.id' => $sub_id),
			'contain' => array('Articulo')
		));
		
		$articulos = $this->Articulo->find('all',array(
			'conditions' => array('Articulo.subcategoria_id' => $sub_id)
		));
		foreach ($articulos as $a) {
			$acum_precio = 0;
			$despacho = $this->Pedido->find('first',array(
				'conditions' => array(
					'Pedido.articulo_id' => $a['Articulo']['id'],
					'Pedido.status' => 'Despachado'
				),
				'order' => 'Pedido.fecha_despacho DESC'
			));
			if (empty($despacho)) {
				$despacho['Pedido']['fecha_despacho'] = "No registrado";
				$despacho['Pedido']['cantidad_cajas'] = "";
				$despacho['Acabado']['descripcion'] = "";
			}
			//var_dump($despacho);
			
			$precio_id = $this->Auth->User('Cliente.precio_id');
			$precio = $this->Precio->findById($precio_id);
			$ganancia = $precio['Precio']['ganancia'];
			$acum_precio = $this->Articulo->calcular_precio($a['Articulo']['id'], $ganancia); // llamamos a la funcion del modelo para calcular el precio
			$info_articulos[] = array (
				'articulo' => $a['Articulo']['descripcion'],
				'precio' => $acum_precio,
				'id' => $a['Articulo']['id'],
				'imagen' =>	$a['Articulo']['imagen'],			
				'cantidad_por_caja' => $a['Articulo']['cantidad_por_caja'],
				'fecha_despacho' => $despacho['Pedido']['fecha_despacho'],
				'cantidad_despacho' => $despacho['Pedido']['cantidad_cajas'],
				'acabado_despacho' => $despacho['Acabado']['descripcion'],
			);
		};
		$acabados = $this->Acabado->find('list',array(
			'fields' => array('id','descripcion')
		));
		$this->set(compact('info_articulos','subcategoria','acabados'));
	}
}

?>
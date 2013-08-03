<?php

class ArticulosController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler', 'Search.Prg');
	public $uses = array('Articulo','Subcategoria','Materiasprima','ArticulosMateriasprima','Config','Categoria','Precio','Pedido','Acabado','AcabadosMateriasprima','User');
    public $presetVars = true; // using the model configuration
	public $paginate = array();
	
    function admin_index($cat_id, $sub_id = null) {
		$this->set(compact('cat_id','sub_id'));
		if (empty($sub_id)) {
			$subcategorias = $this->Subcategoria->find('all',array(
				'conditions' => array('Subcategoria.categoria_id' => $cat_id)
			));
			foreach ($subcategorias as $s){
				$sub_id[]= $s['Subcategoria']['id'];
			}
		} else {
			$subcategoria = $this->Subcategoria->findById($sub_id);
		}
		$linea = $this->Categoria->findById($cat_id);
		$articulos = $this->Articulo->find('all',array(
			'conditions' => array('Articulo.subcategoria_id' => $sub_id),
			'recursive' => 2
		));
		foreach ($articulos as $a){
			$precio[$a['Articulo']['id']] = $this->Articulo->calcular_precio($a['Articulo']['id']);
		}
		$this->set(compact('articulos','subcategoria','linea','precio'));
    }
	
	function admin_editar($cat_id,$id = null,$sub_id = null) {
		$titulo = "";
		if (!empty($this->data)) {
			$guardo = true;
			$data = $this->data;
			$data['Articulo']['codigo'] = strtoupper($data['Articulo']['codigo']);
			if (!empty($this->data['Articulo']['Foto']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['Articulo']['Foto'], 'img/articulos', '')) {
					$data['Articulo']['imagen'] = $this->data['Articulo']['Foto']['name'];
				}
			}
			$i = 0;
			$a = 0;
			$hay_materias = 0;
			if (!empty($this->data['materias'])){
			foreach($this->data['materias'] as $m){
				if (!empty($m) && !empty($this->data['cantidad'][$a])){
					$hay_materias = $hay_materias + 1;
				}
				$a++;
			}
			}
			if ( $hay_materias > 0 && !empty($data['Articulo']['imagen'])){
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
					//Guardando los acabados
					$this->AcabadosMateriasprima->deleteAll(array(
						'articulo_id' => $id
					));
					//debug($this->data);die();
					foreach ($this->data as $k => $d) {
						if (strpos($k,'materia_acabado_') === false) {
						
						}else {
							$id_acabado = explode('_',$k);
							$id_acabado = $id_acabado[2];
							$count = 0;
							$hay_materia = 0;
							foreach($d as $a) {
								if ($a != 0) {
									$hay_materia++;
									if ($this->data['cantidad_acabado_'.$id_acabado][$count] > 0){
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
									} else {
										$guardo = false;
										$this->Session->setFlash("Se debe colocar cantidad a todas las materias primas seleccionadas");
										break;
									}
								}
								$count++;
							}
							if ($hay_materia < 1) {
								$guardo = false;
								$this->Session->setFlash("Para agregar una acabado este debe tener al menos una materia prima asociada");
								break;
							}
						}
					}
					
					if ($guardo){
					
						$this->Session->setFlash("El articulo ha sido guardado exitósamente");
						$this->redirect(array('action' => 'admin_index',$cat_id,$sub_id));
					}
				} 
			} else {
				if ($hay_materias <= 0){
					$this->Session->setFlash("El articulo debe tener por lo menos una materia prima asociada");
				} else {
					$this->Session->setFlash("Debes seleccionar una foto");
				}
			}
		} 
		if (!empty($id)) {
			$titulo = "Editar";
			$this->data = $this->Articulo->findById($id);
			$materiales = $this->ArticulosMateriasprima->find('all',array(
				'conditions' => array(
					'articulo_id' => $id
				),
			));
			$aux = 0;
			foreach ($materiales as $mat) {
				$m = $this->Materiasprima->findById($mat['ArticulosMateriasprima']['materiasprima_id']);
				$valor_mp[$aux]= $mat['ArticulosMateriasprima']['materiasprima_id'];
				$valor_cant[$aux]['cantidad'] = $mat['ArticulosMateriasprima']['cantidad'];
				$valor_cant[$aux]['unidad'] = $m['Materiasprima']['unidad'];
				$aux++;
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
					$m = $this->Materiasprima->findById($m_a['AcabadosMateriasprima']['materiasprima_id']);
					$valores['materia_acabado'][$id_a]['acabado'][] = $nombre_acabado['Acabado']['acabado'];
					$valores['materia_acabado'][$id_a]['id'][] = $m_a['AcabadosMateriasprima']['materiasprima_id'];
					$valores['cantidad_acabado'][$id_a]['cantidad'][] = $m_a['AcabadosMateriasprima']['cantidad'];
					$valores['cantidad_acabado'][$id_a]['unidad'][] = $m['Materiasprima']['unidad'];
				}
			}
			}
			
			//var_dump($valores); die();
			
		} else {
			$titulo = "Agregar";
		}
		$config = $this->Config->find('first');
		$costo_produccion = $config['Config']['costo_produccion'];
		$margen_ganancia = $config['Config']['margen_ganancia'];
		$categorias = $this->Categoria->find('list',array(
			'fields' => array('id','descripcion')
		));
		$materiasprimas[0] = '';
		$materiasprimas_busqueda= $this->Materiasprima->find('all',array(
			'fields' => array('id','descripcion','unidad')
		));
		$numero_materias = 0;
		foreach ($materiasprimas_busqueda as $mp) {
			$materiasprimas[$mp['Materiasprima']['id']] =  $mp['Materiasprima']['descripcion'].' ('.$mp['Materiasprima']['unidad'].')';
			$numero_materias++;
		}
		$acabados = $this->Acabado->find('all');
		$this->set(compact('id','titulo','materiasprimas','valor_mp','valor_cant','costo_produccion','categorias','acabados','array_acabados','valores','numero_materias','margen_ganancia','cat_id','sub_id'));
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
	
	function buscar_precio() {
		$this->loadModel('Materiasprima');
		$materia = $this->Materiasprima->findById($_POST['id_materia']);
		$precio = $materia['Materiasprima']['precio']*$_POST['cantidad'];
		$this->autoRender = false;
		$this->RequestHandler->respondAs('json');
		echo json_encode($precio);
	}
	
	function admin_eliminar($id, $cat_id, $sub_id = null) {
		$this->Articulo->delete($id);
		$this->ArticulosMateriasprima->deleteAll(array(
			'articulo_id' => $id
		));
		$this->Session->setFlash("El artículo se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index',$cat_id,$sub_id));
	}
	
	function admin_ver($id,$cat_id,$sub_id=null) {
		$articulo = $this->Articulo->findById($id);
		$this->set(compact('articulo','cat_id','sub_id'));
	}
	
	function admin_ver_forecast(){
		if (!empty($this->data)) {
			$data = $this->data;
			$entro = false;
			foreach ($data['cantidad'] as $key => $value){
				$acabado = $this->Acabado->findById($data['acabados'][$key]);
				if ($value == 1){
					$entro = true;
					$cajas = $data['cajas'][$key];
					if (empty($cajas) || $cajas < 0) {
						$this->Session->setFlash("El número de cajas debe ser mínimo 1");
						$this->redirect(array('action' => 'admin_forecast'));
					}
					$articulo = $this->Articulo->findById($key);
					foreach ($articulo['Materiasprima'] as $mp){
						$datos = array (
							'Articulo' => $articulo['Articulo']['codigo'],
							'Materiasprima' => $mp['descripcion'],
							'acabado' => $acabado['Acabado']['acabado'],
							'unidad' => $mp['unidad'],
							'piezas' => $cajas*$articulo['Articulo']['cantidad_por_caja'],
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
								'Articulo' => $articulo['Articulo']['codigo'],
								'acabado' => $data['acabados'][$key],
								'Materiasprima' => $nombre_materia['Materiasprima']['descripcion'],
								'unidad' => $nombre_materia['Materiasprima']['unidad'],
								'cantidad' =>  $ma['AcabadosMateriasprima']['cantidad'] * $articulo['Articulo']['cantidad_por_caja'] * $cajas,
								'cajas' => $cajas
							);
							$articulos_mp[$key][]= $datos;
						}
					}
				}
			}
			if (!$entro){
				$this->Session->setFlash("Debes escoger mínimo un artículo");
				$this->redirect(array('action' => 'admin_forecast'));
			}
			$this->set(compact('articulos_mp'));
		}
	}
	
	function admin_forecast(){
		
		// debug($this->Articulo);
		// die();
		// mandamos a la vista todas las subcategorias (Categorias al final)
		$this->loadModel('Subcategoria');
		$categorias = $this->Subcategoria->find('list', array(
			'fields' => array('Subcategoria.descripcion', 'Subcategoria.descripcion')
		));
		$categorias = array_merge( array('' => 'Todas'), $categorias);
		$this->set('descripcions', $categorias);	
		
		//preguntamos si vienen parametros del buscador
		$this->Prg->commonProcess();
		$parametros = $this->Prg->parsedParams();
		if($parametros){   // si viene con datos para el buscador, esto es para trabajar el buscador
											// sin una vista auxiliar como viene en el manual!! parece que sirve
		
		$this->paginate['conditions'] = $this->Articulo->parseCriteria($this->Prg->parsedParams());
		$this->loadModel('Genero');
		$this->paginate['recursive'] = 2;
		$articulos = $this->paginate(); // this->paginate() es magico, hace todo dadas las condiciones en this->paginate
		
		// aqui buscamos los acabados dado el resultado del search plugin
		
		foreach($articulos as $art){
			$acabados[$art['Articulo']['id']] = $prueba = $this->AcabadosMateriasprima->find('all', array (
				'conditions' => array(
					'articulo_id' => $art['Articulo']['id']
				),
				'fields' => array('acabado_id')
			));
		}		
		foreach($acabados as $a => $aca ){
			foreach($aca as $bados){
				$encontrado =  $this->Acabado->find('first', array(
					'conditions' => array(
						'id' => $bados['AcabadosMateriasprima']['acabado_id']
					)
				));
				$final[$a][$encontrado['Acabado']['id']] =  $encontrado['Acabado']['descripcion'];
			}
		}		
		// fin algoritmo de busqueda de acabados
		
        $this->set('articulos', $this->paginate());
		if(!empty($final)){
			$this->set('acabados', $final);
		}
		}else{ // si viene sin datos para el buscador jeje
	
			if (!empty($this->data)) {
			
			} else {
				$articulos = $this->Articulo->find('all',array(
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
						'fields' => array('id','acabado'),
						'conditions' => array('Acabado.id' => $acabados_array)
					));
				}
				$this->set(compact('articulos','acabados'));
			}
		}
	}
	
	function subcategoria_catalogo(){
		$categorias = $this->Categoria->find('all',array(
			'contain' => array('Subcategoria')
		));
		$this->set(compact('categorias'));
	}
	
	function subcategoria_articulo(){
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
			$cliente_id = $this->User->findById($this->Auth->User('id'));
			$cliente_id = $cliente_id['User']['cliente_id'];
			$ultimo_pedido = $this->Pedido->find('first',array(
				'order' => 'Pedido.id DESC'
			));
			$hoy = date('Y-m-d');
			$ano_hoy = $this->Config->obtenerAno($hoy);
			$ano_pedido = $this->Config->obtenerAno($ultimo_pedido['Pedido']['fecha']);
			if ($ano_hoy == $ano_pedido) {
				$num_pedido = $ultimo_pedido['Pedido']['num_pedido']+1;
			} else {
				$num_pedido = 1;
			}
			$nuevo_pedido = array('Pedido' => array(
				'cliente_id' => $cliente_id,
				'status' => 'pendiente',
				'articulo_id' => $articulo_id,
				'cantidad_cajas' => $cantidad,
				'acabado_id' => $acabado,
				'num_pedido' => $num_pedido
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
				'codigo' => $a['Articulo']['codigo'],
				'precio' => $acum_precio,
				'id' => $a['Articulo']['id'],
				'imagen' =>	$a['Articulo']['imagen'],			
				'cantidad_por_caja' => $a['Articulo']['cantidad_por_caja'],
				'fecha_despacho' => $despacho['Pedido']['fecha_despacho'],
				'cantidad_despacho' => $despacho['Pedido']['cantidad_cajas'],
				'acabado_despacho' => $despacho['Acabado']['descripcion'],
			);
		};

		// aqui buscamos los acabados dado el resultado del search plugin
		
		foreach($articulos as $art){
			$acabados[$art['Articulo']['id']] = $this->AcabadosMateriasprima->find('all', array (
				'conditions' => array(
					'articulo_id' => $art['Articulo']['id']
				),
				'fields' => array('acabado_id')
			));
		}		
		foreach($acabados as $a => $aca ){
			$count = 0;
			foreach($aca as $bados){
				$encontrado =  $this->Acabado->find('first', array(
					'conditions' => array(
						'id' => $bados['AcabadosMateriasprima']['acabado_id']
					)
				));
				$acabado_articulo[$a][$encontrado['Acabado']['id']] =  $encontrado['Acabado']['acabado'];
				if ($count == 0) {
					$acabado_descripcion[$a] =  $encontrado['Acabado']['descripcion'];
				}
				$count++;
			}
		}
		// fin algoritmo de busqueda de acabados
		for ($count=1; $count<=25; $count++){
			$cantidad_de_cajas[$count] = $count;
		}
		$this->set(compact('info_articulos','subcategoria','acabados','cantidad_de_cajas','acabado_articulo','acabado_descripcion'));
	}
	
	function buscar_unidad() {
		$this->loadModel('Materiasprima');
		$m = $this->Materiasprima->findById($_POST['id_materia']);
		$this->autoRender = false;
		$this->RequestHandler->respondAs('json');
		echo json_encode('Cantidad ('.$m['Materiasprima']['unidad'].')');
	}
	
	function buscar_acabado(){
		$this->loadModel('Acabado');
		$a = $this->Acabado->findById($_POST['acabado_id']);
		$this->autoRender = false;
		$this->RequestHandler->respondAs('json');
		echo json_encode($a['Acabado']['descripcion']);
	}
}

?>
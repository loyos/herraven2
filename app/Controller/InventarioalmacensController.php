<?php

class InventarioalmacensController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	public $uses = array('Inventarioalmacen','Materiasprima','Inventariomaterial','Config','Categoria','Articulo','Acabado','Caja','Subcategoria');
	
	
	function admin_agregar(){
		$categorias = $this->Categoria->find('all',array(
			'contain' => array('Subcategoria')
		));
		$this->set(compact('categorias'));
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
	
	function admin_ingresar($id) {
		$articulo = $this->Articulo->findById($id);
		if (!empty($this->data)) {
			$data = $this->data;
			$hoy = date('Y-m-d H:i:s');
			foreach ($articulo['Materiasprima'] as $m) {
				$cantidad_materia = $m['ArticulosMateriasprima']['cantidad'] * $data['Inventarioalmacen']['cajas'] *$articulo['Articulo']['cantidad_por_caja'];
				$inventario_materia = array(
					'Inventariomaterial' => array(
						'trimestre' => $this->Config->obtenerTrimestre($hoy),
						'ano' => $this->Config->obtenerAno($hoy),
						'semana' => $this->Config->obtenerSemana($hoy),
						'mes' => $this->Config->obtenerMes($hoy),
						'tipo' => 'salida',
						'fecha' => $hoy,
						'materiasprima_id' => $m['id'],
						'cantidad' => $cantidad_materia
					)
				);
				$this->Inventariomaterial->create();
				$this->Inventariomaterial->save($inventario_materia);	
			}
			$inventario_almacen = array(
				'Inventarioalmacen' => array(
					'tipo' => 'entrada',
					'articulo_id' => $id,
					'fecha' => $hoy,
					'cajas' => $data['Inventarioalmacen']['cajas'],
					'acabado_id' => $data['Inventarioalmacen']['acabado_id'],
				)
			);
			if ($this->Inventarioalmacen->save($inventario_almacen)) {
				$id_inventario_almacen = $this->Inventarioalmacen->id;
				$numero_cajas = $data['Inventarioalmacen']['cajas'];
				for ($i = 1; $i <= $numero_cajas ; $i++) {
					$caja = array('caja');
					while (!empty($caja)) {
						$codigo = $this->Caja->generar_codigo();
						$caja = $this->Caja->find('first',array(
							'conditions' => array('Caja.codigo' => $codigo)
						));
					}
					$nueva_caja = array(
						'Caja' => array(
							'inventarioalmacen_id' => $id_inventario_almacen,
							'codigo' => $codigo
					));
					$this->Caja->create();
					$this->Caja->save($nueva_caja);	
				}
				//$this->Session->setFlash("El ingreso al almacén se realizó con éxito");
				$this->redirect(array('action' => 'admin_etiquetas',$id_inventario_almacen));
			}
		}
		$acabados = $this->Acabado->find('list',array(
			'fields' => array('Acabado.id','Acabado.acabado')
		));
		$this->set(compact('acabados','articulo'));
	}
	
	function admin_index(){
		
	}
	
	function admin_articulos($cat_id = null,$sub_id = null) {
		if (empty($sub_id)) {
			$buscar_sub = $this->Subcategoria->find('all',array(
				'conditions' => array('Subcategoria.categoria_id' => $cat_id)
			));
			foreach ($buscar_sub as $sub) {
				$sub_id[]= $sub['Subcategoria']['id'];
			}
		}
		$articulos = $this->Articulo->find('all',array(
			'conditions' => array('Articulo.subcategoria_id' => $sub_id)
		));
		$this->set(compact('articulos'));
	}
	
	function admin_etiquetas($id_inventario,$print=null) {
		$cajas = $this->Caja->find('all', array(
			'conditions' => array(
				'inventarioalmacen_id' => $id_inventario
			),
			'recursive' => 2
		));
		//var_dump($this->params);die();
		$this->layout = 'sin_menu';
		$this->set(compact('cajas'));
	} 
	
	function admin_inventario(){
		$articulos = $this->Articulo->find('all');
		$acabados = $this->Acabado->find('all');
		$ano = date ("Y");
		foreach ($articulos as $a) {
			$entradas_articulo[$a['Articulo']['codigo']] = $this->Inventarioalmacen->find('all',array(
				'fields' => array('SUM(Inventarioalmacen.cajas)','acabado_id','Acabado.acabado','Inventarioalmacen.articulo_id'),
				'conditions' => array(
					'Inventarioalmacen.articulo_id' => $a['Articulo']['id'],
					'Inventarioalmacen.tipo' => 'entrada',
				),
				'group' => array('Inventarioalmacen.acabado_id')
			));
			$salidas_articulo[$a['Articulo']['codigo']] = $this->Inventarioalmacen->find('all',array(
				'fields' => array('SUM(Inventarioalmacen.cajas)','acabado_id'),
				'conditions' => array(
					'Inventarioalmacen.articulo_id' => $a['Articulo']['id'],
					'Inventarioalmacen.tipo' => 'salida',
				),
				'group' => array('Inventarioalmacen.acabado_id')
			));
		} 
		$this->set(compact('entradas_articulo','salidas_articulo','articulos','acabados'));
	}
	
	function admin_consultar_cajas($articulo_id,$acabado_id) {
		$entradas = $this->Inventarioalmacen->find('all',array(
			'conditions' => array(
				'Inventarioalmacen.articulo_id' => $articulo_id,
				'Inventarioalmacen.acabado_id' => $acabado_id
			)
		));
		foreach ($entradas as $e){
			$inventario[] = $e['Inventarioalmacen']['id'];
		}
		$cajas = $this->Caja->find('all',array(
			'conditions' => array(
				'Caja.inventarioalmacen_id' => $inventario
			)
		));
		$this->set(compact('cajas'));
	}
}

?>
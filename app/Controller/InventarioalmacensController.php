<?php

class InventarioalmacensController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	public $uses = array('Materiasprima','Inventariomaterial','Config','Categoria','Articulo','Acabado','Inventarioalmacen','Caja');
	
	
	function admin_agregar(){
		if (!empty($this->data)){
			$data = $this->data;
			$subcategoria_id = $data['Materiasprima']['subcategoria_id'];
			$this->redirect(array('action' => 'admin_articulos',$subcategoria_id));
		} else {
			$categorias = $this->Categoria->find('list',array(
				'fields' => array('id','descripcion')
			));
			$this->set(compact('categorias'));
		}
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
		if (!empty($this->data)) {
			$data = $this->data;
			$articulo = $this->Articulo->findById($id);
			$hoy = date('Y-m-d H:i:s');
			foreach ($articulo['Materiasprima'] as $m) {
				$cantidad_materia = $m['ArticulosMateriasprima']['cantidad'] * $data['Inventarioalmacen']['cajas'] *$articulo['Articulo']['cantidad_por_caja'];
				$inventario_materia = array(
					'Inventariomaterial' => array(
						'trimestre' => $this->Config->obtenerTrimestre($hoy),
						'ano' => $this->Config->obtenerAno($hoy),
						'tipo' => 'salida',
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
				$this->redirect(array('action' => 'admin_etiquetas',$id_inventario_almacen));
			}
		}
		$acabados = $this->Acabado->find('list',array(
			'fields' => array('Acabado.id','Acabado.acabado')
		));
		$this->set(compact('acabados'));
	}
	
	function admin_index(){
		
	}
	
	function admin_articulos($sub_id) {
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
		$this->set(compact('cajas'));
	} 
	
	
	
}

?>
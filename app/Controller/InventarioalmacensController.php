<?php

class InventarioalmacensController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	public $uses = array('Materiasprima','Inventariomaterial','Config','Categoria','Articulo','Acabado','Inventarioalmacen');
	
	
	function admin_agregar(){
		if (!empty($this->data)){
			$data = $this->data;
			
			$articulos = $this->Articulo->find('all',array(
				'conditions' => array('Articulo.subcategoria_id' => $data['Materiasprima']['subcategoria_id'])
			));
			// var_dump($data['Materiasprima']['subcategoria_id']);
			// var_dump($articulos);die("sd");
			$this->set(compact('articulos'));
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
			$this->Inventarioalmacen->save($inventario_almacen);
			$this->redirect(array('action' => 'admin_agregar'));
		}
		$acabados = $this->Acabado->find('list',array(
			'fields' => array('Acabado.id','Acabado.acabado')
		));
		$this->set(compact('acabados'));
	}
	
	function admin_index(){
		
	}
	
}

?>
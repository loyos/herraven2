<?php

class PreciosController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $uses = array('Precio','Materiasprima','MateriasprimasPrecio','Articulo','Categoria','Subcategoria');
	
    function admin_index() {
		$precios = $this->Precio->find('all');
		$this->set(compact('precios'));
    }
	
	function admin_editar($id = null) {
		$titulo = "";
		if (!empty($this->data)) {
			if ($this->Precio->save($this->data)) {
				$this->Session->setFlash("Los datos se guardaron con éxito");
				$this->redirect(array('action' => 'admin_index'));
			}
		} elseif (!empty($id)) {
			$this->data = $this->Precio->findById($id);
			$titulo = 'Editar';
		} else {
			$titulo = 'Agregar';
		}
		$this->set(compact('id','titulo'));
	}
	
	function admin_eliminar($id) {
		$this->Precio->delete($id);
		$this->Session->setFlash("la lista de precio se elimino con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_listar_subcategorias($id){
		$categorias = $this->Categoria->find('all',array(
			'contain' => array('Subcategoria')
		));
		$this->set(compact('categorias','id'));
	}
	
	function admin_ver($id,$cat,$subcat=null) {
		$materias = $this->Materiasprima->find('all');
		$precio = $this->Precio->findById($id);
		$ganancia = $precio['Precio']['ganancia'];
		if (empty($subcat)){
			$subcategorias = $this->Subcategoria->find('all',array(
				'conditions' => array('Subcategoria.categoria_id' => $cat)
			));
			foreach ($subcategorias as $s) {
				$subcat[] = $s['Subcategoria']['id'];
			}
		}
		$articulos = $this->Articulo->find('all',array(
			'conditions' => array('Articulo.subcategoria_id' => $subcat)
		));
		if ($id == 1) {
			foreach ($articulos as $a) {
				$acum_precio = $this->Articulo->calcular_precio($a['Articulo']['id']);
				$precio_articulo[] = array (
					'articulo' => $a['Articulo']['descripcion'],
					'precio' => $acum_precio,
					'codigo' => $a['Articulo']['codigo'],
					'cantidad' => $a['Articulo']['cantidad_por_caja']
				);
			};
			
		} else {
			$ganancia = $precio['Precio']['ganancia']/100;
			// foreach ($materias as $m){
				// $precio_m = $m['Materiasprima']['precio']+($m['Materiasprima']['precio']*$ganancia);
				// $precio_materia[] = array(
					// 'materia' => $m['Materiasprima']['descripcion'],
					// 'precio' => $precio_m
				// );
			// }
			$ganancia = $precio['Precio']['ganancia'];
			foreach ($articulos as $a) {
				$acum_precio = $this->Articulo->calcular_precio($a['Articulo']['id'], $ganancia);
				$precio_articulo[] = array (
					'articulo' => $a['Articulo']['descripcion'],
					'codigo' => $a['Articulo']['codigo'],
					'precio' => $acum_precio,
					'cantidad' => $a['Articulo']['cantidad_por_caja']
				);
			};
		}
		
		$this->set(compact('precio','precio_materia','precio_articulo'));
	}
	
	
}

?>
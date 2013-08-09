<?php

class PreciosController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $uses = array('Precio','Materiasprima','MateriasprimasPrecio','Articulo','Categoria','Subcategoria','AcabadosMateriasprima','Acabado');
	
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
		$precio = $this->Precio->findById($id);
		$acabados = $this->Acabado->find('list',array(
			'fields' => array('id','acabado')
		));
		$acabados[0]= '';
		if (!empty($this->data['Precio']['acabado_id'])) {
			$acabado_seleccionado = $this->data['Precio']['acabado_id'];
			$materias = $this->Materiasprima->find('all');
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
					$existe_acabado =  $this->AcabadosMateriasprima->find('all',array(
						'conditions' => array(
							'AcabadosMateriasprima.acabado_id' => $this->data['Precio']['acabado_id'],
							'AcabadosMateriasprima.articulo_id' => $a['Articulo']['id']
						)
					));
					if (!empty($existe_acabado)){
						$acum_precio = $this->Articulo->calcular_costo_total($a['Articulo']['id'],$this->data['Precio']['acabado_id']);
						$precio_articulo[] = array (
							'articulo' => $a['Articulo']['descripcion'],
							'precio' => $acum_precio,
							'codigo' => $a['Articulo']['codigo'],
							'cantidad' => $a['Articulo']['cantidad_por_caja']
						);
					}
				};
				
			} else {
				$ganancia = $precio['Precio']['ganancia']/100;
				
				$ganancia = $precio['Precio']['ganancia'];
				foreach ($articulos as $a) {
					$existe_acabado =  $this->AcabadosMateriasprima->find('all',array(
						'conditions' => array(
							'AcabadosMateriasprima.acabado_id' => $this->data['Precio']['acabado_id'],
							'AcabadosMateriasprima.articulo_id' => $a['Articulo']['id']
						)
					));
					if (!empty($existe_acabado)){
						$acum_precio = $this->Articulo->calcular_costo_total($a['Articulo']['id'], $this->data['Precio']['acabado_id'],$ganancia);
						$precio_articulo[] = array (
							'articulo' => $a['Articulo']['descripcion'],
							'codigo' => $a['Articulo']['codigo'],
							'precio' => $acum_precio,
							'cantidad' => $a['Articulo']['cantidad_por_caja']
						);
					}
				};
			}
			
			$this->set(compact('precio','precio_materia','precio_articulo','acabado_seleccionado'));
		}
		$this->set(compact('precio','acabados'));
	}
	
}

?>
<?php

class PreciosController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $uses = array('Precio','Materiasprima','MateriasprimasPrecio','Articulo');
	
    function admin_index() {
		$precios = $this->Precio->find('all');
		$this->set(compact('precios'));
    }
	
	function admin_editar($id = null) {
		$titulo = "";
		if (!empty($this->data)) {
			if ($this->Precio->save($this->data)) {
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
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_ver($id) {
		$materias = $this->Materiasprima->find('all');
		$precio = $this->Precio->findById($id);
		$articulos = $this->Articulo->find('all');
		if ($id == 1) {
			foreach ($materias as $m){
				$precio_materia[] = array(
					'materia' => $m['Materiasprima']['descripcion'],
					'precio' => $m['Materiasprima']['precio']
				);
			};
			foreach ($articulos as $a) {
				$acum_precio = 0;
				foreach ($a['Materiasprima'] as $mpa){
					$acum_precio = $acum_precio + ($mpa['precio']*$mpa['ArticulosMateriasprima']['cantidad']);
				}
				$precio_articulo[] = array (
					'articulo' => $a['Articulo']['descripcion'],
					'precio' => $acum_precio
				);
			};
			
		} else {
			$ganancia = $precio['Precio']['ganancia']/100;
			foreach ($materias as $m){
				$precio_m = $m['Materiasprima']['precio']+($m['Materiasprima']['precio']*$ganancia);
				$precio_materia[] = array(
					'materia' => $m['Materiasprima']['descripcion'],
					'precio' => $precio_m
				);
			}
			foreach ($articulos as $a) {
				$acum_precio = 0;
				foreach ($a['Materiasprima'] as $mpa){
					$precio_m = $mpa['precio']+($mpa['precio']*$ganancia);
					$acum_precio = $acum_precio + ($precio_m*$mpa['ArticulosMateriasprima']['cantidad']);
				}
				$precio_articulo[] = array (
					'articulo' => $a['Articulo']['descripcion'],
					'precio' => $acum_precio
				);
			};
		}
		
		$this->set(compact('precio','precio_materia','precio_articulo'));
	}
}

?>
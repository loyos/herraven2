<div class= "search">
	<?php			
			echo $this->Form->create(null, array(
				'url' => array_merge(array('action' => 'admin_index'), $this->params['pass'])
			));
			echo "<table><tr>";
			echo "<td>";
			echo "Cliente:";
			echo "</td>";
			echo "<td>";
			echo $this->Form->input('denominacion_legal', array('div' => false, 'label' => false));
			echo "</td></tr>";
			echo "<tr><td>";
			echo "Estatus:";
			echo "</td>";
			echo "<td>";
			echo $this->Form->select('Pedido.status', array(
				'No disponible' => 'No disponible',
				'cancelado' => 'Cancelado',
				'Progreso-Despacho' => 'Progreso-Despacho',
				'Despachado ' => 'Despachado',
				'Disponible ' => 'Disponible'
			));
			// echo $this->Form->input('wachu', array('div' => false, 'label' => false));
			echo "</td></tr>";
			echo "<tr><td>";
			echo "Acabado:";
			echo "</td><td>";
			echo $this->Form->input('acabado', array('div' => false, 'label' => false));
			echo "</td></tr>";
			echo "</table>";			
			echo $this->Form->submit(__('Buscar'), array('div' => 'search_button'));
			echo $this->Form->end();
	?>
</div>
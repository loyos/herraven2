<div class="wrap">
	<?php
	$count = 1;
	foreach ($cajas as $a) {
		if ($count%5==0 || $count%4==0){
			echo '<div class="etiqueta" style="clear:left; margin-top:25px;">';
		} else {
			echo '<div class="etiqueta" style="clear:left">';
		}
		if ($count==5){
			$count = 2;
		}
		?>
		<table style="width:100%; height:165px;">
			<tr>
				<td style="width:200px">
				<?php
				echo '<img src="http://web.herraven.com/img/articulos/'.$a['Inventarioalmacen']['Articulo']['imagen'].'" width="100px" height="100px">';
				?>
				</td>
				<td style="text-align:right">
				<?php
				echo '<div class="codigo_caja">';
				echo $a['Caja']['codigo'];
				echo '</div>';
				echo $a['Inventarioalmacen']['fecha'];
				?>
				</td>
			</tr>
			<tr>
				<td>
					<?php
					echo '<div class="codigo_caja">';
					echo $a['Inventarioalmacen']['Articulo']['codigo'];
					echo '<br>';
					if (!empty($a['Inventarioalmacen']['Acabado']['acabado'])){
						echo $a['Inventarioalmacen']['Acabado']['acabado'];
					} else {
						echo 'Sin Acabado';
					}
					echo '</div>';
					?>
				</td>
				<td  style="text-align:right">
					<?php 
					echo '<div class="codigo_caja">';
					echo $a['Inventarioalmacen']['Articulo']['cantidad_por_caja'].'Pz.';
					echo '</div>';
					?>
				</td>
			</tr>
		</table>
		<?php
		echo '</div>';
		$count++;
	}
	?>
</div>
<script>
  function imprimir() {
	alert("fd");
  window.print()
});
</script>
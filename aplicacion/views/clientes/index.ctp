
<h3>LISTADO CLIENTES</h3>

<?php echo $this->Html->link("Agregar Cliente", array ('action'=>'add'));?><br /><br />
<div id="datepicker"></div>
<table>
    <tr>
        <!--<th>Id</th>-->
        <th>Cliente</th>     
        <th>Zona</th>
        <th>Tipo</th>
        <th>Sector</th>		
		<th>Responsable Acciona</th>		
		<th>Obra Contrada 3 ult. años</th>		
		<th>Futura Obra</th>
		<th>Eliminar</th>		
		<th>Líder</th>		
	</tr>
	<?php foreach ($clienteslist as $clientelist): ?>
	<tr>
		<td><?php echo $this->Html->link($clientelist['Cliente']['desccliente'],
			array ('action'=>'edit', $clientelist['Cliente']['id'])); ?></td>	
		<td><?php echo $clientelist['Zona']['Desczona']; ?></td>	
		<td><?php echo $clientelist['Tipo']['Destipo']; ?></td>
		<td><?php echo $clientelist['Sectore']['descsector']; ?></td>
		<td>
			<?php foreach ($clientelist['User'] as $userdata): ?>
				<?php echo $userdata['name']." ".$userdata['surname']; ?><br />
			<?php endforeach; ?>
		</td>
		<td>
			<?php $fecha_actual = date("Y-m-d"); ?>
			<?php foreach ($clientelist['Obra'] as $obradata): 
					if ($fecha_actual>=$obradata['f_contratacion']){
						if ($fecha_actual-$obradata['f_contratacion']>3){
							echo "<class id='caduc'>".$obradata['DescObra']." ".$obradata['ValorObra']."</class>";
						} else {
							echo $obradata['DescObra']." ".$obradata['ValorObra'];
							} ?><br />
			<?php } endforeach; ?>
		</td>
		<td>
			<?php foreach ($clientelist['Obra'] as $obradata): 
					if ($fecha_actual<$obradata['f_contratacion']==1){
						echo $obradata['DescObra']." ".$obradata['ValorObra']; ?><br />
			<?php } endforeach; ?>
		</td>
		<td>
			<?php echo $this->Html->link('Delete', 
				array ('action'=>'delete', $clientelist['Cliente']['id']),
				array(),
				"¿Seguro que desea eliminar este cliente?"); ?>
		</td>
		<td><?php echo $clientelist['LiderUser']['name'];?></td>
	</tr>
    <?php endforeach; ?>
</table>

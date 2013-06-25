<h3>LISTADO CLIENTES ESTRATÉGICOS</h3>
<table>
    <tr>
        <th>Cliente</th>     
        <th>Zona</th>
        <th>Tipo</th>
        <th>Sector</th>		
		<th>Responsable Acciona</th>		
		<th>Obras</th>

	</tr>
	
	<?php foreach ($clienteslist as $clientelist): ?>
	<tr>
		<td><?php echo $clientelist['Cliente']['desccliente']; ?></td>	
		<td><?php echo $clientelist['Zona']['Desczona']; ?></td>	
		<td><?php echo $clientelist['Tipo']['Destipo']; ?></td>
		<td><?php echo $clientelist['Sectore']['descsector']; ?></td>
		<td>
			<?php foreach ($clientelist['User'] as $userdata): ?>
				<?php echo $userdata['name']." ".$userdata['surname']; ?><br />
			<?php endforeach; ?>
		</td>
		<td>
			<?php foreach ($clientelist['Obra'] as $obradata): ?>
				<?php echo $obradata['DescObra']." ".$obradata['ValorObra']; ?><br />
			<?php endforeach; ?>
		</td>
	</tr>
    <?php endforeach; ?>

</table>


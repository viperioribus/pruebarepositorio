<h1>Lista de Autores</h1>
<table>
	<tr>
		<th>Id</th>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Fecha de Nacimiento</th>
		<th>Fecha de Defunción</th>
		<th>Cambios</th>
		<th>Libros</th>
	</tr>
	<?php foreach($autors as $row):?>
	<tr>
		<td><?php echo $row['Autor']['id'];?></td>
		<td><?php echo $row['Autor']['nombre'];?></td>
		<td><?php echo $row['Autor']['apellido'];?></td>
		<td><?php echo $row['Autor']['fecha_nacimiento'];?></td>
		<td><?php echo $row['Autor']['fecha_defuncion'];?></td>
		<td><?php echo $html->link('Vista', '/autors/view/'.$row['Autor']['id']);?>
		<td><?php print_r($row);?></td>
		<?php echo $html->link('Editar', '/autors/edit/'.$row['Autor']['id']);?>
		<?php echo $html->link('Eliminar', '/autors/delete/'.$row['Autor']['id']);?>
		</td>
	</tr>
	<?php endforeach;?>
</table>
<ul>
<li><?php echo $html->link('Nuevo Autor', '/autors/add');?></li>
</ul>
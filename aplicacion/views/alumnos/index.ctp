<table>
	<thead>
		<th>Codigo</th>
		<th>Nombre</th>
		<th>Curso</th>
	</thead>
	<?php foreach($alumnos as $alumno): ?>
	<tr>
		<td><?php echo $alumno['Alumno']['codigo']; ?></td>
		<td><?php echo $alumno['Alumno']['nombre']; ?></td>
		<td><?php echo $alumno['Curso']['nombre']; ?></td>
	</tr>
	<?php endforeach; ?>
</table>
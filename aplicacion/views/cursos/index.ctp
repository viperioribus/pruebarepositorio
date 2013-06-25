<?php foreach($cursos as $curso): ?>
<h2><?php echo $curso['Curso']['nombre'] ?></h2>
<hr />
<h3>Alumnacos(s):</h3>
<ul>
<?php foreach($curso['Alumno'] as $alumno): ?>
	<li><?php echo $alumno['nombre']; ?></li>
<?php endforeach; ?>
</ul>
<?php endforeach; ?>
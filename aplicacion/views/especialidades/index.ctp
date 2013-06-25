<h2>Especialidades</h2>
<?php if (empty($especialidades)): ?>
	No hay especialidades
<?php else: ?>
	<table>
		<tr>
			<th>Nombre</th>
			<th>Pais</th>
			<th>Icono</th>
			<th>Deporte</th>
			<th>Acciones</th>
		</tr>
		<?php foreach($especialidades as $especialidade): ?>
		<tr>
			<td><?php echo $especialidade["Especialidade"]["nombre"]; ?></td>
			<td><?php echo $especialidade["Especialidade"]["pais_id"]; ?></td>
			<td><?php echo $especialidade["Especialidade"]["icon"]; ?></td>
			<td><?php echo "nada"; ?></td>
			
			<!-- Acciones -->
			<td>
				<?php echo $html->link('Editar', array('action'=>'edit', $especialidade['Especialidade']['id'])); ?>
				<?php echo $html->link('Borrar', array('action'=>'delete', $especialidade['Especialidade']['id']), NULL, '¿Estás seguro?'); ?>
			</td>
			
		</tr>
		<?php endforeach; ?>
	</table>
	
<?php

echo $html->div(
   null,
   $paginator->prev(
     '<< Previous', 
     array(
       'class' => 'PrevPg'
     ), 
     null, 
     array(
       'class' => 'PrevPg DisabledPgLk'
     )
   )."&nbsp;".
   $paginator->numbers().
   "&nbsp;".
   $paginator->next(
     'Next >>', 
     array(
       'class' => 'NextPg'
     ), 
     null, 
     array(
       'class' => 'NextPg DisabledPgLk'
     )
   ),
   array(
     'style' => 'width: 100%;'
   )
);  
?>
<?php endif; ?>
<br /><br />
<?php echo $html->link('Añadir Especialidad', array('action'=>'add')); ?><br />

<?php echo $html->link('Listar Especialidades', array('action'=>'index')); ?><br />
<?php if (!$pais): ?>
<?php 	echo $html->link('Listar especialidades de ESP', array('action'=>'index', 'ESP'));?><br />
<?php endif; ?>
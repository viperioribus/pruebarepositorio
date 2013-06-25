<h2>Equipos</h2>
<?php if (empty($equipos)): ?>
	No hay equipos
<?php else: ?>
	<table>
		<tr>
			<th>Nombre</th>
			<th>Ciudad</th>
			<th>Acciones</th>
		</tr>
		<?php foreach($equipos as $equipo): ?>
		<tr>
			<td><?php echo $equipo["Equipo"]["nombre"];?></td>
			<td><?php echo $equipo["Equipo"]["ciudad"];?></td>
			
			<!-- Acciones -->
			<td>
				<?php echo $html->link('Editar', array('action'=>'edit', $equipo['Equipo']['id'])); ?>
				<?php echo $html->link('Borrar', array('action'=>'delete', $equipo['Equipo']['id']), NULL, '¿Estás seguro?'); ?>
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
<?php echo $html->link('Añadir Equipo', array('action'=>'add')); ?><br />

<?php echo $html->link('Listar Equipos', array('action'=>'index')); ?><br />
<h2>Deportes</h2>
<?php if (empty($deportes)): ?>
	No hay deportes
<?php else: ?>
	<table>
		<tr>
			<th>Nombre</th>
			<th>Icon</th>
			<th>Especialidades</th>
			<th>Acciones</th>
		</tr>
		<?php foreach($deportes as $deporte): ?>
		<tr>
			<td><?php echo $deporte["Deporte"]["nombre"];?></td>
			<td><?php echo $deporte["Deporte"]["icon"];?></td>
			<td><?php 
			/*
			print_r($deporte);
			foreach ($deporte["Especialidade"] as $especialidade) {
				echo $especialidade["nombre"]."<br />";
			}*/
			
			echo $form->select('select1', $options, 1, array('onchange'=>"window.location.href='http://localhost/aplicacion/especialidades/index/'+this.value);"), false);?></td>
			
			<!-- Acciones -->
			<td>
				<?php echo $html->link('Editar', array('action'=>'edit', $deporte['Deporte']['id'])); ?>
				<?php echo $html->link('Borrar', array('action'=>'delete', $deporte['Deporte']['id']), NULL, '¿Estás seguro?'); ?>
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
<?php echo $html->link('Añadir Deporte', array('action'=>'add')); ?><br />

<?php echo $html->link('Listar Deportess', array('action'=>'index')); ?><br />
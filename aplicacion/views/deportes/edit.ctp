<?php echo $form->create('Especialidade'); ?>
<fieldset>
	<legend>Editar Especialidad</legend>
	<?php 
		echo $form->hidden('id');
		echo $form->input('nombre');
		echo $form->input('icon');
	?>
</fieldset>
<?php echo $form->end('Guardar'); ?>
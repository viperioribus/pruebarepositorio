<?php echo $form->create('Deporte'); ?>
<fieldset>
	<legend>Añadir nuevo Deporte</legend>
	<?php 
		echo $form->input('nombre');
		echo $form->input('icon');
		echo $form->select('select1', array(1=>'active',2=>'disabled'), 1, array('onchange'=>'jsfunction(this);'), false);
		echo $form->select('select1', $options, 1, array('onchange'=>"window.location.href='http://localhost/aplicacion/especialidades/index/'+this.value);"), false);
	?>
</fieldset>
<?php echo $form->end('Añadir Deporte'); ?>
<?php echo $html->link('Listar Deportes', array('action'=>'index')); ?>
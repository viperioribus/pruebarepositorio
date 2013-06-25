<head>
  	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  	<title>Documento sin título</title>
</head>
<body>
	<?php echo $form->create('Alumno'); ?>
	<fieldset>
		<legend>Añadir nuevo alumno</legend>
		<?php
			echo $form->input('codigo');
			echo $form->input('nombre');
			echo $form->input('apellidos');
			echo $form->input('curso_id');
		?>
	</fieldset>
	<?php echo $form->end('Submit'); ?>
</body>


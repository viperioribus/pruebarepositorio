<?php echo $this->Form->create();?>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Datos Cliente</a></li>
		<li><a href="#tabs-2">Responsables ACCIONA</a></li>
		<li><a href="#tabs-3">Contactos en Cliente</a></li>
		<li><a href="#tabs-4">Gestión de obras</a></li>
		<li><a href="#tabs-5">Otros datos</a></li>	
		<li><a href="#tabs-6">Seguimiento - Historial</a></li>	
	</ul>
	<div id="tabs-1">
		<p>
			<?php
			echo $this->Form->input('Cliente.desccliente', array('label'=>'Nombre'));
			echo $this->Form->input('Cliente.direccion', array('label'=>'Dirección'));
			echo $this->Form->input('Cliente.cpostal', array('label'=>'C.P'));
			echo $this->Form->input ('Cliente.ciudad', array('label'=>'Ciudad'));
			echo $this->Form->input ('Cliente.tlffijo', array('label'=>'Teléfono fijo'));
			echo $this->Form->input ('Cliente.email', array('label'=>'Correo electrónico'));
			echo $this->Form->input ('Cliente.web', array('label'=>'Web'));		
			echo $this->Form->input ('Cliente.fax', array('label'=>'Fax'));	
			echo $this->Form->input ('Cliente.tipo_id');
			echo $this->Form->input ('Cliente.sectore_id', array('label'=>'Actividad'));
			echo $this->Form->input ('Cliente.zona_id', array('label'=>'Zona geográfica'));
			echo $this->Form->input ('Cliente.estrategic', array('label'=>'Cliente estratégico'));
			?>
		</p>
	</div>
	<div id="tabs-2">
		<p>
			<?php
			echo $this->Form->input ('User.User', array(
				'label'=>'Responsable Acciona',
				));
			?>
		</p>
	</div>
	<div id="tabs-3">
		<p>
			<?php
			echo $this->Form->input ('Contacto.nombre', array('label'=>'Nombre'));	
			echo $this->Form->input ('Contacto.cargo', array('label'=>'Cargo'));	
			echo $this->Html->link('Agregar nuevo contacto','#');
			?>
		</p>
	</div>
	<div id="tabs-4">
		<p>
			<?php
			echo $this->Form->input ('Obra.Obra', array('label'=>'Obra Contratada'));
			?>
		</p>
	</div>
	<div id="tabs-5">
		<p>
			<?php
			echo $this->Form->input ('Obra.pagodias', array('label'=>'Pago días'));
			echo $this->Form->input ('Obra.tipocontratacion', array('label'=>'Tipo de contratación'));
			echo $this->Form->input('Obra.concesion', array (
				'label'=>'Concesión',
				'options'=>  array('No','Sí')
			));
			echo $this->Form->input('Obra.temeraria', array (
				'label'=>'Adjudican en temeraria',
				'options'=>  array('No','Sí')
			));
			echo $this->Form->input('Obra.proyectoobra', array (
				'label'=>'Proyecto y obra',
				'options'=>  array('No','Sí')
			));

			#echo $this->Form->file('Document.submittedfile');
			?>
		</p>
	</div>
	<div id="tabs-6">
		<p>
			Historial
		</p>
	</div>
</div>
<?php echo $this->Form->end('Enviar'); ?>

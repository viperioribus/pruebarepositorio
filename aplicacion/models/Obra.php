<?php
class Obra extends AppModel {
	public $name="Obra";
	public $validate= array(
		'f_contratacion'=>'date',
		'DescObra'=> array(
			'repetido'=> array (
				'rule'=>'isUnique',
				'message'=>'Ya existe este cliente'),
			'enblanco'=> array (
				'rule'=>'notEmpty',
				'message'=>'Completar campo')
			)
	
	);
	
}

?>

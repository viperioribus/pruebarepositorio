<?php

class User extends AppModel{
	public $name="User";
	public $validate= array(
		'user'=> array(
			'rule'=> 'isUnique',
			'allowEmpty'=> false,
			'message'=>'Completar campo o usuario ya existe'),
		'email'=> array (
			'rule'=>'email',
			'message'=>'Intorduzca una dirección de correo válida')
		
	);
	
}

?>

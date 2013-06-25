<?php

class Cliente extends AppModel{
	public $name= 'Cliente';
	
	public $validate= array(
		'desccliente'=> array(
			'rule'=>'isUnique',
			'required'=>true,
			'allowEmpty'=>false,
			'message'=>'Completar campo o cliente ya existe'));
	
		
	public $belongsTo= array ('Zona', 'Tipo', 'Sectore',
		'LiderUser' => array(
			'className'=>'User',
			'foreignKey'=>'lideruser_id')			
		);
			
	public $hasOne= array('Contacto'); #cambiar a hasMany
		
	public $hasAndBelongsToMany= array (
		'User'=> array(
			'order'=>'User.name ASC',
			'dependent'=> true),
		'Obra'=> array(
			'dependent'=> true)
	);
}

?>

<?php

	class Autor extends AppModel{
			
		var $name = 'Autor';
		var $displayField= 'nombre';
/*
		var $hasAndBelongsToMany =
					array(
						'Libro' => array(
										'className' => 'Libro',
										'joinTable' => 'autors_libros',
										'foreignKey' => 'autor_id',
										'associationForeignKey' => 'libro_id'
									)
					);
*/
		//var $hasAndBelongsToMany = 'Libro';
		
		/*public $hasAndBelongsToMany= array (
			'User'=> array(
				'order'=>'User.name ASC',
				'dependent'=> true),
			'Obra'=> array(
				'dependent'=> true)
		);*/
/*
		var $hasAndBelongsToMany= array (
			'Libro'=> array(
				'className' => 'Libro',
				'joinTable' => 'autors_libros',
				'associationForeignKey' => 'libro_id',
				'order'=>'Libro.titulo ASC',
				'dependent'=> true)
		);
*/					
	}
	
?>
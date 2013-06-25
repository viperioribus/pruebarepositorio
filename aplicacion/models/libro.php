<?php

	class Libro extends AppModel{
			
		var $name = 'Libro';
		var $displayField= 'titulo';
/*
		var $hasAndBelongsToMany =
					array(
						'Autor' => array(
										'className' => 'Autor',
										'joinTable' => 'autors_libros',
										'foreignKey' => 'libro_id',
										'associationForeignKey' => 'autor_id'
									)
					);
	
*/
		//var $hasAndBelongsToMany = 'Autor';

	}
	
?>
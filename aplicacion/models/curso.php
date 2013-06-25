<?php

class Curso extends AppModel {
	
	var $name = "Curso";
	var $hasMany = "Alumno";
	
	//var $hasMany = array('Alumno' => array('className' => 'Alumno'),
	//					 'Alumna' => array('className' => 'Alumna'));
	
}

?>
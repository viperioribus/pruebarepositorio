<?php

class Alumno extends AppModel {
	
	var $name = 'Alumno';
	var $belongsTo = 'Curso';
	
	//ar $hasOne = array('Dato' => array('className' => 'Dato'));
	
}

?>
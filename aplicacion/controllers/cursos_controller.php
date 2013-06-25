<?php

class CursosController extends AppController {
	
	var $name = "Cursos";
	//var $scaffold;
	
	function index() {
		
		$this->Curso->recursive = 1;
		$cursos = $this->Curso->find('all');
		$this->set('cursos', $cursos);
		
	}
	
}

?>
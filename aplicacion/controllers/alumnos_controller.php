<?php

class AlumnosController extends AppController {
	
	var $name = "Alumnos";
	var $helper = array('Form');
	//var $scaffold;

	function index() {
		
		$this->Alumno->recursive = 0;
		$alumnos = $this->Alumno->find('all');
		$this->set('alumnos', $alumnos);
		
	}
	
	function add() {
		
		if (!empty($this->data)) {
			$this->Alumno->create();
			$this->Alumno->save($this->data);
			$this->redirect(array('action' => 'index'));
		}
		$cursos = $this->Alumno->Curso->find('list', array('fields' => 'Curso.nombre'));
		$this->set('cursos', $cursos);
		
	}
	
}

?>
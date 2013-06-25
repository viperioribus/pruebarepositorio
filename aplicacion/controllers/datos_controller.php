<?php

class DatosController extends AppController {
	
	var $name = "Datos";
	var $helper = array('Form');
	//var $scaffold;

	function index() {
		
		$this->Dato->recursive = 0;
		$datos = $this->Dato->find('all');
		$this->set('datos', $datos);
		
	}
	
	function add() {
		
		if (!empty($this->data)) {
			$this->Dato->create();
			$this->Dato->save($this->data);
			$this->redirect(array('action' => 'index'));
		}
		$cursos = $this->Alumno->Curso->find('list', array('fields' => 'Curso.nombre'));
		$this->set('cursos', $cursos);
		
	}
	
}

?>
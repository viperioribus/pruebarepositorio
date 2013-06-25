<?php

class DeportesController extends AppController {
	
	var $name = 'Deportes';
	var $hasMany = 'Especialidade';
	var $scaffold;
	var $uses = array('Deporte');
	var $helpers = array('Html', 'Form');
	var $components = array('Util');
	
	var $validate = array(
						'nombre' => array(
										'rule' => array('custom','/[a-z]$/i'),
										'message' => 'Sólo letras permitidas'
										)
						);

	var $paginate = array(
						'limit' => 10, 
						'order' => array(
										'nombre', 
										'icon' 
						));
	
/*
	var $paginate = array(
						'fields' => array(
										'Especialidade.nombre', 
										'Especialidade.paise_id', 
										'Especialidade.icon'), 
						'limit' => 10, 
						'order' => array(
										'Especialidade.nombre', 
										'Especialidade.paise_id', 
										'Especialidade.icon' 
						));
*/	
//	function index() {
//		$this->set('especialidades', $this->Especialidade->find('all'));
//	}
	
	function index($pais = NULL) {
			
			/*
		if ($pais != NULL)
			$especialidades = $this->Especialidade->find('all', array('conditions' => array('Especialidade.pais_id' => $pais)));
		else
			$especialidades = $this->Especialidade->find('all');

		$data = $this->paginate('Especialidade', array('Especialidade.pais_id' => $pais));
		$this->set('especialidades', $data);
*/	
		$this->Deporte->recursive = 1;
		$arr_conditions = array();
		//if ($pais != NULL)
		//	$arr_conditions = array('Especialidade.pais_id' => $pais);

		$data = $this->paginate('Deporte', $arr_conditions);
		$this->set('deportes', $data);




//		$this->set('especialidades', $especialidades);
		$this->set('pais', $pais);
		//$id = $this->Util->adaptador($id, $data);
		$this->set('options', $this->Deporte->find('list', array('fields'=>'nombre')));
		
	} 
	
	function add() {
		
		$this->set('options', $this->Deporte->find('list', array('fields'=>'nombre')));
		if (!empty($this->data)) {
			$this->Deporte->create();
			if ($this->Deporte->save($this->data)) {
				$this->Session->setFlash('Datos guardados.');
				$this->redirect(array('action'=>'index'), NULL, TRUE);
			}
			else
				$this->Session->setFlash('Problema al guardar los datos.');
		}
		
	}
	
	function edit($id = null) {
		
		if (!$id) {
			$this->Session->setFlash('ID no encontrado.');
			$this->redirect(array('action'=>'index'), NULL, TRUE);
		}
		if (empty($this->data)) {
			$this->data = $this->Deporte->find(array('id' => $id));
		}
		else {
			if ($this->Deporte->save($this->data)) {
				$this->Session->setFlash('Datos guardados correctamente.');
				$this->redirect(array('action'=>'index', NULL, TRUE));
			}
			else {
				$this->Session->setFlash('Error al guardar.');
			}
		}
		
	}
	
	function delete($id = NULL) {
		
		if (!$id) {
			$this->Session->setFlash('ID no válido');
			$this->redirect(array('action'=>'index'), NULL, TRUE);
		}
		if ($this->Deporte->Del($id)) {
			$this->Session->setFlash('Deporte %'.$id.' eliminado.');
			$this->redirect(array('action'=>'index', NULL, TRUE));
		}
		
	}
	
}


?>
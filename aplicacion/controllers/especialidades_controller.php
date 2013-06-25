<?php

class EspecialidadesController extends AppController {
	
	var $name = 'Especialidades';
	var $belongsTo = 'Deporte';
	var $scaffold;
	var $uses = array('Especialidade');
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
										'pais_id', 
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
			
		$this->Especialidade->recursive = 0;
		$arr_conditions = array();
		if ($pais != NULL)
			$arr_conditions = array('Especialidade.pais_id' => $pais);

//		$data = $this->paginate($this->Especialidade->find('list', array('fields'=>array('Especialidade.nombre', 'Deporte.nombre'))), $arr_conditions);
		
		$data = $this->paginate('Especialidade', $arr_conditions);
		$this->set('especialidades', $data);

		$this->set('pais', $pais);
	} 
	
	function add() {
			
//		$deportes = $this->Especialidade->Deporte->find('list', array('fields' => 'Deporte.nombre'));	
		
		$this->set('options', $this->Especialidade->find('list', array('fields'=>'nombre')));
		if (!empty($this->data)) {
			$this->Especialidade->create();
			if ($this->Especialidade->save($this->data)) {
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
			$this->data = $this->Especialidade->find(array('id' => $id));
		}
		else {
			if ($this->Especialidade->save($this->data)) {
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
		if ($this->Especialidade->Del($id)) {
			$this->Session->setFlash('Especialidad %'.$id.' eliminada.');
			$this->redirect(array('action'=>'index', NULL, TRUE));
		}
		
	}
	
}


?>
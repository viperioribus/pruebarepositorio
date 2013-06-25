<?php

class EquiposController extends AppController {
	
	var $name = 'Equipos';
	var $uses = array('Equipo');
	var $helpers = array('Html', 'Form');
	var $components = array('Util');
/*	
	var $validate = array(
						'nombre' => array(
										'rule' => array('custom','/[a-z]$/i'),
										'message' => 'Sólo letras permitidas'
										)
						);
*/
	var $paginate = array(
						'limit' => 10, 
						'order' => array(
										'nombre', 
										'ciudad'
						));
	

	function index($pais = NULL) {
			
		$arr_conditions = array();
//		if ($pais != NULL)
//			$arr_conditions = array('Especialidade.pais_id' => $pais);

		$data = $this->paginate('Equipo', $arr_conditions);
		$this->set('equipos', $data);
//		$this->set('pais', $pais);
		
	} 
	
	function add() {
		
		$this->set('options', $this->Equipo->find('list', array('fields'=>'nombre')));
		if (!empty($this->data)) {
			$this->Equipo->create();
			if ($this->Equipo->save($this->data)) {
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
			$this->data = $this->Equipo->find(array('id' => $id));
		}
		else {
			if ($this->Equipo->save($this->data)) {
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
		if ($this->Equipo->Del($id)) {
			$this->Session->setFlash('Equipo %'.$id.' eliminado.');
			$this->redirect(array('action'=>'index', NULL, TRUE));
		}
		
	}
	
}


?>
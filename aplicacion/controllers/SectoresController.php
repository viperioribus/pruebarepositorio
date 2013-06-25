<?php

class SectoresController extends AppController {
	public $helpers= array('Html', 'Form');

	public function index(){
			$this->set('sectorslist', $this->Sectore->find('all'));
	}
	
	public function addsector(){
		if ($this->request->isPost()) {
			if ($this->Sectore->save($this->request->data)) {
				$this->Session->setFlash('Your post has been saved.');
				$this->redirect(array('action' => 'index'));
			} 
		}
	}
	
	public function delete ($idSector){
		$this->Sectore->delete($idSector);
		$this->Session->setFlash('Elemento eliminado');
		$this->redirect(array('action'=>'index'));		
	}
	
}

?>

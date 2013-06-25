<?php
class ObrasController extends AppController {

	public $components= array('RequestHandler');
	public $helpers = array('Js' => array('Jquery'));
    public $paginate = array(
        'limit' => 5,
        'order' => array(
            'Obra.DescObra' => 'asc'
        )
    );
    
	public function index() {
		#$this->set('obraslist', $this->Obra->find('all'));
		$obraslist= $this->paginate('Obra');
		$this->set ('obraslist', $obraslist);
	}
	
	public function add() {
		if ($this->request->isPost()){
			if ($this->Obra->save($this->request->data)){
				$this->Session->setFlash('Obra agregada');
				$this->redirect(array ('action'=>'index'));
			} 
		}
	}
	
	public function edit($idObra){
		$this->Obra->id= $idObra;
		if ($this->request->is('get')){
			$this->request->data= $this->Obra->read();
			} else {
				if ($this->Obra->save($this->request->data)){
					$this->Session->setFlash('Obra actualizada');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Obra NO actualizada');
					}
				}	
	}
		
	public function delete($id){
		$this->Obra->delete($id);
		$this->Session->setFlash("Obra eliminada");
		$this->redirect(array('action'=>'index'));
	}
}

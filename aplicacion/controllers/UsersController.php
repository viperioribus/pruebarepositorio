<?php

class UsersController extends AppController {
	
	public $name= 'Users';
	public $uses= array('User', 'Cliente');
	
	public function index(){
		$this->set('userslist', $this->User->find('all'));
	}
	
	public function add(){
		if ($this->request->isPost()){
			
			$this->User->set($this->request->data);
			
			
			if ($this->User->save($this->request->data)){
				$this->Session->setFlash('Usuario salvado');
				$this->redirect(array('action'=>'index'));
			}			
		}
	}	
	
	public function delete($id){
		$this->User->delete($id);
		$this->Session->setFlash('Elemento eliminado');
		$this->redirect(array('action'=>'index'));		
		
	}
	
    public function view($id = null) {
        $this->User->id = $id;
        $this->set('user', $this->User->read());
	}
	
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');
			}
		}
	}
	
	
	public function seguimiento() {
		$userlist= $this->User->find('all');
		$clientlist= $this->Cliente->find('all');
		$this->set(array(
			'userlist'=> $userlist,
			'clientlist'=> $clientlist
		));
	}
}

?>

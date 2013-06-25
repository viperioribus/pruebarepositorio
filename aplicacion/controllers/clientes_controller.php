<?php

class ClientesController extends AppController {

		public $name= 'Clientes';
		public $components= array('RequestHandler');
		public $helpers = array('Js' => array('Jquery'));
		#public $uses= array ('contactPersonas');
		public $paginate= array(
			'limit'=> 25);
			
		function listselectedfields (){
			$this->set('zonas', $this->Cliente->Zona->find('list',
				array('fields'=> array ('Zona.Desczona'))));
			$this->set('sectores', $this->Cliente->Sectore->find('list', 
				array('fields'=> array ('Sectore.descsector'))));
			$this->set('tipos', $this->Cliente->Tipo->find('list', 
				array('fields'=> array ('Tipo.Destipo'))));
			$this->set('obras', $this->Cliente->Obra->find('list', 
				array('fields'=> array ('Obra.DescObra'))));			
			
			
			$this->set('users', $this->Cliente->User->find('list', 
				array('fields'=> array ('User.surname'))));

		}
		
		public function index(){
			$this->set('clienteslist',$this->Cliente->find('all'));			
		}
				
		public function estrategic(){
			$this->set('clienteslist',$this->Cliente->findAllByEstrategic(1));			
		}
		
		public function nonestrategic(){
			$this->set('clienteslist',$this->Cliente->findAllByEstrategic(0));			
		}	
		
		public function delete($idCliente, $cascade= true){
			if ($this->Cliente->delete($idCliente)){
				$this->Session->setFlash('Cliente eliminado');
				$this->redirect(array('action'=>'index'));	
			}			
		}
		
		public function edit ($idCliente= null){
			

			$this->listselectedfields();
			
			$this->Cliente->id= $idCliente;
			if ($this->request->is('get')){
				$this->request->data= $this->Cliente->read();
			} else {
				if ($this->Cliente->save($this->request->data)){

					$this->Session->setFlash('Cliente actualizado');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Cliente NO actualizado');
					}
				}
			$this->render('add');	
		}
		
		public function add(){
		
			$this->listselectedfields();
			
			if ($this->request->isPost()){
				if ($this->Cliente->saveAll($this->request->data)){
					$this->Session->setFlash('Cliente agregado');
					$this->redirect(array('action'=>'index'));
				}
			}
		}	

		public function view($id){
			$this->Cliente->id = $id;
			$this->set('cliente', $this->Cliente->read());
		}			
}


?>

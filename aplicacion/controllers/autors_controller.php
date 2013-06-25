<?php

	class AutorsController extends AppController{

		var $name = 'Autors';
		var $helpers = array('Html', 'Form');
		
		function index() {

			$this->Autor->recursive = 1;
			$this->set('autors', $this->Autor->findAll());

		}

		function view($id){

			$this->set('autors', $this->Autor->read(null, $id));

		}
	}
	
?>
<?php

class Especialidade extends AppModel {
	
	var $name = 'Especialidade';
	var $validate = array(
						'nombre' => array(
										'rule' => VALID_NOT_EMPTY, 
										'message' => 'Campo Nombre vacío.'
									)	
					);
}

?>
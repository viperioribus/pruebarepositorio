<?php

class Deporte extends AppModel {
	
	var $name = 'Deporte';
	var $validate = array(
						'nombre' => array(
										'rule' => VALID_NOT_EMPTY, 
										'message' => 'Campo Nombre vacío.'
									)	
					);
}

?>
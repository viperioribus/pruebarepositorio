<?php

class Equipo extends AppModel {
	
	var $name = 'Equipo';
	var $validate = array(
						'nombre' => array(
										'rule' => VALID_NOT_EMPTY, 
										'message' => 'Campo Nombre vacío.'
									)	
					);
}

?>
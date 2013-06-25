<?php

class Sectore extends AppModel{
	public $name="Sectore";
	public $validate= array(
		'descsector'=> array(
			'rule'=>'notEmpty',
			'message'=>'Completar campo'));

}

?>

<?php



class Inicial{
	
	function Inicial($id, $table, $idfield){
		
		$this->_table=$table;
		$this->_idfield=$idfield;
		$this->_id=$id;
		
	}

	function getID(){return $this->_id;}
	
	function getAt($atrib){
		
		GLOBAL $db;
	
						
			$queryStr = "SELECT ".$atrib." FROM "._TABLE_PREFIX_.$this->_table." WHERE ".$this->_idfield." = '" . $this->_id . "'";
			$resArr = $db->getResultArray($queryStr);
			
			if (is_bool($resArr) && $resArr == false)
				return false;
			else if (count($resArr) != 1)
				return false;
			
			$resArr = $resArr[0];
			
			return $resArr[$atrib];
				
	}

	function setAt($atrib, $valor){
		
		GLOBAL $db;
		
			$queryStr = "UPDATE "._TABLE_PREFIX_.$this->_table." SET ".$atrib." = '".$va."' WHERE ".$this_idfield." = ".$this->_id;
			$res = $db->getResult($queryStr);
			if (!$res)
				return false;
			
			return true;
	  			
	}
	

}
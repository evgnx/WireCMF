<?php

class router extends dispatcher  {
	

	function __construct ($root) {
		
		$this->dispatcher = parent::__construct($root);
		return $this;
	}
	
	
}


?>
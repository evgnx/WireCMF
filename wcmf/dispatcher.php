<?php

class dispatcher {
	
	protected $arrPatterns = array();
	protected $arrUri = array();
	protected $strUri;
	public $sysRoot;
	
	function __construct ($sys_root, $locale = '') {
		$this->locale = $locale;
		$this->sysRoot = $sys_root;
		$ok = rtrim(str_replace('?'.$_SERVER['QUERY_STRING'],'', $_SERVER['REQUEST_URI']),'/');
		$this->fullUri = $_SERVER['SERVER_NAME'].$ok;
		$this->makeRequest($ok);
		
	}

	
	function makeRequest($uri_str) {
		foreach(explode('/',$uri_str) as $key=>$val)
			$this->arrPatterns[] = $val;
		$this->arrPatterns[0] = '/';
		
		for($i=0;$i<count($this->arrPatterns); $i++) 
			$this->arrUri[] = isset($this->arrUri[$i-1])?$this->arrUri[$i-1].'/'.$this->arrPatterns[$i]:'';
		$this->arrUri[0] = '/';

		$this->strUri = str_replace('//','/', implode ('/',$this->arrPatterns));	
	}
	
	function getUriStr() {
		return $this->strUri;
	}

	function getPatternsArr() {
		return $this->arrPatterns;
	}
	
	function getUriArr() {
		return $this->arrUri;
	}

	function getSysPath() {
		if(file_exists($this->sysRoot.$this->strUri)) {
			return $this->sysRoot.$this->strUri;
		} else {
			return false;
		}
	}

	function getPatternCfg($uri) {
		if(file_exists($file = $this->sysRoot.$uri.'/_config.php')) {
			return $file;
		} else {
			return $this->sysRoot.'/_global.php';
		}
	}
	
	function getRouteCfg($uri) {
		if(file_exists($file = $this->sysRoot.$uri.'/_router.php')) {
			return $file;
		} else {
			return $this->sysRoot.'/_global.php';
		}
	}
	
	function setRoute($from, $to) {
		if($this->getUriStr() == $from) {
			
			$this->arrPatterns = array();
			$this->arrUri = array();			
			
			$this->makeRequest($to);
		}
		
	}
}

?>
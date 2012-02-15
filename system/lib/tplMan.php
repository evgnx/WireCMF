<?php

class tplMan {
	
	private $templates = array();
	
	function __construct () {
	}
	
	function setTemplate($url,$file) {
		$data = array('url'=>$url,'file'=>$file);
		$this->templates[] = $data;
	}
	
	function getTemplate($url) {

		//print_r($this->templates);

		$cur_tpl = '';
		for($i=0;$i<count($url);$i++) {
			for($j=0;$j<count($this->templates);$j++) {
				if($url[$i] == $this->templates[$j]['url'] && file_exists($this->templates[$j]['file'])) {
					
					$cur_tpl = $this->templates[$j]['file'];
					//print_r($cur_tpl);
				}
			}
		}
		
		
		
		if('' != $cur_tpl) {
			return $cur_tpl;
		} else {
			die('There is no templates defined');
		}
	}
	
}


?>
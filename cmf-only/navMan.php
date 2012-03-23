<?php
class navMan {

	function __construct ($dispatcher) {
				
		$this->arr_data = $this->getNavigationBlocks($dispatcher);
		$this->templates = array();
		$this->locale = $dispatcher->locale;
	}
	
	function setTemplate($arr_labels, $file) {
		foreach ($arr_labels as $label) {
			if(file_exists($file)) {
				$this->templates[$label] = $file;
			}
		}
	}

	function getHTMLStr($label,$arr_params = array()) {
		if(isset($this->templates[$label])) {
	
			$xsl = new DOMDocument;
			$xsl->resolveExternals = TRUE;
			$xsl->substituteEntities = TRUE;
		
			if($xsl->load($this->templates[$label])) {

				$proc = new XSLTProcessor;
				$proc->importStyleSheet($xsl);
				foreach($arr_params as $name=>$val) $proc->setParameter('', $name,$val);		
				echo $proc->transformToXML($this->dom);
			} else {
				echo 'Template is not loaded';
			}
		} else {
			echo "Template is not defined<";
		}
	}
	

	function makeXML($cur_uri) {

		$dom = new DOMDocument('1.0');
		$dom->loadXML('<root></root>');
		$dom->documentElement->setAttribute('current_url',$cur_uri);
		$dom->encoding = 'utf-8';
		$dom->formatOutput = true;

		$groups = array();
		$passed  = array();

		
		
		foreach($this->arr_data as $uri=>$data) {
			foreach($data['labels'] as $group=>$block) {

				if(!isset($groups[$group])) {
					$group_elm = $dom->createElement('group');
					$group_elm->setAttribute('label',$group);
					$dom->documentElement->appendChild($group_elm);
				}

				for($i=0;$i<count($block);$i++) {
					$item_elm = $dom->createElement('item');
					$item_elm->setAttribute('indx',$block[$i]['indx']);
					$item_elm->setAttribute('href',$block[$i]['href']);
					$item_elm->setAttribute('name',$block[$i]['name']);	
					
						
					
					$parent_elm = isset($passed[$uri][$group])?$passed[$uri][$group]:$group_elm;
					
					$parent_elm->appendChild($item_elm);
					$passed[$block[$i]['href']][$group] = $item_elm; 
				}
				$groups[$group] = '';
			}
		}
		$this->str = $dom->saveXML();
		$this->dom = $dom;	
	}

	
	function getNavigationBlocks($dispatcher) {

		$arr_nav = array();
		foreach($dispatcher->getUriArr() as $uri) {
			
			$path = $dispatcher->sysRoot.($uri=='/'?$uri:$uri.'/');
			$path.= '_config.xml';			
			
			if(file_exists($path)) {
				$cur_sxe = simplexml_load_file($path);
				
				if(is_object($cur_sxe) && isset($cur_sxe->navigation) && isset($cur_sxe->navigation->block)) {
					foreach($cur_sxe->navigation->block as $block) {
						if($uri == $dispatcher->getUriStr() ||
						   $uri != $dispatcher->getUriStr() && (integer) $block['inherit']) {
							$arr_nav[(string) $block['url_from']]['labels'][(string) $block['label']] = array();
						}
					}
				}
			}
		}
		
		return $this->getNavItemsForBlock($dispatcher, $arr_nav);
		
	}
	
	function getNavItemsForBlock($dispatcher,$arr_nav) {
		
		foreach($arr_nav as $uri=>$val) {
			$path = $dispatcher->sysRoot.($uri=='/'?$uri:$uri.'/');
			if ($handle = opendir($path)) {
				while (false !== ($file = readdir($handle))) {
				    if ($file != "." && $file != ".." && is_dir($path.$file)) {
						$file = is_dir($path.$file)?$path.$file."/_config.xml":$path.$file;
				        if(file_exists($file)) 	$arr_nav[$uri]['files'][] = $file;
				    }
				}
				closedir($handle);
			}
		}
		
		//print_r($arr_nav);
		
		foreach($arr_nav as $uri=>$val) {
			
			if (isset($arr_nav[$uri]['files'])) {
			
				foreach($arr_nav[$uri]['files'] as $fid=>$file) {
					$cur_sxe = simplexml_load_file($file);
					if(is_object($cur_sxe) && isset($cur_sxe->node)) {
						
						
						
						foreach($cur_sxe->node as $node) {
							if((string) $node['locale'] === (string) $dispatcher->locale ) {						
								foreach($arr_nav[$uri]['labels'] as $lid => $label) {
									if($lid == (string) $node['label'] ) {
										$_indx = isset($node['indx'])?(int) $node['indx']:0;
										$_href = str_replace(array($dispatcher->sysRoot,'/_config.xml'),'',$file);
										$_arr = array('href'=>$_href,
													  'name'=> (string) $node,
													  'indx'=> $_indx,
													  'locale'=> (string) $node['locale']
													 
													  );
										$arr_nav[$uri]['labels'][$lid][] = $_arr;
									}
								}
							}					
						}
					}
				}
			}
		}
		
		return $arr_nav;
	}
}


?>
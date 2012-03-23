<?php

class ctxMan {
	
	protected $curXMLData;
	
	function __construct ($dispatcher, $locale = '') {
		
		$this->locale = $locale;
		
		$dom_ctx = new DOMDocument('1.0');
		$dom_ctx->loadXML('<root></root>');
		$dom_ctx->encoding = 'utf-8';
		$dom_ctx->formatOutput = true;

		$dom_path = new DOMDocument('1.0');
		$dom_path->loadXML('<root></root>');
		$dom_path->encoding = 'utf-8';
		$dom_path->formatOutput = true;
		$dom_path->documentElement->setAttribute('current_url',$dispatcher->getUriStr());


		foreach($dispatcher->getUriArr() as $uri) {
			
			$path = $dispatcher->sysRoot.($uri=='/'?$uri:$uri.'/');
			$path.= '_config.xml';			

			$item_elm = $dom_path->createElement('item');			
			if(file_exists($path)) {
			
				$cur_sxe = simplexml_load_file($path);
				
				if(is_object($cur_sxe) && isset($cur_sxe->title)) {
					foreach($cur_sxe->title as $title) {
						if(isset($title['scope']) && (string) $title['scope'] == 'path') {
							$item_elm->setAttribute('name', (string) $title);
						} else {
							$item_elm->setAttribute('name', $uri);							
						}
					}
				} else {
					$item_elm->setAttribute('name', $uri);						
				}
				
				
				
				if(is_object($cur_sxe)) {
					
					if(isset($cur_sxe->context)) {
						$cur_dom_sxe = dom_import_simplexml($cur_sxe->context);
					}
						$cur_dom_sxe->setAttribute('uri',$uri);
						$cur_dom_sxe = $dom_ctx->importNode($cur_dom_sxe,true);
						$cur_dom_sxe = $dom_ctx->documentElement->appendChild($cur_dom_sxe);
				
					if($uri == $dispatcher->getUriStr()) {
						$this->metaData = $cur_sxe;
					}
				}
			}
			$item_elm->setAttribute('href', $uri);
			$dom_path->documentElement->appendChild($item_elm);
		}
		
		$this->ctx_xml_str = $dom_ctx->saveXML();
		$this->ctx_xml_sxe = simplexml_import_dom($dom_ctx);
		
		$this->path_xml_str = $dom_path->saveXML();
		$this->dom_path = $dom_path;			
	}
	

	
	function prepareContent($sxe, $uri) {

		$files 	 = array();
		$arr_res = array();

		foreach($sxe as $item) {
			 
			if(count($item->file)) {
				
				foreach($item->file as $file) {
					
					$cur_file = array('label'  =>(string) $file['label'],
									  'file'   =>(string) $file['name'],
									  'type'   =>(string) 'include',
									  'locale' =>(string) $file['locale'],									  
									  'inherit'=>(string) $file['inherit']);
					if($uri == $item['uri'] && $cur_file['inherit'] != 'drop') {
						$arr_res[] = $cur_file;
					} else {
						if($cur_file['inherit'] == '1' || $cur_file['inherit'] == 'true') {
							$arr_res[] = $cur_file;
						}
						
						if($cur_file['inherit'] == 'drop') {
							foreach($arr_res as $i=>$drop) {
								if($drop['label'] == $cur_file['label'] &&
								   $drop['file'] == $cur_file['file'] &&
								   $drop['type'] == $cur_file['type']) {
									unset($arr_res[$i]);
									
									
								}
							}
						}
					}
				}
			}
		}
		
		$this->files = $arr_res;
		return $arr_res;
	}

	function getFile($label, $path) {
		
		
		
		$res = $this->findFileByLabel($label);
	
		
		if(is_array($res) && $res['type'] == 'include') {
			if(file_exists($path.$res['file'])) {
				include_once ($path.$res['file']);
			} else {
				echo 'File not found @:'.$path.$res['file'];
			}
		} else {
			
			
				//echo 'There is no label / file';
		}
	}
	
	function findFileByLabel($label) {
		foreach ($this->files as $file) {
			if($file['label'] == $label && ($file['locale'] == $this->locale || $file['locale'] == '')) {
	
				return $file;				
			}
		}
		return false;
	}

	function getTitle($scope = 'title') {
		
		
		if( isset($this->metaData->title)) {
			
			//echo "1";
			foreach($this->metaData->title as $title) {
				if((string) $title['scope'] == $scope) {
					echo (string) $title;
				}
			}
		} else {
			//echo "2";
			return false;
		}
	}
	
	function getPath($file_xsl, $arr_params = array()) {
		
		$xsl = new DOMDocument;
		$xsl->resolveExternals = TRUE;
		$xsl->substituteEntities = TRUE;

		if($xsl->load($file_xsl)) {
			$proc = new XSLTProcessor;
			$proc->importStyleSheet($xsl);
			
			
			foreach($arr_params as $name=>$val) $proc->setParameter('', $name,$val);		
			echo $proc->transformToXML($this->dom_path);
		} else {
			echo 'Template is not loaded';
		}
	}
	
	function getMeta($types) {
		$str = '';
		if( isset($this->metaData->meta)) {
			foreach(explode(',',$types) as $type) {
				foreach($this->metaData->meta as $meta) {
					if((string) $meta['name'] == $type) {
						$str.= (string) $meta->asXML();
						$str.="\n";
					}
				}
			}
		}
		echo $str;
	}
	

	
	
}


?>
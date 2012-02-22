<?php
// for test 
define('LOCALE', ($_SERVER['SERVER_NAME'] == 'coecru.tw1.ru')?'ru':'en'); 
define('CURRENT', LOCALE == 'ru'?'COEC.RU':'COEC.CA');
define('ANOTHER', LOCALE == 'ru'?'COEC.CA':'COEC.RU');
define('CURRENT_URL', LOCALE == 'ru'?'coecru.tw1.ru':'coecca.tw1.ru');
define('ANOTHER_URL', LOCALE == 'ru'?'coecca.tw1.ru':'coecru.tw1.ru');
// 

define('CMFPATH',$_SERVER['DOCUMENT_ROOT']."/cmf/"); //CMF
define('TPLPATH',$_SERVER['DOCUMENT_ROOT']."/tpl/"); //wireframes
define('INCPATH',$_SERVER['DOCUMENT_ROOT']."/_inc/"); //content
define('XSLPATH',$_SERVER['DOCUMENT_ROOT']."/xsl/"); //templates

include_once(CMFPATH.'lib/dispatcher.php');
include_once(CMFPATH.'lib/tplMan.php');
include_once(CMFPATH.'lib/ctxMan.php');
include_once(CMFPATH.'lib/navMan.php');


$dispatcher = new Dispatcher($_SERVER['DOCUMENT_ROOT']."/_", LOCALE);

if ($path = $dispatcher->getSysPath()) {

	//including local config files

	for($i=0;$i<count($arrUri = $dispatcher->getUriArr());$i++) {
		include_once($dispatcher->getRouteCfg($arrUri[$i]));
	}


	$objTplMan = new tplMan();
	$objCtxMan = new ctxMan($dispatcher, LOCALE);
	$objNavMan = new navMan($dispatcher);	
	$objNavMan->makeXML($dispatcher->getUriStr());
	
	
	for($i=0;$i<count($arrUri = $dispatcher->getUriArr());$i++) {
		include_once($dispatcher->getPatternCfg($arrUri[$i]));
	}


	//including template;
	$_tmp_ctx = $objCtxMan->prepareContent($objCtxMan->ctx_xml_sxe, $dispatcher->getUriStr());
	include_once $objTplMan->getTemplate($dispatcher->getUriArr());

	/*echo '<pre style="margin:10px; padding:10px; border:1px solid grey;font:normal 10px/14px Monaco; display:block; background:#fff"; >';
	echo 'path:';
	echo $path;
	echo "\n\n";
	print_r($dispatcher->getUriArr());
	echo "\n\n";	
	echo htmlspecialchars($objCtxMan->ctx_xml_str)."\n";
	echo "\n\n";
	echo htmlspecialchars($objCtxMan->path_xml_str)."\n";
	echo "\n\n";
	echo 'nav:\n';	
	echo htmlspecialchars($objNavMan->str)."\n";
	echo "\n\n";	
	print_r($objNavMan->templates);
	echo "\n\n";	
	print_r($objNavMan->arr_data);
	echo "\n\n";
	print_r($_tmp_ctx);
	echo "\n\n";	
	echo '</pre>';*/


} else {
	
	echo('404');
	
}

?>



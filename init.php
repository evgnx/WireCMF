<?php
define('TPLPATH',$_SERVER['DOCUMENT_ROOT']."/templates/");
define('INCPATH',$_SERVER['DOCUMENT_ROOT']."/includes/");
$syspath = $_SERVER['DOCUMENT_ROOT']."/system/";
$xslpath = $_SERVER['DOCUMENT_ROOT']."/xsl/";
$root  =  $_SERVER['DOCUMENT_ROOT']."/root";

include_once($syspath.'lib/dispatcher.php');
include_once($syspath.'lib/tplMan.php');
include_once($syspath.'lib/ctxMan.php');
include_once($syspath.'lib/navMan.php');

$dispatcher = new Dispatcher($root);

if ($path = $dispatcher->getSysPath()) {

	//including local config files

	for($i=0;$i<count($arrUri = $dispatcher->getUriArr());$i++) {
		include_once($dispatcher->getRouteCfg($arrUri[$i]));
	}


	$objTplMan = new tplMan();
	$objCtxMan = new ctxMan($dispatcher);
	$objNavMan = new navMan($dispatcher);	
	$objNavMan->makeXML($dispatcher->getUriStr());
	
	
	for($i=0;$i<count($arrUri = $dispatcher->getUriArr());$i++) {
		include_once($dispatcher->getPatternCfg($arrUri[$i]));
	}


	//including template;
	$_tmp_ctx = $objCtxMan->prepareContent($objCtxMan->ctx_xml_sxe, $dispatcher->getUriStr());

	include_once $objTplMan->getTemplate($dispatcher->getUriArr());

	echo '<pre style="margin:10px; padding:10px; border:1px solid grey;font:normal 10px/14px Monaco; display:block";>';
	echo $path;
	echo "\n\n";
	print_r($dispatcher->getUriArr());
	echo "\n\n";	
	echo htmlspecialchars($objCtxMan->ctx_xml_str)."\n";
	echo "\n\n";
	echo htmlspecialchars($objCtxMan->path_xml_str)."\n";
	echo "\n\n";	
	echo htmlspecialchars($objNavMan->str)."\n";
	echo "\n\n";	
	print_r($objNavMan->templates);
	echo "\n\n";	
	//print_r($objNavMan->arr_data);
	//echo "\n\n";
	//print_r($_tmp_ctx);
	//echo "\n\n";	
	echo '</pre>';

} else {
	
	echo('404');
	
}

?>



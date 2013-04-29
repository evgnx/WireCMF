<?php
// relative path
define('ASSETS_REL','/_assets/');  //


// path relatetd to server root
define('SRVR',	$_SERVER['DOCUMENT_ROOT']);
define('BOOT',	SRVR.'/boot');
define('WCMF',	SRVR.'/wcmf/'); 	//framework
define('LIBS',	WCMF.'/base/'); 	//framework libraries
define('LAYOUT',SRVR.'/_layout/'); 	//layouts [stands for 'wireframe'] for pages
define('ASSETS',SRVR.ASSETS_REL);   //
define('TMPLTS',SRVR.'/_tmplts/'); 	//templates [xslt templates for building navigation — subj 4 r7d ]

// REQUIRED LIBS (min)
// dispatcher is the basic module, which handle all request, which came to server [requires Apache mod_rewrite]
include_once(WCMF.'dispatcher.php'); 
// bacic libraries to manage templates / content / navigation [requires xml/php configuration files located @URI]
include_once(LIBS.'tplMan.php');
include_once(LIBS.'ctxMan.php');
include_once(LIBS.'navMan.php');

// initialising Dispatcher first
$dispatcher = new Dispatcher(BOOT);


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
	
	include_once SRVR.'/debug.php';

} else {
	echo('404');
}


?>


<?php

$objTplMan->setTemplate($arrUri[$i],TPLPATH.'main.tpl.php');
$objNavMan->setTemplate(array('general'),TPLPATH.'_nav_general.xsl');
$objNavMan->setTemplate(array('ad','marketing'),TPLPATH.'_nav_left.xsl');
$objNavMan->setTemplate(array('ad_types'),TPLPATH.'_nav_right.xsl');


?>

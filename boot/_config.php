<?php
$objTplMan->setTemplate($arrUri[$i],LAYOUT.'/main.tpl/main.tpl.php');

$objNavMan->setTemplate(array('insurance_estate_nav'),TMPLTS.'nav_products.xsl');
$objNavMan->setTemplate(array('insurance_car_nav'),TMPLTS.'nav_products.xsl');
$objNavMan->setTemplate(array('insurance_person_nav'),TMPLTS.'nav_products.xsl');

$objNavMan->setTemplate(array('insurance_nav'),TMPLTS.'nav_products.xsl');
$objNavMan->setTemplate(array('main_nav'),TMPLTS.'nav_main.xsl');
?>
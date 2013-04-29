<?php
 $cache_expire = 256;//60*60*24*365;
 header("Pragma: public");
 header("Cache-Control: max-age=".$cache_expire);
 header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$cache_expire) . ' GMT');
 ?>

<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ru-RU">
<body>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>*</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- meta: begin -->
<?php $objCtxMan->getFile('com_header',ASSETS.'data/'); ?>
<!-- meta: end --> 
<!-- js-top: begin -->
<?php $objCtxMan->getFile('com_header_scr',ASSETS.'data/'); ?>
<!-- js-bottom: begin -->

</head>
<body>
АСТ электронный полис
<div>
	<?php $objNavMan->getHTMLStr('main_nav',array('label'=>'main_nav')); ?>
</div>
<div>
	<?php $objNavMan->getHTMLStr('insurance_nav',array('label'=>'insurance_nav','bloq'=>'person')); ?>
</div>
<div>
	<?php $objNavMan->getHTMLStr('insurance_nav',array('label'=>'insurance_nav','bloq'=>'estate')); ?>
</div>
<div>
	<?php $objNavMan->getHTMLStr('insurance_nav',array('label'=>'insurance_nav','bloq'=>'vehicle'));?>
</div>
<!-- prouct-flow-visual: begin -->
<?php $objCtxMan->getFile('product_flow',ASSETS.'data/'); ?>
<!-- prouct-flow-visual: end -->

<div>
	<?php $objCtxMan->getFile('cmain_top',ASSETS.'data/'); ?>
	<?php $objCtxMan->getFile('cmain_mid',ASSETS.'data/'); ?>
	<?php $objCtxMan->getFile('cmain_btm',ASSETS.'data/'); ?>
</div>
<div>
	<?php $objCtxMan->getFile('col_r_top',ASSETS.'data/'); ?>
	<?php $objCtxMan->getFile('col_r_mid',ASSETS.'data/'); ?>
	<?php $objCtxMan->getFile('col_r_btm',ASSETS.'data/'); ?>
</div>
<?php $objCtxMan->getFile('com_footer',ASSETS.'data/'); ?>
<?php $objCtxMan->getFile('com_footer_scr',ASSETS.'data/'); ?>
</body>
</html>
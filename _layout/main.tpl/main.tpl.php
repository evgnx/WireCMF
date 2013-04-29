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
<title>"АСТ — электронный полис. Страховой полис онлайн.</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Open Graph Tags -->
<meta property="og:title" content="АСТ — электронный полис." />
<meta property="og:desription" content="АСТ электронный страховой полис — это сервис покупки страхового полиса онлайн. Пакетные предложения от лидеров: Альянс, ВТБ Страхование, ВСК, Россгострах" />
<meta property="og:locale" content="ru_RU" />
<meta property="og:locale:alternate" content="en_US" />
<meta property="og:type"  content="website" />
<meta property="og:url" content="http://ast-epolis.ru/" />
<meta property="og:image" content="http://ast-epolis.ru/images/ast-epolis.png"/>
<meta property="og:site_name" content="АСТ — электронный полис" />
<meta property="fb:admins" content="1154591383" />
<!-- // --> 

<!-- itemscope and itemtype attributes [schema.org/LocalBusiness] -->
<meta itemprop="name" content="АСТ — электронный полис. Страхование недвижимости, страхование выезжающих за рубеж, страхование автомобиля.">
<meta itemprop="description" content="АСТ электронный страховой полис — это сервис покупки страхового полиса онлайн. Пакетные предложения от лидеров: Альянс, ВТБ Страхование, ВСК, Россгострах">
<meta itemprop="image" content="http://epolis-ast.ru">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script> 
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
</head>
<body>
АСТ электронный полис
<div>
	<ul>
		<?php $objNavMan->getHTMLStr('main_nav',array('label'=>'main_nav','kind'=>'pills')); ?>
	</ul>
</div>
<div>
	<?php $objNavMan->getHTMLStr('insurance_nav',array('label'=>'insurance_nav','bloq'=>'person')); ?>
</div>
<div>
	<?php $objNavMan->getHTMLStr('insurance_nav',array('label'=>'insurance_nav','bloq'=>'estate')); ?>
</div>
<div>
	<?php $objNavMan->getHTMLStr('insurance_nav',array('label'=>'insurance_nav','bloq'=>'vehicle')); ?>
</div>
</body>
</html>
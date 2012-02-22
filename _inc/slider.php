<?
$url = rtrim(str_replace('?'.$_SERVER['QUERY_STRING'],'', $_SERVER['REQUEST_URI']),'/');

$building_q = 37;
$products_q = 7;
$building = array();
$products = array();

if ($url == '' ||  $url =='/steelbuidings') {
	for ($i = 1; $i <= $building_q; $i++) {
		$building[$i-1] = '<li><img src="/_img/products/ci_00_c'.(($i < 10)?'0':'').$i.'.jpg" style="width:320; height:200px"/></li>'; }
}


if ($url == ''  || $url =='/products') {
	for ($i = 1; $i <= $products_q ; $i++) {
		$products[$i-1] = '<li><img src="/_img/products/ci_01_c'.(($i < 10)?'0':'').$i.'.jpg" style="width:320; height:200px"/></li>'; }
}	

$allimg = array_merge($building,$products);
shuffle($allimg);

?>

<ul id="slider1">
<? for ($i = 0; $i <= count($allimg); $i++) {echo $allimg[$i];} ?>
</ul>
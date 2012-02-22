<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>
<?php $objCtxMan->getTitle();?>
</title>
<!-- ?php $objCtxMan->getMeta('keywords,description');?-->
<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
<script src="/tpl/_j/jall.js" type="text/javascript"></script>
<script src="/tpl/_j/jquery.bxSlider.min.js" type="text/javascript"></script>
<script src="/tpl/_j/jquery.easing.1.3.js" type="text/javascript"></script>
<script>

function log(msg){
  if (window.console && console.log) {
    console.log(msg); //for firebug
  }
}

</script>
<link rel="stylesheet" href="/tpl/_c/rest.css" />
<link rel="stylesheet" href="/tpl/_c/grid.css" />
<link rel="stylesheet" href="/tpl/_c/page.css" />
<link rel="stylesheet" href="/tpl/_c/font.css" />
<link rel="stylesheet" href="/tpl/_c/text.css" />
<link rel="stylesheet" href="/tpl/_c/menu.css" />
</head>

<body>
<!-- my grid -->
<div id="overlay">&nbsp;</div>
<div class="container">
	<div class="container_12">
		<div class="grid_12 alpha omega clearfix topwrap">
			<div class="row clearfix">
				<div class="grid_1 col">
					<div class="clocal tt-center"> 
						<!-- clocale-switch:begin --> 
						<span class="ww-switch"> <a href="http://<?=strtolower(CURRENT_URL);?>" style="color:#FFF; text-decoration:none"><?=CURRENT;?></a></span> 
						<!-- clocale-switch:end --> 
					</div>
				</div>
				<div class="grid_6 prefix_5 clearfix col">
					<div class="grid_5 alpha">
						<div class="phonebox">
							<div>+1 (647) 478—85—58</div>
						</div>
					</div>
					<div class="grid_1 omega">
						<div class="slocal tt-center"> <span class="ww-switch"> 
							<!-- slocale-switch:begin --> 
							<a href="http://<?=strtolower(ANOTHER_URL);?>" style="color:#F00"><?=ANOTHER;?></a> 
							<!-- slocale-switch:end --> 
							</span> </div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
		<!-- intro-row -->
		<div class="grid_12 alpha omega clearfix"> 
			<!-- r1 -->
			<div class="grid_8 prefix_2 suffix_2 alpha omega">
				<h1 class="coec">
					<?php $objCtxMan->getTitle();?>
				</h1>
			</div>
			<div class="clear"></div>
			<!-- r2 -->
			<div class="grid_10 prefix_1 suffix_1 alpha omega tt-center intro"> 
				<!-- @include_once TEXT.INDEX_INTRO -->
				<?php $objCtxMan->getFile('intro',INCPATH); ?>
			</div>
			<div class="clear"></div>
			<!-- r3 -->
			<div class="grid_10 prefix_1 suffix_1 alpha omega">
				<div class="p-add20b clearfix">
					<div id="centeredmenu">
						<?php $objNavMan->getHTMLStr('main',array('label'=>'main','locale'=>LOCALE)); ?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="grid_10 alpha omega prefix_1 suffix_1">
				<?php $objCtxMan->getFile('main',INCPATH); ?>
				<div class="clear">&nbsp;</div>
			</div>
		</div>
		<div class="clear">&nbsp;</div>
		<div id="slidewrap">
			<div class="control control-prev"><a href="" id="go-prev">prev</a></div>
			<div class="control control-next"><a href="" id="go-next">next</a></div>
			<div class="clear">&nbsp;</div>
			<div style="width:320px;">
				<?php $objCtxMan->getFile('slidr',INCPATH); ?>
			</div>
		</div>
		<div class="clear">&nbsp;</div>
		<?php $objCtxMan->getFile('footr',INCPATH);?>
		<div class="clear">&nbsp;</div>
	</div>
</div>
</body>
</html>

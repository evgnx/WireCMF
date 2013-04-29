<?



echo '<pre style="margin:10px; padding:10px; border:1px solid grey;font:normal 10px/14px Monaco; display:block; background:#fff"; >';
	echo 'path:';
	echo $path;
	echo "\n\n";
	echo 'title:';
	echo "\n\n";
	print_r($objCtxMan->getTitle());
	echo "\n\n";
	echo 'URL (Array):';
	echo "\n\n";
	print_r($dispatcher->getUriArr());
	echo "\n\n";
	echo "Content (XML)";	
	echo "\n\n";	
	echo htmlspecialchars($objCtxMan->ctx_xml_str)."\n";
	echo "Path (XML)";	
	echo "\n\n";
	echo htmlspecialchars($objCtxMan->path_xml_str)."\n";
	echo "\n\n";
	echo 'nav:\n';	
	echo htmlspecialchars($objNavMan->str)."\n";
	echo "\n\n";	
	print_r($objNavMan->templates);
	echo "\n\n";	
	print_r($objNavMan->arr_data);
	echo "Content:";
	echo "\n\n";
	print_r($_tmp_ctx);
	echo "\n\n";	
	echo '</pre>';

?>
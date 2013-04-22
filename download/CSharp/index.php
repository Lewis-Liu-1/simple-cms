<?php
	$main_folder=dirname( $_SERVER['PHP_SELF']);
	$path=getcwd();
	$files=array();
	$i=1;
	foreach (glob("$path/*.txt") as $filename)
	{
		$f=basename($filename);
		$files[$i]=array(str_replace(".txt", "", $filename)=>$f);
		$i++;	
	}	
	define('root_dir', $_SERVER['DOCUMENT_ROOT']); 
	require_once(root_dir."/includes/article.php");
?>


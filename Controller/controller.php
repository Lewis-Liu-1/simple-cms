<?php
 	require_once(RootDir.ModelDir.'/model_menus.php');
	$ID = $_GET[$_QID];
	$ID = pack("H*",$ID);
	$search=explode("/",$ID, 10); //10 LEVELS DIRECTORY
	//$s=PWS::factory(SupportedSystem);
	//$menus=$s::singleton();
	//$search=array_reverse($search);
	//var_dump($search);
	//echo "<br/>"; 	
	$menus=MenuModel::singleton();

	if ($menus->isIDExist($search,$directories))
	{
		if ($menus->isFile($search,$filename))
		{
			include_once(RootDir.ViewDir.'/viewfile.php');
		}
		else {
			include_once(RootDir.ViewDir.'/viewdir.php');	
		}	
	}
	else {
		include_once(RootDir.ViewDir.'/viewhome.php');	
	}
		
?>
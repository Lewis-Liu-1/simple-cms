<?php

	$s=$_SERVER['DOCUMENT_ROOT'];

	require_once($s.'/settings.php');
	require_once(RootDir.ModelDir.'/model_menus.php');
	require_once(RootDir.ViewDir.'/print_message.php');
	require_once(RootDir.ModelDir.'/model_comment.php');

	$menus=MenuModel::singleton();

	$ID=$_POST["topic"];

	$user=$_POST["username"];
	$email=$_POST["email"];
	$comment=$_POST["comment"];

	$user=sanitize($user,true);
	$email=sanitize($email,true);
	$comment=sanitize($comment,false);
	
	//echo $ID;
	//$ID = pack("H*",$ID);
	$search=explode("/",$ID, 10); //10 LEVELS DIRECTORY
	//$s=PWS::factory(SupportedSystem);
	//$menus=$s::singleton();
	//$search=array_reverse($search);
	//var_dump($search);
	//echo "<br/>"; 	
	$menus=MenuModel::singleton();
	
	$check=false;	
	if ($menus->isIDExist($search,$directories))
	{
		if ($menus->isFile($search,$filename))
		{
			$check=true;
		}
	}	
			
	if ($check===false)
	{
		$f=new MessageBox();
		$f->showMessage("File not exist, can't post your comment!",$id);
		unset($f);
		exit();
	}
	
	$mc=new CommentModel();
	if ($mc->isCommentValid($comment) ==false)
	{
		$f = new MessageBox();
		$s = "Please input '/' at top left corner of comment field!";
		$f -> showMessage($s,$ID);
		unset($f);
		exit();
	}

	$mc->setFileID($ID);
	$mc->setUser($user);
	$mc->setEmail($email);
	$mc->setComment($comment);
	$check=$mc->save();
	if ($check)
	{
		$f = new MessageBox();
		$s = "Comment posted!";
		$f -> showMessage($s,$ID);
		unset($f);
	}	
	unset($h);
	unset($menus);
			
?>
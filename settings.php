<?php
	define (RootDir, $_SERVER['DOCUMENT_ROOT']); 
	define (DataDir, '/data');
	define (ViewDir,'/View');
	define (ModelDir,'/Model');
	define (ControllerDir,'/Controller');
	$themes=array("red","blue","ocean","lavendar");
	$curTheme=$themes[0];
	define (ThemeDir,ViewDir.'/Theme/');

	define (CommentDirName,"Comments");

	define (CommentFilePath,RootDir.DataDir.'/'.CommentDirName.'/comments.php'); 
	define (RatingFilePath,RootDir.DataDir.'/'.CommentDirName.'/ratings.php');
	define (WebSiteName,'Find a Stuff');
	define (IndexFileName,'index.ini');

	//run time symbols, do not change this part
	define (SupportedSystem,'File');
	define (WelcomeFilePath,RootDir.DataDir.'/Introduction.txt');
	define (DataType,'Product');
	define (ContactEmail,'yyiu002@hotmail.com');
	define (LogoFileName,'logo2.jpg');
	define (ImageDescFileName,'description.txt');
	global $_QID;$_QID='a';

		function removeSlashes($s)
		{
			if (get_magic_quotes_gpc())
			{
				$s=stripslashes($s);
			}
			return $s;	
		}
		
		function sanitize($s,$remove=true)
		{
			$s=removeSlashes($s);
			if ($remove)
			{
				$injections=array('/(\n+)/i',
					'/(\r+)/i',
					'/(\t+)/i',
					'/(%0A+)/i',
					'/(%0d+)/i',
					'/(%08+)/i',
					'/(%09+)/i'
					);
					$s=preg_replace($injections,'',$s);
			}
			return $s;	
		}

	error_reporting(E_ALL);	
?>
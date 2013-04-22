<?php

	require_once('Driver/'.SupportedSystem.'/read_comment.php');
	require_once('Classes/'.'section_names.php');

	class CommentModel 
	{
		var $ob;
		function __construct()
		{
			$this->ob=new CommentSectionNames();
		}

		public function isCommentValid($comment)
		{
			$pos = strpos($comment,"/");
			if ($pos === false)
			{
				return false;
			}
			else { 
				if ($pos > 0 ) return false;
			}
			return true;			
		}

		private function getValidComment($comment)
		{
			$comment=substr($comment,1);
			return $comment;
		}
		
		public function setFileID($id)
		{
			$this->ob->fileID=$id;
		}
		public function setUser($user)
		{
			$this->ob->user=$user;
		}
		public function setEmail($email)
		{
			$this->ob->email=$email;
		}
		public function setComment($comment)
		{
			$this->ob->comment=$this->getValidComment($comment);
		}
		public function save()
		{
			$this->ob->ip=$_SERVER['REMOTE_ADDR'];
			$this->ob->time=date("D, d M Y H:i:s");
			$writer=new CommentWriter();
			$data=$this->ob->getFormattedData();
			$writer->save($data,$this->ob->fileID);
			return true;
		}
	}
?>
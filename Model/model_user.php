<?php

	require_once('Driver/'.SupportedSystem.'/read_user.php');
	require_once('Classes/'.'section_names.php');

	class UserModel 
	{
		var $ob;
		var $reader;
	   var $randKey;
		
		function __construct()
		{
			$this->ob=new UserSectionNames();
			$this->reader=new UserReader();
      	$this->randKey = '0iQx5oBk66oVZep';
		}

		public function isUserExist($user)
		{
			return $this->reader->isUserExist();
		}

    	function InsertIntoDB(&$formvars)
    	{
    
        	$confirmcode = $this->MakeConfirmationMd5($formvars['email']);
        
        	$formvars['confirmcode'] = $confirmcode;
         try
         {
         	$this->reader->saveToDB($formvars);
         }
         catch(Exception $e)
         {
         	$this->HandleDBError($e->getMessage());
         }	
    	}
		
		function MakeConfirmationMd5($email)
    	{
      	$randno1 = rand();
      	$randno2 = rand();
        	return md5($email.$this->rand_key.$randno1.''.$randno2);
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
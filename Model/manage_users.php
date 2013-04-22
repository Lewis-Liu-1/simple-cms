<?php
	interface IUser
	{
		function IsFieldUnique($formvars,$fieldname);
		public function register($u,$p,$ip,$email,$tel);
		public function exist($u,$p="");
	}
	
	class UserManager:IUser
	{
		private $users;
		
		public function register($u,$p,$ip,$email,$tel)
		{
			if ($this->exist($u))
			{
				return false;
			}
				
			$absolute=USERS_FILE;
			$file = fopen($absolute,"a+") or exit("Unable open file!");
			fputs($file,self::U.$u."\n");
			fputs($file,self::P.md5($p)."\n");
			fputs($file,self::E.$email."\n");
			fputs($file,self::I.$ip."\n");
			fputs($file,self::T.$tel."\n");
			fclose($file); 
		}		
		
		public function exist($u,$p="")
		{
			$this->read();
			$check=false;
			if (strlen($p)>0) $check=true;
			$mp=md5($p);
			foreach($users as $user => $pass)
			{
				if ((strcmp($user,$u)==0 && check ==false) ||
						(strcmp($user,$u)==0 && strcmp($pass,$mp)==0))
					return true;
				}
			}
			return false;
		}
		
		private function read()
		{
			$users=array();
			$absolute=USERS_FILE;
			$u,$p;

			$file = fopen($absolute,"r") or exit("Unable open file!");
			while(!feof($file))
  			{
  				$line=fgets($file);
				$this->get_input($line,self::U,$u);
				if ($this->get_input($line,self::P,$p))
				{
					$users[$u]=$p;
				}				
  			}	
  		
			fclose($file); 
		}
		
		private function getInput($s,$pat,&$v)
		{
			$pos = strpos($s,$pat);
			if ($pos!==false)
			{ 
				if ($pos==0)
				{
					$v=str_replace($pat,"",$s);
					return true;
				}
			}
			return false;
		}
	}
?>
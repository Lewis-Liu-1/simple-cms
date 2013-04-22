<?php
	
	require_once('Driver/'.SupportedSystem.'/read_menus.php');
		
	class MenuModel
	{
		public $menus;
		private static $instance;
		
		private $reader;		
		function  __construct()
		{
			$this->reader=new MenuReader();      
         //echo 'Call the contrustor'.PHP_EOL;
			$this->menus=$this->reader->populateMenus();
		}
		
		public static function singleton()
		{
			if (!isset(self::$instance)) {
           // echo 'Creating new instance.'.PHP_EOL;
            $className = __CLASS__;
            self::$instance = new $className;
        	}		
			return self::$instance;	
		}
		
		public function isIDExist($a,&$subMenus)
		{
			$subMenus=array();
			$subMenus=$this->menus;

			$check=$this->checkPath($a,0,$subMenus);
			return $check;
		}
		
		//return $src, which is the remainder menus of current folder
		private function checkPath($seed,$index,&$src)
		{
			$temp=$src;
			foreach($temp as $key =>$value)
			{
				//echo "level =$index Seach $key<br/>";
				if (strcmp($key,$seed[$index])==0)
				{
					$src=$value;
					$index++;
					//have we search full path
					if ($index>=count($seed))
					{ 
						//echo "found";				
						return true;
					}
					if (is_array($value))
					{
						return $this->checkPath($seed,$index,$src);
					}
					return false;
				}
				//not equal, keep search other items
			}
			//not found at this level, then fail	
			return false;
		}		
		
		public function isFile($a,&$filename)
		{
			return $this->reader->isFile($a,$filename);
		}
		
		public function getAttitude($filename,$id)
		{
			return $this->reader->getAttitude($filename,$id);	
		}

		public function saveAttitude($filename,$id,$count)
		{
			return $this->reader->saveAttitude($filename,$id,$count);	
		}
		
		public function getRatings($filename)
		{
			return $this->reader->getRatings($filename);
		}
	}

?>
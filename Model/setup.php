<?php
	class PWS
	{
		public static function factory($type)
		{
			$filename=RootDir.ModelDir.'/'.$type.'_system.php';
			//echo "factory $filename".PHP_EOL;
			
			if (include_once $filename) {
            $classname = $type.'_system';
            //echo $classname;
            return $classname;
        	} 
        	else 
        	{
            throw new Exception('Driver not found');
        	}
      }  		
	}
?>
<?php
	class FileReader
	{
		private $title;
		private $filePath;		
		private $lines;
		function __construct($filename)
		{	
			$this->title = basename($filename,".txt");
			$this->filePath=$filename;
			//echo "file=".$this->filePath;
		}
			
		public function getFileTitle()
		{
			return $this->title;	
		}
		public function loadData()
		{
			$file = fopen($this->filePath,"r") or exit("Unable open file!");
			$this->lines=array();		
			while(!feof($file))
	  		{
	  			$line=fgets($file);
				$this->lines[]=$line;
			}
			
			return $this->lines;
		}
			
		public function loadPictures()
		{
			$sortedData = array();
	   	foreach(scandir($this->filePath) as $file) {
     	  		if(is_file($this->filePath .'/'. $file)) {
     	  			if (strcmp($file,"description.txt")==0)
     	  			{
     	  			}
     	   		else	array_push($sortedData, $file);
	    		}
			}
			return $sortedData;
		}	
	}
?>
	
	  
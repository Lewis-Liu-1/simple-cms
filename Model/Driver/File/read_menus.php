<?php

	class MenuReader
	{
		private $ratings;
		
		function __construct()
		{
			$this->readRatings();
		}
		
		function __destruct()
		{
			$this->saveFile();
		}

		private function readRatings()
		{
			$this->ratings=array();
			$file = fopen(RatingFilePath,"r+") or exit("Unable open Rating file!");
			while(!feof($file))
			{
				$line=fgets($file);
				$this->ratings[]=$line;	
  			}
			fclose($file); 
		}		

		private function saveFile()
		{			
			$file = fopen(RatingFilePath,"w") or exit("Unable save Rating file!");
			foreach($this->ratings as $l)
			{
				$l=str_replace("\n","",trim($l));
				if (strlen($l)>2)
				{
					fputs($file,$l."\n");
				}
			}
			fclose($file); 
		}

		function populateMenus()
		{
			$absolute=RootDir.DataDir;
			$relative=DataDir;
			
			$ret=$this->populateSubMenus($absolute,$relative);
			return $ret;
		}
		
		function populateSubMenus($absolute,$relative)
		{
			$ret=array();
			$i=0;
			
			if ($handle = opendir($absolute)) 
			{
		   	while (false !== ($file = readdir($handle))) 
		   	{
					if ($this->noNeedCheck($file)) continue;
					$s=$relative."/".$file;
					if (is_dir($absolute."/".$file))
					{
						$a=$absolute."/".$file;
						$r=$relative."/".$file;
						//$key=$this->translate(basename($s));
						if (strcmp($file,CommentDirName)!=0)
						{
							$ret[basename($s)]=$this->populateSubMenus($a,$r);
						}
						//$ret[$s]=$this->translate($file);
					}
					else{
						$s=substr($file, -strlen(".txt"));
						if ($s == ".txt")
						{
							$ret[$file]="file:".$i;
							$i++;
						}
					}
				}
			   closedir($handle);
				$order = $this->readOrder($relative);
	
				if (count($order) > 1)
				   $ret=$this->sortFiles($ret,$order);
			}
			return $ret;						
		}
		
		public function isFile($a,&$filename)
		{
			$filename=implode("/", $a);
			$filename=RootDir.DataDir.'/'.$filename;
			
			if (is_dir($filename)) return false;
			//echo "File to show $filename<br/>";
			return true;
		}
		
		function readOrder($path)
		{
			$order=array();			 			
			$filename=RootDir.$path."/".IndexFileName;
			
			if (file_exists($filename)==false) return $order;
			$file = fopen($filename,"r");
						
			if ($file == false) return $order;
			//echo "read_order $filename<br/>";
			//Output a line of the file until the end is reached
			while(!feof($file))
  			{
  				$line=fgets($file);
  				if (strlen(trim($line))>0)
	  				$order[]=$line;
  			}
			fclose($file);
			return $order;			
		}
		
		function sortFiles($array,$order)
		{
			//var_dump($array);			
			$ret=array();
			foreach($order as $val)
			{
				foreach($array as $key =>$value)				
				//if (array_key_exists($val, $array)) 
				{
					if (strcasecmp(trim($key),trim($val))==0)
					{
						$ret[$key]=$value;
						unset($array[$key]);
					}
				//	var_dump($val);
				}
			}
			
			foreach($array as $key =>$value)
			{
				$ret[$key]=$value;				
			}
						
			return $ret;
		}		
		
		function noNeedCheck($f)
		{
			if ($f =="." || $f ==".." || $f ==IndexFileName
				|| $f =='Images'
				|| $f =='index.php' )
				return true;
			return false;		
		}
		
		public function getRatings($filename)
		{
			$ret=array();
			$ret[]=$this->getAttitude($filename,1);
			$ret[]=$this->getAttitude($filename,2);
			$ret[]=$this->getAttitude($filename,3);
			return $ret;
		}
				
		public function getAttitude($filename,$id)
		{
			$check=false;
			foreach($this->ratings as $line)
  			{
  				if ($check==true)
  				{
  					$v=$this->getValue($line,$id);
					return $v;
				}
  				else if (strcmp(trim($line),trim($filename))==0)
  				{
  					$check=true;
  				}
  			}
  			return 0;
		}
		
		public function saveAttitude($filename,$id,$count)
		{
			foreach($this->ratings as &$line)
  			{
  				if ($check==true)
  				{
  					$this->changeValue($line,$id,$count);
					return;
				}
  				else if (strcmp(trim($line),trim($filename))==0)
  				{
  					$check=true;
  				}
  			}
  			$this->ratings[]=$filename;
  			$l="";
  			$this->ratings[]=$this->changeValue($l,$id,$count);
		}
				
		private function getValue($line,$id)
		{
			$ret=$line;
			$count=preg_match("/(\d+),(\d+),(\d+)/i", $line, $matches);
			if ($count>0)
			{
				return $matches[$id];	
			}
			return 0;			
		}
		
		private function changeValue(&$line,$id,$count)
		{
			$a=0;
			$b=0;
			$c=0;
			$count1=preg_match("/(\d+),(\d+),(\d+)/i", $line, $matches);
			//echo "$s to match [$v[0]]<br/>";
			//echo "matches: ". var_dump($matches);
			//echo "<br/>";
			if ($count1>0)
			{ 
				$a=$matches[1];					
				$b=$matches[2];					
				$c=$matches[3];
			}						
			switch($id)
			{
				case 1:
					 $line=$count.",$b,$c";
					 break;
				case 2:
					 $line="$a,".$count.",$c";
					 break;
				case 3:
					 $line="$a,$b,".$count;
				 	 break;
			}	
			return $line;
		}
	}

?>
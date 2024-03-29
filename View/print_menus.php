<?php
 	require_once(RootDir.ModelDir.'/model_menus.php');
	class WebMenus
	{
		private $links;
				
		function  __construct()
		{
			$this->absolute=RootDir.DataDir;//self::data_folder;
			$this->relative=DataDir;
		}
		
		public function printMenus($menus)
		{
			global $_QID,$curTheme;
			echo "<div id=\"menu\" class=\"tabsmenuclass\">";
			echo "<div id='theme'>Current Theme:&nbsp;".$curTheme;
			echo "</div>";
	 		echo "<ul>";
			echo "<li>";
			echo "<a href=\"/index.php\">Home</a>";
			echo "</li>";
			foreach($menus as $key =>$val)
			{
				if (is_array($val))
				{
					echo "<li>";
					echo "<a href=\"/index.php?$_QID=".bin2hex($key)."\">".basename($key)."</a>";
					echo "</li>";
				}
			}
			echo "</ul>";
			//echo "<span id='cur_date'></span>";    
			echo "</div>";
		}
		
		public function printWebPath($directory)
		{
			global $_QID;
			
			echo "<div class='webpath'>You are at: &nbsp;";
			$i=0;
			foreach($directory as $val)
			{
				if ($i>0) {
					echo "&nbsp;&gt;&nbsp;";
					$repeat.='/';
				}	
				$repeat.=$val;
				echo "<a href='/index.php?$_QID=".bin2hex($repeat);
				echo "'>".basename($val,".txt");
				echo "</a>";
				$i++;
			}
			echo "</div>";
		}
		
		public function printLinks($src,$seed)
		{
			//var_dump($src);
			//echo "<br/>";			
			//var_dump($seed);
			//echo "<br/>";			

			global $_QID;
			$f=implode("/", $src);
			echo "<div class ='section'>";
			foreach($seed as $key =>$val)
			{
				$myid=bin2hex($f.'/'.$key);
				
				$s = "<a href='"."/index.php?$_QID=".$myid;
				$s .= "'>".basename($key,".txt");
				$s .= "</a>";
				if (is_array($val))
				{
					echo "<div class='categories1'>";				
					echo "$s &nbsp;&nbsp;&nbsp;&nbsp;".DataType.'s'."(".count($val).")";
					echo "</div>";
					echo "<div class='categories'>";				
					//$this->printLinks($key,$val);								
					echo "</div>";
				}
				else {
					echo DataType.":&nbsp;".$s."<br/>";	
				}
			}
			echo "</div>";
		}	
		
		public function printLeaves($src,$seed)
		{
			global $_QID;
			//echo "----------------------------<br/>";			
			//var_dump($src);
			//echo "<br/>";			
			//var_dump($seed);
			//echo "<br/>";			
			
			//echo "<div class='section command'>";
			$f=implode("/", $src);
			foreach($seed as $key =>$val)
			{
				if (is_array($val))
				{
					if (count($val)>0)
					{
						$subSrc=$src;
						array_push($subSrc,$key);
						$this->printLeaves($subSrc,$val);
					}	
				}
				else {
					$myid=bin2hex($f.'/'.$key);
				
					$s = "<a href='"."/index.php?$_QID=".$myid;
					$s .= "'>".basename($key,".txt");
					$s .= "</a>";
					echo "<div class ='section'>";
					echo basename($f).":&nbsp;".$s."<br/>";	
					echo "</div>";
				}
			}
			//echo "</div>";
		}
		
		public function printSPLeaves($src,$seed,&$counter)
		{
			global $_QID;
			static $dirLevel=0;
			$f=implode("/", $src);
			foreach($seed as $key =>$val)
			{
				$myid=bin2hex($f.'/'.$key);
				if ($counter==0) return;
				$s = "<a href='"."/index.php?$_QID=".$myid;
				$s .= "'>".basename($key,".txt");
				$s .= "</a>";
				if (is_array($val))
				{
					if (count($val)>0)
					{
						$subSrc=$src;
						array_push($subSrc,$key);
						$this->printSPLeaves($subSrc,$val,$counter);
					}	
				}
				else {
					echo "<div>";
					echo "&nbsp;".$s."<br/>";
					echo "</div>";	
					$counter--;
				}
			}
		}	

		private function getLeave($src,$seed)
		{
			foreach($seed as $key =>$val)
			{
				if (is_array($val))
				{
					if (count($val)>0)
					{
						$subSrc=$src;
						array_push($subSrc,$key);
						return $this->getLeave($subSrc,$val);
					}	
				}
				else {
					return $key;
				}
			}
			return "";	
		}		
		
		private function loadIntro($id)
		{
			//$filename = pack("H*",$id);
			//$f=new FileModel($filename);
			//$f->loadSections();
			//$fv=new MyFileViewer();
			//$fv->printSections($f->getSections());
		}
		
		private function printSubTitle($s)
		{
			
		}
		public function printTitle($s)
		{
			echo "<div class=\"title\">$s</div>";
		}
	}
?>

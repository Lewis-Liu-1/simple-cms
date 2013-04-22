<?php
	interface ISectionViewer 
	{
		public function convertSection($object);
		public function convertLine($line);
		public function getCSSName();
	}
	
	class MySectionViewer implements ISectionViewer
	{
		public $print;
		function  __construct()
		{
			$this->print = false;
		}

		public function printTitle($s)
		{
			echo "<div class='title'>$s</div>";
		}
	
		public function getCSSName() {return 'section section1';}
	
		public function convertSection($object)
		{
			echo "<div class='".$this->getCSSName()."'>";
			foreach($object->getData() as $s)
			{
				$s=$this->convertLine($s);
				echo $s."<br/>";
			}
			echo "</div>";
		}
		
		public function convertLine($s)
		{
  			$len=strlen($s);

  			$line1=ltrim($s);
  			$len1=strlen($line1);

			$line=htmlentities($s, ENT_COMPAT);
			$line=str_replace("\t","&nbsp;&nbsp;",$line);

  			$count =$len - $len1;
  			if ($count>0) 
  			{
				$line=str_repeat("&nbsp;",$count).$line;
  			}
			$line=$this->clickable($line);
			$this->print = true;
			return $line;
		}	
		
	  function clickable($url){
        $url		=    str_replace("\\r","\r",$url);
        //$url      =    str_replace("\\n","\n<BR>",$url);
        $url      =    str_replace("\\n\\r","\n\r",$url);

        $in=array(
        '`((?:https?|ftp)://\S+[[:alnum:]]/?)`si',
        '`((?<!//)(www\.\S+[[:alnum:]]/?))`si'
        );
        $out=array(
        '<a href="$1"  rel=nofollow>$1</a> ',
        '<a href="http://$1" rel=\'nofollow\'>$1</a>'
        );
        return preg_replace($in,$out,$url);
    }
    
	}
	class CMDViewer extends MySectionViewer
	{
		public function getCSSName() {return 'section command';}
	}

	class CSectionViewer extends  MySectionViewer
	{
		public function getCSSName() {return 'section code';}
		
		public function convertSection($object)
		{
			echo "<div class='".$this->getCSSName()."'>";
			foreach($object->getData() as $s)
			{
				$s=parent::convertLine($s);
				
				$colors = array('main', 'printf', 'exit', 'scanf','fopen',
				'fread','fclose','malloc','switch');
				$s=$this->convertFuncName($s,$colors);
				$colors = array('#include','#define');
				$s=$this->convertPreDefs($s,$colors);
				$colors = array('class', 'int' , 'char', 'void','long','if','else','case',
					'using','namespace');
				$s=$this->highlightWord($s,$colors);
				echo $s."<br/>";
			}
			echo "</div>";
		}

		private function highlightWord($s,$colors)
		{
			foreach ($colors as $color) 
			{
				$s=str_replace($color." ","<span style=\"color:#66f\">".$color."</span>&nbsp;",$s);	
			}
			return $s;	
		}
	
		private function convertPreDefs($s,$colors)
		{
			foreach ($colors as $color) 
			{
				$s=str_replace($color,"<span style=\"color:#660\">".$color."</span>",$s);	
			}
			return $s;	
		}

		private function convertFuncName($s,$colors)
		{
			foreach ($colors as $color) 
			{
				$s=str_replace($color."(","<span style=\"color:#66f\">".$color."</span>(",$s);	
			}
			return $s;	
		}
	}

	class LinkViewer extends  MySectionViewer
	{
		public function convertSection($object)
		{
			$ref=$object->link;
			$val=$object->content;
			echo "<div class=\"atlink\"><a href=\"".trim($ref)."\">";
			echo "$val</a></div>";
		}
	}

	class ImgViewer extends  LinkViewer
	{
		public function convertSection($object)
		{
			$ref=$object->link;
			$val=$object->content;
			echo "<div class=\"atlink\"><img src=\"".trim($ref)."\">";
			//echo "$val";
			echo "</img>";
			echo "</div>";
		}
	}

  class CommentViewer extends MySectionViewer
  {
  		public static $count=0;
  		
		public function getCSSName() 
		{
				self::$count++;
				if (self::$count %2 ==0)
					return 'comment';
				return 'comment comment1';
		}

		public function convertSection($sec)
		{
			$c=$sec->ob;
			
			if (self::$count==0)
			{
				echo "<div id='comments'><span id='comments_start'>Comments</span></div>";
			}
			echo "<div class='".$this->getCSSName()."'>";
			//$c->comment =str_replace("\n","<br/>",$c->comment);
			
			echo "<div class=\"cmt_header\">";				
			echo "<span class='username'><img src='/images/person.jpg' align='left' />".$c->user."</span><br/>";
			//echo "<span class='email'>".$c->email."</span><br/>";
			echo "<span class='time'>".$c->time."</span><br/>";
				//echo "<span class='shortlink ip'>".$this->ip."</span><br/>\n";
			echo "</div>\n";
			echo "<div class='says'>".$this->convertLine($c->comment)."</div>\n";

			echo "</div>";
		} 
  }
  
  class WalkViewer extends MySectionViewer
  {
  		const ImageWid = '425';
  		const ImageHei = '325';
  		
		public function getCSSName() 
		{
			return 'walk';
		}

		public function convertSection($sec)
		{
			$c=$sec->ob;
			
			echo "<div class='".$this->getCSSName()."'>";
			
			if (strlen($c->loc)>1) 
			{ 
				echo "<div > ".$c->loc."</div>";
			}
			if (strlen($c->google)>1) 
			{ 
				echo "<div > ".$c->google."</div>";
			}
			if (strlen($c->img)>1) 
			{ 
				$f=trim(RootDir).trim($c->img);
				list($width, $height, $type, $attr) = getimagesize($f);
				echo "<div class='myimg' >";
				echo "<img class='sizeimg' ";
				echo "orgwid='".$width."' orghei='".$height."'";
				echo " tempwid='".self::ImageWid."' temphei='".self::ImageHei."'";
				echo " width='".self::ImageWid."'";
				echo " height='".self::ImageHei."'";
				echo " src='".$c->img."'>";
				echo "</img></div>";
			}
			if (strlen($c->map)>1) 
			{ 
				echo "<div > ".$c->map."</div>";
			}

			if (strlen($c->distance)>1) 
			{ 
				echo "<div >Distance &nbsp; ".$c->distance."</div>";
			}
			if (strlen($c->images)>1)
			{
				echo "<a class='atlink' href='".$c->images."' target='_blank'>More Photoes from here</a>";	
				//echo "<iframe width='425' height='350' frameborder='0' scrolling='no' ";
				//echo "marginheight='0' marginwidth='0' src='";
				//echo $c->images;
				//echo "'></iframe>";
			}
			echo "</div>";
		}
	}
			
 	class PicViewer extends MySectionViewer
  	{
  		public static $ret;
  		
  		public function __construct()
  		{
  			self::$ret = array();
  		}

		public function convertSection($sec)
		{
			$c=$sec->ob;
			//echo $c->name;
			self::$ret[]=$sec->ob;//->getFormattedData();
			//var_dump($this->ret);
		}
  	}

?>


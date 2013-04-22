<?php
require_once('section.php');

class CSection extends MySection {}
class CMDSection extends MySection{}
class LINKSection extends MySection
{
	var $link;
	var $content;
	public function recreate()
	{
		$l=$this->getData();
		if (count($l)>=2)
		{
			$this->link=$l[0];
			$this->content=$l[1];
		}	
	}
}

class IMGSection extends LINKSection
{
	public function recreate()
	{
		$l=$this->getData();
		if (count($l)>=1)
		{
			$this->link=$l[0];
		}	
	}
}

class CommentSection extends MySection
{
		var $items;
		var $ob;
		var $var;
		
		public function getSectionNames(){return 'CommentSectionNames';}
		
		//called by base class after sections was loaded, then base class call recreate
		public function recreate()
		{
			$sec=$this->getSectionNames();
			$this->ob=new $sec;
			$a=getConstants($this->ob);	//get constant names and their values
			$c=(array_values($a));			//{0->(link):(.*),etc}
			$b=get_class_vars($sec);		//get correspondent variable names
			$d=array_keys($b);				//variable arrays{0=>link,1=>name,2=>desc}
			
			//print_r($a);
			//echo count($a);			
			//var_dump($c);
			//echo "<br/><br/>";
			//var_dump($d);
			
			$this->items = array_map(null,$c,$d);//{ {(link):(.*)=>link},{(name):(.*)=>name},etc}
			
			//var_dump($this->items);
						
			foreach ($this->items as $key =>$value)
			{
				if (is_array($value))
				{ 
					//to debug it!!!
					//echo $value[0],"->". $value[1]. "<br/>";
				}		
			}
			
			//raw data from text file!!!			
			foreach($this->getData() as $s)
			{
				//var_dump($s);
				$this->getContent($s);
			}			
		}
	
		
		private function getContent($s)
		{
			$done = true;
			foreach ($this->items as $key => $v) 
			{
				//echo "$key = $v[0] in ". $s." ??<br/>";
				
				$pos = strpos($s,$v[0]);
				if ($pos!==false)
				{ 
					if ($pos==0)
					{
						$m=str_replace($v[0],"",$s);
						//echo "variable ". $v[1]."<br/>";
						$this->var = &$this->ob->$v[1];
						$this->var = ($m);
						$done	=	false;	
					}
					break;
				}
			}
			
			if ($done)
			{
				if (strlen(trim($s))>0)
			 		$this->var.=($s);	
			}	
		}
}

class WalkSection extends CommentSection
{
	public function getSectionNames(){return 'WalkSectionNames';}
}

class UserSection extends CommentSection
{
	public function getSectionNames(){return 'UserSectionNames';}
}

class PicSection extends CommentSection
{
	public function getSectionNames(){return 'PicSectionNames';}
}

?>
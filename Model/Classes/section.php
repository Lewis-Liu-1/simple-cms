<?php
require_once ('section_names.php');

class MySection
{
	private $data;
	private $esc=false;
		
	function __construct($n="")
	{
		$this->data=array();
		if (is_null($n)) return;
		$this->Name=$n;
	}
	
	public function addLine($l)
	{
		$this->data[]=$l;
	}
	
	public function getData()
	{
		return $this->data;
	}
	
	public static function inString($src,$pat)
	{
		if (is_array($src) || is_array($pat)) return false;
		$src=trim($src);
		$sub=trim($pat);
		$pos=strpos($src,$pat);
		if ($pos!==false)
		{
			if ($pos==0)
			{
				if (strlen($src)>strlen($pat)) return false; // like '/x...'	
				//echo "source ? pattern $src = $pat <br/>";				
				return true;			
			}
		}
		return false;
		
	}
	
	public function isEscape($v)
	{
		$check = self::inString($v,SectionName::ESCAPE);
		if ($check){
			$this->esc = $this->esc? false:true;
		}
		return $this->esc;
	}
	
	public function isNewSection($v)
	{
		$s=new SectionName();
		$a=getConstants($s);
		//var_dump($a);
		foreach($a as $value)
		{
			//echo $value;
			if (self::inString($v,$value))
			{
				//if ($this->esc) return false;
				return true;				
			}	
		}
		return false;	
	}
		
	public function recreate(){}	
}
?>

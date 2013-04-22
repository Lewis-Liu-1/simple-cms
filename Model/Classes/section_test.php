<?php
	
	require_once('section.php');
	require_once('section_names.php');

	class TestSection extends MySection
	{
		private $var;
		private $items;
		private $step;		
		
		private $key;

		var $ob;
		var $obTitles;
		var $testItems;
		function recreate()
		{
			$this->testItems=array();
			$this->obTitles=array();
			$this->step=new StepSection();
			 
			$this->ob=new TestSectionNames();
			$a=getConstants($this->ob);
			$c=(array_values($a));
			$b=get_class_vars('TestSectionNames');
			$d=array_keys($b);

			$this->items = array_map(null,$c,$d);
			foreach ($this->items as $key =>$value)
			{
				if (is_array($value))
				{ 
					//echo $value[0],"->". $value[1]. "<br/>";
				}		
			}
			
			foreach($this->getData() as $s)
			{
				$this->getContent($s);
			}
			//var_dump($this->obTitles);
		}
	
		function getContent($s)
		{
			$done=true;
			foreach ($this->items as $key => $v) 
			{
				$count=preg_match("/".$v[0]."/i", $s, $matches);
				//echo "$s to match [$v[0]]<br/>";
				//echo "matches: ". var_dump($matches);
				//echo "<br/>";
				if ($count>0)
				{ 
					//echo "$s to match [$v[0]]<br/>";
					//echo "<b>".$matches[1]." ; ".$matches[2]."</b>";
					$this->var =	&$this->ob->$v[1];
					$this->var = ($matches[2]);
					$this->obTitles[$v[0]]=$matches[1];					
					$done=false;	
					break;
				}
			}
			
			if ($done)
			{
				if ($this->isTestStep($s)) $done=false;	
			}			

			if ($done)
			{
				if (strlen(trim($s))>0)
			 		$this->var.=($s);	
			}	
		}
		
		private function isTestStep($s)
		{
			$count=preg_match("/".StepSection::STEP."/i", $s, $matches);
			if ($count>0)
			{
				$this->step=new StepSection();
				$this->step->desc=$matches[2];
				$this->testItems[]=$this->step;
				//echo "<b>step ".$matches[1]."</b>".$this->step->desc."<br/>end<br/>";
				return true;
			}
			$count=preg_match("/".StepSection::EXPECT."/i", $s, $matches);
			if ($count>0)
			{						
				$this->step->expected=$matches[1];				
				//echo $this->step->desc." <----from expected <br/>";
				return true;	
			}
		}		
	}
?>

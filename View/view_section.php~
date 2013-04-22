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
	
		public function getCSSName() {return 'section section1';}
	
		public function convertSection($object)
		{
			echo "<div class='".$this->getCSSName()."'>";
			foreach($object->getData() as $s)
			{
				$s=$this->convertLine($s);
				echo $s;
			}
			echo "</div>";
		}
		
		public function convertLine($s)
		{
  			$len=strlen($s);

  			$line1=ltrim($s);
  			$len1=strlen($line1);

			$line=htmlentities($s, ENT_COMPAT);
			$line=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;",$line);

  			$count =$len - $len1;
  			if ($count>0) 
  			{
				$line=str_repeat("&nbsp;",$count).$line;
  			}

			$this->print = true;
			return $line;
		}	
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
				echo $s;
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

	class MyFileViewer
	{
		private $sections;
		
		private $views;
		private $viewer;
		private $defaultViewer;
		function __construct()
		{
			$this->defaultViewer=new MySectionViewer(); 
			$this->views=array(new CSectionViewer() =>'CSection',
									new LinkViewer() =>'LinkSection',
									new ImgViewer() =>'IMGSection',
									new TestViewer() =>'TestSection');
		}
				
		public function getSections($id)
		{
			$f=new FileModel($id);
			$sections=$f->getSections();
			foreach($sections as $v)
			{
				$this->handleSection($v);	
			}						
		}

		private function handleSection($v)
		{
			$this->viewer=$this->getViewer($v->Name);
			$this->viewer->printSection($v);
		}
		
		private function getViewer($s)
		{				
			foreach($this->views as $key =>$value)
			{
				if (is_array($value))
				{
					foreach($value as $v)
					{
						if (strcmp($v,$s)==0) return $key;
					}	
				}
				else {
					if (strcmp($value,$s)==0) return $key;
				}	
			}
			return $this->defaultViewer;			
		}
			
		public function printTitle($s)
		{
			echo "<h3 style='margin-left:10px;margin-top:5px;'>$s</h3>";
		}
	}
?>
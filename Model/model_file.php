<?php
require_once('Driver/'.SupportedSystem.'/read_file.php');
require_once('Classes/'.'section_names.php');
require_once('Classes/'.'section.php');
require_once('Classes/'.'section_test.php');
require_once('Classes/'.'section_extends.php');

class FileModel
{
	const DefaultSection = 'MySection';

	private $data;
	private $reader;
	private $sectionMap;

	private function loadParsers()
	{
		$this->sectionMap=array('MySection'=>SectionName::NORMAL,
								'CSection' =>array(SectionName::C,SectionName::CPLUS,
											SectionName::CSHARP,SectionName::JAVA),
									'LinkSection' =>SectionName::LINK,
									'IMGSection' =>SectionName::IMG,
									'CMDSection' =>SectionName::CMD,
									'CommentSection'=>SectionName::COMMENT,
									'WalkSection'=>SectionName::WALK,
									'PicSection'=>SectionName::PIC,
									'TestSection' =>SectionName::TEST);
	}
	
	function __construct($filename) 
	{
		$this->loadParsers();		
		$this->reader =new FileReader($filename);
	}

	function loadPictures()
	{
		return $lines=$this->reader->loadPictures();		
	}
	
	function loadSections()
	{
		$lines=$this->reader->loadData();
		$this->data=array();
		$s=self::DefaultSection;
	
		$sec=new $s;
		foreach($lines as $v)
		{
			if ($sec->isEscape($v)) 
			{
				$sec->addLine($v);
			}	
			else if ($sec->isNewSection($v))
			{
				$this->data[]=$sec;
				$s=$this->getSectionName($v);
				$sec=new $s;
			}
			else {
				$sec->addLine($v);
			}	
		}
		if (count($sec->getData())>0)
		{
			$this->data[]=$sec;	
		}
		$this->handleSections();
	}
	
	public function getSections()
	{
		return $this->data;		
	}

	private function handleSections()
	{
		foreach($this->data as $section)
		{
			$section->recreate();//use the data we got, recreate object
		}
	}
	
	
	function getSectionName($v)
	{
		foreach($this->sectionMap as $key => $value)
		{
			if (is_array($value))
			{
				foreach($value as $key0 => $val0)
				{
					if (MySection::inString($v,$val0))
					{
						return $key;	
					}	
				}	
			}
			elseif(MySection::inString($v,$value)) {
				return $key;				
			}		
		}
		return self::DefaultSection;	
	}

	function __destruct() 
	{
		
	}
	
	public function getFileTitle()
	{
		return $this->reader->getFileTitle();
	}
}


?>
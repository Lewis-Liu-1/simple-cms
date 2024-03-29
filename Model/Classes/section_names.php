<?php

  	function getConstants($object)
  	{
		$reflect = new ReflectionClass($object);
		$constants = $reflect->getConstants();
		return $constants;  	
  	}
  
  	function getVariables($object)
	{
		$reflect = new ReflectionClass($object);
		$properties = $reflect->getProperties();
		return $properties;  	
	}		
  
  	class SectionName
  	{	
  		const COMMENT	='CMT:';
  		const LINK		='A:';
		const ASM		='ASM:';
		const C			='C:';
		const CPLUS		='C++:';
		const CSHARP	='C#:';
		const JAVA		='JAVA:';
		const NORMAL	='N:';
		const IMG		='IMG:';
		const PIC		='PIC:';
		const CMD		='CMD:';
		const TEST		='TEST:';
		const INFO		='INFO:';
		const WALK		='WALK:';
		const ESCAPE	='/';
  }
  
   class BaseNames
   {
		public function getMySectionName()
		{
			return SectionName::NORMAL;
		}
		//To get data array like ({"Name:Lewis","Age:30"},{"Name:Jen","Age:28"})
		public function getFormattedData()
		{
			$values=get_object_vars($this);
		
			$reflect = new ReflectionClass($this);
			$a = $reflect->getConstants();
			$fields=array_values($a);
			
			$to=array_combine($fields,$values);
			array_unshift($to[$this->getMySectionName()],"");
			$to=array_reverse($to);//array $array, $preserve_keys = null);
			array_walk($to, 'test_alter');
			return $to;
		}
   }
   
  	class CommentSectionNames extends BaseNames
	{
		const CTIME ='time:';	
		const CIP ='ip:';	
		const CUSER ='username:';	
		const CEMAIL ='email:';	
		const CCMT ='says:';
		const CFOR='for:';	
		var $time;
		var $ip;
		var $user;
		var $email;
		var $comment;
		var $fileID;
		
		public function getMySectionName(){return SectionName::COMMENT;}
	}

	function test_alter(&$item1, $key, $suffix)
	{	
  		$item1 = "$item1\n";//$suffix";
	}

	class InfoSectionNames
	{
		const AUTHOR='(Author):(.*)';
		const POST='(Post\s+Date:(.*)';
	}
	
	class WalkSectionNames
	{
		const TIME ='time:';	
		const LOC ='Location:';	
		const GOOGLE ='Google:';	
		const MAP ='Map:';
		const IMAGE='Img:';
		const DISTANCE='Distance:';
		const IMAGES='Images:';
		var $time;
		var $loc;
		var $google;
		var $map;
		var $img;
		var $distance;
		var $images;
	}
		
	class TestSectionNames
	{
		const NAME='^(Name):(.*)';
		const CPRODUCT='^(Product\s+Group):(.*)';
		const TYPE='^(Test\s+Type):(.*)';
		const SOFTWARE='^(Software):(.*)';
		const CLASSFY='(Classification):(.*)';
		const STANDARD='(Standard):(.*)';
		const AIM='(Aim\s+\/\s+Purpose\s+of\s+Test):(.*)';
		const REQUIRED='(Set-up\s+Instructions\/Equipment\s+Required):(.*)';
		const PROC='(Test\s+Procedure):(.*)';
	
		var $name;
		var $product;
		var $type;
		var $software;
		var $classfication;
		var $standard;
		var $aim;
		var $required;
		var $proc;
	}
	
	class StepSection
	{
		const STEP='Step\s+(\d+):(.*)';
		const EXPECT='Exp\s+result:(.*)';
		var $desc;
		var $expected;
		var $para;
		var $result;
		var $pass;		
	}
	
	class UserSectionNames
	{
		const NAME='(Name):(.*)';
		const PASS='(Pass):(.*)';
		const REGTIME ='(RegTime):(.*)';	
		const EMAIL ='(Email):(.*)';	
		const HTTP ='(Http):(.*)';	
		const TEL ='(Tel):(.*)';	
		const IP ='(Ip):(.*)';	
		const IMAGE='(Img):(.*)';
		var $name;
		var $pass;
		var $regTime;
		var $email;
		var $http;
		var $tel;
		var $ip;
		var $image;
	}
	
	class PicSectionNames extends BaseNames
	{
		const LINK='Link:';
		const NAME='Name:';
		const DESC ='Desc:';	
		var $link;
		var $name;
		var $desc;
		public function getMySectionName(){return SectionName::PIC;}
	}
?>
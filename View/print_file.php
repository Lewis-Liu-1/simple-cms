<?php
	require_once('print_section.php');
	require_once('print_test.php');
	
   
	class MyFileViewer
	{
		private $sections;
		
		private $views;
		private $viewer;
		private $defaultViewer;
		
		function __construct()
		{
			$this->defaultViewer=new MySectionViewer(); 
			$this->views=array('CSection'=>new CSectionViewer(),
									'LINKSection'=>new LinkViewer(),
									'IMGSection'=>new ImgViewer(),
									'TestSection'=>new TestViewer(),
									'CommentSection' =>new CommentViewer(),
									'WalkSection' =>new WalkViewer(),
									'PicSection' =>new PicViewer(),
									'CMDSection' =>new CMDViewer());
			//var_dump($this->views);
		}
		
		public function printSections($s)
		{
			global $IMAGES_DIR;
			foreach($s as $v)
			{
				$this->handleSection($v);	
			}
			
			if (count(PicViewer::$ret)>0)
			{
				$imgs=array();
				$names=array();
				$desc=array();
				foreach(PicViewer::$ret as $key =>$ob)
				{
					$imgs[]=str_replace(RootDir,"",$IMAGES_DIR.'/'.$ob->link);
					$names[]=$ob->name;
					$desc[]=$ob->desc;	
				}
				
				$this->showImages($imgs,$names,$desc);
				//var_dump($desc);	
			}
			?>
	       <script language="javascript" type="text/javascript">
				<!--
					$(document).ready(function()
					{				
							$('#comments_start').html(
							<?php 
								echo "\"Comments(".CommentViewer::$count.")\""; 
							?>
							);
					});		
				//-->
		     </script>		
			
			<?php
			
		}
		
		private function showImages($imgs,$names,$desc)
		{
 			echo "\n<script type='text/javascript'>\n";
			for($i=0;$i<count($imgs);$i++)
			{
				$s1=sanitize($imgs[$i]);
				$s2=sanitize($desc[$i]);
    			echo "slider.AddImage('$s1','$s2')\n";
			}
			echo ("</script>\n");
		}
		
		private function handleSection($v)
		{
			//echo "Section Start<b>". get_class($v)." ".$v->Name." </b><br/>";
			//var_dump($v);			
			$this->viewer=$this->getViewer(get_class($v));
			$this->viewer->convertSection($v);
			//echo "Section end<br/><br/>";
		}
		
		private function getViewer($s)
		{	
			foreach($this->views as $key =>$value)
			{
				//echo $value." ? ".$s;
				if (strcmp($key,$s)==0) 
				{
					//echo "found ".get_class($key);	
					return $value;
				}	
			}
			return $this->defaultViewer;			
		}
		
		public function printTitle($s)
		{
			echo "<div class='title'>$s</div>";
		}
	}
?>
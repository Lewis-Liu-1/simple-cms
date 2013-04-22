<?php
	class CommentWriter
	{
		public function save($data,$id)
		{
			$this->saveComment($data,$id);
			$this->backupComment($data,$id);
		}
		
		private function saveComment($data,$id)
		{	
			$file=RootDir.DataDir.'/'.$id;
			//echo $file;
			$file = fopen($file,"a+") or exit("Unable open file!");
			foreach($data as $key =>$va)
			{
				fputs($file,$key.$va);
			}
			fclose($file); 
		}
		
		private function backupComment($data,$id)
		{
			$file = fopen(CommentFilePath,"a+") or exit("Unable open file!");
			foreach($data as $key =>$va)
			{
				fputs($file,$key.$va);
			}
			fclose($file); 
		}
	}
?>

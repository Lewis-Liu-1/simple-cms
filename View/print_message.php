<?php
	class MessageBox
	{
		public function showMessage($s,$id)
		{
			global $_QID;
			echo $s."<br/>";
			echo "<a href=/index.php?$_QID=".bin2hex($id).">back</a>";
		}			
	}
?>
<?php
	$s=$_SERVER['DOCUMENT_ROOT'];
	require_once($s.'/settings.php');
 	require_once(RootDir.ModelDir.'/model_menus.php');

	$ar="";
	if ($_POST['a'])
	{
		$ar=$_POST['a'];
		$ar=pack("H*",$ar);
	}
	if($_POST['id'])
	{
		$id=$_POST['id'];
	}

	$search=explode("/",$ar, 10); //10 LEVELS DIRECTORY
	$menus=MenuModel::singleton();
	$count=0;	
	if ($menus->isIDExist($search,$directories))
	{
		if ($menus->isFile($search,$filename))
		{
			$count=$menus->getAttitude($filename,$id);
			$count++;
			$menus->saveAttitude($filename,$id,$count);
		}
	}		
//		$ip_sql=mysql_query("select ip_add from image_IP where img_id_fk='$id' and ip_add='$ip'");
//		$count=mysql_num_rows($ip_sql);

//		if($count==0)
//		{
//			$sql = "update images set love=love+1 where img_id='$id'";
//			mysql_query( $sql);
//			$sql_in = "insert into image_IP (ip_add,img_id_fk) values ('$ip','$id')";
//			mysql_query( $sql_in);

//			$result=mysql_query("select love from images where img_id='$id'");
			//$row=mysql_fetch_array($result);
			//$love=$row['love'];
?>
<span class="on_img" align="left">
	<?php echo $count; ?>
</span>
<?php
?>
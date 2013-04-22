<?php
include("config.php");
$ip=$_SERVER['REMOTE_ADDR']; 

if($_POST['id'])
{
$id=$_POST['id'];

$ip_sql=mysql_query("select ip_add from image_IP where img_id_fk='$id' and ip_add='$ip'");
$count=mysql_num_rows($ip_sql);

if($count==0)
{
$sql = "update images set love=love+1 where img_id='$id'";
mysql_query( $sql);
$sql_in = "insert into image_IP (ip_add,img_id_fk) values ('$ip','$id')";
mysql_query( $sql_in);

$result=mysql_query("select love from images where img_id='$id'");
$row=mysql_fetch_array($result);
$love=$row['love'];
?>
<span class="on_img" align="left"><?php echo $love; ?></span>
<?
}
else
{
echo 'NO !';
}



}

?>
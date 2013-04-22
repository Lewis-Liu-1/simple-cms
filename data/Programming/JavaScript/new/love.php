<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Show The Love</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>
<script>
$(document).ready(function()
{
  $("span.on_img").mouseover(function ()
  {
    $(this).addClass("over_img");
  });

  $("span.on_img").mouseout(function ()
  {
    $(this).removeClass("over_img");
  });
});

$(function() {
$(".love").click(function() 
{
var id = $(this).attr("id");
var dataString = 'id='+ id ;
var parent = $(this);


$(this).fadeOut(300);
$.ajax({
type: "POST",
url: "ajax_love.php",
data: dataString,
cache: false,

success: function(html)
{
parent.html(html);
parent.fadeIn(300);
} 
});


return false;

 });
});
</script>
<style type="text/css">
body
{
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
font-weight:bold;
color:#FFFFFF
}
a
{
color:#FFFFFF

}
a:hover
{
color:#FFFFFF

}
.on_img
{
  background-image:url(on.gif);
  background-repeat:no-repeat;
 
  padding-left:35px;
  
 
  cursor:pointer;
   width:60px;
  
  
}       

.over_img
{
  background-image:url(over.gif);
  background-repeat:no-repeat;
  
   padding-left:35px;
 
  cursor:pointer;
  width:60px;
}
.box
{
background-color:#303030; padding:6px;
height:17px;
}
a
{
text-decoration:none;

}
a:hover
{
text-decoration:none;

}
</style>
</head>

<body>
<div style="font-family:'Georgia', Times New Roman, Times, serif; color:#333333; font-size:18px">Tutorial link <a href="" style="color:#0099FF">Click Here</a></div>
<div align="center">

<div style="width:500px" >

<div style="color:#333333" align="left"><h3>Show The Love</h3></div>
<?php
include('config.php');
$sql=mysql_query("select * from images");

while($row=mysql_fetch_array($sql))
{

$img_id=$row['img_id'];
$img_name=$row['img_name'];
$img_url=$row['img_url'];
$love=$row['love'];
?>


<div style="margin-bottom:30px">
<div class="box" align="left">
<a href="#" class="love" id="<?php echo $img_id; ?>">
<span class="on_img" align="left"> <?php echo $love; ?> </span> 
</a>
</div>
<img src='<?php echo $img_url; ?>' />
</div>
<?php

}
?>

</div>











</div>

</div>
</body>
</html>

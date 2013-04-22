
<div class ="rating" >
	<div>
	<div style="color:#333333" align="left">Average Rating 
		<?php 
			$ret=$menus->getRatings($filename);
			$ret1=array('Good','OK','No');
			$ret=array_map(null,$ret1,$ret);	
			foreach($ret as $key =>$val)
			{			
				echo '<span class=\'v\' id=\'_lr'.$key.'\'>'.$val[0].'('.$val[1].')'.'</span>';
			} 
		?>
	</div>
	<div style="color:#333333" align="left">Your Rating
&nbsp;&nbsp;&nbsp;
	<a href="#" id="love">
		<img border="0px" src="<?php echo ThemeDir.'/images/good.gif';?>" />Good
	</a>
	&nbsp;&nbsp;&nbsp;
	<a href="#" id="nomatter">
		<img border="0px" src="<?php echo ThemeDir.'/images/ok.gif';?>" />OK
	</a>
	&nbsp;&nbsp;&nbsp;
	<a href="#" id="hate">
		<img border="0px" src="<?php echo ThemeDir.'/images/bad.gif';?>" />No
	</a>
	</div>
	</div>
</div>
       <script language="javascript" type="text/javascript">
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

				$("[id=love]").click(function() 
				{
					var id =1;// $(this).attr("id");
					var dataString =<?php echo '\'' . $_QID . '=\'+\''. bin2hex($ID) ; ?>'+'&'+'id='+ id ;
					//var dataString ='id='+ id ;
					var parent = $(this);
					var child=parent.firstChild;
					$(this).fadeOut(300);
					$.ajax({
						type: "POST",
						url: "/View/ajax_love.php",
						data: dataString,
						cache: false,
						success: function(html)
						{
							//parent.children('#goodspan').html(' '+html+'');
							$("#_lr0").html("Good ("+html+")");							
							//parent.html("Good "+html);							
							parent.fadeIn(300);
						} 
					});
					return false;
 				});

				$("[id=nomatter]").click(function() 
				{
					var id =2;// $(this).attr("id");
					var dataString =<?php echo '\'' . $_QID . '=\'+\''. bin2hex($ID) ; ?>'+'&'+'id='+ id ;
					//var dataString ='id='+ id ;
					var parent = $(this);
					var child=parent.firstChild;
					$(this).fadeOut(300);
					$.ajax({
						type: "POST",
						url: "/View/ajax_love.php",
						data: dataString,
						cache: false,
						success: function(html)
						{
							//parent.children('#goodspan').html(' '+html+'');
							$("#_lr1").html("OK ("+html+")");							
							//parent.html("Good "+html);							
							parent.fadeIn(300);
						} 
					});
					return false;
 				});
				$("[id=hate]").click(function() 
				{
					var id =3;// $(this).attr("id");
					var dataString =<?php echo '\'' . $_QID . '=\'+\''. bin2hex($ID) ; ?>'+'&'+'id='+ id ;
					//var dataString ='id='+ id ;
					var parent = $(this);
					var child=parent.firstChild;
					$(this).fadeOut(300);
					$.ajax({
						type: "POST",
						url: "/View/ajax_love.php",
						data: dataString,
						cache: false,
						success: function(html)
						{
							//parent.children('#goodspan').html(' '+html+'');
							$("#_lr2").html("No ("+html+")");							
							//parent.html("Good "+html);							
							parent.fadeIn(300);
						} 
					});
					return false;
 				});
			});

        </script>

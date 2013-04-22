<div id="inputform">
	<div class ='flip'>Post a Comment </div>
	<div class ='panel'>
	<?php 
		$handler=ControllerDir.'/control_comment.php';
		echo "<form action=\"".$handler."\" method=\"post\">";
	?>
	<div>
	<input name="username" id="status" value="Your name here" type="text"/> 
	</div>				
	<div>
	<input name="email" id="status" value="Your email here" type="text"/> 
	</div>				
	<div>
	<textarea rows="10" cols="50" width='500px' name="comment"> 
		Your comment here 
	</textarea>	 
	</div>				
	<div>
	<input value="Submit" type="submit"/>
	</div>				
	<input name="topic" value="<?php echo $ID;?>" type="hidden"/><br/>
	</form>
	</div>
</div>
<div class="subTitle">
&nbsp;&nbsp;&nbsp;&nbsp;Login<br/><br/>
	<?php 
		$handler=ControllerDir.'/control_login.php';
		echo "<form action=\"".$handler."\" method=\"post\">";
	?>
	<table>
	<tr>
	<td>
		<div>&nbsp;User&nbsp;Name:&nbsp;</div>
	</td>
	<td>
		<input name="username" class="field" type="text"/>
	</td>
	</tr>	

	<tr>
	<td>
		<div>&nbsp;Password&nbsp;&nbsp;&nbsp;</div>
	</td>
	<td>
		<input name="password" class="field" type="text"/>
	</td>
	</tr>	
	<tr>
	<td colspan="2">
		<input value="Login" type="submit"/><a href='includes/retrieve_pass.php'>&nbsp;Forgot&nbsp;password?</a>
		<a href='/View/members/register.php'>&nbsp;Register</a>
	</td>	
	</tr>
	</table>				
	</form>

<?php
	
?>
</div>

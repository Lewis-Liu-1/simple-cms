<?php
 	require_once('header.php');
 	require_once('print_menus.php');
	?>
	<body >
		<center>
	   <div class="main_content">
			<?php 
				$m=new WebMenus();
				$m->printMenus($menus->menus);
			?>
			<div id="header">
			</div>
		
	   	<div id="container">
				<div class="right_section">
				<?php
					require_once('ads_right.inc');
					require_once('print_login_form.php');
					require_once('list_articles.php');
					require_once('list_comments.php');
				?>
				</div>
			
	   		<div id="content">
	   			<div id="silver"></div>
	         	<div id="main">
					<?php
					 	$m->printWebPath($search);
						$m->printLinks($search,$directories);
						//var_dump($directories);							
						$m->printLeaves($search,$directories);
					?>
					</div>
   			</div>
   		</div>
   		
		<?php
	 		require_once("footer.inc");
		?>
	
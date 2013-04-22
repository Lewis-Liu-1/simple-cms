<?php
	require_once(RootDir.ModelDir.'/model_file.php');

 	require_once('header.php');
 	require_once('print_menus.php');
 	require_once('print_file.php');
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
					 	
						$f=new FileModel($filename);
						$f->loadSections();
						//var_dump($f->getSections());
						$fv=new MyFileViewer();
						$fv->printTitle($f->getFileTitle());
						$fv->printSections($f->getSections());
					?>
					</div>
   			</div>
	
			<div id='fileend'>
			<?php
				require_once("print_comment_form.php");
				require_once("rating.php");					
			?>
			</div>	

   	</div>
   		
		<?php
	 		require_once("footer.inc");
		?>

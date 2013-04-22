<?php
	require_once(RootDir.ModelDir.'/model_file.php');

 	require_once('header.php');
 	require_once('print_menus.php');
 	require_once('print_file.php');
?>
<body>
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
						$IMAGES_DIR=RootDir.DataDir.'/Images';
						$f=new FileModel($IMAGES_DIR);
						$pics=$f->loadPictures();
						//var_dump($pics);
												
						$f=new FileModel($IMAGES_DIR.'/'.ImageDescFileName);
						$f->loadSections();
						$fv=new MyFileViewer();
						//$fv->printTitle($f->getFileTitle());
						$fv->printSections($f->getSections());
						
						
						require_once('list_pictures.php');
						foreach($menus->menus as $key=>$val)
						{
							if (is_array($val))
							{
								echo "<div class ='subTitle1'>";
								echo $key;
								$counter=20;
								$m->printSPLeaves(array($key),$val,$counter);
								echo "</div>";
							}
						}
					
						//$f=new FileModel(WelcomeFilePath);
						//$f->loadSections();
						//$fv=new MyFileViewer();
						//$fv->printTitle($f->getFileTitle());
						//$fv->printSections($f->getSections());
					?>
					</div>
   			</div>
   		</div>
   		
		<?php
	 		require_once(RootDir.ViewDir."/footer.inc");
		?>

<script type="text/javascript" src="scripts/pwdwidget.js"></script>      
<script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/settings.php');

 	require_once(RootDir.ModelDir.'/model_menus.php');
	$menus=MenuModel::singleton();
		
 	require_once(RootDir.ViewDir.'/header.php');
 	require_once(RootDir.ViewDir.'/print_menus.php');
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
					require_once(RootDir.ViewDir.'/ads_right.inc');
					require_once(RootDir.ViewDir.'/list_articles.php');
					require_once(RootDir.ViewDir.'/list_comments.php');
				?>
				</div>
	   		<div id="content">
	   			<div id="silver"></div>
		         <div id="main">
		         <?php 
					 	require_once('print_register_form.php');
					?> 	
					</div>
				</div>
   		</div>
   	</div>
   		
		<?php
	 		require_once(RootDir.ViewDir.'/footer.inc');
		?>
	
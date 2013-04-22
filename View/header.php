<html xmlns="http://www.w3.org/1999/xhtml">

<head id="Head1" runat="server">
    <title id="page_title"><?php echo WebSiteName;?> </title>
<meta name="description" content="Find a stuff" />
<meta name="keywords" content="C,C++,C#,ASP.NET,ASSEMBLY,Java,HTML,CSS,XML,JavaScript" />
<meta name="author" content="Lewis Liu" />
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />    

<link type="text/css" rel="stylesheet" media="all" href="<?php echo ThemeDir.$curTheme;?>/StyleSheet.css" />
    <script src="/js/jquery-1.4.2.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/slider.js"></script>
    <script type="text/javascript" src="/js/clock.js"></script>
    <script type="text/javascript" src="/js/ajax.js"></script>
    <script type="text/javascript" src="/js/editor.js"></script>
    <link href="/images/kangaroo.gif" rel="shortcut icon" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="<?php echo ThemeDir.$curTheme;?>/mouseovertabs.css" />


<script src="http://www.metservice.com/assets/js/ms.widget.js" type="text/javascript">
/***********************************************
* Dynamic Countdown script- Dynamic Drive (http://www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/
</script>

	<script src="/js/mouseovertabs.js" type="text/javascript">

/***********************************************
* Mouseover Tabs Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/

</script>


	<script type="text/javascript">
	
	
	function getWindowWidth() {
		var windowWidth = 0;
		if (typeof(window.innerWidth) == 'number') {
			windowWidth = window.innerWidth;
		}
		else {
			if (document.documentElement && document.documentElement.clientWidth) {
				windowWidth = document.documentElement.clientWidth;
			}
			else {
				if (document.body && document.body.clientWidth) {
					windowWidth = document.body.clientWidth;
				}
			}
		}
		return windowWidth;
	}
	
	var sized=false;
	
		$(document).ready(function() {
			$('input[type="text"]').addClass("idleField");
       		$('input[type="text"]').focus(function() {
       			$(this).removeClass("idleField").addClass("focusField");
    		    if (this.value == this.defaultValue){ 
    		    	this.value = '';
				}
				if(this.value != this.defaultValue){
	    			this.select();
	    		}
    		});
    		$('input[type="text"]').blur(function() {
    			$(this).removeClass("focusField").addClass("idleField");
    		    if ($.trim(this.value) == ''){
			    	this.value = (this.defaultValue ? this.defaultValue : '');
				}
    		});
    		
    		$(".flip").click(function(){
		    	$(".panel").slideToggle("slow");
		    });
		    var swid=getWindowWidth();
		    var wid=swid*80/100;
		   $(".main_content").width(wid);
			var rightwid=$(".right_section").width()+20;
			wid=wid-rightwid;
		   $("#content").width(wid);
			//$(".picArea").width(wid);		 
		   $("#fileend").width(wid-10);
		 
		 $(".sizeimg").click(function()
		 	{
		 		var wid0=$(this).attr("orgwid");
		 		var hei0=$(this).attr("orghei");
		 		var wid=$(this).attr("tempwid");
		 		var hei=$(this).attr("temphei");
				if ($(this).width()==wid0)
				{
		 			$(this).animate({width: wid}, 'slow')
		 			$(this).animate({height: hei}, 'slow')
					$(this).css("cursor","se-resize");
				}
				else
				{	
		 			$(this).animate({width: wid0}, 'slow')
		 			$(this).animate({height: hei0}, 'slow')
					$(this).css("cursor","nw-resize");
				}
		 	});   

	    $("[src$='.jpg']").each(function()
		    {
		    	var s=$(this).width();
			 	if ((s)>$("#content").width()) {
					var v=$("#content").width();
		    		$(this).width(v);
		    	}
		    });

		 wid = $(".tabsmenuclass").width();
		 hei=$(".tabsmenuclass").height();
		 var s0=wid.toString();
		 var s1=hei.toString();
		 var s=s0+'px '+s1+'px';
		 //alert(s);
		 
			    	
  });
	</script>
</head>




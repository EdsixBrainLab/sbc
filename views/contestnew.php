<?php
/* include_once("db_connection.php");
include_once("qry/Query.php");
 */
 $logoutUrl = "logout.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Skill Angels Assessment</title>
	
	
<script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">
	<!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript" src="js/charts.js"></script>
    <script src="js/jquery-1.11.0.min.js"></script>
<script src="js/skillpiecharts.js" type="text/javascript"></script>
<script src="js/skillpiecharts-more.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="js/jquery.fancybox-media.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css" media="screen" />


<style>
.active
{
background-color:rgba(255,112,6,1);
}


.not-active {
   pointer-events: none;
   cursor: default;
}

</style>
</head>

<body ng-app="Dashboard" ng-controller="Stars">
<div id="wrapper">
<!-- header starts here -->
 <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
<div class="pageheader">           
		   <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<a class="navbar-brand navbar-brand1" href="javascript:;"><img src="images/logo.png" width="141" height="116" alt="logo"></a>-->
            </div>
            <!-- /.navbar-header -->
			<span class="topHead">Welcome to Skill Angels Assessment</span>
            <ul class="nav navbar-top-links navbar-right rightSideButton">
            	
            	<!-- <a href="myprofile.html"><button type="button" class="btn btn-primary">Edit Account</button></a>-->
                 <a href="<?php echo $logoutUrl ?>" class="btn btn-primary">Logout</a>
            </ul>
			</div>
</nav>
<div class="pagemenu">
		   <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
				
                    <ul class="nav" id="side-menu">
                        <li class="sidebarProfile" ng-controller="Stars">
                        	<!--<button id="pageHome" type="button"  class="btn btn-default btn-circle editBtn menu"><i class="fa fa-edit"></i></button>-->
                        	<img src="images/Parrot_logo_wink2.png" width="150" height="150" class="img-circle">
                            <h2 ><?php echo $Name ?></h2>
                        </li>
                        <li>
                            <a id="Dashboard" class="Dashboard menu" style="cursor:pointer" href="new/profile.php">Profile<i class="fa fa-th-large fa-fw"></i></a>
                        </li>
                        <li>
                            <a id="MyGames" class="MyGames  menu" style="cursor:pointer">My Games<i class="fa fa-gamepad fa-fw"></i></a>
                        </li>
                        <li>
                            <a id="MyReports" class="MyReports  menu" style="cursor:pointer">My Reports<i class="fa fa-table fa-fw"></i></a>
                        </li>
                        <li>
                            <a id="MyProfile" class="MyProfile  menu" style="cursor:pointer">My Profile<i class="fa fa-edit fa-fw"></i></a>
                        </li>
                    </ul>
                     <ul class="side-skill pageHomePager myprofilehide DashboardPager MyGamesPager MyReportsPager">
                            	<li>Memory (M)<span class="performanceMemory"></span></li>
                                <li>Visual Processing (VP)<span class="performanceVP"></span></li>
                                <li>Focus and Attention (FA)<span class="performanceFA"></span></li>
                                <li>Problem Solving (PS)<span class="performancePS"></span></li>
                                <li>Linguistics (LI)<span class="performanceLinguistics"></span></li>
                            </ul>
                </div>
             
            </div>	
			  </div>	

 <!--  header ends here -->
<div id="page-wrapper">
<div id="ProfileHtml"></div>
<div id="GamesHtml"></div>
<div id="ReportHtml"></div>
<?php //include_once('new/profile.php'); ?>
<?php //include_once('new/mygames.php'); ?>
<?php //include_once('new/reports.php'); ?>
</div>


<!-- Footer starts here-->
<footer>
<div class="container" id="footerpart">
<div class="row">
<div class="col-md-3 col-sm-6">

  
  <ul>
<li>EdSix Brain Lab<sup>TM</sup> Pvt Ltd</li>
<li># 1 H, Module no. 8,</li>
<li>IIT Madras Research Park First Floor,</li>
<li>Kanagam Road ,Taramani Chennai - 600113</li>
  </ul> 
  </div>
<div class="col-md-3 col-sm-6">
<ul>
<li class="callicon">044-66469877</li>
<li class="msgicon"><a href="mailto:angel@skillangels.com">angel@skillangels.com</a></li>
</ul>
<div class="socialmedia">
<span>Join Us</span>
<a href="https://www.facebook.com/skillangels" target="_blank"><img src="images/fb.png" width="33" height="33"></a> <a href="https://www.linkedin.com/company/edsix-brain-lab-pvt-ltd?trk=company_logo" target="_blank"><img src="images/icon_LinkedIn.png" width="33" height="33"></a>
</div>

</div>
<div class="col-md-3 col-sm-6">
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="termsofservice.php" target="_blank">Terms Of Service</a></li>
<li><a href="privacypolicy.php" target="_blank">Privacy Policy</a></li>
<li><a href="faq.php" target="_blank">FAQ</a></li>
</ul>
</div>
<div class="col-md-3 col-sm-6">

  <img src="images/index_logo.png" class="img-responsive"  width="193" height="67">
   <br/>
<img src="images/logo_RTBI.png"  > <img src="images/logo_CJE.png"  ></div>
</div>
</div>

</footer>
<div class="footerBottom"><p>&copy; 2017 Skillangels. All rights reserved</p></div>	
<!-- footer ends here --> 
    <!-- /#wrapper -->
	<!-- jQuery -->
      <script src="js/bootstrap.min.js"></script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/sb-admin-2.js"></script>
	 <script src="js/jquery-ui.js"></script>
<script type="text/javascript" >
$(document).ready(function() {
  ProfileHtml();
  GamesHtml();
});
function ProfileHtml()
{	
		$.ajax({
			type: "POST",
			url: "new/profile.php",
			data: {},
			success: function(result){ alert(result);
				 $('#loadingimage').hide();
				 $('#ProfileHtml').html(result);
				}
		});	
}
function GamesHtml()
{	
		$.ajax({
			type: "POST",
			url: "new/mygames.php",
			data: {},
			success: function(result){ alert(result);
				 $('#loadingimage').hide();
				 $('#GamesHtml').html(result);
				}
		});	
}
</script>
</body>
</html>

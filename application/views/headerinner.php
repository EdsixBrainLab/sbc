<?php 

$conteststartdate=$this->session->conteststartdate;
$curdatetime=date('Y-m-d H:i:s'); //echo $conteststartdate."<br/>".$curdatetime;
$time_one = new DateTime($conteststartdate);
$time_two = new DateTime($curdatetime);
$countdowntime=$time_one->getTimestamp() - $time_two->getTimestamp();

//$this->session->set_userdata('countdowntime',$countdowntime);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>SkillAngels Challenge – India’s Largest Online Brain Skill contest</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>assets/css/metisMenu.min.css" rel="stylesheet">
	<!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/design-system.css" rel="stylesheet">
	<!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/charts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/skillpiecharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/skillpiecharts-more.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/design-system-motion.js"></script>

<!--FULL SCREEN-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/fancy/jquery.fancybox.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/fancy/fullscreen.css" media="screen">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/css/fancy/jquery.fancybox.js"></script>
<style>
.active
{
background-color:rgba(255,112,6,1);
}


.not-active {
   pointer-events: none;
   cursor: default;
}
.activemenu { background:#fff; }
</style>

</head>
<header id="header" class="navbar-default">
	<div class="container">
		<div class="col-md-3 col-sm-4 col-xs-12 text-center">
		  <div class="logo" ><a  title="SkillAngels" href="javascript:;"><img src="<?php echo base_url(); ?>assets/images/skillangels_logo.png" alt="SkillAngels" width="210"/><!--<img src="images/SUPER_BRAIN_OLYMPIAD.png" alt="G-TEC Gensmart Academy" width="100"/>--></a></div>
		</div>
		
		<div class="col-md-9 col-sm-8 col-xs-12 login-btn">
		<nav class="navbar1">
			<div class="navbar-collapse1" id="primary-menu">
			  <ul class="nav navbar-nav" style="float: right;">
				<?php if($countdowntime<=0){ ?>
				
				<?php if($this->uri->segment(2)!="review"){ ?>
				
				
                        <li>
                            <a id="Dashboard" class="Dashboard menu menuLink <?php if($this->uri->segment(2)=="myprofile"){echo 'activemenu';} ?>" style="cursor:pointer" href="<?php echo base_url(); ?>index.php/home/myprofile">My Profile<i class="fa fa-edit fa-fw"></i></a>
                        </li>
                        <li>
                            <a id="MyGames" class="MyGames  menu menuLink <?php if($this->uri->segment(2)=="mygames"){echo 'activemenu';} ?>" style="cursor:pointer" href="<?php echo base_url(); ?>index.php/home/mygames">My Games<i class="fa fa-gamepad fa-fw"></i></a>
                        </li>
                        <li>
                            <a id="MyReports" href="<?php echo base_url(); ?>index.php/home/myreports" class="MyReports  menu menuLink <?php if($this->uri->segment(2)=="myreports"){echo 'activemenu';} ?>" style="cursor:pointer">My Reports<i class="fa fa-table fa-fw"></i></a>
                        </li>
				<?php } ?>
				<?php } ?>
				<?php //if($isexpired['conteststatus']==0 && $isplayed['played']==0)
						{ ?>
							<!--<li>
							<a id="Reschedule" href="reschedule.php" class="myschedule  menu menuLink" style="cursor:pointer">Reschedule<i class="fa fa-table fa-fw"></i></a>
							</li>-->
					<?php } ?>
						<li >
							<a href="<?php echo base_url(); ?>index.php/home/logout" class="btn menuLink">Logout</a>
						</li>
				</ul>
			</div>
		  </nav>
	</div>
 
		
	</div>
</header>
<style>
.disable a{
  pointer-events: none;
  cursor: default;
}
.navbar-brand>img {
	display: inline-block;
}
.welcomemsg{color:#fff;}
.nav>li>a{text-align:center;}

.welcomemsg h3{color: #fff;}

</style>
<body >
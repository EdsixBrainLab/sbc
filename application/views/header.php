<!DOCTYPE html>
<?php header("Access-Control-Allow-Origin: *"); ?>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SkillAngels Challenge – India’s Largest Online Brain Skill contest</title>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min_index.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet">
    <!--<link href="css/main.css" rel="stylesheet">-->
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/design-system-motion.js"></script>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
<script  type="text/javascript">
if(window==window.top) {
    // not in an iframe
 //window.location.href='http://superbrainolympiad.com/';
}
</script>
</head><!--/head-->
<body>
<?php
//echo "<pre>";print_r($_SESSION['name']);exit;

?>
<?php if(!isset($this->session->userId))
{?> 
<link href="<?php echo base_url(); ?>assets/css/newstyle.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/design-system.css" rel="stylesheet">
<header id="header">
	<div class="container">
	<div style="display:none;" id="iddivLoading" class="loading">Loading&#8230;</div>
		<div class="col-md-5 col-sm-12 col-xs-12 text-center">
		  <div class="logo" ><a  title="SkillAngels" href="<?php echo base_url();?>index.php"><img src="<?php echo base_url(); ?>assets/images/skillangels_logo.png" alt="SkillAngels" width="210"/><!--<img src="images/SUPER_BRAIN_OLYMPIAD.png" alt="G-TEC Gensmart Academy" width="100"/>--></a></div>
		</div>
		<!--<div class="col-md-3 col-sm-12 col-xs-12 puzzle-model">
		</div>-->
		<div class="col-md-7 col-sm-12 col-xs-12 login-btn">
			<div class="container">
			<form class="form-horizontal"  role="form" method="post" id="form-login">
				<div class="form-group" >
					<ul class="nav navbar-nav">
						<li class="">
							<input type="text" class="form-control" name="user_name" id="User_ID" placeholder="Enter User Name">
						</li>
						<li class="">          
						<input type="password" class="form-control" name="User_PWD" id="User_PWD" placeholder="Enter password">
						</li>
						<li class="">
							<input type="button" id="submit" class="form-control loginLink" value="Login">	
						</li>
						
							<!--<input type="button" id="" class="form-control loginLink" value="Register">-->
						<!-- <a href="<?php echo base_url(); ?>index.php/home/registration" id="" class="btn btn-success loginLink">Register</a>  -->
						
						
					</ul>
					<div id="ErrMsg" class="col-lg-12 col-sm-12" style="color: #fbe336;font-weight: bolder;font-size: 14px;clear: both;">  <?php if(isset($ErrMsg)){echo $ErrMsg;}?></div>
				</div>

				</form>
			</div>
		</div>
		<!-- <marquee style="color:chartreuse; font-size:20px; font-weight:bold;" onmouseover="this.stop();" onmouseout="this.start();">For all users who have not taken up the contest, another opportunity beckons. Login to the portal today (12-Nov-2017) after 8 am and choose any 1 hour slot between 9 am and 9 pm to be played on 12-Nov-2017.Please use the latest browsers. Also clear your cache on your devices before logging in.</marquee> -->
	</div>
</header>
<?php }  else{	?>
<link href="<?php echo base_url(); ?>assets/css/newstyle.css" rel="stylesheet">
<header id="header">
	<div class="container">
		<div class="col-md-3 col-sm-12 col-xs-12 text-center">
		  <div class="logo" ><a  title="SkillAngels" href="javascript:;"><img src="<?php echo base_url(); ?>assets/images/skillangels_logo.png" alt="SkillAngels" width="210"/><!--<img src="images/SUPER_BRAIN_OLYMPIAD.png" alt="G-TEC Gensmart Academy" width="100"/>--></a></div>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12 padtop" >
			<h3>Welcome <span style="color:#ff5c5d"><?php echo $this->session->name; ?></span></h3>
		</div>
		<div class="col-md-3 col-sm-12 col-xs-12 login-btn">
			<nav class="navbar1">
			<div class="navbar-collapse" id="primary-menu">
			  <ul class="nav navbar-nav">
				<li><a href="<?php echo base_url(); ?>index.php/home/myprofile" class="loginLink">Profile</a></li>
				</ul>
			</div>
		  </nav>
		</div>
 </div>
</header>
<?php } ?>

<style>
.padtop{text-align:center;padding:20px 0px 0px 40px;}
.topHead{color: #fff;font-size: 25px;}

.loading {
  position: fixed;
  z-index: 999;
/*   height: 2em;
  width: 2em; */
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  background: #5a5757 url(<?php echo base_url(); ?>assets/images/ajax-page-loader.gif) center center no-repeat;
  background-size: 5%;
  opacity: 0.6;
}
</style>
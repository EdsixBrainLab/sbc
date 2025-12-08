<?php //include('headerinner.php'); ?>
<?php //if($countdowntime<0){header("Location:profile.php");} 

//echo 'hai'; exit;
date_default_timezone_set('Asia/Kolkata');

// User Profiles


$conteststartdate= $this->session->conteststartdate;
$startTime= $this->session->conteststartdate;
$endTime=$this->session->contestenddate;
$contestdate=date('d-m-Y', strtotime(str_replace('/', '-', $conteststartdate)));
$conteststarttime=date('h', strtotime($startTime));
$conteststarttimed=date('h:i', strtotime($startTime));
$conteststarttimeampm=date('A', strtotime($startTime));

$contestendtime=date('h', strtotime($endTime));
$contestendtimed=date('h:i', strtotime($endTime));
$contestendtimeampm=date('A', strtotime($endTime)); 

$curdatetime=date('Y-m-d H:i:s'); //echo $conteststartdate."<br/>".$curdatetime;
$time_one = new DateTime($conteststartdate);
$time_two = new DateTime($curdatetime);
$countdowntime=$time_one->getTimestamp() - $time_two->getTimestamp();

if($countdowntime<0)
{

	$disableclass="class=''";
}
else{$disableclass="class='disable'";}


foreach($qryiscanreschedule as $objiscan)
{
	$iscan=$objiscan;
}

foreach($qryisplayed as $objisplayed)
{
	$isplayed=$objisplayed;
}

?>


<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/countdown/flipclock.css">
<script src="<?php echo base_url(); ?>assets/css/countdown/flipclock.js"></script>
<script type="text/javascript">
		var clock;		
		$(document).ready(function() {
			var countdowntime='<?php echo $countdowntime; ?>';
			if(countdowntime<0)
			{ 
				//window.location.href="mygames.php";
				window.location.href="<?php echo base_url(); ?>index.php/home/mygames";
			}
			var clock;
			clock = $('.clock').FlipClock({
		        clockFace: 'DailyCounter',
		        autoStart: false,
		        callbacks: {
		        	stop: function() {
		        		//window.location.href="mygames.php";
						window.location.href="<?php echo base_url(); ?>index.php/home/mygames";
		        	}
		        }
			
		    });
				 
		    //clock.setTime(378000);
			clock.setTime(<?php echo $countdowntime;?>);
		    clock.setCountdown(true);
		    clock.start();
			//alert("AAA"+a);
		});
</script>
<div class="container" style="text-align:center;margin-top: 10px;">
<div class="col-md-6 col-sm-6 col-lg-6" style="background: bisque; height:200px;">
<h2>Your Details</h2>
<?php
	if($this->session->asid==3)
	{
		$class=str_replace("Grade ","",$this->session->gradename);
	}
	else
	{ 
		$class=str_replace("Grade ","",$this->session->gradename)." - ".$this->session->section;
	}
?>
<h4><label>Name  : <?php echo $this->session->name; ?></label></h4>
<h4><label>School  : <?php echo $this->session->schoolname; ?></label></h4>
<h4><label>Class  : <?php echo $class; ?></label></h4>
<?php if($_SESSION["section"]!=''){ ?>
<!--<h4><label>Section  : <?php echo $this->session->section; ?></label></h4>-->
<?php } ?>
</div>
<div class="col-md-6 col-sm-6 col-lg-6" style="background: aquamarine; height:200px;">
<h2>Contest Details</h2>
<h4><label>Contest Start Date & Time  : <?php echo date('d-m-Y',strtotime($this->session->conteststartdate))." - ".$conteststarttimed." ".$conteststarttimeampm; ?></label></h4>
<!--<h4><label>Contest End Date    :   <?php echo date('d-m-Y',strtotime($this->session->contestenddate)); ?></label></h4>-->
<!--<h4><label>Contest Time  : <?php echo $conteststarttimed." ".$conteststarttimeampm; ?> to <?php echo $contestendtimed." ".$contestendtimeampm; ?> </label></h4>-->
</div>
</div>
<div id="">
<div class="container hinge-nav">
	<!--<div class="">
		<h2 style="text-align: center;">Your contest details</h2>
		<div class="" style="text-align:center">
			<h4><label>Contest Date  : <?php echo $contestdate; ?></label></h4>
			<h4><label>Contest Time </label> : <?php echo $conteststarttime." ".$conteststarttimeampm; ?> to <?php echo $contestendtime." ".$contestendtimeampm; ?> </label></h4>
		</div>
		 
	</div>-->
	<div class="" style="background: tomato; margin-bottom: 12px;">
		<h2 style="text-align: center;padding-top: 12px;">The Contest will be launching in</h2>
		 
		<div class="header waypoint">
				<div class="flip-counter clock" ></div>
				<div class="message"></div>
		</div>
	</div>
</div>
</div>
<?php //include('footer.php'); ?>

<style>/*
#page-wrapper{border: none;}
body {background-color: #fff;}
.countdown-container{
//background:url('https://cdn.dribbble.com/users/4908/screenshots/2570659/rocket.gif');
//background:url('https://i.pinimg.com/originals/6e/52/42/6e5242aab82fdb8822649c916a2ed714.gif');
background-repeat: no-repeat;
background-size: 100%;
background-position: center center;
padding:10% 10% 30% 10%;
text-align: center;
}
h2{padding: 20px;color: #fff;}
.clock{padding-left: 20%;}
.topHead{color: #fff;font-size: 25px;}
*/
.waypoint{padding:5% 0px;}
</style>
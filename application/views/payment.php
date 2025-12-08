<?php 
//echo $userid; exit;
/* include("db_connection.php");
include("qry/Query.php");
if(isset($_SESSION['userId'])){header("Location:profile.php");exit;} */
?>
<?php
/* $userid =  $_REQUEST['uid']; 
$create =  $_REQUEST['key'];
if($userid!='' &&$create!='')
{ 
	$isalreadyreguser=chkprocesseduser($userid); //echo $isalreadyreguser;exit;
	$isalreadregisted= $conn->query($isalreadyreguser);
	while($row =$isalreadregisted->fetch_assoc()){
		$isexist=$row;
	}

	if($isexist['emailcount']==0)
	{ 
		$qryuserdetails =UserDetailsmd5($userid);//echo "<pre>";print_r($qryuserdetails);exit;	
		$qryuserdetails = $conn->query($qryuserdetails);
		if ($qryuserdetails->num_rows > 0) 
		{	//echo 'hello'; exit;
			while($row =$qryuserdetails->fetch_assoc()){
				$userdetails=$row;
			}

			$qryplandetails =PlanDetails();
			$qryplandetails = $conn->query($qryplandetails);
			while($row =$qryplandetails->fetch_assoc()){
				$data['plandetails'][]=$row;
			}
		}
		else{
			
			header("Location:index.php");exit;
		}
	}
	else
	{
		header("Location:chk_registration.php");exit;
	}
}
else
{
	 header("Location:index.php");exit; 
} */
?>
<?php //include("header.php"); ?>
 <style> 
 .nav {
    position: relative;
 }
 .container .form-group label{color:#000;font-weight: 600;margin-bottom:0px;}
 .container .form-group label.error{color:red;font-size:11px;}
 .container .form-group input{ border: 1px solid #ccc;margin-bottom: 0px;}
 .form-control[readonly] {
		cursor:auto;
	  background-color:#f8f8f8
} .form-control[readonly]:focus {
      -webkit-box-shadow: none;  
      box-shadow: none;  
	  background-color:#f8f8f8
}
#btnRegisterSubmit{}
.form-group {margin-bottom: 0px;}
form .col-lg-6{min-height: 75px;}
textarea{margin-bottom:0}
#mainContDisp{
	border: 1px solid #eeeeee;
    background: #fafafa;
    box-shadow: 10px 10px 5px #888888;
    padding: 20px 15px 30px 25px;
 }
 </style>
<div id="mainContDisp" class="container playGames homePlayGames" style="margin-top:20px;margin-bottom:70px;">
<form name="frmcoupon" id="frmcoupon" action="" method="POST" enctype="multipart/form-data" >
  <div class="row">
    <div class="col-lg-12">
	<h1 style="margin:0 0 10px;  border: none;border-bottom: 2px solid #eaeaea;text-align: center;"><span style="padding-bottom:5px;">Registration Confirmation </span> </h1>
	 </div></div>
	
<div style="" id="iddivLoading" class="loading"></div>

<div class="row" style="padding:30px 0px;display:none;" id="userdata">
<div class="row">
<div class="col-lg-12" style="text-align:center;"><h3>Welcome <strong><?php echo $userdetails	['first_name']; ?></strong>, please find your registration details below.</h3></div>
</div>
<div class="row" >
	<div class="col-lg-12"  style="text-align:center;">
		<div class="form-group">
			<label >USERNAME  :  <?php echo $userdetails['first_name']; ?></label>
		</div> 
		<div class="form-group">
			<label>EMAIL  :  <?php echo $userdetails['email']; ?></label>
		</div> 
		<div class="form-group">
			<label>GRADE  :  <?php echo $userdetails['gradename']; ?></label>
		</div> 
		<div class="form-group">
			<label>SCHOOL  :  <?php echo $userdetails['school']; ?></label>
		</div> 
	</div>
</div> 
</div> 
<div class="row" style="display:none;" id="verfication">
	<h3>Welcome <strong><?php echo $userdetails	['first_name']; ?></strong>,
	<br/>Please wait, this may take some time to verify you.</h3>
</div>
<!--<div style="text-align:center;clear:both;">    
<div style="padding-bottom:5px;"><label  style="color:red"  class="error" id="errSlot"></label>
</div><input type="submit" id="proceed" style="float:none;" class="btn btn-success" name="proceed" value="Proceed to Pay">
</div>-->
</form>
</div>
<!-- END FOOTER  -->
<!-- START SIDEBAR -->
<?php //include("footer.php"); ?>
  
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
<script>

setTimeout(function(){
	
	paymentconfirmation();
	$("#verfication").hide();
},1000);


function paymentconfirmation()
{
	var userid='<?php echo $userid; ?>';
	window.location.replace("<?php echo base_url(); ?>index.php/home/paymentresponse?hdnPaymSubscribeID="+userid+" ");
}
</script>

<style>
.error 

{   color: red;
    font-size: 13px;
}
</style>
 </body>
</html>
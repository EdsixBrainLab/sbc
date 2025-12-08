<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

<head>
<?php
include("db_connection.php");
include("qry/Query.php");
?>
<?php
$contest_level_id=1;
$contest_id=1;
$isinsert=0;

		if(isset($_REQUEST['ud']) && isset($_REQUEST['res'])){}
		else{header("location:index.php");}
	/* $qryList= mysql_query("select * from change_password_history where status=0 and md5(userid)='".$_REQUEST['ud']."' and md5(randid)='".$_REQUEST['res']."'"); */
	
	$qryList=GetResetpwdUserDetails($_REQUEST['ud'],$_REQUEST['res']); 
	$qryList=$conn->query($qryList);
	
	while($objList =	$qryList->fetch_assoc()){
		$List[]=$objList;
	} 
	//echo "<pre>";print_r($List);exit;
	if(count($List)>0){}
	else{header("location:index.php");}
	
	if(isset($_POST))
	{
		if(isset($_REQUEST['txtOPassword']))
		{
			
			/* $qryListData= mysql_query("select count(id) as existcount,id,first_name,email from user where md5(id)='".$_REQUEST['ud']."' limit 1"); */
			$qryListData= GetUserDetailsforResetpwd($_REQUEST['ud']);
			$qryListData=$conn->query($qryListData);
			while($objListData = $qryListData->fetch_assoc()){
				$ListData=$objListData;
			} 
// Generate two salts (both are numerical)
$salt1 = mt_rand(1000,9999999999);
$salt2 = mt_rand(100,999999999);
// Append our salts to the password
$salted_pass = $salt1 . $_REQUEST['txtOPassword'] . $salt2;
// Generate a salted hash
$pwdhash = sha1($salted_pass);

 	
		/* $qryList= mysql_query("update login_master set Password=md5('".$_REQUEST['txtOPassword']."') where Username=(select email from user where md5(id)='".$_REQUEST['ud']."')"); */
		$exepwdupdate=ResetPwd($pwdhash,$_REQUEST['ud'],$salt1,$salt2);
		$conn->query($exepwdupdate);
		/* $qryList= mysql_query("update change_password_history set updatedate=now(),status=1 where md5(userid)='".$_REQUEST['ud']."' and md5(randid)='".$_REQUEST['res']."'"); */
		$exelogupdate=ResetPwd_log($_REQUEST['ud'],$_REQUEST['res']);
		$conn->query($exelogupdate);
		$isinsert=1;
		
//$baseurl="http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
	$subject = 'Super Brain Game Contest - Password Reset - Successful';

$message = '<table align="center" width="800px" border="1" cellspacing="0" cellpadding="0" style="font-size:medium;margin-right:auto;margin-left:auto;border:1px solid rgb(197,197,197);font-family:Arial,Helvetica,sans-serif;background-image:initial;background-repeat:initial">

<tbody>
<tr style="display:block;overflow:hidden">
<td style="float:left;border:0px;">
<a href="http://superbraingame.skillangels.com" target="_blank" ><img src="http://www.godofbrains.in/images/emailer/header.jpg" width="100%"  alt="Skillangels" /></a>
</td>
</tr>

<tr style="padding:0px;margin:10px 42px 20px;display:block;font-size:13px;font-family:Verdana,Geneva,sans-serif;line-height:18px;text-align:justify">
<td colspan="2" style="border:0px">
Dear '.$ListData['first_name'].',

</td>

<tr style="padding:0px;margin:10px 42px 20px;display:block;font-size:13px;font-family:Verdana,Geneva,sans-serif;line-height:18px;text-align:justify">
<td colspan="2" style="border:0px">
Your Password has been reset. Now, You can now login <a href="'.$baseurl.'" target="_blank" >'.$baseurl.'</a>  with the following credentials
</td>
</tr>
 
<tr style="padding:0px;margin:10px 42px 5px;display:block;font-size:13px;font-family:Verdana,Geneva,sans-serif;line-height:18px;text-align:justify">
<td colspan="2" style="border:0px">

Username  :	'.$ListData['email'].'
</td>
</tr>
<tr style="padding:0px;margin:5px 42px 10px;display:block;font-size:13px;font-family:Verdana,Geneva,sans-serif;line-height:18px;text-align:justify">
<td colspan="2" style="border:0px">
Password  :	'.$_REQUEST['txtOPassword'].'
</td>
</tr>
<tr style="padding:0px;margin:20px 42px 5px;display:block;font-size:13px;font-family:Verdana,Geneva,sans-serif;line-height:18px;text-align:justify">
<td colspan="2" style="border:0px">

With Best Regards,
</td>
</tr>
<tr style="padding:0px;margin:5px 42px 20px;display:block;font-size:13px;font-family:Verdana,Geneva,sans-serif;line-height:18px;text-align:justify">
<td colspan="2" style="border:0px">
Support Team - Super Brain Game Contest 
</td>
</tr>



<tr style="">
<td style="text-align:center;color:#fff;border:0px;background-size:100%;background-color:#35395e;padding-top:20px;padding-bottom:20px;font-family: cursive;font-size: 20px;">
<div style="width:45%;float:left;text-align:right">
<a href="http://www.skillangels.com/" target="_blank" style="color:#fff;text-decoration: none;" >www.skillangels.com</a><br/>
<a href="mailto:superbraingame@skillangels.com"  style="color:#fff;text-decoration: none;" >superbraingame@skillangels.com</a>
</div>
<div style="border-left:4px solid #f99d1a;padding-left:10px;margin-left:10px;width:45%; float:left;text-align:left">
<span>Chutti TV</span> +91 97 90 944 440<br/>
<span>Kochu TV</span> +91 98 40 955 150
</div>
</td>

</tr>
<tr style="display:block;overflow:hidden">
<td style="float:left;border:0px;">

</td>

</tr>
</tbody>
</table>';
				
				require 'mailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host = "smtpout.secureserver.net";
	$mail->Port = 465;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	$mail->Username = "sundar@skillangels.com";
	$mail->Password = "sandy@08cs081";
	$mail->setFrom('sundar@skillangels.com', 'Contest');
	$mail->addReplyTo('sundar@skillangels.com', 'Contest');
	$mail->addAddress($ListData['email'], ''); //to mail id
	$mail->Subject = $subject;
	$mail->msgHTML($message);

//send the message, check for errors
if (!$mail->send()) {
    //echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    //echo "Message sent!";
}
	
	

		}
		
	}
	
		?>
<!-- START BASIC PAGE NEEDS -->
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
        <title>Super Brain Game Contest</title>
  <meta name="keywords" content="Super Brain Game,SuperBrain, SkillAngels, Super Brain, SuperBrain Challenge, Brain Skill contest, Edsix Brain Lab, Skill challenge" />
  <meta name="description" content="Super Brain Game Contest – an online Brain Skill Contest for Kids from Std I to Std XII"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/stylesheet.css" rel="stylesheet"/>
<link href="css/font-awesome.css" rel="stylesheet"/>
<link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,300,100,200' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <link href="css/bootstrap.min_index.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
<link href='fonts/css_raleway.css' rel='stylesheet' type='text/css'>
<link href='fonts/css_opensans.css' rel='stylesheet' type='text/css'>
<!-- END GOOGLE FONT -->

 <!--STYLES-->
 <!--STYLES END--> 
 <script src="js/jquery.min.js"></script>
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="js/selectivizr.js"></script>
    <![endif]-->
	<style>
.landing-menu {
    margin: 18px 0;    
	margin-bottom: 0px;
    float: left;
}
.menu {
    margin-bottom: 0;
    display: table-cell;
    vertical-align: middle;
}
.menu li {
    display: inline;    
	background-color: #eec64a;
    padding: 10px;    
	margin-right: 5px;
}
.menu a, .mobile-menu a {
    font-size: 15px;
    color: #000 !important;
    letter-spacing: .03em;
    font-weight: 400;
    padding: 3px 10px;
	font-weight: bold;
    font-family: 'Open Sans',sans-serif;
}
</style>

</head>
<body>
<?php include_once('header.php'); ?>
<!-- START NAVIGATION -->


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
 </style>
 
<div id="mainContDisp" class="container playGames homePlayGames" style="margin-top:20px;margin-bottom:70px;">

  <?php if($isinsert==0){ ?>
<form name="frmCPassword" id="frmCPassword" class="" method="post"  enctype="multipart/form-data" >
  <div class="row">
    <div class="col-lg-12">
	<h1 style="margin:0 0 10px;  border: none;border-bottom: 2px solid #eaeaea;text-align: center;"><span style="padding-bottom:5px;">Change Password </span> </h1>
	<div style="padding-top:5px;">
      <div class="">
      <h3>Please enter your new password to update : </h3><span style="float:right;"><label><span style="color:red">*</span> Required fields
	  </label></span>
  </div></div></div></div>
  <div class="row">
  
	
	<div class="col-lg-6">
  <div class="form-group">
    <label for="txtOPassword">Password <span style="color:red">*</span></label>
    <input type="password" placeholder="Minimum 8 characters" class="form-control" maxlength="20" name="txtOPassword" value="" id="txtOPassword">
  </div>
    </div>
	<div class="col-lg-6">
  <div class="form-group">
    <label for="txtCPassword">Confirm Password <span style="color:red">*</span></label>
    <input type="password" placeholder="Minimum 8 characters" class="form-control" maxlength="20" name="txtCPassword" value="" id="txtCPassword">
	<input type="hidden" value="<?php echo $_REQUEST['res']; ?>" name="res"/>
	<input type="hidden" value="<?php echo $_REQUEST['ud']; ?>" name="ud"/>
  </div>
    </div>
	 
	

   <div style="text-align:center;clear:both;">
  
  <input type="submit" id="btnRegisterSubmitCP" style="float:none;" class="btn btn-success" value="Submit">
   </div>
   </div>
 </form>
  <?php } 
  else{ ?>
	  <div class="row">
	        <h3 style="text-align:center;color:green">Your password is updated successfully.</h3>

	  </div>
	<?php   
  }
  ?>
</div>

<div style="display:none;" id="iddivLoading" class="loading">Loading&#8230;</div>
<style>
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>
<!-- ......................... -->
 
  
  
  
  <!-- END FOOTER --> 
<!-- START SIDEBAR -->
<!--/#bottom-->
<?php include_once('footer.php'); ?><!--/#footer-->
<!-- END SIDEBAR --> 

<!--SCRIPTS-->

<!--SCRIPTS END-->
	 <link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-ui.js"></script>
  <script src="js/jquery.validate.js"></script>
 

<script>
$(document).ready(function () {
	 		
	$('.numbersOnly').keyup(function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
});
$('.alphaOnly').keyup(function () { 
    this.value = this.value.replace(/[^a-zA-Z ]/g,'');
});

$.validator.addMethod('filesize', function(value, element, param) {
    return this.optional(element) || (element.files[0].size <= param) 
});

 $('#txtPassword').bind("cut copy paste",function(e) {
     e.preventDefault();
 });
  $('#txtCPassword').bind("cut copy paste",function(e) {
     e.preventDefault();
 }); $('#txtEmail').bind("cut copy paste",function(e) {
     e.preventDefault();
 });
  $('#txtCEmail').bind("cut copy paste",function(e) {
     e.preventDefault();
 });
	// $("#frmRegister").valid();
    $("#frmCPassword").validate({
        rules: {
            			
			"txtOPassword": {required: true,minlength: 8},
			"txtCPassword": {required: true,equalTo: "#txtOPassword"}
        },
        messages: {
           
            "txtOPassword": {required: "Please, enter password"},
			"txtCPassword": {required: "Please, confirm password",equalTo: "Please, enter valid confirm password"}
			
        },
		errorPlacement: function(error, element) {
    if (element.attr("type") === "radio") {
        error.insertAfter(element.parent().parent());
    } else {
        error.insertAfter(element);
    }
},
		highlight: function(input) {
            $(input).addClass('error');
        } 
    });

});



		</script>

</body>
</html>

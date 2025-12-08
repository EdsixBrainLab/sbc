<?php 
//include("db_connection.php");
//include("qry/Query.php");
//if(isset($_SESSION['userId'])){header("Location:profile.php");exit;}
$contest_level_id=1;
$contest_id=1;
       echo '<!DOCTYPE html>
<html>
<head>
    <title>SBC</title>
</head>
<body>
    <h1>Welcome to the Super Brain Challenge</h1>
    <p>Registration closed!</p>
</body>
</html>';
        exit;
	
?>
<?php
function getUserCountry($ip) {
    // Replace with a valid Geo-IP API URL and token
    $apiUrl = "https://ipinfo.io/{$ip}/json?token=129576f977ac0c"; 
    $response = @file_get_contents($apiUrl);
    $data = json_decode($response, true);
    return $data['country'] ?? null;
}

function restrictAccessForIndia() {
    $ip = $_SERVER['REMOTE_ADDR']; // Get user's IP
    if ($ip === "::1" || $ip === "127.0.0.1") {
        // Handle localhost for testing
        $ip = "8.8.8.8"; // Example public IP for testing
    }

    $country = getUserCountry($ip);
    if ($country === "IN") {
        // If user is from India, deny access
       echo '<!DOCTYPE html>
<html>
<head>
    <title>Restricted Page</title>
</head>
<body>
    <h1>Welcome to the Restricted Page</h1>
    <p>You are not from India and have access to this page.</p>
</body>
</html>';
        exit;
    }
}

// Restrict access on this page
//restrictAccessForIndia();
?>


<!-- START BASIC PAGE NEEDS -->

<?php //include('header.php'); ?>
<!-- START NAVIGATION -->

 <style> 
 
.loading_icon {
  position: fixed;
  z-index: 999;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  background: #5a5757 url(<?php echo base_url(); ?>assets/images/loading_icon.gif) center center no-repeat;
  background-size: 5%;
  opacity: 0.6;
}
.erroremail {
    color: #b51908 !important;
    font-size: 14px;
}
 #mainContDisp{
	border: 1px solid #eeeeee;
    background: #fafafa;
    box-shadow: 10px 10px 5px #888888;
    padding: 20px 15px 30px 25px;
 }
 .nav {
    position: relative;
 }
 .container .form-group label{color:#000;font-weight: 600;margin-bottom:0px;}
 .container .form-group label.error{color:#b51908;font-size:14px;}
 .container .form-group input{ border: 1px solid #ccc;margin-bottom: 0px;}
 .form-control[readonly] {
		cursor:auto;
	  background-color:#f8f8f8
} .form-control[readonly]:focus {
      -webkit-box-shadow: none;  
      box-shadow: none;  
	  background-color:#f8f8f8
}
.form-group {margin-bottom: 0px;}
form .col-lg-6{min-height: 84px;}
textarea{margin-bottom:0}

 </style>
<div id="mainContDisp" class="container playGames homePlayGames" style="margin-top:20px;margin-bottom:70px;">
<div id="succesemail"></div>
 
<form name="frmRegister" id="frmRegister" class="" method="post" enctype="multipart/form-data" >
<div class="row">
    <div class="col-lg-12">
		<h1 style="margin:0 0 10px;  border: none;text-align: center;"><span style="padding-bottom:5px;">Registration </span> </h1>
	</div>
</div>
<div class="row" id="regbanner">
    <div class="col-lg-12">
  <img width="100%" src="<?php echo base_url(); ?>assets/images/banner_register.jpg">
 </div>
</div>
		<div class="row">
			<div class="col-lg-12">
				<div style="padding-top:5px;">
					<h3>Please fill the below details to register for contest : </h3><span style="float:right;"><label><span style="color:red">*</span> Required fields
					</label></span>
				</div>
			</div>
		</div>
  <div class="row">
		<div class="col-lg-6">
		<div class="form-group">
		<label for="txtFName">First Name <span style="color:red">*</span></label>
		<input type="text" maxlength="40" class="form-control alphaOnly" name="txtFName" value=""  id="txtFName">
		</div> 
		</div>
		<div class="col-lg-6">
		<div class="form-group">
		<label for="txtLName">Last Name <span style="color:red">*</span></label>
		<input type="text" maxlength="40"  class="form-control alphaOnly" name="txtLName" value="" id="txtLName">
		</div> 
		</div>
 </div>
<div class="row">
	<div class="col-lg-6">
	<div class="form-group">
	<label for="txtMobile">Gender <span style="color:red">*</span></label>
	<div class="form-group"> 
	<div class="col-sm-3"><label class="radio-inline"><input type="radio" class=""  name="rdGender" value="M" id="rdGM">Male</label></div>
	<div class="col-sm-3"><label class="radio-inline"><input type="radio" class=""  name="rdGender" value="F" id="rdGF">Female</label></div>
	</div>
	</div>
	</div>
	<div class="col-lg-6" style="display:none;">
	<div class="form-group">
	<label for="txtAge">Age</label>
	<input type="text" readonly class="form-control" name="txtAge" value="" id="txtAge">
	</div>
	</div>
	<div class="col-lg-6">
	<div class="form-group">
	<label for="txtGrade">Grade <span style="color:red">*</span></label>
	<select class="form-control" name="ddlGrade" id="ddlGrade">
	<option value="">Select</option>
	<?php foreach($GradeList as $grade){
	?>
	<option value="<?php echo $grade['id']; ?>"><?php echo str_replace("Grade ",'',$grade['grade_name']); ?></option>
	<?php 
	}
	?>

	</select> 
	</div>
	</div>
</div>

<div class="row">
	

	<div class="col-lg-6">
	<div class="form-group">
	<label for="txtEmail">Email <span style="color:red">*</span></label>
	<input type="text" maxlength="100" class="form-control" name="txtEmail" value="" id="txtEmail">
	<label for="txtEmail" generated="true"  class="erroremail" id="errEmail"></label>
	</div>
	</div>
	<div class="col-lg-6">
	<div class="form-group">
	<label for="txtCEmail">Confirm Email <span style="color:red">*</span></label>
	<input type="text" maxlength="100" class="form-control" name="txtCEmail" value="" id="txtCEmail">
	</div>
	</div>
</div>
<div class="row" style="display:none;">
	<div class="col-lg-6">
	<div class="form-group">
	<label for="txtOPassword">Password <span style="color:red">*</span></label>
	<input type="password" placeholder="Minimum 8 characters" class="form-control" maxlength="20" name="txtOPassword" value="skillangels" id="txtOPassword">
	</div>
	</div>
	<div class="col-lg-6">
		<div class="form-group">
		<label for="txtCPassword">Confirm Password <span style="color:red">*</span></label>
		<input type="password" placeholder="Minimum 8 characters" class="form-control" maxlength="20" name="txtCPassword" value="skillangels" id="txtCPassword">
		</div>
	</div>
</div>
<div class="row"> 

		<div class="col-lg-6">
		<div class="form-group">
		<label for="txtSchool">School Name <span style="color:red">*</span></label>
		<input type="text" class="form-control" name="txtSchool" value="" id="txtSchool">
		</div>
		</div>	
		<div class="col-lg-6" >
		<div class="form-group">
		<label for="ddlCountry">Country <span style="color:red">*</span></label>
		<select class="form-control"  name="ddlCountry" id="ddlCountry">
		<option value="">Select</option>
		<?php foreach($CountryList as $country){ 
		if($country['id']==113){$selected="selected='selected'";}else{$selected='';}
		?>
		<option <?php echo $selected; ?> value="<?php echo $country['id']; ?>" rel="<?php echo $country['phonecode']; ?>"><?php echo $country['countryname']; ?></option>
		<?php 
		}
		?>
		</select>  </div>
		</div>
		
</div>
<div class="row">
<div class="col-lg-6">
		<div class="form-group">
		<label for="txtMobile">Mobile <span style="color:red">*</span></label>
		<div class="input-group">
		<span class="input-group-addon" id="idmobileCode">+91</span>
		<input placeholder="" type="text" class="form-control numbersOnly" maxlength="15" name="txtMobile" value="" id="txtMobile">
		</div>
		</div>
		</div>
<div class="col-lg-6">
		<div class="form-group">
		<label for="txtPincode">Coupon Code <span style="color:red">*</span></label>
		<input type="text" class="form-control" maxlength="8"  name="txtCouponcode" value="" id="txtCouponcode">
		</div>
		</div>		
		</div>
		
		
<!--<div class="row">
		<div class="col-lg-6" style="display:none;">
		<div class="form-group">
		<label for="ddlState">State / Province<span style="color:red">*</span></label>
		<select class="form-control"  name="ddlState" id="ddlState">
		 <?php //foreach($StateList as $state){
		//if($state['id']==1811){$selected="selected='selected'";}else{$selected='';}
		?>
		<option <?php //echo $selected; ?> value="<?php //echo $state['id']; ?>"><?php //echo $state['state_name']; ?></option>
		<?php //} ?> 
		</select>
		</div>
		</div>
		
</div>-->
<div class="row">
		<!--<div class="col-lg-6">
		<div class="form-group">
		<label for="txtUID">Participant ID Proof</label>
		<input type="file" class="form-control" name="txtUID" value="" id="txtUID">
		</div>
		</div>
		-->
		
</div> 
<div class="row">
<div style="text-align:center;clear:both;">
   <div style="padding-bottom:5px;">   
     <label  style=""  class="" id="">By clicking register button, I agree to the <a style="color: maroon;" href="<?php echo base_url(); ?>index.php/home/terms" target="_blank">terms and conditions</a> of the contest.</label>
</div>

   <div style="padding-bottom:5px;">   
     <label  style="color:red"  class="error" id="errcommon"></label>
	</div>
  <input type="button" id="btnRegisterSubmit" style="float:none;" class="btn btn-success" value="Register">
   </div>
 </div>
 </form>
  
</div>
<div class="loading_icon" style="display:none;">Loading&#8230;</div>

<!-- ......................... -->
 
  
  
  
  <!-- END FOOTER --> 
<!-- START SIDEBAR -->
<?php //include('footer.php'); ?>
<!-- END SIDEBAR --> 


<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
 

<script>
$(document).ready(function () {
	
	$("#ddlCountry").change(function(){
		$("#idmobileCode").html("+"+$('option:selected', this).attr('rel'));
	$.ajax({
				 url: "ajax_data.php", 
				 type:'POST',
				 data:{CType:'ST',countryID:$("#ddlCountry").val()},
				 success: function(result){
						$("#ddlState").html(result);
				}});
			});		
				
	var isemailavail=0;
	$("#txtEmail").blur(function(){
		$.ajax({
				 //url: "ajax_data.php", 
				 url: "<?php echo base_url(); ?>index.php/home/checkemailexist", 
				 type:'POST',
				 data:{CType:'EC',emailID:$("#txtEmail").val()},
				 success: function(result){
					 if($.trim(result)>0){isemailavail=0;$("#errEmail").html("This E-Mail ID is already registered. Please try with new id.").show();}
					 else{isemailavail=1;$("#errEmail").html("").show();
					 }
						
				}});
		
	});
	$("#btnRegisterSubmit").click(function(){ 
		//$(".loading1").show();
		 if($("#frmRegister").valid() && isemailavail==1)
		 {	
			$(".loading_icon").show();
			
			var formData = new FormData($("#frmRegister")[0]);
			$.ajax({
			//url: "ajax_data.php",
			url: "<?php echo base_url(); ?>index.php/home/insertreg",
			type: 'POST',
			dataType:"json",
			data: formData,
			contentType: false,       
			cache: false,             
			processData:false,
			success: function (data) 
			{ 
				$(".loading_icon").hide();
				//alert($.trim(data.response));
				if($.trim(data.response)=='1')
				{
					window.location.href = "<?php echo base_url(); ?>index.php/home/paymentresponse?hdnPaymSubscribeID="+data.RegID;
					/* $("#mainContDisp").html('<div class="col-lg-12" style="min-height:300px"><h1 style="margin:0 0 10px;  border: none;border-bottom: 2px solid #eaeaea;text-align: center;"><span style="padding-bottom:5px;">Registration </span> </h1><h3 style="margin-top: 30px;color: green;">Thanks for registering with Super Brain Challenge. Please check your mail box and complete your registration.</label></span></div>');*/
				}
				else
				{
					$("#errcommon").show().html(data.msg);
				}
			
        } 
    });

    return false;
	
		 }
		 $("#errEmail").show();
	});
	
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
	
		$("#frmRegister").validate({
		rules: 
		{
			"txtFName": {required: true,minlength: 3},
			"txtEmail": {required: true,email: true},
			"txtCEmail": {required: true,email: true,equalTo: "#txtEmail"},			
			"txtOPassword": {required: true,minlength: 8},
			"txtCPassword": {required: true,equalTo: "#txtOPassword"},
			"txtLName": {required: true},
			"ddlGrade": {required: true},
			"rdGender": {required: true},
			"txtMobile": {required: true},
			"txtDOP": {required: true},
			"txtSchool": {required: true},
			"ddlTimeSlot": {required: true},
			"ddlCountry": {required: true},
			"ddlState": {required: true},
			"txtUID":{accept: "png|jpe?g|pdf", filesize: 1048576*4},
			"ddlpreferred_channel": {required: true},
			"txtCouponcode": {required: true}			
		},
		messages: 
		{
			"txtFName": {required: "Please enter first name"},
			"txtEmail": {required: "Please enter email",email: "Please enter valid email"},
			"txtCEmail": {required: "Please confirm email",email: "Please enter valid email",equalTo: "These email don't match. Try again?"},
			"txtOPassword": {required: "Please enter password"},
			"txtCPassword": {required: "Please confirm password",equalTo: "Please enter valid confirm password"},
			"txtLName": {required: "Please enter last name"},
			"rdGender": {required: "Please select gender"},
			"txtMobile": {required:"Please enter mobile"},
			"ddlGrade": {required: "Please select grade"},
			"txtDOP": {required: "Please select date of contest"},
			"txtSchool": {required: "Please enter school name"},
			"ddlTimeSlot": {required: "Please select time slot"},
			"ddlCountry": {required: "Please select country"},
			"ddlState": {required: "Please select state / province"},
			"txtUID":{accept: "Please upload files only in the format of PNG, JPEG or PDF", filesize: "Please upload file size only upto 4MB"},
			"ddlpreferred_channel": {required: "Please select most watched channel"},
			"txtCouponcode": {required: "Please enter coupon code"}
		},
		errorPlacement: function(error, element) 
		{
			if (element.attr("type") === "radio")
			{
				error.insertAfter(element.parent().parent());
			}
			else if (element.attr("name") === "txtMobile")
			{
				error.insertAfter(element.parent());
			}
			else
			{
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

<?php 
//include("db_connection.php");
//include("qry/Query.php");
//if(isset($_SESSION['userId'])){header("Location:profile.php");exit;}
$contest_level_id=1;
$contest_id=1;

	
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
 .container .form-group label.error{color:#b51908;font-size:14px;display: block;
    clear: both;}
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
		<h1 style="margin:0 0 10px;  border: none;text-align: center;"><span style="padding-bottom:5px;">Student Feedback form – 2024-25   </span> </h1>
	</div>
</div>
 
		<div class="row">
			<div class="col-lg-12">
				<div style="padding-top:5px;">
				<h2>Hey Star! Hope you are enjoying the puzzle time. </h2>
					<h3>We'd love to hear your ideas and thoughts. Share with us by filling this form.   </h3><span style="float:right;"><label><span style="color:red"> </span>  
					</label></span>
				</div>
			</div>
		</div>
 
		<div class="row">
			<div class="col-lg-4">
				 <label>Name : <span><?php echo $query[0]['first_name']; ?></span></label>
			</div>
			<div class="col-lg-4">
				 <label>Grade : <span><?php echo $query[0]['gradename']; ?></span></label>
			</div>
			<div class="col-lg-4">
				 <label>School Name : <span><?php echo $query[0]['schoolname']; ?></span></label>
			</div>
		</div>
		
		<div class="row">
			
			 
		</div>
		<br/>
  <div class="row">
		<div class="col-lg-6">
		<div class="form-group">
		<label for="txtFName">How is the Skillangels program overall?  <span style="color:red">*</span></label>
<div class="form-group"> 
	<div class="col-sm-3"><label class="radio-inline"><input type="radio" class=""  name="rdQ1" value="Super" id="rdSuper">Super</label></div>
	<div class="col-sm-3"><label class="radio-inline"><input type="radio" class=""  name="rdQ1" value="Confusing" id="rdConfusing">Confusing</label></div>
	<div class="col-sm-3"><label class="radio-inline"><input type="radio" class=""  name="rdQ1" value="Boring" id="rdBoring">Boring</label></div>
	</div>

	</div> 
		</div>
		<div class="col-lg-6">
		<div class="form-group">
		<label for="txtLName">Is the option “how to play” useful? <span style="color:red">*</span></label>
		<div class="form-group"> 
	<div class="col-sm-3"><label class="radio-inline"><input type="radio" class=""  name="rdQ2" value="Yes" id="rdQ2Yes">Yes</label></div>
	<div class="col-sm-3"><label class="radio-inline"><input type="radio" class=""  name="rdQ2" value="No" id="rdQ2No">No</label></div>
 
	</div>
		</div> 
		</div>
 </div>
<div class="row">
	<div class="col-lg-6">
	<div class="form-group">
	<label for="txtMobile">Are the puzzles challenging to solve? <span style="color:red">*</span></label>
	<div class="form-group"> 
	<div class="col-sm-3"><label class="radio-inline"><input type="radio" class=""  name="rdQ3" value="Yes" id="rdQ3Yes">Yes</label></div>
	<div class="col-sm-3"><label class="radio-inline"><input type="radio" class=""  name="rdQ3" value="No" id="rdQ3No">No</label></div>
 
	</div>
	</div>
	</div>
	<div class="col-lg-6">
	<div class="form-group">
	<label for="txtMobile">Is the design of the puzzle page attractive? <span style="color:red">*</span></label>
	<div class="form-group"> 
	<div class="col-sm-3"><label class="radio-inline"><input type="radio" class=""  name="rdQ4" value="Yes" id="rdQ4Yes">Yes</label></div>
	<div class="col-sm-3"><label class="radio-inline"><input type="radio" class=""  name="rdQ4" value="No" id="rdQ4No">No</label></div>

 
	</div>
	</div>
	</div>
	 
	 
</div>

<div class="row">
	<div class="col-lg-6">
	<div class="form-group">
	<label for="txtMobile">Did you find the timer enough to answer the puzzles? <span style="color:red">*</span></label>
	<div class="form-group"> 
	<div class="col-sm-3"><label class="radio-inline"><input type="radio" class=""  name="rdQ5" value="Yes" id="rdQ5Yes">Yes</label></div>
	<div class="col-sm-3"><label class="radio-inline"><input type="radio" class=""  name="rdQ5" value="No" id="rdQ5No">No</label></div>
 
	</div>
	</div>
	</div>
	<div class="col-lg-6">
	<div class="form-group">
	<label for="txtMobile">Generally, how do you rate the puzzles from 0 to 4 scale? <span style="color:red">*</span></label>
	<div class="form-group"> 
	<div class="col-sm-2"><label class="radio-inline"><input type="radio" class=""  name="rdQ6" value="0" id="rdQ60">0</label></div>
	<div class="col-sm-2"><label class="radio-inline"><input type="radio" class=""  name="rdQ6" value="1" id="rdQ61">1</label></div>
	<div class="col-sm-2"><label class="radio-inline"><input type="radio" class=""  name="rdQ6" value="2" id="rdQ62">2</label></div>
	<div class="col-sm-2"><label class="radio-inline"><input type="radio" class=""  name="rdQ6" value="3" id="rdQ63">3</label></div>
	<div class="col-sm-2"><label class="radio-inline"><input type="radio" class=""  name="rdQ6" value="4" id="rdQ64">4</label></div>
 
	</div>
	</div>
	</div>
	 
	 
</div>



<div class="row">
	

	<div class="col-lg-6">
	<div class="form-group">
	<label for="txtEmail">Which skill do you like the most?  <span style="color:red">*</span></label>
	<div class="form-group"> 
	<div class="col-sm-4"><label class="checkbox-inline"><input type="checkbox" class=""  name="rdQ7[]" value="Memory" id="rdQ70">Memory</label></div>
	<div class="col-sm-4"><label class="checkbox-inline"><input type="checkbox" class=""  name="rdQ7[]" value="Visual Processing" id="rdQ71">Visual Processing</label></div>
	<div class="col-sm-4"><label class="checkbox-inline"><input type="checkbox" class=""  name="rdQ7[]" value="Focus and Attention" id="rdQ72">Focus and Attention</label></div>
	<div class="col-sm-4"><label class="checkbox-inline"><input type="checkbox" class=""  name="rdQ7[]" value="Problem Solving" id="rdQ73">Problem Solving</label></div>
	<div class="col-sm-4"><label class="checkbox-inline"><input type="checkbox" class=""  name="rdQ7[]" value="Linguistics" id="rdQ74">Linguistics</label></div>
 
	</div>	
	</div>
	</div>
	<div class="col-lg-6">
	<div class="form-group">
	<label for="txtCEmail">Have you received any certificate or reward so far? <span style="color:red">*</span></label>
	<div class="form-group"> 
	<div class="col-sm-3"><label class="radio-inline"><input type="radio" class=""  name="rdQ8" value="Yes" id="rdQ8Yes">Yes</label></div>
	<div class="col-sm-3"><label class="radio-inline"><input type="radio" class=""  name="rdQ8" value="No" id="rdQ8No">No</label></div>
 
	</div>	</div>
	</div>
</div>
<div class="row"  >
	<div class="col-lg-6">
	<div class="form-group">
	<label for="txtOPassword">How do you plan to get more rewards next time? Share your secret plan! <span style="color:red">*</span></label>
	<textarea rows="4" cols="50" name="txtplan" ></textarea>
	</div>
	</div>
	<div class="col-lg-6">
		<div class="form-group">
		<label for="txtCPassword">Happy to listen if you have any other feedback :    <span style="color:red">*</span></label>
	<textarea rows="4" cols="50" name="txtfeedback" ></textarea>
		</div>
	</div>
</div>
 
 <div class="row">
<div style="text-align:center;clear:both;">
  

   <div style="padding-bottom:5px;">   
     <label  style="color:red"  class="error" id="errcommon"></label>
	</div>
  <input type="button" id="btnRegisterSubmit" style="float:none;" class="btn btn-success" value="Register">
  <?php 
  if($isskip[0]['count']>0) 
  { ?>
  
  <input type="button" id="btnSkipSubmit" style="float:none;" class="btn btn-success" value="Skip" >
  <?php } ?>  
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
	
	 
	 
 
	$("#btnSkipSubmit").click(function(){  
	  $.ajax({
			//url: "ajax_data.php",
			url: "<?php echo base_url(); ?>index.php/home/skipultrev",
			type: 'POST',
			success: function (data) 
			{ 
				$(".loading_icon").hide();
				//if($.trim(data.response)=='1')
				{
					 
					 window.location.href="<?php echo base_url(); ?>index.php/home/mygames";
				}
				 
			
        } 
    });
	 
	});
 
	$("#btnRegisterSubmit").click(function(){ 
		//$(".loading1").show();
		 if($("#frmRegister").valid() )
		 {	
			$(".loading_icon").show();
			
			var formData = new FormData($("#frmRegister")[0]);
			$.ajax({
			//url: "ajax_data.php",
			url: "<?php echo base_url(); ?>index.php/home/insertultrev",
			type: 'POST',
			dataType:"json",
			data: formData,
			contentType: false,       
			cache: false,             
			processData:false,
			success: function (data) 
			{ 
				$(".loading_icon").hide();
				if($.trim(data.response)=='1')
				{
					 
					 $("#mainContDisp").html('<div class="col-lg-12" style="min-height:300px"><h1 style="margin:0 0 10px;  border: none;border-bottom: 2px solid #eaeaea;text-align: center;"><span style="padding-bottom:5px;">Registration </span> </h1><h3 style="margin-top: 30px;color: green;text-align:center;">Hey students, a huge shoutout for sharing your thoughts with us! Your feedback is awesome!  <br/>Thanks a bunch!  <br/>Gear up for the Super Brain Challenge 2025! Unleash your intellect and compete for glory. Ready to ignite your mind? <br><a href="<?php echo base_url(); ?>index.php/home/mygames">Click here</a> to start, and let the challenge begin! </label></span></div>');
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
			"rdQ1": {required: true},
			"rdQ2": {required: true},
			
			"rdQ3": {required: true},
			"rdQ4": {required: true},
			
			"rdQ5": {required: true},
			"rdQ6": {required: true},
			
			"rdQ7": {required: true},
			"rdQ8": {required: true},
			
			"rdQ9": {required: true},
			"rdQ10": {required: true}	
		},
		messages: 
		{
			"rdQ1": {required: "Please select anyone"},
			"rdQ2": {required: "Please enter anyone"},
			"rdQ3": {required: "Please enter anyone"},
			"rdQ4": {required: "Please enter anyone"},
			
			"rdQ5": {required: "Please enter anyone"},
			"rdQ6": {required: "Please enter anyone"},
			
			"rdQ7": {required: "Please enter anyone"},
			"rdQ8": {required: "Please enter anyone"},
			
			"rdQ9": {required: "This field is required"},
			"rdQ10": {required: "This field is required"}	
		},
		errorPlacement: function(error, element) 
		{
			if (element.attr("type") === "radio")
			{
				error.insertAfter(element.parent().parent().parent());
			}
			else if (element.attr("type") === "checkbox")
			{
				error.insertAfter(element.parent().parent().parent());
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

<?php 

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
<form name="frmRegister" action="" id="frmRegister" class="" method="post" enctype="multipart/form-data" >
  <div class="row">
    <div class="col-lg-12">
	<h1 style="margin:0 0 10px;  border: none;border-bottom: 2px solid #eaeaea;text-align: center;"><span style="padding-bottom:5px;">Registration Successful!!!</span> </h1>
	 </div></div>	 
	 <div class="row">
	  <div class="col-lg-12 alert alert-success" style="text-align:center;">Your registration has been successful.</div>
	  
	 </div>
	 <input type="hidden" class="form-control" name="user_name" id="uname" value="<?php echo $email; ?>">
	 <input type="hidden" class="form-control" name="User_PWD" id="pwd" value="<?php echo $org_pwd; ?>">
	 <input type="hidden" class="form-control" name="type" id="" value="ISUSER">
	 <div style="text-align: center;"><input type="button" id="btnsubmit" class="btn btn-success" value="Click here to login"></div>
	 
	
 </form>
</div>
<script>
$('#btnsubmit').click(function(){
	
	var uname = $("#uname").val();
	var pwd = $("#pwd").val();
	userlogin(uname,pwd);
	
//$.ajax({});


}); 

/* function userlogin(User_ID,User_PWD)
{} */
</script>
 
 <?php //include("footer.php"); ?>
<!-- END SIDEBAR --> 
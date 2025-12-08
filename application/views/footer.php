<footer style="display:none;">
<div class="container" id="footerpart">
<div class="row">
<div class="col-md-4 col-sm-6"><ul><li>EDSIX BRAINLAB PRIVATE LTD.<font size="6"><sup>&#174;</sup></font></li><li>Module #1, A3-01, 3rd Floor, A Block,</li><li>Phase 2, IITM Research Park,</li><li>Kanagam Road, Taramani, Chennai -113</li></ul> </div>
<div class="col-md-4 col-sm-6">
<ul>
<li class="callicon">044-66469877, +91 95695 65454</li>
<li class="msgicon"><a href="mailto:angel@skillangels.com">angel@skillangels.com</a></li>
</ul>
<div class="socialmedia">
<span>Follow us on</span>
<a href="https://www.facebook.com/skillangels" target="_blank"><img src="<?php echo base_url(); ?>assets/images/fb.png" width="33" height="33"></a> <a href="https://www.linkedin.com/company/edsix-brain-lab-pvt-ltd?trk=company_logo" target="_blank"><img src="<?php echo base_url(); ?>assets/images/icon_LinkedIn.png" width="33" height="33"></a>
</div></div>

<div class="col-md-4 col-sm-6">
<ul>
<li><a href="<?php echo base_url(); ?>">Home</a></li>
<li><a href="<?php echo base_url(); ?>index.php/home/privacypolicy" >Privacy Policy</a></li>
<!--<li><a href="faq.php" target="_blank" >FAQ</a></li>-->
</ul>
</div>
</div>
</div>
</footer>
<style>
.footer2{
background: #56595f;padding: 10px 0px;color: #fff;}</style>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script><script src="<?php echo base_url(); ?>assets/js/jquery.prettyPhoto.js"></script>
<!--<script src="js/main.js"></script>
 Sweet Alert --><script src="<?php echo base_url(); ?>assets/js/sweetalert/sweetalert2.js"></script><link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sweetalert/sweetalert2index.min.css">
<!--.......................-->
<script  type="text/javascript">
if(window==window.top) {
    // not in an iframe
// window.location.href='http://superbrainolympiad.com/';
}
</script>
<script type="text/javascript">
$(document).ready(function(e) {
$("#User_ID").keyup(function(){
	 if(event.keyCode == 13){
        $('#submit').trigger("click");
    }
});
$("#User_PWD").keyup(function(){
	if(event.keyCode == 13){
        $('#submit').trigger("click");
    }
});

$('#submit').click(function()
{
	var User_ID=$("#User_ID").val();
	var User_PWD=$("#User_PWD").val();
	$("#iddivLoading").show();
	/* Avoid Multiple Login */	
	$.ajax({
		type:"POST",
		url:"userloginchecking.php",url:"<?php echo base_url(); ?>index.php/home/userlogin",
		data:{user_name:User_ID,User_PWD:User_PWD,type:'ISUSER'},
		success:function(isloginval)
		{ 
		$("#iddivLoading").hide();
			if(isloginval==0)
			{
				userlogin(User_ID,User_PWD);
			}
			else
			{
				swal({
				  title: 'Are you sure?',
				  text: "You are logging into another system. Would you like to continue.",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, continue!',
				  cancelButtonText: 'No, cancel!',
				  confirmButtonClass: 'btn btn-success',
				  cancelButtonClass: 'btn btn-danger',
				  buttonsStyling: false
				}).then(function () {
						userlogin(User_ID,User_PWD); 
				}, function (dismiss) {
				  if (dismiss === 'cancel') {
					/* swal(
					  'Cancelled',
					  'You are continuing with your previous login :)',
					  'error'
					); */
					$(".loader").hide();
				  }
				});
			} 
		}
	});
});	
<?php if(isset($this->session->userId)){ ?>
setInterval(checkuserisactive, 1000*60*2); //300000 MS == 5 minutes
checkuserisactive();
<?php } ?>
});
function userlogin(User_ID,User_PWD)
{
	var country = "";
	var city = "";
	var region = "";
	var isp = "";
	 
	$.ajax({
	type:"POST", 	
	url:"<?php echo base_url(); ?>index.php/home/userlogin",	
	data:{user_name:User_ID,User_PWD:User_PWD,type:'ISLOGIN',txcountry:country,txcity:city,txregion:region,txisp:isp},	
	success:function(result)
	{    
	//alert(result);
		if(result=='COUNTDOWN')
		{	 			
		window.location.href="<?php echo base_url(); ?>index.php/home/countdown";
		}		
		else if(result=='REVIEW')		
		{ 			
		window.location.href="<?php echo base_url(); ?>index.php/home/review";		
		}	
		else if(result=='PROFILE')		
		{ 			
		window.location.href="<?php echo base_url(); ?>index.php/home/mygames";		
		}		
		else if(result=='ERROR')	
		{	
			$("#ErrMsg").text("Sorry..! Authentication Failed. Please Check Your User ID and Password.");	
		}	
	}	
	}); 
}

function checkuserisactive()
{
	$.ajax({
			type:"POST",
			//url:"userloginchecking.php",
			url:"<?php echo base_url(); ?>index.php/home/userlogin",
			data:{type:'ISACTIVE'},
			async:false,
			success:function(result)
			{ //alert(result);
				if(result==1)
				{ 
					//window.location.href= "index.php";
					window.location.href= "<?php echo base_url(); ?>";
				}		
			}
		});
}
</script><!-- Cookie Alert----><link href="<?php echo base_url(); ?>assets/css/cookiealert/cookiealert.css" rel="stylesheet" type="text/css" /><!-- START Bootstrap-Cookie-Alert --><div class="alert text-center cookiealert" role="alert"><b>Do you like cookies?</b> &#x1F36A; We use cookies to ensure you get the best experience on our website. <a href="<?php echo base_url(); ?>index.php/home/privacypolicy#cookie" target="_blank" >Learn more</a><button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">        I agree</button></div><script src="<?php echo base_url(); ?>assets/js/cookiealert/cookiealert.js"></script>
</body>
</html>

		  
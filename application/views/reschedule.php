<?php include_once('headerinner.php'); 
$contest_level_id=1;
$qrySlotDateList= SlotDateList($contest_level_id);
$qrySlotDateList = $conn->query($qrySlotDateList);
while($objSlotDateList =  $qrySlotDateList->fetch_assoc()){
	$SlotDateList[]=$objSlotDateList['slot_date'];
} 

?>
<?php //if($countdowntime>0){header("Location:countdown.php");} ?>
<div id="wrapper">
<div class="container">
<?php 
if($isexpired['conteststatus']==0 && $isplayed['played']==0)
{ ?>
<!--MyProfile starts here -->
	<div id="divMyProfile" class="MyProfilePager1 pageHomePagerHide Dashboardhide mygameshide myreporthide ">
			<div class="row" >
                <div class="col-lg-12">
                    <h1 class="page-header">Re-Scheduling</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
			<div id="msgFP"></div>
        		<div class="col-lg-12 profileContainer">
					<div class="col-lg-4 col-md-4">
							<div class="col-lg-12 col-md-12">
								<h3>Contest Details</h3>
								<ul>   
									<li><label>Contest Start Date</label> : <?php echo date('d-m-Y',strtotime($_SESSION["conteststartdate"])); ?></li>
									<li><label>Contest End Date </label> :  <?php echo date('d-m-Y',strtotime($_SESSION["contestenddate"])); ?></li>
								</ul>
							</div>
					</div>
					<div class="col-lg-8 col-md-8">
							<div class="col-lg-12 col-md-12">
								<form id="frmreschedule" name="frmreschedule" action="" method="post" >
								<h3>Re-Schedule</h3>
								<ul>   
									<li><label>Contest Date</label> : <label><b>12-11-2017</b></label></li>
									<li><label>Slot</label> :  
									<select class="" name="ddlTimeSlot" id="ddlTimeSlot" style="width: 180px;">
										<option value="">Select</option>
									</select>
									<label for="" generated="true"  class="error" id="timeslot"></label>
									</li>
									<li>
										<input type="button" id="btnreschedule" name="btnreschedule" value="Reschedule" class="btn btn-success" />
									</li>
								</ul>
								</form>
							</div>
					</div>

                </div>
			</div>
	</div>

<?php } else {
if($countdowntime>0){
	header("Location:countdown.php");exit;
}
else{ ?>	
	<div id="divMyProfile" class="MyProfilePager1 pageHomePagerHide Dashboardhide mygameshide myreporthide ">
		<div class="row" >
                <div class="col-lg-12">
                    <h1 class="page-header">Re-Scheduling</h1>
                </div>
                <!-- /.col-lg-12 -->
        </div>
		<div class="row">
			<div id="Errorslot">Reschedule of slot is not possible, because you already took the contest.</div>
		</div>
	</div>
<?php }} ?>
	</div>
<script type="text/javascript">
$(document).ready(function() {
contestslot();
var availableDates = [<?php $i=0;foreach($SlotDateList as $slotdate){$i++; if($i>1){echo ','; } echo '"'.$slotdate.'"';} ?>];
var d = new Date();
//d.setMonth(5);
function available(date) {
  dmy = date.getDate() + "-" +(date.getMonth()+1) + "-" + date.getFullYear();
 // alert(dmy);
  if ($.inArray(dmy, availableDates) != -1) {
    return [true, "","Available"];
  } else {
    return [false,"","unAvailable"];
  }
}
function contestslot()
{
			$.ajax({
				 url: "ajax_data.php", 
				 type:'POST',
				 data:{CType:'TS',date_slotID:'12-11-2017',contest_level_id:1},
				 success: function(result){ //alert(result);
						 if(result==0){
							$("#timeslot").html("Selected time slot is not available now, please select other.").show();
							}
						 else{ $("#timeslot").html("");
							$("#ddlTimeSlot").html(result);
						 }
				}
				});
}
contestdate = $("#txtcdate" ).datepicker({
			beforeShowDay: available,
			onSelect: function(value, ui) {
			 $.ajax({
				 url: "ajax_data.php", 
				 type:'POST',
				 data:{CType:'TS',date_slotID:$("#txtcdate").val(),contest_level_id:1},
				 success: function(result){
						 if(result==0){
							$("#timeslot").html("Selected time slot is not available now, please select other.").show();
							}
						 else{ $("#timeslot").html("");
							$("#ddlTimeSlot").html(result);
						 }
				}
				});
				},
	
			 dateFormat: 'dd-mm-yy' ,minDate: 0,maxDate:'30-11-2017',
			 defaultDate: d,
          changeMonth: false, changeYear: false
});
 $("#frmreschedule").validate({
        rules: {
            "txtcdate": {required: true},
			"ddlTimeSlot": {required: true},
        },
        messages: {
            "txtcdate": {required: "Please select contest date"},
			"txtEmail": {required: "Please select slot"},
        },
		errorPlacement: function(error, element) {
    if(element.attr("name") === "txtMobile"){
		error.insertAfter(element.parent());
	}
	else{
        error.insertAfter(element);
    }
},
	highlight: function(input) {
		$(input).addClass('error');
	} 
});

$("#btnreschedule").click(function(){
	if($("#frmreschedule").valid())
	{
		$.ajax({
			url: "rescheduleajax.php", 
			type:'POST',
			data:{CType:'RESCH',cdate:$("#txtcdate").val(),TimeSlot:$("#ddlTimeSlot").val()},
			success: function(result){ //alert(result);
				if(result==1)
				{	window.location.href="countdown.php";
					/* $("#msgFP").html('<span style="color:green">Slot resceduled successfully.</span>'); */
				}
				else if(result=='NS')
				{
					$("#msgFP").html('<span style="color:red">Sorry. Selected slot is not avable now. Try another</span>');
				}
				else if(result==0)
				{
					$("#msgFP").html('<span style="color:red">Reschedule of slot is not possible, because user already took the contest</span>');
				}
			}
		});
	}
});	
});
</script>
<style>
.profileContainer ul li label{width: 200px;}
.error{color:#bd1515;}
#Errorslot{padding:100px;text-align: center;color: #f11010;font-size: 25px;}
</style>

<link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-ui.js"></script>
  <script src="js/jquery.validate.js"></script>
  
<?php include_once('footer.php'); ?>
<!-- header starts here -->
<?php //include_once('headerinner.php'); ?>
 <!-- header End here -->
 <?php  //if($countdowntime>0){header("Location:countdown.php");} 
 $baseurl = base_url();
 ?>
 <style>
 .page-header1{
	 background: #e06565;
    margin: 10px 0;
    color: #fff;
    text-align: center;    padding: 10px;
 }
 @-webkit-keyframes glowing {
  0% { background-color: #fbfaf9; -webkit-box-shadow: 0 0 3px #000; }
  50% { background-color: #fbfaf9; -webkit-box-shadow: 0 0 40px #000; }
  100% { background-color: #fbfaf9; -webkit-box-shadow: 0 0 3px #000; }
}

@-moz-keyframes glowing {
  0% { background-color: #fbfaf9; -moz-box-shadow: 0 0 3px #000; }
  50% { background-color: #fbfaf9; -moz-box-shadow: 0 0 40px #000; }
  100% { background-color: #fbfaf9; -moz-box-shadow: 0 0 3px #000; }
}

@-o-keyframes glowing {
  0% { background-color: #fbfaf9; box-shadow: 0 0 3px #000; }
  50% { background-color: #fbfaf9; box-shadow: 0 0 40px #000; }
  100% { background-color: #fbfaf9; box-shadow: 0 0 3px #000; }
}

@keyframes glowing {
  0% { background-color: #fbfaf9; box-shadow: 0 0 3px #000; }
  50% { background-color: #fbfaf9; box-shadow: 0 0 40px #000; }
  100% { background-color: #fbfaf9; box-shadow: 0 0 3px #000; }
}

.gamepopup  {
  -webkit-animation: glowing 2000ms infinite;
  -moz-animation: glowing 2000ms infinite;
  -o-animation: glowing 2000ms infinite;
  animation: glowing 2000ms infinite;
}

 </style>
<?php 
 

$isexpired['conteststatus']=$this->session->isexpired;
 
$bgcolor=array("1"=>"MemoryGame","2"=>"VisualProcessingGame","3"=>"FocusGame","4"=>"ProblemSolvingGame","5"=>"LinguisticsGame");
$btncolor=array("1"=>"btn-success-red","2"=>"btn-success-yellow","3"=>"btn-success-green","4"=>"btn-success-orange","5"=>"btn-success-blue");
$bordercolor=array("1"=>"#f00","2"=>"#ffc000","3"=>"#92d050","4"=>"#ff6600","5"=>"#00b0f0");
?>
<div id="loadingimage"></div>
<div id="wrapper">
<!-- Coontent Start here -->
<div class="container">
	<div id="ajaxcontent" style="min-height:950px;">
		<!--My games starts here -->
		
		<!--my games ends here-->
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	fancyCall();MyGames();
});
function MyGames()
{$('#loadingimage').show();
	$.ajax({
		type: "POST", 
		url: "<?php echo base_url(); ?>index.php/home/mygames_ajax",
		data: {},
		success: function(result)
		{ //alert(result);
			 $('#loadingimage').hide();
			 $('#ajaxcontent').html(result);
			  fancyCall();
		}
	}); 
	
}
function fancyCall()
{
	$("a.gamepopup").each(function() {
	var tthis = this;
	$(this).fancybox({
	'transitionIn'    :    'elastic',
	'transitionOut'    :    'elastic',
	'speedIn'     :    600,
	'speedOut'     :    200,
	'overlayShow'    :    false,
	/*'width'  : 750,           // set the width
	'height' : 500,  */         // set the height
	'type'   : 'iframe',       // tell the script to create an iframe
	'scrolling'   : 'no',
	'idleTime': false,
	/* 'href'          : $(this).attr('data-href'), */
	'href'          : $(this).attr('data-href'),
	helpers     : { 
		overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox
	},
	keys : {
		// prevents closing when press ESC button
		close  : null
	},
	'afterClose': function ()
	{
		MyGames();			
	},
	beforeShow : function()
	{ 
		$(".fancybox-inner").addClass("fancyGameClass");
		$.ajax({
			type: "POST",
			//url: "gameajax.php",
			url: "<?php echo base_url(); ?>index.php/home/gameajax",
			data: {gameurl:$(tthis).attr('data-href')},
			success: function(result){ /* alert(result); */
				if($.trim(result)=='IA')
				{
					$.fancybox.close();
				}
			}
		});
	}
	});
});

}
</script>
<!-- Footer starts here-->
<?php //include_once('footer.php'); ?>
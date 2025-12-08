<!DOCTYPE html>

<?php
$servername = "localhost";
$username = "umuat";
$password = "umuat";
$ErrorFlag="N";
// Create connection
$conn = new mysqli($servername, $username, $password,"umuat","3306");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Data Sample 

$User_ID="39"; // default

if(isset($_GET['User_ID']))
{
$User_ID=$_GET['User_ID'];
}
$User_grade_ID="";



// User Profiles
$sql = "SELECT user_id, User_name AS User_Name,User_Grade_ID, user_contest_slot AS User_Contest_Slot, CONCAT(User_Contest_Start_Time,':00 To ',User_Contest_End_Time,':00') AS User_Contest_Time, User_Contest_Level_ID FROM Vi_Contest_User_Profile WHERE user_id=".$User_ID."";



$Profile="";
$Name="";
$UserID="";
$UserContestLevelID="";
$SlotDate="";
$SlotTime="";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

	$intRows=0;

    while($row = $result->fetch_assoc()) {
		$intRows=$intRows+1;
		$Profile=$Profile.'{"Name":"'.$row["User_Name"].'","UserID":"'.$row["user_id"].'","SlotDate":"'.$row["User_Contest_Slot"].'","SlotTime":"'.$row["User_Contest_Time"].'"}';
		$Name=$row["User_Name"];
		
		$SlotDate=$row["User_Contest_Slot"];
		$User_Grade_ID=$row["User_Grade_ID"];
		$SlotTime=$row["User_Contest_Time"];
		$UserContestLevelID=$row["User_Contest_Level_ID"];
		if ($intRows<mysqli_num_rows($result)) 
		{$Profile=$Profile.",";}
	}

} else {
  //  echo "User Skill Game Scores - Profiles (0 results)";
}


//-----------------GameDetails
$sql = "SELECT Skill_Name as Skill_Name, Skill_Description, Game_Name, Game_Description, Game_Icon_Path,Game_ID   
FROM `vi_Contest_User_Games` WHERE grade_ID=".$User_Grade_ID." and User_ID=".$User_ID."";
 
 //echo $sql;
 
 
  //FROM `vi_Contest_User_Games` WHERE grade_ID=".$User_Grade_ID."";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

	$intRows=0;

    while($row = $result->fetch_assoc()) {
		
		$intRows=$intRows+1;
		$GameDetails=$GameDetails.'{"Skill_Name":"'.$row["Skill_Name"].'","Game_Name":"'.$row["Game_Name"].'","Skill_Description":"'.$row["Skill_Description"].'","Game_Path":"'.$row["Game_Icon_Path"].'","Game_Description":"'.$row["Game_Description"].'","Game_ID":"'.$row["Game_ID"].'"}';
	    
		if ($intRows<mysqli_num_rows($result)) 
		{$GameDetails=$GameDetails.",";}
	}

} else {
  //  echo "User Skill Game Scores - GameDetails (0 results)";
}








// User Skill Game Scores - Memory
$sql = "SELECT userid, questionno,status, score,timervalue FROM Vi_UserGameScore WHERE skillid=1 and userid=".$User_ID." order by questionno";

$Mscore="";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row

	$intRows=0;

    while($row = $result->fetch_assoc()) {
		$intRows=$intRows+1;
		$Mscore=$Mscore.'{"Number":"'.$row["questionno"].'","Status":"'.$row["status"].'","Score":"'.$row["score"].'","TimerValue":"'.$row["timervalue"].'"}';
		if ($intRows<mysqli_num_rows($result)) 
		{$Mscore=$Mscore.",";}
	}

} else {
    if ($ErrorFlag == "Y") echo "0 results";
}

// User Skill Game Scores - vp
$sql = "SELECT userid, questionno,status, score,timervalue FROM Vi_UserGameScore WHERE skillid=2 and userid=".$User_ID." order by questionno";

$VPscore="";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row

	$intRows=0;

    while($row = $result->fetch_assoc()) {
		$intRows=$intRows+1;
		$VPscore=$VPscore.'{"Number":"'.$row["questionno"].'","Status":"'.$row["status"].'","Score":"'.$row["score"].'","TimerValue":"'.$row["timervalue"].'"}';
		if ($intRows<mysqli_num_rows($result)) 
		{$VPscore=$VPscore.",";}
	}

} else {
    if ($ErrorFlag == "Y") echo "0 results";
}


// User Skill Game Scores - FA
$sql = "SELECT userid, questionno,status, score,timervalue FROM Vi_UserGameScore WHERE skillid=3 and userid=".$User_ID." order by questionno";

$FAscore="";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row

	$intRows=0;

    while($row = $result->fetch_assoc()) {
		$intRows=$intRows+1;
		$FAscore=$FAscore.'{"Number":"'.$row["questionno"].'","Status":"'.$row["status"].'","Score":"'.$row["score"].'","TimerValue":"'.$row["timervalue"].'"}';
		if ($intRows<mysqli_num_rows($result)) 
		{$FAscore=$FAscore.",";}
	}

} else {
   if ($ErrorFlag == "Y") echo "0 results";
}



// User Skill Game Scores - PS
$sql = "SELECT userid, questionno,status, score,timervalue FROM Vi_UserGameScore WHERE skillid=4 and userid=".$User_ID." order by questionno";

$PSscore="";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row

	$intRows=0;

    while($row = $result->fetch_assoc()) {
		$intRows=$intRows+1;
		$PSscore=$PSscore.'{"Number":"'.$row["questionno"].'","Status":"'.$row["status"].'","Score":"'.$row["score"].'","TimerValue":"'.$row["timervalue"].'"}';
		if ($intRows<mysqli_num_rows($result)) 
		{$PSscore=$PSscore.",";}
	}

} else {
    if ($ErrorFlag == "Y") echo "0 results";
}

// User Skill Game Scores - LI
$sql = "SELECT userid, questionno,status, score,timervalue FROM Vi_UserGameScore WHERE skillid=5 and userid=".$User_ID." order by questionno";

$LIscore="";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row

	$intRows=0;

    while($row = $result->fetch_assoc()) {
		$intRows=$intRows+1;
		$LIscore=$LIscore.'{"Number":"'.$row["questionno"].'","Status":"'.$row["status"].'","Score":"'.$row["score"].'","TimerValue":"'.$row["timervalue"].'"}';
		if ($intRows<mysqli_num_rows($result)) 
		{$LIscore=$LIscore.",";}
	}

} else {
   if ($ErrorFlag == "Y") echo "0 results";
}


$conn->close();
?>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Super Brain</title>
	
	
<script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">
	<!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery-1.11.0.min.js"></script>
<script src="js/skillpiecharts.js" type="text/javascript"></script>
<script src="js/skillpiecharts-more.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="js/jquery.fancybox-media.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css" media="screen" />



<script type="text/javascript">
$('.gamepopup').fancybox({
			'transitionIn'    :    'elastic',
'transitionOut'    :    'elastic',
'speedIn'     :    600,
'speedOut'     :    200,
'overlayShow'    :    false,
'width'  : 800,           // set the width
    'height' : 600,           // set the height
    'type'   : 'iframe',       // tell the script to create an iframe
    'scrolling'   : 'no',
	'helpers': {
        'overlay': { 'closeClick': false } //Disable click outside event
    }

});	
</script>
<script type="text/javascript">
$(function () {

var score= '{ "Memory":[<?php echo $Mscore ?>]}' ;
var objMemoryPerformance=JSON.parse(score);

score= '{ "VisualProcessing":[<?php echo $VPscore ?>]}' ;
var objVPPerformance=JSON.parse(score);


score= '{ "FocusAttention":[<?php echo $FAscore ?>]}' ;
var objFAPerformance=JSON.parse(score);

score= '{ "ProblemSolving":[<?php echo $PSscore ?>]}' ;
var objPSPerformance=JSON.parse(score);

score= '{ "Linguistics":[<?php echo $LIscore ?>]}' ;
var objLIPerformance=JSON.parse(score);

MemoryAttemptedQuestions=objMemoryPerformance.Memory.length;
VPAttemptedQuestions=objVPPerformance.VisualProcessing.length;
FAAttemptedQuestions=objFAPerformance.FocusAttention.length;

PSAttemptedQuestions=objPSPerformance.ProblemSolving.length;

LIAttemptedQuestions=objLIPerformance.Linguistics.length;





var MemoryScore=10 * MemoryAttemptedQuestions;
var VisualProcessingScore=10 * VPAttemptedQuestions;

var FocusAttentionScore=10 * FAAttemptedQuestions;
var ProblemSolvingScore=10 * PSAttemptedQuestions;
var LinguisticsScore=10 * LIAttemptedQuestions;

/* 
for (var i = 0; i < objMemoryPerformance.Memory.length; i++)
{
	
 
   if(objMemoryPerformance.Memory[i].Score != '')
   MemoryScore+=parseFloat(objMemoryPerformance.Memory[i].Score);
}

for (var i = 0; i < objVPPerformance.VisualProcessing.length; i++)
{
if(objVPPerformance.VisualProcessing[i].Score != '')
VisualProcessingScore+=parseFloat(objVPPerformance.VisualProcessing[i].Score);
}

for (var i = 0; i < objFAPerformance.FocusAttention.length; i++)
{
if(objFAPerformance.FocusAttention[i].Score != '')
FocusAttentionScore+=parseFloat(objFAPerformance.FocusAttention[i].Score);
}


for (var i = 0; i < objPSPerformance.ProblemSolving.length; i++)
{
if(objPSPerformance.ProblemSolving[i].Score != '')
ProblemSolvingScore+=parseFloat(objPSPerformance.ProblemSolving[i].Score);
}

for (var i = 0; i < objLIPerformance.Linguistics.length; i++)
{
if(objLIPerformance.Linguistics[i].Score != '')
LinguisticsScore+=parseFloat(objLIPerformance.Linguistics[i].Score);
}

 */



    $('#container').highcharts({
        chart: {
            polar: true,
			events: {
            load: function(event) {
               $("text").html('');
			   $(".highcharts-legend-item").hide();
			   $(".highcharts-button").hide();
            }
        } 
        },

        title: {
            text: ''
        },

        pane: {
            startAngle: 0,
            endAngle: 360
        },
		       
        xAxis: {
            tickInterval: 45,
            min: 0,
            max: 360,
            labels: {
                formatter: function () {
                    return '';
                }
            }
        },

        yAxis: {
            min: 0,
			max:100
        },

        plotOptions: {
            series: {
                pointStart: 0,
                pointInterval: 72
            },
            column: {
                pointPadding: 0,
                groupPadding: 0
            }
        },

        series: [{
            type: 'column',
            name: 'Percentage completed',
            data: [MemoryScore, VisualProcessingScore, FocusAttentionScore, ProblemSolvingScore, LinguisticsScore],
            pointPlacement: 'between',
			tooltip: {
                valueSuffix: ' %'
            }
        }]
    });
});

</script>
	
	
	
	
	
	
	
	
	
	
	
	
<script>
// game jSON data structure with initialization with database game data
// code by mr.Jagadeesh ON 20151002 //
// AUTHOR : Mr.Govee.

angular.module('Dashboard', []).controller('Stars', function($scope) {

// Game Performance Data Structure and initialization 


 $scope.MemoryColor=[
{classApply:'memoryColor',content:'',Totaltip:''},
{classApply:'memoryColor',content:'',Totaltip:''},
{classApply:'memoryColor',content:'',Totaltip:''},
{classApply:'memoryColor',content:'',Totaltip:''},
{classApply:'memoryColor',content:'',Totaltip:''},
{classApply:'memoryColor',content:'',Totaltip:''},
{classApply:'memoryColor',content:'',Totaltip:''},
{classApply:'memoryColor',content:'',Totaltip:''},
{classApply:'memoryColor',content:'',Totaltip:''},
{classApply:'memoryColor',content:'',Totaltip:''}
];	



	
$scope.vpColor=[
{classApply:'VPColor',content:'',Totaltip:''},
{classApply:'VPColor',content:'',Totaltip:''},
{classApply:'VPColor',content:'',Totaltip:''},
{classApply:'VPColor',content:'',Totaltip:''},
{classApply:'VPColor',content:'',Totaltip:''},
{classApply:'VPColor',content:'',Totaltip:''},
{classApply:'VPColor',content:'',Totaltip:''},
{classApply:'VPColor',content:'',Totaltip:''},
{classApply:'',content:'x',Totaltip:''},
{classApply:'',content:'x',Totaltip:''}
];		
	
$scope.faColor=	[
{classApply:'FAColor',content:'',Totaltip:''},
{classApply:'FAColor',content:'',Totaltip:''},
{classApply:'FAColor',content:'',Totaltip:''},
{classApply:'FAColor',content:'',Totaltip:''},
{classApply:'',content:'x',Totaltip:''},
{classApply:'',content:'x',Totaltip:''},
{classApply:'FAColor',content:'',Totaltip:''},
{classApply:'FAColor',content:'',Totaltip:''},
{classApply:'FAColor',content:'',Totaltip:''},
{classApply:'FAColor',content:'',Totaltip:''}
];

$scope.psColor=	[
{classApply:'PSColor',content:'',Totaltip:''},
{classApply:'PSColor',content:'',Totaltip:''},
{classApply:'PSColor',content:'',Totaltip:''},
{classApply:'PSColor',content:'',Totaltip:''},
{classApply:'PSColor',content:'',Totaltip:''},
{classApply:'PSColor',content:'',Totaltip:''},
{classApply:'PSColor',content:'',Totaltip:''},
{classApply:'',content:'x',Totaltip:''},
{classApply:'',content:'x',Totaltip:''},
{classApply:'PSColor',content:'',Totaltip:''}
];


$scope.liColor=	[
{classApply:'LIColor',content:'',Totaltip:''},
{classApply:'LIColor',content:'',Totaltip:''},
{classApply:'LIColor',content:'',Totaltip:''},
{classApply:'LIColor',content:'',Totaltip:''},
{classApply:'LIColor',content:'',Totaltip:''},
{classApply:'LIColor',content:'',Totaltip:''},
{classApply:'LIColor',content:'',Totaltip:''},
{classApply:'LIColor',content:'',Totaltip:''},
{classApply:'LIColor',content:'',Totaltip:''},
{classApply:'LIColor',content:'',Totaltip:''}
];

var score= '{ "Memory":[<?php echo $Mscore ?>]}' ;
var objMemoryPerformance=JSON.parse(score);

score= '{ "VisualProcessing":[<?php echo $VPscore ?>]}' ;
var objVPPerformance=JSON.parse(score);


score= '{ "FocusAttention":[<?php echo $FAscore ?>]}' ;
var objFAPerformance=JSON.parse(score);

score= '{ "ProblemSolving":[<?php echo $PSscore ?>]}' ;
var objPSPerformance=JSON.parse(score);



score= '{ "Linguistics":[<?php echo $LIscore ?>]}' ;
var objLIPerformance=JSON.parse(score);

score= '{ "Linguistics":[<?php echo $LIscore ?>]}' ;
$scope.ContestDate =  '<?php echo $SlotDate ?>'  //StudentDetails[0].ContestDate;
$scope.ContestSlot =  '<?php echo $SlotTime ?>' //StudentDetails[0].ContestSlot;
$scope.UserID =  '<?php echo $User_ID ?>'
$scope.UserContestLevelID ='<?php echo $UserContestLevelID ?>'

var GameDetailsData= '{ "GameDetails":[<?php echo $GameDetails ?>]}' ;
var objGameDetails=JSON.parse(GameDetailsData);

//alert(' Game details '+objGameDetails.GameDetails.length);
//for (i=0;i<objGameDetails.GameDetails.length; i++)
//alert(objGameDetails.GameDetails[i].Skill_Name);

$scope.MMGameType= objGameDetails.GameDetails[0].Skill_Name;
$scope.MMGameImage= objGameDetails.GameDetails[0].Game_Path;
$scope.MMGameName= objGameDetails.GameDetails[0].Game_Name;
$scope.MMSkillDescription= objGameDetails.GameDetails[0].Skill_Description;
$scope.MMGameDescription= objGameDetails.GameDetails[0].Game_Description;
$scope.MMGame_ID= objGameDetails.GameDetails[0].Game_ID;



//alert(' Game details '+objGameDetails.GameDetails[0].Skill_Name);

$scope.VPGameType= objGameDetails.GameDetails[1].Skill_Name;
$scope.VPGameImage= objGameDetails.GameDetails[1].Game_Path;
$scope.VPGameName= objGameDetails.GameDetails[1].Game_Name;
$scope.VPSkillDescription= objGameDetails.GameDetails[1].Skill_Description;
$scope.VPGameDescription= objGameDetails.GameDetails[1].Game_Description;
$scope.VPGame_ID= objGameDetails.GameDetails[1].Game_ID;
//alert(' Game details '+objGameDetails.GameDetails[1].Skill_Name);

 
$scope.FAGameType= objGameDetails.GameDetails[2].Skill_Name; 
$scope.FAGameImage= objGameDetails.GameDetails[2].Game_Path;
$scope.FAGameName= objGameDetails.GameDetails[2].Game_Name;

$scope.FASkillDescription= objGameDetails.GameDetails[2].Skill_Description;
$scope.FAGameDescription= objGameDetails.GameDetails[2].Game_Description;
$scope.FAGame_ID= objGameDetails.GameDetails[2].Game_ID;
//alert(' Game details '+objGameDetails.GameDetails[2].Skill_Name);

$scope.PSGameType= objGameDetails.GameDetails[3].Skill_Name;
$scope.PSGameImage= objGameDetails.GameDetails[3].Game_Path;
$scope.PSGameName= objGameDetails.GameDetails[3].Game_Name;
//$scope.PSGamePath= Games[3].Path;
$scope.PSSkillDescription= objGameDetails.GameDetails[3].Skill_Description;
$scope.PSGameDescription= objGameDetails.GameDetails[3].Game_Description;
$scope.PSGame_ID= objGameDetails.GameDetails[3].Game_ID;
//alert(' Game details '+objGameDetails.GameDetails[3].Skill_Name);


$scope.LIGameType= objGameDetails.GameDetails[4].Skill_Name;
$scope.LIGameImage= objGameDetails.GameDetails[4].Game_Path;
$scope.LIGameName= objGameDetails.GameDetails[4].Game_Name;
$scope.LISkillDescription= objGameDetails.GameDetails[4].Skill_Description;
$scope.LIGameDescription= objGameDetails.GameDetails[4].Game_Description; 
$scope.LIGame_ID= objGameDetails.GameDetails[4].Game_ID;

//alert('objMemoryPerformance '+objMemoryPerformance.Memory.length+'objVPPerformance '+objVPPerformance.VisualProcessing.length+'objFAPerformance '+objFAPerformance.FocusAttention.length+'objPSPerformance '+objPSPerformance.ProblemSolving.length+'objLIPerformance '+objLIPerformance.Linguistics.length);	


var MemoryScore= 0;
var VisualProcessingScore= 0;
var FocusandAttentionScore= 0;
var ProblemSolvingScore= 0;
var LinguisticsScore= 0;	
	
$scope.MemoryPlayStatus="MColor-border";	
$scope.VPPlayStatus="VPColor-border";
$scope.FAPlayStatus="FAColor-border";
$scope.PSPlayStatus="PSColor-border";
$scope.LIPlayStatus="LIColor-border";

if (objMemoryPerformance.Memory.length>0) $scope.MemoryPlayStatus="MColor";
if (objVPPerformance.VisualProcessing.length>0) $scope.VPPlayStatus="VPColor";
if (objFAPerformance.FocusAttention.length>0) $scope.FAPlayStatus="FAColor";

if (objPSPerformance.ProblemSolving.length>0) $scope.PSPlayStatus="PSColor";
if (objLIPerformance.Linguistics.length>0) $scope.LIPlayStatus="LIColor";
	
// Facilitate to play starts here
	
var MTotalQuestions=10;
var MAttemptedQuestions= 0;
if (objMemoryPerformance.Memory.length<=10) MAttemptedQuestions=objMemoryPerformance.Memory.length;
else MAttemptedQuestions=10;

var MCorrectQuestions=0;

var VPTotalQuestions=10;
var VPAttemptedQuestions=0;
if (objVPPerformance.VisualProcessing.length<=10) VPAttemptedQuestions=objVPPerformance.VisualProcessing.length;
else VPAttemptedQuestions=10;
  
var VPCorrectQuestions=0;

var FATotalQuestions=10;
var FAAttemptedQuestions= 0;
if  (objFAPerformance.FocusAttention.length<=10) FAAttemptedQuestions=objFAPerformance.FocusAttention.length;
else FAAttemptedQuestions=10;

var FACorrectQuestions=0;

var PSTotalQuestions=10;
var PSAttemptedQuestions=0;
if  (objPSPerformance.ProblemSolving.length<=10) PSAttemptedQuestions=objPSPerformance.ProblemSolving.length;
else PSAttemptedQuestions=10;

var PSCorrectQuestions=0;

var LITotalQuestions=10;
var LIAttemptedQuestions=0;
if ( objLIPerformance.Linguistics.length<=10)LIAttemptedQuestions=objLIPerformance.Linguistics.length;
else LIAttemptedQuestions=10;

var LICorrectQuestions=0;


if (MTotalQuestions==MAttemptedQuestions)
{
	$scope.MGamePlayStatus="Completed";
	$scope.MGamePlayStatusIcon="statusCompletedIcon";
	$scope.MGamePlayLink="javascript:;";
}
 if (MTotalQuestions>MAttemptedQuestions)
{
	$scope.MGamePlayStatus="In-complete";
	$scope.MGamePlayStatusIcon="statusInCompletedIcon";
	$scope.MGamePlayLink="playgame.php?"+"user_id="+$scope.UserID+"&skill_id=1&game_id="+$scope.MMGame_ID+"&contest_lid="+$scope.UserContestLevelID;
}
 if (MAttemptedQuestions===0)
{
	$scope.MGamePlayStatus="Yet to Play";
	$scope.MGamePlayStatusIcon="statusNotPlayIcon";
	$scope.MGamePlayLink="playgame.php?"+"user_id="+$scope.UserID+"&skill_id=1&game_id="+$scope.MMGame_ID+"&contest_lid="+$scope.UserContestLevelID;
}

if (objMemoryPerformance.Memory.length>0)
{
if((objMemoryPerformance.Memory[objMemoryPerformance.Memory.length-1].TimerValue==0))
{

	$scope.MGamePlayLink="javascript:;";
}
}



var BalanceTime=180;

if (objMemoryPerformance.Memory.length>0)
{

 for (i=0;i<objMemoryPerformance.Memory.length;i++)
 {
  if (objMemoryPerformance.Memory[i].TimerValue<BalanceTime)
	  BalanceTime=objMemoryPerformance.Memory[i].TimerValue;
   }
	
var totalquestion=10-objMemoryPerformance.Memory.length;

if ((objMemoryPerformance.Memory.length!=10))
{
if (BalanceTime>0) 
{
$scope.MPlaytooltipstatus="Questions Left "+ totalquestion + " Time Left "+ BalanceTime; 	

}

}
else
{
	$scope.MGamePlayLink="javascript:;";
	$scope.MPlaytooltipstatus="Game play Completed";
}
if (BalanceTime==0)
{
	$scope.MGamePlayLink="javascript:;";
	$scope.MPlaytooltipstatus="Time Over";
}
}
else
{
	$scope.MPlaytooltipstatus="Start";
}

//--------------------------------------VisualProcessing tooltip for playnow------------------------------------------------------------


var BalanceTime=180;

if (objVPPerformance.VisualProcessing.length>0)
{

 for (i=0;i<objVPPerformance.VisualProcessing.length;i++)
 {
  if (objVPPerformance.VisualProcessing[i].TimerValue<BalanceTime)
	  BalanceTime=objVPPerformance.VisualProcessing[i].TimerValue;
   }
	


if ((objVPPerformance.VisualProcessing.length!=10))
{
if (BalanceTime>0) 
var totalquestion=10-objVPPerformance.VisualProcessing.length;	

{
$scope.VPPlaytooltipstatus="Questions Left "+  totalquestion   + " Time Left "+ BalanceTime; 	

}

}
else
{
	$scope.VPGamePlayLink="javascript:;";
	$scope.VPPlaytooltipstatus="Game play Completed";
}
if (BalanceTime==0)
{
	$scope.VPGamePlayLink="javascript:;";
	$scope.VPPlaytooltipstatus="Time Over";
}
}
else
{
	$scope.VPPlaytooltipstatus="Start";
}

//-------------------------------------------------------------------------------------------------------------

var BalanceTime=180;

if (objFAPerformance.FocusAttention.length>0)
{

 for (i=0;i<objFAPerformance.FocusAttention.length;i++)
 {
  if (objFAPerformance.FocusAttention[i].TimerValue<BalanceTime)
	  BalanceTime=objFAPerformance.FocusAttention[i].TimerValue;
   }
	


if ((objFAPerformance.FocusAttention.length!=10))
{
if (BalanceTime>0) 
var totalquestion=10-objFAPerformance.FocusAttention.length;	

{
$scope.FAPlaytooltipstatus="Questions Left "+  totalquestion   + " Time Left "+ BalanceTime; 	

}

}
else
{
	$scope.FAGamePlayLink="javascript:;";
	$scope.FAPlaytooltipstatus="Game play Completed";
}
if (BalanceTime==0)
{
	$scope.FAGamePlayLink="javascript:;";
	$scope.FAPlaytooltipstatus="Time Over";
}
}
else
{
	$scope.FAPlaytooltipstatus="Start";
}


//-----------------------------------------ProblemSolving tooltip for playnow-----------------------------------------------


var BalanceTime=180;

if (objPSPerformance.ProblemSolving.length>0)
{

 for (i=0;i<objPSPerformance.ProblemSolving.length;i++)
 {
  if (objPSPerformance.ProblemSolving[i].TimerValue<BalanceTime)
	  BalanceTime=objPSPerformance.ProblemSolving[i].TimerValue;
   }
	


if ((objPSPerformance.ProblemSolving.length!=10))
{
if (BalanceTime>0) 
var totalquestion=10-objPSPerformance.ProblemSolving.length;	

{
$scope.PSPlaytooltipstatus="Questions Left "+  totalquestion   + " Time Left "+ BalanceTime; 	

}

}
else
{
	$scope.PSGamePlayLink="javascript:;";
	$scope.PSPlaytooltipstatus="Game Completed";
}
if (BalanceTime==0)
{
	$scope.PSGamePlayLink="javascript:;";
	$scope.PSPlaytooltipstatus="Time Over";
}
}
else
{
	$scope.PSPlaytooltipstatus="Start";
}
//----------------------------------------------------------------------------------



var BalanceTime=180;

if (objLIPerformance.Linguistics.length>0)
{

 for (i=0;i<objLIPerformance.Linguistics.length;i++)
 {
  if (objLIPerformance.Linguistics[i].TimerValue<BalanceTime)
	  BalanceTime=objLIPerformance.Linguistics[i].TimerValue;
   }
	


if ((objLIPerformance.Linguistics.length!=10))
{
if (BalanceTime>0) 
var totalquestion=10-objLIPerformance.Linguistics.length;	

{
$scope.LIPlaytooltipstatus="Questions Left "+  totalquestion   + " Time Left "+ BalanceTime; 	

}

}
else
{
	$scope.LIGamePlayLink="javascript:;";
	$scope.LIPlaytooltipstatus="Game Completed";
}
if (BalanceTime==0)
{
	$scope.LIGamePlayLink="javascript:;";
	$scope.LIPlaytooltipstatus="Time Over";
}
}
else
{
	$scope.LIPlaytooltipstatus="Start";
}

















if (VPTotalQuestions==VPAttemptedQuestions)
{
	$scope.VPGamePlayStatus="Completed";
	$scope.VPGamePlayStatusIcon="statusCompletedIcon";
	$scope.VPGamePlayLink="javascript:;";
	
}
 if (VPTotalQuestions>VPAttemptedQuestions)
{
	$scope.VPGamePlayStatus="In-complete";
	$scope.VPGamePlayStatusIcon="statusInCompletedIcon";
	$scope.VPGamePlayLink="playgame.php?"+"user_id="+$scope.UserID+"&skill_id=2&game_id="+$scope.VPGame_ID+"&contest_lid="+$scope.UserContestLevelID;
}
 if (VPAttemptedQuestions===0)
{
	$scope.VPGamePlayStatus="Yet to Play";
	$scope.VPGamePlayStatusIcon="statusNotPlayIcon";
	$scope.VPGamePlayLink="playgame.php?"+"user_id="+$scope.UserID+"&skill_id=2&game_id="+$scope.VPGame_ID+"&contest_lid="+$scope.UserContestLevelID;
	
}

i/* f (objVPPerformance.VisualProcessing.length>0)
{
if((objVPPerformance.VisualProcessing[objVPPerformance.VisualProcessing.length-1].TimerValue==0))
{

	$scope.VPGamePlayLink="javascript:;";
}
} */



if (FATotalQuestions==FAAttemptedQuestions)
{
	$scope.FAGamePlayStatus="Completed";
	$scope.FAGamePlayStatusIcon="statusCompletedIcon";
	$scope.FAGamePlayLink="javascript:;";
	
}
 if (FATotalQuestions>FAAttemptedQuestions)
{
	$scope.FAGamePlayStatus="In-complete";
	$scope.FAGamePlayStatusIcon="statusInCompletedIcon";
	$scope.FAGamePlayLink="playgame.php?"+"user_id="+$scope.UserID+"&skill_id=3&game_id="+$scope.FAGame_ID+"&contest_lid="+$scope.UserContestLevelID;
}
 if (FAAttemptedQuestions===0)
{
	$scope.FAGamePlayStatus="Yet to Play";
	$scope.FAGamePlayStatusIcon="statusNotPlayIcon";
	$scope.FAGamePlayLink="playgame.php?"+"user_id="+$scope.UserID+"&skill_id=3&game_id="+$scope.FAGame_ID+"&contest_lid="+$scope.UserContestLevelID;
	
}

/* if (objFAPerformance.FocusAttention.length>0)
{
if((objFAPerformance.Focus[objFAPerformance.FocusAttention.length-1].TimerValue==0))
{
	
	$scope.FAGamePlayLink="javascript:;";
}
} */


	

if (PSTotalQuestions==PSAttemptedQuestions)
{
	$scope.PSGamePlayStatus="Completed";
	$scope.PSGamePlayStatusIcon="statusCompletedIcon";
	$scope.PSGamePlayLink="javascript:;";
	
}
 if (PSTotalQuestions>PSAttemptedQuestions)
{
	$scope.PSGamePlayStatus="In-complete";
	$scope.PSGamePlayStatusIcon="statusInCompletedIcon";
	$scope.PSGamePlayLink="playgame.php?"+"user_id="+$scope.UserID+"&skill_id=4&game_id="+$scope.PSGame_ID+"&contest_lid="+$scope.UserContestLevelID;
}
 if (PSAttemptedQuestions===0)
{
	$scope.PSGamePlayStatus="Yet to Play";
	$scope.PSGamePlayStatusIcon="statusNotPlayIcon";
	$scope.PSGamePlayLink="playgame.php?"+"user_id="+$scope.UserID+"&skill_id=4&game_id="+$scope.PSGame_ID+"&contest_lid="+$scope.UserContestLevelID;
	
}
/* if (objPSPerformance.ProblemSolving.length>0)
{
if((objPSPerformance.Focus[objPSPerformance.ProblemSolving.length-1].TimerValue==0))
{
	
	$scope.PSGamePlayLink="javascript:;";
}
} */



if (LITotalQuestions==LIAttemptedQuestions)
{
	$scope.LIGamePlayStatus="Completed";
	$scope.LIGamePlayStatusIcon="statusCompletedIcon";
	$scope.LIGamePlayLink="javascript:;";
	
}
 if (LITotalQuestions>LIAttemptedQuestions)
{
	$scope.LIGamePlayStatus="In-complete";
	$scope.LIGamePlayStatusIcon="statusInCompletedIcon";
	$scope.LIGamePlayLink="playgame.php?"+"user_id="+$scope.UserID+"&skill_id=5&game_id="+$scope.LIGame_ID+"&contest_lid="+$scope.UserContestLevelID;
}
 if (LIAttemptedQuestions===0)
{
	$scope.LIGamePlayStatus="Yet to Play";
	$scope.LIGamePlayStatusIcon="statusNotPlayIcon";
	$scope.LIGamePlayLink="playgame.php?"+"user_id="+$scope.UserID+"&skill_id=5&game_id="+$scope.LIGame_ID+"&contest_lid="+$scope.UserContestLevelID;
	
}

/* if (objLIPerformance.Linguistics.length>0)
{
if((objLIPerformance.Focus[objLIPerformance.Linguistics.length-1].TimerValue==0))
{
	
	$scope.LIGamePlayLink="javascript:;";
}
}
 */



// Facilitate to play ends here


	
	// Game performance starts here.
	
for (var i = 0; i < 10; i++)
  {
		$scope.MemoryColor[i].classApply='';
		$scope.MemoryColor[i].content='';
  }	
 //alert( objMemoryPerformance.Memory.length);
//alert('objMemoryPerformance.Memory starts here'+objMemoryPerformance.Memory.length);

for (var i = 0; i < objMemoryPerformance.Memory.length; i++)
{
	  //---To Calculate Score-----
	//alert('objMemoryPerformance.Memory starts here'+i);
 
	  if(objMemoryPerformance.Memory[i].Score != '')
   MemoryScore+=parseFloat(objMemoryPerformance.Memory[i].Score);

//-------- GamePerformance Memory Status
$scope.MemoryColor[i].classApply='';
$scope.MemoryColor[i].content='';
$scope.MemoryColor[i].Totaltip=objMemoryPerformance.Memory[i].Score ;
if(objMemoryPerformance.Memory[i].Status == 'Correct')

	$scope.MemoryColor[i].classApply='memoryColor';

//--------In-Correct--------
if(objMemoryPerformance.Memory[i].Status == 'In-correct')
{	

	$scope.MemoryColor[i].content='x';
	
  }
  //--------Un-attended-- Blank------	
if(objMemoryPerformance.Memory[i].Status == 'Un-attended')
{	
	$scope.MemoryColor[i].content='';
		
 }
if (i===9)
{
	break;
}
 }

 //-----------------------------------------VisualProcessing
 for (var i = 0; i < 10; i++)
  {
		$scope.vpColor[i].classApply='';
		$scope.vpColor[i].content='';
  }
 for (var i = 0; i < objVPPerformance.VisualProcessing.length; i++)
  {
	  //---To Calculate Score-----
	 
	  if(objVPPerformance.VisualProcessing[i].Score != '')
   VisualProcessingScore+=parseFloat(objVPPerformance.VisualProcessing[i].Score);

//-------- GamePerformance Memory Status
$scope.vpColor[i].classApply='';
$scope.vpColor[i].content='';
$scope.vpColor[i].Totaltip=objVPPerformance.VisualProcessing[i].Score;

if(objVPPerformance.VisualProcessing[i].Status == 'Correct')

	$scope.vpColor[i].classApply='VPColor';

//--------In-Correct--------
if(objVPPerformance.VisualProcessing[i].Status == 'In-correct')
{	

	$scope.vpColor[i].content='x';
	
  }
  //--------Un-attended-- Blank------	
if(objVPPerformance.VisualProcessing[i].Status == 'Un-attended')
{	
	$scope.vpColor[i].content='';
		
 }
 if (i===9)
{
	break;
}
  }
 
 //-----------------------------------------------------------FocusAttention-------------------------
	
 FocusandAttentionScore=0;
 for (var i = 0; i < 10; i++)
  {
		$scope.faColor[i].classApply='';
		$scope.faColor[i].content='';
  }
 for (var i = 0; i < objFAPerformance.FocusAttention.length; i++)
  {
	  //---To Calculate Score-----
	 
	  if(objFAPerformance.FocusAttention[i].Score != '')
   FocusandAttentionScore+=parseFloat(objFAPerformance.FocusAttention[i].Score);

//-------- GamePerformance faColor Status
$scope.faColor[i].classApply='';
$scope.faColor[i].content='';
$scope.faColor[i].Totaltip=objFAPerformance.FocusAttention[i].Score;
if(objFAPerformance.FocusAttention[i].Status == 'Correct')

	$scope.faColor[i].classApply='FAColor';

//--------In-Correct--------
if(objFAPerformance.FocusAttention[i].Status == 'In-correct')
{	

	$scope.faColor[i].content='x';
	
  }
  //--------Un-attended-- Blank------	
if(objFAPerformance.FocusAttention[i].Status == 'Un-attended')
{	
	$scope.faColor[i].content='';
		
 }
 if (i===9)
{
	break;
}
  } 
//alert(FocusandAttentionScore); 
//----------------------------------------------objPSPerformance
 for (var i = 0; i < 10; i++)
  {
		$scope.psColor[i].classApply='';
		$scope.psColor[i].content='';
  }	
 for (var i = 0; i < objPSPerformance.ProblemSolving.length; i++)
  {
	  //---To Calculate Score-----
	 
	  if(objPSPerformance.ProblemSolving[i].Score != '')
   ProblemSolvingScore+=parseFloat(objPSPerformance.ProblemSolving[i].Score);

//-------- GamePerformance faColor Status
$scope.psColor[i].classApply='';
$scope.psColor[i].content='';
$scope.psColor[i].Totaltip=objPSPerformance.ProblemSolving[i].Score;
if(objPSPerformance.ProblemSolving[i].Status == 'Correct')

	$scope.psColor[i].classApply='PSColor';

//--------In-Correct--------
if(objPSPerformance.ProblemSolving[i].Status == 'In-correct')
{	

	$scope.psColor[i].content='x';
	
  }
  //--------Un-attended-- Blank------	
if(objPSPerformance.ProblemSolving[i].Status == 'Un-attended')
{	
	$scope.psColor[i].content='';
		
 }
 if (i===9)
{
	break;
}
  } 
//--------------------------------------------------------objLIPerformance


 for (var i = 0; i < 10; i++)
  {
		$scope.liColor[i].classApply='';
		$scope.liColor[i].content='';
  }
for (var i = 0; i < objLIPerformance.Linguistics.length; i++)
  {
	  //---To Calculate Score-----
	 
	  if(objLIPerformance.Linguistics[i].Score != '')
   LinguisticsScore+=parseFloat(objLIPerformance.Linguistics[i].Score);


//-------- GamePerformance liColor Status
$scope.liColor[i].classApply='';
$scope.liColor[i].content='';
$scope.liColor[i].Totaltip=objLIPerformance.Linguistics[i].Score;
if(objLIPerformance.Linguistics[i].Status == 'Correct')

	$scope.liColor[i].classApply='LIColor';

//--------In-Correct--------
if(objLIPerformance.Linguistics[i].Status == 'In-correct')
{	

	$scope.liColor[i].content='x';
	
  }
  //--------Un-attended-- Blank------	
if(objLIPerformance.Linguistics[i].Status == 'Un-attended')
{	
	$scope.liColor[i].content='';
		
 }
 if (i===9)
{
	break;
}
  } 
 
 
// student details Data Structure 

$scope.starsWon=0;

var VisualProcessingStars=[
{
"Star1":"NoStar",
"Star2":"NoStar",
"Star3":"NoStar",
"Star4":"NoStar",
"Star5":"NoStar",
"Star6":"NoStar",
"Star7":"NoStar",
"Star8":"NoStar",
"Star9":"NoStar",
"Star10":"NoStar"
}
]

if(VisualProcessingScore>0 ) {VisualProcessingStars[0].Star1="VPStar1";$scope.starsWon=$scope.starsWon+1}
if(VisualProcessingScore>10) {VisualProcessingStars[0].Star2="VPStar1";$scope.starsWon=$scope.starsWon+1}
if(VisualProcessingScore>20) {VisualProcessingStars[0].Star3="VPStar1";$scope.starsWon=$scope.starsWon+1}
if(VisualProcessingScore>30 ) {VisualProcessingStars[0].Star4="VPStar1";$scope.starsWon=$scope.starsWon+1}
if(VisualProcessingScore>40 ) {VisualProcessingStars[0].Star5="VPStar1";$scope.starsWon=$scope.starsWon+1}
if(VisualProcessingScore>50 ) {VisualProcessingStars[0].Star6="VPStar1";$scope.starsWon=$scope.starsWon+1}
if(VisualProcessingScore>60 ) {VisualProcessingStars[0].Star7="VPStar1";$scope.starsWon=$scope.starsWon+1}
if(VisualProcessingScore>70 ) {VisualProcessingStars[0].Star8="VPStar1";$scope.starsWon=$scope.starsWon+1}
if(VisualProcessingScore>80 ) {VisualProcessingStars[0].Star9="VPStar1";$scope.starsWon=$scope.starsWon+1}
if(VisualProcessingScore>90 ) {VisualProcessingStars[0].Star10="VPStar1";$scope.starsWon=$scope.starsWon+1}



var MemoryStars=[
{
"Star1":"NoStar",
"Star2":"NoStar",
"Star3":"NoStar",
"Star4":"NoStar",
"Star5":"NoStar",
"Star6":"NoStar",
"Star7":"NoStar",
"Star8":"NoStar",
"Star9":"NoStar",
"Star10":"NoStar"
}
]

if(MemoryScore>0 ) {MemoryStars[0].Star1="memoryStar";$scope.starsWon=$scope.starsWon+1}
if(MemoryScore>10) {MemoryStars[0].Star2="memoryStar";$scope.starsWon=$scope.starsWon+1}
if(MemoryScore>20) {MemoryStars[0].Star3="memoryStar";$scope.starsWon=$scope.starsWon+1}
if(MemoryScore>30 ) {MemoryStars[0].Star4="memoryStar";$scope.starsWon=$scope.starsWon+1}
if(MemoryScore>40 ) {MemoryStars[0].Star5="memoryStar";$scope.starsWon=$scope.starsWon+1}
if(MemoryScore>50 ) {MemoryStars[0].Star6="memoryStar";$scope.starsWon=$scope.starsWon+1}
if(MemoryScore>60 ) {MemoryStars[0].Star7="memoryStar";$scope.starsWon=$scope.starsWon+1}
if(MemoryScore>70 ) {MemoryStars[0].Star8="memoryStar";$scope.starsWon=$scope.starsWon+1}
if(MemoryScore>80 ) {MemoryStars[0].Star9="memoryStar";$scope.starsWon=$scope.starsWon+1}
if(MemoryScore>90 ) {MemoryStars[0].Star10="memoryStar";$scope.starsWon=$scope.starsWon+1}



var FocusandAttentionStars=[
{
"Star1":"NoStar",
"Star2":"NoStar",
"Star3":"NoStar",
"Star4":"NoStar",
"Star5":"NoStar",
"Star6":"NoStar",
"Star7":"NoStar",
"Star8":"NoStar",
"Star9":"NoStar",
"Star10":"NoStar"
}
]
if(FocusandAttentionScore>0 ) {FocusandAttentionStars[0].Star1="FAStar1";$scope.starsWon=$scope.starsWon+1}
if(FocusandAttentionScore>10) {FocusandAttentionStars[0].Star2="FAStar1";$scope.starsWon=$scope.starsWon+1}
if(FocusandAttentionScore>20) {FocusandAttentionStars[0].Star3="FAStar1";$scope.starsWon=$scope.starsWon+1}
if(FocusandAttentionScore>30 ) {FocusandAttentionStars[0].Star4="FAStar1";$scope.starsWon=$scope.starsWon+1}
if(FocusandAttentionScore>40 ) {FocusandAttentionStars[0].Star5="FAStar1";$scope.starsWon=$scope.starsWon+1}
if(FocusandAttentionScore>50 ) {FocusandAttentionStars[0].Star6="FAStar1";$scope.starsWon=$scope.starsWon+1}
if(FocusandAttentionScore>60 ) {FocusandAttentionStars[0].Star7="FAStar1";$scope.starsWon=$scope.starsWon+1}
if(FocusandAttentionScore>70 ) {FocusandAttentionStars[0].Star8="FAStar1";$scope.starsWon=$scope.starsWon+1}
if(FocusandAttentionScore>80 ) {FocusandAttentionStars[0].Star9="FAStar1";$scope.starsWon=$scope.starsWon+1}
if(FocusandAttentionScore>90 ) {FocusandAttentionStars[0].Star10="FAStar1";$scope.starsWon=$scope.starsWon+1}




var ProblemSolvingStars=[
{
"Star1":"NoStar",
"Star2":"NoStar",
"Star3":"NoStar",
"Star4":"NoStar",
"Star5":"NoStar",
"Star6":"NoStar",
"Star7":"NoStar",
"Star8":"NoStar",
"Star9":"NoStar",
"Star10":"NoStar"
}
]
if(ProblemSolvingScore>0 ) {ProblemSolvingStars[0].Star1="PSStar1";$scope.starsWon=$scope.starsWon+1}
if(ProblemSolvingScore>10) {ProblemSolvingStars[0].Star2="PSStar1";$scope.starsWon=$scope.starsWon+1}
if(ProblemSolvingScore>20) {ProblemSolvingStars[0].Star3="PSStar1";$scope.starsWon=$scope.starsWon+1}
if(ProblemSolvingScore>30 ) {ProblemSolvingStars[0].Star4="PSStar1";$scope.starsWon=$scope.starsWon+1}
if(ProblemSolvingScore>40 ) {ProblemSolvingStars[0].Star5="PSStar1";$scope.starsWon=$scope.starsWon+1}
if(ProblemSolvingScore>50 ) {ProblemSolvingStars[0].Star6="PSStar1";$scope.starsWon=$scope.starsWon+1}
if(ProblemSolvingScore>60 ) {ProblemSolvingStars[0].Star7="PSStar1";$scope.starsWon=$scope.starsWon+1}
if(ProblemSolvingScore>70 ) {ProblemSolvingStars[0].Star8="PSStar1";$scope.starsWon=$scope.starsWon+1}
if(ProblemSolvingScore>80 ) {ProblemSolvingStars[0].Star9="PSStar1";$scope.starsWon=$scope.starsWon+1}
if(ProblemSolvingScore>90 ) {ProblemSolvingStars[0].Star10="PSStar1";$scope.starsWon=$scope.starsWon+1}



var LinguisticsStars=[
{
"Star1":"NoStar",
"Star2":"NoStar",
"Star3":"NoStar",
"Star4":"NoStar",
"Star5":"NoStar",
"Star6":"NoStar",
"Star7":"NoStar",
"Star8":"NoStar",
"Star9":"NoStar",
"Star10":"NoStar"
}
]
if(LinguisticsScore>0 ) {LinguisticsStars[0].Star1="linguisticsStar1";$scope.starsWon=$scope.starsWon+1}
if(LinguisticsScore>10) {LinguisticsStars[0].Star2="linguisticsStar1";$scope.starsWon=$scope.starsWon+1}
if(LinguisticsScore>20) {LinguisticsStars[0].Star3="linguisticsStar1";$scope.starsWon=$scope.starsWon+1}
if(LinguisticsScore>30 ) {LinguisticsStars[0].Star4="linguisticsStar1";$scope.starsWon=$scope.starsWon+1}
if(LinguisticsScore>40 ) {LinguisticsStars[0].Star5="linguisticsStar1";$scope.starsWon=$scope.starsWon+1}
if(LinguisticsScore>50 ) {LinguisticsStars[0].Star6="linguisticsStar1";$scope.starsWon=$scope.starsWon+1}
if(LinguisticsScore>60 ) {LinguisticsStars[0].Star7="linguisticsStar1";$scope.starsWon=$scope.starsWon+1}
if(LinguisticsScore>70 ) {LinguisticsStars[0].Star8="linguisticsStar1";$scope.starsWon=$scope.starsWon+1}
if(LinguisticsScore>80 ) {LinguisticsStars[0].Star9="linguisticsStar1";$scope.starsWon=$scope.starsWon+1}
if(LinguisticsScore>90 ) {LinguisticsStars[0].Star10="linguisticsStar1";$scope.starsWon=$scope.starsWon+1}


//alert('M '+MemoryScore+'VP '+VisualProcessingScore+'FA '+FocusandAttentionScore+'PS '+ProblemSolvingScore+'LI '+LinguisticsScore);



//alert(' Game details '+objGameDetails.GameDetails[3].Skill_Name);

//alert('Memory stars 10 '+MemoryScore+'VP '+VisualProcessingScore+'FA '+FocusandAttentionScore+'PS '+ProblemSolvingScore+'LI '+LinguisticsScore);

    $scope.memoryStars= [
       {classApply: MemoryStars[0].Star1},
{classApply: MemoryStars[0].Star2},
{classApply: MemoryStars[0].Star3},
{classApply: MemoryStars[0].Star4},
{classApply: MemoryStars[0].Star5},
{classApply: MemoryStars[0].Star6},
{classApply: MemoryStars[0].Star7},
{classApply: MemoryStars[0].Star8},
{classApply: MemoryStars[0].Star9},
{classApply: MemoryStars[0].Star10}
    ];
	

$scope.vpStar= [
       {classApply:VisualProcessingStars[0].Star1},
{classApply:VisualProcessingStars[0].Star2},
{classApply:VisualProcessingStars[0].Star3},
{classApply:VisualProcessingStars[0].Star4},
{classApply:VisualProcessingStars[0].Star5},
{classApply:VisualProcessingStars[0].Star6},
{classApply:VisualProcessingStars[0].Star7},
{classApply:VisualProcessingStars[0].Star8},
{classApply:VisualProcessingStars[0].Star9},
{classApply:VisualProcessingStars[0].Star10}
    ];


$scope.faStar= [
       {classApply:FocusandAttentionStars[0].Star1},
{classApply:FocusandAttentionStars[0].Star2},
{classApply:FocusandAttentionStars[0].Star3},
{classApply:FocusandAttentionStars[0].Star4},
{classApply:FocusandAttentionStars[0].Star5},
{classApply:FocusandAttentionStars[0].Star6},
{classApply:FocusandAttentionStars[0].Star7},
{classApply:FocusandAttentionStars[0].Star7},
{classApply:FocusandAttentionStars[0].Star7},
{classApply:FocusandAttentionStars[0].Star7}
    ];
	
	$scope.psStar= [
       {classApply:ProblemSolvingStars[0].Star1},
{classApply:ProblemSolvingStars[0].Star2},
{classApply:ProblemSolvingStars[0].Star3},
{classApply:ProblemSolvingStars[0].Star4},
{classApply:ProblemSolvingStars[0].Star5},
{classApply:ProblemSolvingStars[0].Star6},
{classApply:ProblemSolvingStars[0].Star7},
{classApply:ProblemSolvingStars[0].Star8},
{classApply:ProblemSolvingStars[0].Star9},
{classApply:ProblemSolvingStars[0].Star10}
    ];
$scope.liStar= [
{classApply:LinguisticsStars[0].Star1},
{classApply:LinguisticsStars[0].Star2},
{classApply:LinguisticsStars[0].Star3},
{classApply:LinguisticsStars[0].Star4},
{classApply:LinguisticsStars[0].Star5},
{classApply:LinguisticsStars[0].Star6},
{classApply:LinguisticsStars[0].Star7},
{classApply:LinguisticsStars[0].Star8},
{classApply:LinguisticsStars[0].Star9},
{classApply:LinguisticsStars[0].Star10}
];
	


	
//---------------------------
	
//alert('end M '+MemoryScore+'VP '+VisualProcessingScore+'FA '+FocusandAttentionScore+'PS '+ProblemSolvingScore+'LI '+LinguisticsScore);


});

</script>	
	
</head>

<body ng-app="Dashboard" ng-controller="Stars">

<!--- -----------------------  header starts here ---->
 <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
<div class="pageheader">           
		   <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand navbar-brand1" href="index.html"><img src="images/logo.png" width="141" height="116" alt="logo"></a>
            </div>
            <!-- /.navbar-header -->
			<span class="topHead">Welcome to Super Brain Contest</span>
            <ul class="nav navbar-top-links navbar-right rightSideButton">
            	
            	<a href="myprofile.html"><button type="button" class="btn btn-primary">Edit Account</button></a>
                <button type="button" class="btn btn-primary">Logout</button>
            </ul>
			</div>
			<div class="pagemenu">
		   <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebarProfile" ng-controller="Stars">
                        	<button type="button"  class="btn btn-default btn-circle editBtn"><i class="fa fa-edit"></i></button>
                        	<img src="images/Parrot_logo_wink2.png" width="150" height="150" class="img-circle">
                            <h2 ><?php echo $Name ?></h2>
                        </li>
                        <li>
                            <a href="index.php?User_ID=<?php echo $User_ID ?>">Dashboard<i class="fa fa-th-large fa-fw"></i></a>
                        </li>
                        <li>
                            <a href="mygames.php?User_ID=<?php echo $User_ID ?>">My Games<i class="fa fa-gamepad fa-fw"></i></a>
                        </li>
                        <li>
                            <a href="myreports.php?User_ID=<?php echo $User_ID ?>">My Reports<i class="fa fa-table fa-fw"></i></a>
                        </li>
                        <li>
                            <a href="myprofile.php?User_ID=<?php echo $User_ID ?>">My Profiles<i class="fa fa-edit fa-fw"></i></a>
                        </li>
                    </ul>
                     <ul class="side-skill">
                            	<li>Memory (M)<span class="performanceMemory"></span></li>
                                <li>Visual Processing (VP)<span class="performanceVP"></span></li>
                                <li>Focus and Attention (FA)<span class="performanceFA"></span></li>
                                <li>Problem Solving (PS)<span class="performancePS"></span></li>
                                <li>Linguistics (LI)<span class="performanceLinguistics"></span></li>
                            </ul>
                </div>
             
            </div>	
			  </div>	
		
</nav>
 <!--------------  header ends here ------------------------------------------------------->
 
<div class="pagehome">
              <div class="row">
      			<div class="col-lg-12 landingContainer">
        			<div class="col-lg-4">
                    	<img class="landingIcon" src="images/HomeGameIcon.png" width="123" height="123" alt="# Games">
                    	<div class="landingPageBox homeGameContainer">
                   		  <h4># Games</h4>
                       	  <p>5 Brain Games to complete</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                    	<img class="landingIcon" src="images/HomeQuestionsIcon.png" width="123" height="123" alt="# Questions">
                    	<div class="landingPageBox homeQuestionContainer">
                    		<h4># Questions</h4>
                        	<p>10 questions in Each Brain Game</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                            <img class="landingIcon" src="images/HomeGame-ScoresIcon.png" width="123" height="123" alt="Game Scores">
                    	<div class="landingPageBox homeGamescoreContainer">
                    		<h4>Game Scores</h4>
                        	<p>Speed & Accuracy decide your Scores</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                            <img class="landingIcon" src="images/HomeReportsIcon.png" width="123" height="123" alt="# Reports">
                    	<div class="landingPageBox homeReportContainer">
                    		<h4># Reports</h4>
                        	<p>Know your BSPI in "My Reports"</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                            <img class="landingIcon" src="images/HomeTime-DurationIcon.png" width="123" height="123" alt="Time Duration for Games">
                    	<div class="landingPageBox homeTimeContainer">
                    		<h4>Time Duration for Games</h4>
                        	<p>Each game has a time limit. Finish before the Timer goes off!</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                            <img class="landingIcon" src="images/HomeGamePlayIcon.png" width="123" height="123" alt="Game Play">
                    	<div class="landingPageBox homePlayContainer">
                    		<h4>Game Play</h4>
                        	<p>Each Game challenge can be taken only once</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                            <img class="landingIcon" src="images/HomeTime-SlotIcon.png" width="123" height="123" alt="Time Slot">
                    	<div class="landingPageBox timeSlotContainer">
                    		<h4>Time Slot</h4>
                        	<p>You have to  complete all the 5 games within the time slot</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                            <img class="landingIcon" src="images/HomeHow-to-PlayIcon.png" width="123" height="123" alt="How to Play?">
                    	<div class="landingPageBox homeHowtoplayContainer">
                    		<h4>How to Play?</h4>
                        	<p>Read the instructions before you begin to play each game</p>
                        </div>
                    </div>
      			</div>
 			</div>

</div>

 <!------------------------- Footer starts here------------------------------------------->

	 <div class="footer pagefooter">
    	<div class="row">
        	<div class="col-lg-6">
    			Copyright © 2015 Skill Angels. All rights reserved.
            </div>
            <div class="col-lg-6 footerLinks">
    			<ul>
                	<li><a href="javascript:;">Contact Us</a><span>|</span></li>
                    <li><a href="javascript:;">Terms of Services</a><span>|</span></li>
                    <li><a href="javascript:;">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
	<!------------------------ footer ends here ------------------------------------------> 
    <!-- /#wrapper -->
	<!-- jQuery -->
      <script src="js/bootstrap.min.js"></script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/sb-admin-2.js"></script>
	 <script src="js/jquery-ui.js"></script>
	  <script>
  $(function() {
    $( document ).tooltip();
    
  });
  </script>
 
 
 
 
 
 
</body>
</html>
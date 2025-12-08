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
// User Profiles
$sql = "SELECT user_id, User_name AS User_Name,User_Grade_ID, user_contest_slot AS User_Contest_Slot, CONCAT(User_Contest_Start_Time,':00 To ',User_Contest_End_Time,':00') AS User_Contest_Time, User_Contest_Level_ID FROM Vi_Contest_User_Profile WHERE user_id=".$User_ID."";



$Profile="";
$Name="";
$UserID="";
$SlotDate="";
$SlotTime="";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

	$intRows=0;

    while($row = $result->fetch_assoc()) {
		$intRows=$intRows+1;
		$Profile=$Profile.'{"Name":"'.$row["User_Name"].'","User_ID":"'.$row["user_id"].'","SlotDate":"'.$row["User_Contest_Slot"].'","SlotTime":"'.$row["User_Contest_Time"].'"}';
		$Name=$row["User_Name"];
		$UserID=$row["user_id"];
		$SlotDate=$row["User_Contest_Slot"];
		$User_Grade_ID=$row["User_Grade_ID"];
		$SlotTime=$row["User_Contest_Time"];
		$UserContestLevelID=$row["User_Contest_Level_ID"];
		
		if ($intRows<mysqli_num_rows($result)) 
		{$Profile=$Profile.",";}
	}

} else {
     if ($ErrorFlag == "Y") echo "0 results".$sql."<br>";
}

//-----------------GameDetails

$sql = "SELECT Skill_Name as Skill_Name, Skill_Description, Game_Name, Game_Description, Game_Icon_Path,Game_ID   
FROM `vi_Contest_User_Games` WHERE grade_ID=".$User_Grade_ID." and User_ID=".$User_ID."";
 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

	$intRows=0;

    while($row = $result->fetch_assoc()) {
		
		$intRows=$intRows+1;
		$GameDetails=$GameDetails.'{"Skill_Name":"'.$row["Skill_Name"].'","Game_Name":"'.$row["Game_Name"].'","Skill_Description":"'.$row["Skill_Description"].'","Game_Description":"'.$row["Game_Description"].'","Game_Path":"'.$row["Game_Icon_Path"].'","Game_ID":"'.$row["Game_ID"].'"}';   
	    
		if ($intRows<mysqli_num_rows($result)) 
		{$GameDetails=$GameDetails.",";}
	}

} else {
   if ($ErrorFlag == "Y") echo "0 results - Contest_User_Games".$sql."<br>";
}

//echo GameDetails;




// User Skill Game Scores - Memory
/* $sql = "SELECT userid, questionno,status, score,timervalue FROM Vi_UserGameScore WHERE skillid=1 and userid=".$User_ID." order by questionno"; */

$sql = "SELECT userid, questionno,status, score,timervalue FROM Vi_UserGameScore WHERE skillid=1 and userid=".$User_ID." order by timervalue desc ";
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
   if ($ErrorFlag == "Y") echo "0 results - UserGameScore skill 1".$sql."<br>";
}

// User Skill Game Scores - vp
/* $sql = "SELECT userid, questionno,status, score,timervalue FROM Vi_UserGameScore WHERE skillid=2 and userid=".$User_ID." order by questionno"; */

$sql = "SELECT userid, questionno,status, score,timervalue FROM Vi_UserGameScore WHERE skillid=2 and userid=".$User_ID." order by timervalue desc";
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
  if ($ErrorFlag == "Y")  echo "0 results - UserGameScore skill 2".$sql."<br>";
}


 // User Skill Game Scores - FA
/* $sql = "SELECT userid, questionno,status, score,timervalue FROM Vi_UserGameScore WHERE skillid=3 and userid=".$User_ID." order by questionno"; */

 $sql = "SELECT userid, questionno,status, score,timervalue FROM Vi_UserGameScore WHERE skillid=3 and userid=".$User_ID." order by timervalue desc";
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
   if ($ErrorFlag == "Y") echo "0 results - UserGameScore skill 3".$sql."<br>";
} 
 


// User Skill Game Scores - PS
/* $sql = "SELECT userid, questionno,status, score,timervalue FROM Vi_UserGameScore WHERE skillid=4 and userid=".$User_ID." order by questionno"; */

$sql = "SELECT userid, questionno,status, score,timervalue FROM Vi_UserGameScore WHERE skillid=4 and userid=".$User_ID." order by timervalue desc";
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
   if ($ErrorFlag == "Y") echo "0 results - UserGameScore skill 4".$sql."<br>";
}

// User Skill Game Scores - LI
/* $sql = "SELECT userid, questionno,status, score,timervalue FROM Vi_UserGameScore WHERE skillid=5 and userid=".$User_ID." order by questionno"; */

$sql = "SELECT userid, questionno,status, score,timervalue FROM Vi_UserGameScore WHERE skillid=5 and userid=".$User_ID." order by timervalue desc";
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
   if ($ErrorFlag == "Y") echo "0 results - UserGameScore skill 5".$sql."<br>";
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
	<link href="css/jquery-ui.css" rel="stylesheet">
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
    'height' : 400,           // set the height
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

//alert(objMemoryPerformance.Memory.length);
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
            data: [MemoryScore, VisualProcessingScore, 0, ProblemSolvingScore, LinguisticsScore],
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

angular.module('Mygames', []).controller('GameDetails', function($scope) {

// Game Performance Data Structure and initialization 
var ErrorFlag="N";

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

if (ErrorFlag=="Y")  alert('pass till initialization of game performence');

var score= '{ "Memory":[<?php echo $Mscore ?>]}' ;
var objMemoryPerformance=JSON.parse(score);

score= '{ "VisualProcessing":[<?php echo $VPscore ?>]}' ;
var objVPPerformance=JSON.parse(score);


score= '{ "FocusAttention":[<?php echo $FAscore ?>]}' ;
var objFAPerformance=JSON.parse(score); 

score= '{ "ProblemSolving":[<?php echo $PSscore ?>]}' ;
var objPSPerformance=JSON.parse(score);



score= '{ "Linguistics":[<?php echo $LIscore ?>]}' ;
$scope.ContestDate =  '<?php echo $SlotDate ?>'  //StudentDetails[0].ContestDate;
$scope.ContestSlot =  '<?php echo $SlotTime ?>' //StudentDetails[0].ContestSlot;
$scope.UserID =  '<?php echo $User_ID ?>'
$scope.UserContestLevelID ='<?php echo $UserContestLevelID ?>'

var objLIPerformance=JSON.parse(score);

var GameDetailsData= '{ "GameDetails":[<?php echo $GameDetails ?>]}' ;
var objGameDetails=JSON.parse(GameDetailsData);

//for (i=0;i<objGameDetails.GameDetails.length; i++)
//alert(objGameDetails.GameDetails[i].Skill_Name);
$scope.MMGameType= objGameDetails.GameDetails[0].Skill_Name;
$scope.MMGameImage= objGameDetails.GameDetails[0].Game_Path;
$scope.MMGameName= objGameDetails.GameDetails[0].Game_Name;
$scope.MMGame_ID= objGameDetails.GameDetails[0].Game_ID;
$scope.MMSkillDescription= objGameDetails.GameDetails[0].Skill_Description;
$scope.MMGameDescription= objGameDetails.GameDetails[0].Game_Description;
 
 $scope.VPGameType= objGameDetails.GameDetails[1].Skill_Name;
$scope.VPGameImage= objGameDetails.GameDetails[1].Game_Path;
$scope.VPGameName= objGameDetails.GameDetails[1].Game_Name;
$scope.VPGame_ID= objGameDetails.GameDetails[1].Game_ID;
$scope.VPSkillDescription= objGameDetails.GameDetails[1].Skill_Description;
$scope.VPGameDescription= objGameDetails.GameDetails[1].Game_Description;

 
 $scope.FAGameType= objGameDetails.GameDetails[2].Skill_Name; 
$scope.FAGameImage= objGameDetails.GameDetails[2].Game_Path;
$scope.FAGameName= objGameDetails.GameDetails[2].Game_Name;
$scope.FAGame_ID= objGameDetails.GameDetails[2].Game_ID;
$scope.FASkillDescription= objGameDetails.GameDetails[2].Skill_Description;
$scope.FAGameDescription= objGameDetails.GameDetails[2].Game_Description; 


$scope.PSGameType= objGameDetails.GameDetails[3].Skill_Name;
$scope.PSGameImage= objGameDetails.GameDetails[3].Game_Path;
$scope.PSGameName= objGameDetails.GameDetails[3].Game_Name;
$scope.PSGame_ID= objGameDetails.GameDetails[3].Game_ID;
$scope.PSSkillDescription= objGameDetails.GameDetails[3].Skill_Description;
$scope.PSGameDescription= objGameDetails.GameDetails[3].Game_Description;


$scope.LIGameType= objGameDetails.GameDetails[4].Skill_Name;
$scope.LIGameImage= objGameDetails.GameDetails[4].Game_Path;
$scope.LIGameName= objGameDetails.GameDetails[4].Game_Name;
$scope.LIGame_ID= objGameDetails.GameDetails[4].Game_ID;
$scope.LISkillDescription= objGameDetails.GameDetails[4].Skill_Description;
$scope.LIGameDescription= objGameDetails.GameDetails[4].Game_Description; 


if (ErrorFlag=="Y") alert('pass till initialization of skill name assignment');

// game play status

	


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

if (ErrorFlag=="Y") alert('pass till initialization of game play status');
// Facilitate to play starts here
	
var MTotalQuestions=10;
var MAttemptedQuestions= 0;
if (objMemoryPerformance.Memory.length<=10) MAttemptedQuestions=objMemoryPerformance.Memory.length;
else MAttemptedQuestions= 10;
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

if (ErrorFlag=="Y") alert('pass till initialization of AttemptedQuestions');

if ((MTotalQuestions==MAttemptedQuestions))
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



if (ErrorFlag=="Y") alert('pass till initialization of Game Play Link memory status');


var BalanceTime=180;

if (objMemoryPerformance.Memory.length>0)
{

BalanceTime=objMemoryPerformance.Memory[objMemoryPerformance.Memory.length-1].TimerValue;	

var totalquestion=10-objMemoryPerformance.Memory.length;

if ((objMemoryPerformance.Memory.length<10))
{
if (BalanceTime>0) 
{
$scope.MPlaytooltipstatus="Questions Left "+ totalquestion + " Time Left "+ BalanceTime; 	

}
else
{
	$scope.MGamePlayLink="javascript:;";
	$scope.MPlaytooltipstatus="Time Over";
}
}
else
{
	$scope.MGamePlayLink="javascript:;";
	$scope.MPlaytooltipstatus="Game play Completed";
}

}
else
{
	$scope.MPlaytooltipstatus="Start";
}

//--------------------------------------VisualProcessing tooltip for playnow------------------------------------------------------------
if (ErrorFlag=="Y") alert('pass till initialization of VP Game Play Link memory status');

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
if (ErrorFlag=="Y") alert('pass till initialization of Game Play Link VP status');
//-------------------------------------------------------------------------------------------------------------
if (ErrorFlag=="Y") alert('pass till initialization of FA Game Play Link memory status');
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
if (ErrorFlag=="Y") alert('pass till initialization of Game Play Link FA status'); 

//-----------------------------------------ProblemSolving tooltip for playnow-----------------------------------------------

if (ErrorFlag=="Y") alert('pass till initialization of PS Game Play Link memory status');
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
if (ErrorFlag=="Y") alert('pass till initialization of Game Play Link PS status');
//----------------------------------------------------------------------------------

if (ErrorFlag=="Y") alert('pass till initialization of LI Game Play Link memory status');

var BalanceTime=180;

if (objLIPerformance.Linguistics.length>0)
{

 for (i=0;i<objLIPerformance.Linguistics.length;i++)
 {
  if (objLIPerformance.ProblemSolving[i].TimerValue<BalanceTime)
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
if (ErrorFlag=="Y") alert('pass till initialization of Game Play Link LI status');

//----------------------------------------------------------
if (ErrorFlag=="Y") alert('pass till initialization of VP AttemptedQuestions');
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


if (objVPPerformance.VisualProcessing.length>0)
{
if((objVPPerformance.VisualProcessing[objVPPerformance.VisualProcessing.length-1].TimerValue==0))
{

	$scope.VPGamePlayLink="javascript:;";
}
}
//--------------------------------------FA ISSUSE------------------------------------------
 if (ErrorFlag=="Y") alert('pass till initialization of FA AttemptedQuestions');
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
}
  */
//----------------------------------------------------------------------------------------------------
	
if (ErrorFlag=="Y") alert('pass till initialization of  PS AttemptedQuestions');
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


if (objPSPerformance.ProblemSolving.length>0)
{
if((objPSPerformance.Focus[objPSPerformance.ProblemSolving.length-1].TimerValue==0))
{
	
	$scope.PSGamePlayLink="javascript:;";
}
}


if (ErrorFlag=="Y") alert('pass till initialization of LI AttemptedQuestions');

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

if (objLIPerformance.Linguistics.length>0)
{
if((objLIPerformance.Focus[objLIPerformance.Linguistics.length-1].TimerValue==0))
{
	
	$scope.LIGamePlayLink="javascript:;";
}
}
// Facilitate to play ends here

// Game performance starts here

for (var i = 0; i < 10; i++)
  {
		$scope.MemoryColor[i].classApply='';
		$scope.MemoryColor[i].content='';
  }	
	
for (var i = 0; i < objMemoryPerformance.Memory.length; i++)
  {
	  //---To Calculate Score-----
	 
	  if(objMemoryPerformance.Memory[i].Score != '')
   MemoryScore+=parseFloat(objMemoryPerformance.Memory[i].Score);

//-------- GamePerformance Memory Status
$scope.MemoryColor[i].classApply='';
$scope.MemoryColor[i].content='';
$scope.MemoryColor[i].Totaltip=objMemoryPerformance.Memory[i].Score ;


if(objMemoryPerformance.Memory[i].Status == 'Correct')
{
	$scope.MemoryColor[i].classApply='memoryColor';
	MCorrectQuestions=MCorrectQuestions+1;}
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
  
  
  
 
  if (ErrorFlag=="Y") alert('pass till assigment of game performance scores ');



 //-----------------------------------------VisualProcessing
 
 if (ErrorFlag=="Y") alert('pass till initialization of VP AttemptedQuestions');
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
$scope.vpColor[i].Totaltip=objVPPerformance.VisualProcessing[i].Score ;

if(objVPPerformance.VisualProcessing[i].Status == 'Correct')
{
	$scope.vpColor[i].classApply='VPColor';
	VPCorrectQuestions=VPCorrectQuestions+1;
}
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
 if (ErrorFlag=="Y") alert('pass till initialization of FA AttemptedQuestions');
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
$scope.faColor[i].Totaltip=objFAPerformance.FocusAttention[i].Score ;
if(objFAPerformance.FocusAttention[i].Status == 'Correct')
{
	$scope.faColor[i].classApply='FAColor';
FACorrectQuestions=FACorrectQuestions+1;}
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

if (ErrorFlag=="Y") alert('pass till initialization of PS AttemptedQuestions');
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
{
	$scope.psColor[i].classApply='PSColor';
	PSCorrectQuestions=PSCorrectQuestions+1;}

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
if (ErrorFlag=="Y") alert('pass till initialization of LI AttemptedQuestions');
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
{
	$scope.liColor[i].classApply='LIColor';
LICorrectQuestions=LICorrectQuestions+1;}
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




//alert('stars begins');

 

 
 

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




//$scope.StudentName= '<?php echo $Name ?>';
//$scope.StudentImage= StudentDetails[0].Image;

//'{"Skill_Name":"'.$row["Skill_Name"].'","Game_Name":"'.$row["Game_Name"].'","Skill_Description":"'.$row["Skill_Description"].'","Game_Description":"'.$row["Game_Description"].'"}';




//alert('Game performence begins');

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
{classApply:FocusandAttentionStars[0].Star8},
{classApply:FocusandAttentionStars[0].Star9},
{classApply:FocusandAttentionStars[0].Star10}
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
	
//alert('Score begins');
$scope.MemoryTotalScore=MemoryScore;
$scope.VisualProcessingTotalScore=VisualProcessingScore;
 $scope.FocusandAttentionTotalScore=FocusandAttentionScore; 
$scope.ProblemSolvingTotalScore=ProblemSolvingScore;
$scope.LinguisticsTotalScore=LinguisticsScore;	

$scope.MTotalQuestions=MTotalQuestions;
$scope.MAttemptedQuestions=MAttemptedQuestions;
$scope.MCorrectQuestions="00";

$scope.VPTotalQuestions=VPTotalQuestions;
$scope.VPAttemptedQuestions=VPAttemptedQuestions;

//alert(VPAttemptedQuestions);
//alert('test scope'+$scope.VPAttemptedQuestions);

$scope.VPCorrectQuestions=VPCorrectQuestions;
  
   $scope.FATotalQuestions=FATotalQuestions;
 $scope.FAAttemptedQuestions=FAAttemptedQuestions;
  $scope.FACorrectQuestions=FACorrectQuestions;  
  
 $scope.PSTotalQuestions=PSTotalQuestions;
 $scope.PSAttemptedQuestions=PSAttemptedQuestions;
$scope.PSCorrectQuestions=PSCorrectQuestions; 

  
 $scope.LITotalQuestions=LITotalQuestions;
 $scope.LIAttemptedQuestions=LIAttemptedQuestions;
$scope.LICorrectQuestions=LICorrectQuestions;

// Attempted questions Handling decimals 

if ((MAttemptedQuestions+'').length < 2) 
	$scope.MAttemptedQuestions="0"+MAttemptedQuestions ;
else
	$scope.MAttemptedQuestions=MAttemptedQuestions;

if ((VPAttemptedQuestions+'').length < 2) 
	$scope.VPAttemptedQuestions="0"+VPAttemptedQuestions ;
else
	$scope.VPAttemptedQuestions=VPAttemptedQuestions;

 if ((FAAttemptedQuestions+'').length < 2) 
	$scope.FAAttemptedQuestions="0"+FAAttemptedQuestions ;
else
	$scope.FAAttemptedQuestions=FAAttemptedQuestions; 

if ((PSAttemptedQuestions+'').length < 2) 
	$scope.PSAttemptedQuestions="0"+PSAttemptedQuestions ;
else
	$scope.PSAttemptedQuestions=PSAttemptedQuestions;

if ((LIAttemptedQuestions+'').length < 2) 
	$scope.LIAttemptedQuestions="0"+LIAttemptedQuestions ;
else
	$scope.LIAttemptedQuestions=LIAttemptedQuestions;

// correct questions decimal handling

if ((MCorrectQuestions+'').length < 2) 
	$scope.MCorrectQuestions="0"+MCorrectQuestions ;
else
	$scope.MCorrectQuestions=MCorrectQuestions;

if ((VPCorrectQuestions+'').length < 2) 
	$scope.VPCorrectQuestions="0"+VPCorrectQuestions ;
else
	$scope.VPCorrectQuestions=VPCorrectQuestions;
 if ((FACorrectQuestions+'').length < 2) 
	$scope.FACorrectQuestions="0"+FACorrectQuestions ;
else
	$scope.FACorrectQuestions=FACorrectQuestions; 
if ((PSCorrectQuestions+'').length < 2) 
	$scope.PSCorrectQuestions="0"+PSCorrectQuestions ;
else
	$scope.PSCorrectQuestions=PSCorrectQuestions;

if ((LICorrectQuestions+'').length < 2) 
	$scope.LICorrectQuestions="0"+LICorrectQuestions ;
else
	$scope.LICorrectQuestions=LICorrectQuestions;


//alert($scope.MGamePlayLink);




//alert('ContestDate begins');
 //$scope.starsWon = VisualProcessingScore + MemoryScore + FocusandAttentionScore + ProblemSolvingScore + LinguisticsScore;
	
});

</script>		
	
	
	
	
	
	
	
	
	
	
	
</head>

<body  ng-app="Mygames" ng-controller="GameDetails">

    <div id="wrapper" class="myGamesWrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
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
            	
            	<button type="button" class="btn btn-primary">Edit Account</button>
                <button type="button" class="btn btn-primary">Logout</button>
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebarProfile">
                        	<button type="button" class="btn btn-default btn-circle editBtn"><i class="fa fa-edit"></i></button>
                        	<img src="images/Parrot_logo_wink2.png" width="150" height="150" class="img-circle">
                            <h2><?php echo $Name ?><h2>
                        </li>
                        <li>
                            <a href="index.php?User_ID={{UserID}}">My Dashboard<i class="fa fa-th-large fa-fw"></i></a>
                        </li>
                        <li>
                            <a class="active1" href="mygames.php?User_ID={{UserID}}">My Games<i class="fa fa-gamepad fa-fw"></i></a>
                        </li>
                        <li>
                            <a href="myreports.php?User_ID={{UserID}}">My Reports<i class="fa fa-table fa-fw"></i></a>
                        </li>
                        <li>
                            <a href="myprofile.php?User_ID={{UserID}}">My Profiles<i class="fa fa-edit fa-fw"></i></a>
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
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">My Games</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
      			<div class="col-lg-12">
        				<div class="contentbox">
        					<div class="gamesList">
                			<div class="gameBox MemoryGame">
                				<h3 title="{{MMSkillDescription}}">{{MMGameType}}</h3>
                				<img src="images/{{MMGameImage}}" alt="{{MMGameImage}}">
           	    				<h4 title="{{MMGameDescription}}">{{MMGameName}}</h4>
                    			<a class="gamepopup viewMoreBtn" href="{{MGamePlayLink}}" title="{{MPlaytooltipstatus}}">Play Now</a>
                                <a class="howToPlayBtn" href="javascript:;" title="{{MMGameDescription}}">How to Play?</a>
                			</div>
                            <div class="gameStatusContainer">
                            	<ul>
                                	<li><p>Total Questions</p><span>{{MTotalQuestions}}</span></li>
     <li><p>Attempted</p><span>{{MAttemptedQuestions}}</span></li>
                                    <li><p>Correct</p><span>{{MCorrectQuestions}}</span></li>
                                    <li class="gameStatusBtn" title="{{MGamePlayStatus}}">Status<br><a class="btn btn-success-red" href="javascript:;"><span class="{{MGamePlayStatusIcon}}"></span>{{MGamePlayStatus}} </a></li> 
                                </ul>
                            </div>
                             <h4 class="score-head">Score</h4>
                            <div class="gamePercentageMemory">
                           
                	<span class="memory{{MemoryTotalScore}}">{{MemoryTotalScore}}%</span>
                </div>
                            <div class="earnedStars">
                           	  <ul>
  <li ng-repeat="x in memoryStars">
  <span class="{{ x.classApply}}"></span></li>
</ul>
                            </div>
           				  	</div>
            				<div class="gamesList">
                			<div class="gameBox VisualProcessingGame">
                            	<h3 title="{{VPSkillDescription}}">{{VPGameType}}</h3>
                				<img src="images/{{VPGameImage}}" alt="Visual Processing">
                				<h4 title="{{VPGameDescription}}">{{VPGameName}}</h4>
                    			<a class="gamepopup viewMoreBtn" href="{{VPGamePlayLink}}" title="{{VPPlaytooltipstatus}}">Play Now</a>
                                <a class="howToPlayBtn" href="javascript:;" title="{{VPGameDescription}}">How to Play?</a>
                			</div>
                            <div class="gameStatusContainer">
                            	<ul>
                                	<li><p>Total Questions</p><span>{{VPTotalQuestions}}</span></li>
                                    <li><p>Attempted</p><span>{{VPAttemptedQuestions}}</span></li>
                                    <li><p>Correct</p><span>{{VPCorrectQuestions}}</span></li>
                                    <li class="gameStatusBtn disableGameStatus" title="{{VPGamePlayStatus}}">Status<br><a class="btn btn-success-yellow" href="javascript:;"><span class="{{VPGamePlayStatusIcon}}"></span>{{VPGamePlayStatus}} </a></li>
                                </ul>
                            </div>
								
	
                               <h4 class="score-head">Score</h4>
                            <div class="gamePercentageVP">
                    <span class="VP{{VisualProcessingTotalScore}}">{{VisualProcessingTotalScore}}%</span>
                </div>
                            <div class="earnedStars">
                               <ul>
  <li ng-repeat="x in vpStar">
  <span class="{{ x.classApply}}"></span></li>
</ul>  	
							
							
                            </div>
            				</div>
            		<div class="gamesList">
                			<div class="gameBox FocusGame">
                            	<h3 title="{{FASkillDescription}}">{{FAGameType}}</h3>
                				<img src="images/{{FAGameImage}}" alt="{{FAGameImage}}">
                				<h4 title="{{FAGameDescription}}">{{FAGameName}}</h4>
                    			<a class="gamepopup viewMoreBtn" href="{{FAGamePlayLink}}" title="{{FAPlaytooltipstatus}}">Play Now</a>
                                <a class="howToPlayBtn" href="javascript:;" title="{{FAGameDescription}}">How to Play?</a>
                			</div>
                            <div class="gameStatusContainer">
                            	<ul> 
                                	<li><p>Total Questions</p><span>{{FATotalQuestions}}</span></li>
                                    <li><p>Attempted</p><span>{{FAAttemptedQuestions}}</span></li>
                                    <li><p>Correct</p><span>{{FACorrectQuestions}}</span></li>
                                    <li class="gameStatusBtn inCompleteGameStatus" title="{{FAGamePlayStatus}}">Status<br><a class="btn btn-success-green" href="javascript:;"><span class="{{FAGamePlayStatusIcon}}"></span>{{FAGamePlayStatus}}</a></li>
                                </ul>
                            </div>
							
   
                              <h4 class="score-head">Score</h4>
                            <div class="gamePercentageFG">
                	<span class="FA{{FocusandAttentionTotalScore}}">{{FocusandAttentionTotalScore}}%</span>
                </div>
                            <div class="earnedStars">
                           	 <ul>
  <li ng-repeat="x in faStar">
  <span class="{{ x.classApply}}"></span></li>
</ul>
                            </div>
            				</div>  
            				<div class="gamesList">
                			<div class="gameBox ProblemSolvingGame">
                            	<h3 title="{{PSSkillDescription}}">{{PSGameType}}</h3>
                				<img src="images/{{PSGameImage}}" alt="{{PSGameImage}}">
                				<h4 title="{{PSGameDescription}}">{{PSGameName}}</h4>
                    			<a class="gamepopup viewMoreBtn" href="{{PSGamePlayLink}}"  title="{{PSPlaytooltipstatus}}">Play Now</a>
                                <a class="howToPlayBtn" href="javascript:;" title="{{PSGameDescription}}">How to Play?</a>
                			</div>
                            <div class="gameStatusContainer">
                            	<ul> 
                                	<li><p>Total Questions</p><span>{{PSTotalQuestions}}</span></li>
                                    <li><p>Attempted</p><span>{{PSAttemptedQuestions}}</span></li>
                                    <li><p>Correct</p><span>{{PSCorrectQuestions}}</span></li>
                                    <li class="gameStatusBtn" title="{{PSGamePlayStatus}}">Status<br><a class="btn btn-success-orange" href="javascript:;"><span class="{{PSGamePlayStatusIcon}}"></span>{{PSGamePlayStatus}} </a></li>
                                </ul>
                            </div>
								
	
                              <h4 class="score-head">Score</h4>
                            <div class="gamePercentagePS">
                	<span class="PS{{ProblemSolvingTotalScore}}">{{ProblemSolvingTotalScore}}%</span>
                </div>
                            <div class="earnedStars">
                            <ul>
  <li ng-repeat="x in psStar">
  <span class="{{ x.classApply}}"></span></li>
</ul>
                            </div>
            				</div>
            				<div class="gamesList">
                			<div class="gameBox LinguisticsGame">
                            	<h3 title="{{LISkillDescription}}">{{LIGameType}}</h3>
                				<img src="images/{{LIGameImage}}" alt="{{LIGameImage}}">
                				<h4 title="{{LIGameDescription}}">{{LIGameName}}</h4>
                    			<a class="gamepopup viewMoreBtn" href="{{LIGamePlayLink}}" title="{{LIPlaytooltipstatus}}">Play Now</a>
                                <a class="howToPlayBtn" href="javascript:;" title="{{LIGameDescription}}">How to Play?</a>
                			</div>
                            <div class="gameStatusContainer">
                            	<ul> 
                                	<li><p>Total Questions</p><span>{{LITotalQuestions}}</span></li>
                                    <li><p>Attempted</p><span>{{LIAttemptedQuestions}}</span></li>
                                    <li><p>Correct</p><span>{{LICorrectQuestions}}</span></li>
                                    <li class="gameStatusBtn" title="{{LIGamePlayStatus}}">Status<br><a class="btn btn-success-blue" href="javascript:;"><span class="{{LIGamePlayStatusIcon}}"></span>{{LIGamePlayStatus}} </a></li>
                                </ul>
                            </div>
                              <h4 class="score-head">Score</h4>
                            <div class="gamePercentageL">
                	<span class="linguistics{{LinguisticsTotalScore}}">{{LinguisticsTotalScore}}%</span>
                </div>
                            <div class="earnedStars">
                           	   <ul>
  <li ng-repeat="x in liStar">
  <span class="{{ x.classApply}}"></span></li>
</ul>
                            </div>
            				</div>
            			</div>
      				</div>
 				</div>
            <div class="skillPerformanceContainer">
            	<div class="row">
                	<div class="col-lg-3 col-md-12 superBrainWrapper">
                    	<div class="superBrainContainer">
                    		<h3>Super Brains Round I</h3>
                            <i class="fa fa-clock-o roundClock"></i>
                        	<p><span>Contest Date :</span> {{ContestDate}}
							<br><span>Contest Slot :</span> {{ContestSlot}}</p>
                        </div>
                        <div class="playStatusContainer">
                        	<h3>Game Play Status</h3>
                            <button type="button" class="btn btn-default btn-circle"><i class="fa fa-info"></i></button>
                            <ul>
						
                            	<li>M<span class="{{MemoryPlayStatus}}"></span></li>
                                <li>VP<span class="{{VPPlayStatus}}"></span></li>
                                <li>FA<span class="{{FAPlayStatus}}"></span></li>
                                <li>PS<span class="{{PSPlayStatus}}"></span></li>
                                <li>LI<span class="{{LIPlayStatus}}"></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 boxBorder">
                    	<h3>My Skill Pie</h3>
                         <div class="performanceBox">
                    		<!-- <img src="images/pieChat.png" width="165" height="159" alt="pieChat"> -->
							<div id="container" class="pieChartContainer"></div>
                            <ul class="chartLegend">
                            	<li><span class="MColor"></span>Memory</li>
                                <li><span class="VPColor"></span>Visual Processing</li>
                                <li><span class="FAColor"></span>Focus and Attention</li>
                                <li><span class="PSColor"></span>Problem Solving</li>
                                <li><span class="LIColor"></span>Linguistics</li>
                            </ul>
                           <!-- <ul>
                            	<li><span class="performanceMemory"></span>Memory</li>
                                <li><span class="performanceVP"></span>Visual Processing</li>
                                <li><span class="performanceFA"></span>Focus and Attention</li>
                                <li><span class="performancePS"></span>Problem Solving</li>
                                <li><span class="performanceLinguistics"></span>Linguistics</li>
                            </ul> -->
                        </div>
                    </div>
                <div class="col-lg-3 col-md-6 boxBorder">
                    	<h3>My Game Performance</h3>
                        <ul class="gamePerformanceChat">
                        	<li><span class="gamePerformanceHead">Q</span>
                                <div class="gamePerformanceInner">
                                	<span>1</span>
                                	<span>2</span>
                                	<span>3</span>
                                	<span>4</span>
                                	<span>5</span>
                                	<span>6</span>
                                	<span>7</span>
                                	<span>8</span>
                                	<span>9</span>
                                	<span>10</span>
                            	</div>
                            </li>
                            <li><span class="gamePerformanceHead">M</span>
                            	<div class="gamePerformanceInner">
                               
      
	   
  
  <span ng-repeat="x in MemoryColor" class="{{ x.classApply}}" title="Score: {{x.Totaltip}}">{{x.content}}</span>

                           	
                            	</div>
                            </li>
                            <li><span class="gamePerformanceHead">VP</span>
                            	<div class="gamePerformanceInner">
                                	
       
  
  <span ng-repeat="x in vpColor" class="{{ x.classApply}}" title="Score: {{x.Totaltip}}">{{x.content}}</span>

                            </div>
                            	
                            </li>
                         <li><span class="gamePerformanceHead">FA</span>
                            	<div class="gamePerformanceInner">
                                
  
  <span ng-repeat="x in faColor" class="{{ x.classApply}}" title="Score: {{x.Totaltip}}">{{x.content}}</span>
  

  
 
                            	</div>
                            </li> 
							
                            <li><span class="gamePerformanceHead">PS</span>
                            	<div class="gamePerformanceInner">
								
								
  
    
  <span  ng-repeat="x in psColor" class="{{ x.classApply}}" title="Score: {{x.Totaltip}}">{{x.content}}</span>
 

                            	</div>
                            </li> 
                            <li><span class="gamePerformanceHead">LI</span>
                            	<div class="gamePerformanceInner">
       
   
  <span ng-repeat="x in liColor" class="{{ x.classApply}}" title="Score: {{x.Totaltip}}">{{x.content}}</span>
 
                      	
									
									
                            	</div>
                            </li>
                        </ul>
                        <ul class="gamePerformanceStatus">
                        	<li><span class="Correct"></span>Correct</li>
                            <li><span class="Unattended"></span>Unattended</li>
                            <li><span class="InCorrect">x</span>InCorrect</li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 boxBorder performanceBoxContainer">
                    	<h3>Congrats you won</h3>
                        <div class="performanceBox">
                        	<div class="starsWonBg">{{starsWon}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <div class="footer">
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

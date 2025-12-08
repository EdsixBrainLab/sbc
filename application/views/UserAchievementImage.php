<?php
include("db_connection.php");
include("qry/Query.php");
/* if(isset($_SESSION['userId'])){header("Location:profile.php");exit;} */
header('Content-Type: image/png');

$User_ID=$_SESSION['userId'];
$UserContestLevelID=1;
$MemoryScore= 0;
$VisualProcessingScore= 0;
$FocusandAttentionScore= 0;
$ProblemSolvingScore= 0;
$LinguisticsScore= 0;
$starsWon=0;
$TotalScore=0;

// User Skill Game Scores - Memory
$sql =SkillScoreMemory($User_ID,$UserContestLevelID);
$Mscore="";
$result = $conn->query($sql);
if ($result->num_rows > 0) {// output data of each row
	$intRows=0;
    while($row = $result->fetch_assoc()) {
		$TotalScore+=$row["score"];
		$Mscore[]=$row;
	}
} else {
   if ($ErrorFlag == "Y") echo "0 results";
}
// User Skill Game Scores - vp
$sql =SkillScoreVP($User_ID,$UserContestLevelID);
$VPscore="";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
	$intRows=0;
    while($row = $result->fetch_assoc()) {
		$TotalScore+=$row["score"];
		$VPscore[]=$row;
	}
} else {
   if ($ErrorFlag == "Y") echo "0 results ". $sql;
}
// User Skill Game Scores - FA
$sql =SkillScoreFA($User_ID,$UserContestLevelID);
$FAscore="";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
	$intRows=0;
    while($row = $result->fetch_assoc()) {
		$TotalScore+=$row["score"];
		$FAscore[]=$row;
	}
} else {	
   if ($ErrorFlag == "Y") echo "0 results ". $sql;
}
// User Skill Game Scores - PS
$sql =SkillScorePS($User_ID,$UserContestLevelID);
$PSscore="";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
	$intRows=0;
    while($row = $result->fetch_assoc()) {
		$PSscore[]=$row ;
		$TotalScore+=$row["score"];
	}
} else {
   if ($ErrorFlag == "Y") echo "0 results ". $sql;
}

// User Skill Game Scores - LI
$sql =SkillScoreLIG($User_ID,$UserContestLevelID);
$LIscore="";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
	$intRows=0;
    while($row = $result->fetch_assoc()) {
			$LIscore[]=$row ;
		$TotalScore+=$row["score"];
	}
}else {
   if ($ErrorFlag == "Y") echo "0 results ". $sql;
}

for ($i = 0;$i<count($Mscore);$i++)
{
	if(isset($Mscore[$i]['score']) && $Mscore[$i]['score']!='')
	{
		$MemoryScore=$MemoryScore + $Mscore[$i]['score'];
	}
}
for ($i = 0; $i <count($VPscore); $i++)
{
	if(isset($VPscore[$i]['score']) && $VPscore[$i]['score'] != '')
	{
		$VisualProcessingScore=$VisualProcessingScore+$VPscore[$i]['score'];
	}
}
for ($i=0; $i <count($FAscore);$i++)
{
	if(isset($FAscore[$i]['score']) && $FAscore[$i]['score'] != '')
	{
		$FocusandAttentionScore+=$FAscore[$i]['score'];
	}
}
for ($i=0;$i<count($PSscore);$i++)
{
	if(isset($PSscore[$i]['score']) && $PSscore[$i]['score'] != '')
	{
		$ProblemSolvingScore+=$PSscore[$i]['score'];
	}
}
for ($i=0;$i<count($LIscore);$i++)
{
	if(isset($LIscore[$i]['score']) && $LIscore[$i]['score']!= '')
	{
		$LinguisticsScore+=$LIscore[$i]['score'];
	}
}

if($MemoryScore>0 ) {$starsWon=$starsWon+1;}
if($MemoryScore>10) {$starsWon=$starsWon+1;}
if($MemoryScore>20) {$starsWon=$starsWon+1;}
if($MemoryScore>30 ) {$starsWon=$starsWon+1;}
if($MemoryScore>40 ) {$starsWon=$starsWon+1;}
if($MemoryScore>50 ) {$starsWon=$starsWon+1;}
if($MemoryScore>60 ) {$starsWon=$starsWon+1;}
if($MemoryScore>70 ) {$starsWon=$starsWon+1;}
if($MemoryScore>80 ) {$starsWon=$starsWon+1;}
if($MemoryScore>90 ) {$starsWon=$starsWon+1;}

if($VisualProcessingScore>0 ) {$starsWon=$starsWon+1;}
if($VisualProcessingScore>10) {$starsWon=$starsWon+1;}
if($VisualProcessingScore>20) {$starsWon=$starsWon+1;}
if($VisualProcessingScore>30 ) {$starsWon=$starsWon+1;}
if($VisualProcessingScore>40 ) {$starsWon=$starsWon+1;}
if($VisualProcessingScore>50 ) {$starsWon=$starsWon+1;}
if($VisualProcessingScore>60 ) {$starsWon=$starsWon+1;}
if($VisualProcessingScore>70 ) {$starsWon=$starsWon+1;}
if($VisualProcessingScore>80 ) {$starsWon=$starsWon+1;}
if($VisualProcessingScore>90 ) {$starsWon=$starsWon+1;}

if($FocusandAttentionScore>0 ) {$starsWon=$starsWon+1;}
if($FocusandAttentionScore>10) {$starsWon=$starsWon+1;}
if($FocusandAttentionScore>20) {$starsWon=$starsWon+1;}
if($FocusandAttentionScore>30 ) {$starsWon=$starsWon+1;}
if($FocusandAttentionScore>40 ) {$starsWon=$starsWon+1;}
if($FocusandAttentionScore>50 ) {$starsWon=$starsWon+1;}
if($FocusandAttentionScore>60 ) {$starsWon=$starsWon+1;}
if($FocusandAttentionScore>70 ) {$starsWon=$starsWon+1;}
if($FocusandAttentionScore>80 ) {$starsWon=$starsWon+1;}
if($FocusandAttentionScore>90 ) {$starsWon=$starsWon+1;}

if($ProblemSolvingScore>0 ) {$starsWon=$starsWon+1;}
if($ProblemSolvingScore>10) {$starsWon=$starsWon+1;}
if($ProblemSolvingScore>20) {$starsWon=$starsWon+1;}
if($ProblemSolvingScore>30 ) {$starsWon=$starsWon+1;}
if($ProblemSolvingScore>40 ) {$starsWon=$starsWon+1;}
if($ProblemSolvingScore>50 ) {$starsWon=$starsWon+1;}
if($ProblemSolvingScore>60 ) {$starsWon=$starsWon+1;}
if($ProblemSolvingScore>70 ) {$starsWon=$starsWon+1;}
if($ProblemSolvingScore>80 ) {$starsWon=$starsWon+1;}
if($ProblemSolvingScore>90 ) {$starsWon=$starsWon+1;}

if($LinguisticsScore>0 ) {$starsWon=$starsWon+1;}
if($LinguisticsScore>10) {$starsWon=$starsWon+1;}
if($LinguisticsScore>20) {$starsWon=$starsWon+1;}
if($LinguisticsScore>30 ) {$starsWon=$starsWon+1;}
if($LinguisticsScore>40 ) {$starsWon=$starsWon+1;}
if($LinguisticsScore>50 ) {$starsWon=$starsWon+1;}
if($LinguisticsScore>60 ) {$starsWon=$starsWon+1;}
if($LinguisticsScore>70 ) {$starsWon=$starsWon+1;}
if($LinguisticsScore>80 ) {$starsWon=$starsWon+1;}
if($LinguisticsScore>90 ) {$starsWon=$starsWon+1;}

$AverageScore=$TotalScore/5;


$FocusAndAttentionScore=$FocusandAttentionScore;

// User Achievement Score
$sql = "SELECT User_Name,Grade_Name, State, City  FROM vi_contest_user_profile WHERE user_ID=".$User_ID."";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
	$intRows=0;
    while($row = $result->fetch_assoc()) {
		$intRows=$intRows+1;
		$UserName=$row["User_Name"];
		$Grade=$row["Grade_Name"];
		$City=$row["City"];
		$State=$row["State"];		
		$MemoryScore=$MemoryScore;
		$VisualProcessingScore=$VisualProcessingScore;
		$FocusAndAttentionScore=$FocusandAttentionScore;
		$ProblemSolvingScore=$ProblemSolvingScore;
		$LinguisticsScore=$LinguisticsScore;
		$TotalScore=$starsWon;
		$BSPIScore=ROUND($AverageScore,2);
	}
}else {
   if ($ErrorFlag == "Y") echo "0 results ". $sql;
}


$Greeting1='Wow !!!';
$Greeting2='Good !!!';
$Greeting3='Nice !!!';
$Greeting4='Super !!!';
$Greeting5='Great !!!';
$Greeting6='Excellent !!!';
$Greeting7='Wonderful !!!';
$Greeting8='Awesome !!!';
$Greeting9='Terrific !!!';
$Greeting10='Fantasticc !!!';
$BackgroundImage= 'images/bg/sbc'.str_pad(ROUND(($BSPIScore/2),0)*2,3,"0",STR_PAD_LEFT).'.png';
//$BackgroundImage= 'images/bg/kgt000.png';
//echo $BackgroundImage;exit;
$img = LoadPNG($BackgroundImage,$UserName, $Grade, $City,$State,$TotalScore,$BSPIScore,$MemoryScore,$VisualProcessingScore,$FocusAndAttentionScore,$ProblemSolvingScore,$LinguisticsScore,$Greeting1,$Greeting2,$Greeting3,$Greeting4,$Greeting5,$Greeting6,$Greeting7,$Greeting8,$Greeting9,$Greeting10);

imagepng($img);
imagedestroy($img);

function LoadPNG($fBackgroundImage,$fUserName, $fGrade, $fCity,$fState,$fTotalScore,$fBSPIScore,$fMemoryScore,$fVisualProcessingScore,$fFocusAndAttentionScore,$fProblemSolvingScore,$fLinguisticsScore,$fGreeting1,$fGreeting2,$fGreeting3,$fGreeting4,$fGreeting5,$fGreeting6,$fGreeting7,$fGreeting8,$fGreeting9,$fGreeting10)
{
    /* Attempt to open */
    $im = @imagecreatefrompng($fBackgroundImage);
    /* See if it failed */
    if(!$im)
    {
      echo "Loading bg has issue ".fBackgroundImage;
    }
// Create some colors
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
// The text to draw
// Replace path by your own font path
$font = "fonts/OpenSansBold.ttf";
// Add some shadow to the text
 $text_color = imagecolorallocate($im, 213, 91, 0);
	imagestring($im, 5, 200, 62, str_pad($fUserName,50," ",STR_PAD_BOTH), $text_color);
	imagestring($im, 5, 192, 85, str_pad($fGrade,50," ",STR_PAD_BOTH), $text_color);
	imagestring($im, 3, 185, 107, str_pad($_SESSION['schoolname'],65," ",STR_PAD_BOTH), $text_color);
	/* imagestring($im, 5, 200, 92, str_pad($fCity,50," ",STR_PAD_BOTH), $text_color);
	imagestring($im, 5, 200, 107, str_pad($fState,50," ",STR_PAD_BOTH), $text_color); */
	/* BSPIScore */ 
	$text_color = imagecolorallocate($im, 255, 255, 255);
	
	if (strlen($fBSPIScore) == 1)
    {
     imagettftext ($im, 25, 0, 195, 375, $text_color, $font, $fBSPIScore);
    }
	 elseif (strlen($fBSPIScore) > 2)
    {
     imagettftext ($im, 25, 0, 178, 375, $text_color, $font, $fBSPIScore);
    }	
		elseif (strlen($fBSPIScore) > 3)
    {
     imagettftext ($im, 20, 0, 100, 350, $text_color, $font, $fBSPIScore);
    }
	else
    {
     imagettftext ($im, 25, 0, 180, 350, $text_color, $font, $fBSPIScore);
    }

/* TotalScore */ 
    if (strlen($fTotalScore) == 1)
    {
    imagettftext ($im, 50, 0, 570, 300, $text_color, $font, $fTotalScore);
    }
    elseif (strlen($fTotalScore) > 2)
    {
     imagettftext ($im, 50, 0, 530, 300, $text_color, $font, $fTotalScore);
    }
	else
    {
     imagettftext ($im, 50, 0, 550, 300, $text_color, $font, $fTotalScore);
    }
	/* MemoryScore */ 
	$text_color = imagecolorallocate($im, 255, 0, 0);

	if (strlen($fMemoryScore) == 1)
    {
      imagettftext ($im, 30, 0, 235, 508, $text_color, $font, $fMemoryScore);
    }
    elseif (strlen($fMemoryScore) > 2)
    {
     imagettftext ($im, 30, 0, 215, 508, $text_color, $font, $fMemoryScore);
    }
	else
    {
      imagettftext ($im, 30, 0, 228, 508, $text_color, $font, $fMemoryScore);
    }
	/* VisualProcessingScore */ 
	$text_color = imagecolorallocate($im, 255, 153, 51);
	if (strlen($fVisualProcessingScore) == 1)
	{
   
    imagettftext ($im, 30, 0, 350, 508, $text_color, $font, $fVisualProcessingScore);
   }
    elseif (strlen($fVisualProcessingScore) > 2)
    {
      imagettftext ($im, 30, 0, 325, 508, $text_color, $font, $fVisualProcessingScore);
    }
	else
    {
       imagettftext ($im, 30, 0, 340, 508, $text_color, $font, $fVisualProcessingScore);
    }
   /* FocusAndAttentionScore */ 
	$text_color = imagecolorallocate($im, 102, 204, 0);
	if (strlen($fFocusAndAttentionScore) == 1)
   {
    imagettftext ($im, 30, 0, 460, 508, $text_color, $font, $fFocusAndAttentionScore);
   }
    elseif (strlen($fFocusAndAttentionScore) > 2)
    {
      imagettftext ($im, 30, 0, 435, 510, $text_color, $font, $fFocusAndAttentionScore);
    }
	else
    {
        imagettftext ($im, 30, 0, 450, 510, $text_color, $font, $fFocusAndAttentionScore);
    }
   /* ProblemSolvingScore */ 
	$text_color = imagecolorallocate($im, 230, 107, 25);
	
	if (strlen($fProblemSolvingScore) == 1)
  {
   imagettftext ($im, 30, 0, 570, 510, $text_color, $font, $fProblemSolvingScore);
   }
  elseif (strlen($fProblemSolvingScore) > 2)
    {
      imagettftext ($im, 30, 0, 545, 510, $text_color, $font, $fProblemSolvingScore);
    }
	else
    {
       imagettftext ($im, 30, 0, 560, 510, $text_color, $font, $fProblemSolvingScore);
    }
   /* LinguisticsScore */ 
	$text_color = imagecolorallocate($im, 51, 204, 255);
	if (strlen($fLinguisticsScore) == 1)
  {
  imagettftext ($im, 30, 0, 680, 510, $text_color, $font, $fLinguisticsScore);
  }
  elseif (strlen($fLinguisticsScore) > 2)
    {
      imagettftext ($im, 30, 0, 655, 510, $text_color, $font, $fLinguisticsScore);
    }
	else
    {
        imagettftext ($im, 30, 0, 670, 510, $text_color, $font, $fLinguisticsScore);
    }
	/* Greetings Range */
	$text_color = imagecolorallocate($im, 255, 255, 255);
	
 if ($fBSPIScore < 11)
  {
  imagestring($im, 5, 495, 87, str_pad($fGreeting1,40," ",STR_PAD_BOTH), $text_color);
  }
  elseif ($fBSPIScore < 21)
    {
      imagestring($im, 5, 495, 87, str_pad($fGreeting2,40," ",STR_PAD_BOTH), $text_color);
    }
	elseif ($fBSPIScore < 31)
    {
      imagestring($im, 5, 495, 87, str_pad($fGreeting3,40," ",STR_PAD_BOTH), $text_color);
    }
	 elseif ($fBSPIScore < 41)
    {
      imagestring($im, 5, 495, 87, str_pad($fGreeting4,40," ",STR_PAD_BOTH), $text_color);
    }
	 elseif ($fBSPIScore < 51)
    {
      imagestring($im, 5, 495, 87, str_pad($fGreeting5,40," ",STR_PAD_BOTH), $text_color);
    }
	 elseif ($fBSPIScore < 61)
    {
      imagestring($im, 5, 495, 87, str_pad($fGreeting6,40," ",STR_PAD_BOTH), $text_color);
    }
	 elseif ($fBSPIScore < 71)
    {
      imagestring($im, 5, 495, 87, str_pad($fGreeting7,40," ",STR_PAD_BOTH), $text_color);
    }
	 elseif ($fBSPIScore < 81)
    {
      imagestring($im, 5, 495, 87, str_pad($fGreeting8,40," ",STR_PAD_BOTH), $text_color);
    }
	elseif ($fBSPIScore < 91)
    {
      imagestring($im, 5, 495, 87, str_pad($fGreeting9,40," ",STR_PAD_BOTH), $text_color);
    }
	else
    {
imagestring($im, 5, 495, 87, str_pad($fGreeting10,40," ",STR_PAD_BOTH), $text_color);
    }


	
    return $im;
}

?>
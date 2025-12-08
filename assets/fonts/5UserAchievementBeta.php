<?php
header('Content-Type: image/png');


$UserName='Mr.P.NAVEENKUMAR';
$Grade='GRADE VIII';
$City='CHENNAI';
$State='TAMILNADU';
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
if(isset($_GET['BSPIScore']))
{
$BSPIScore=$_GET['BSPIScore'];
}
else
{
$BSPIScore=10;
}

if(isset($_GET['MScore']))
{
$MemoryScore=$_GET['MScore'];
}
else
{
$MemoryScore='21';
}
if(isset($_GET['VPScore']))
{
$VisualProcessingScore=$_GET['VPScore'];
}
else
{
$VisualProcessingScore='3';
}
if(isset($_GET['FAScore']))
{
$FocusAndAttentionScore=$_GET['FAScore'];
}
else
{
$FocusAndAttentionScore='454';
}

if(isset($_GET['PSScore']))
{
$ProblemSolvingScore=$_GET['PSScore'];
}
else
{
$ProblemSolvingScore='56';
}
if(isset($_GET['TScore']))
{
$TotalScore=$_GET['TScore'];
}
else
{
$TotalScore='6';
}

if(isset($_GET['LScore']))
{
$LinguisticsScore=$_GET['LScore'];
}
else
{
$LinguisticsScore='789';
}



//$BackgroundImage='./images/bg/skillangels.png';
$BackgroundImage= './images/bg/m'.str_pad(ROUND(($BSPIScore/2),0)*2,3,"0",STR_PAD_LEFT).'.png';


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
        /* Create a blank image */
        $im  = imagecreatetruecolor(200, 700);
        $bgc = imagecolorallocate($im, 255, 0, 0);
        $tc  = imagecolorallocate($im, 150, 200, 200);
        $background_color = imagecolorallocate($im, 0xFF, 0xCC, 0xDD);
		
		$font = "/mnt/vol1/sites/umuat/OpenSansBold.ttf";

        imagefilledrectangle($im, 50, 50, 200, 200, $bgc);

        /* Output an error message */
        imagestring($im, 1, 5, 5, 'Error loading ' . $fBackgroundImage, $tc);
    }
	 $white = imagecolorallocate($im, 0xFF,0xFF,0xFF);
	$black = imagecolorallocate($im, 0x00,0x00,0x00);
    

	 $text_color = imagecolorallocate($im, 213, 91, 0);
	imagestring($im, 5, 200, 62, str_pad($fUserName,50," ",STR_PAD_BOTH), $text_color);
	imagestring($im, 5, 200, 77, str_pad($fGrade,50," ",STR_PAD_BOTH), $text_color);
	imagestring($im, 5, 200, 92, str_pad($fCity,50," ",STR_PAD_BOTH), $text_color);
	imagestring($im, 5, 200, 107, str_pad($fState,50," ",STR_PAD_BOTH), $text_color);
	
	//$filename= '.images/bg/M'.str_pad(ROUND(($fBSPIScore/2),0)*2,3,"0",STR_PAD_LEFT).'.png';
	//imagestring($im, 5, 500, 107, $filename, $text_color);
	/* BSPIScore */ 
	$text_color = imagecolorallocate($im, 255, 255, 255);
	if (strlen($fBSPIScore) == 1)
    {
     imagettftext ($im, 25, 0, 190, 350, $text_color, $font, $fBSPIScore);
    }

	 elseif (strlen($fBSPIScore) > 2)
    {
     imagettftext ($im, 25, 0, 170, 350, $text_color, $font, $fBSPIScore);
    }
	
		elseif (strlen($fBSPIScore) > 3)
    {
     imagettftext ($im, 25, 0, 100, 350, $text_color, $font, $fBSPIScore);
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
     imagettftext ($im, 50, 0, 535, 300, $text_color, $font, $fTotalScore);
    }
	else
    {
     imagettftext ($im, 50, 0, 550, 300, $text_color, $font, $fTotalScore);
    }
	
	
	
	/* MemoryScore */ 
	$text_color = imagecolorallocate($im, 255, 0, 0);
	
	if (strlen($fMemoryScore) == 1)
    {
      imagettftext ($im, 30, 0, 263, 520, $text_color, $font, $fMemoryScore);
    }
    elseif (strlen($fMemoryScore) > 2)
    {
     imagettftext ($im, 30, 0, 243, 520, $text_color, $font, $fMemoryScore);
    }
	else
    {
      imagettftext ($im, 30, 0, 253, 520, $text_color, $font, $fMemoryScore);
    }
	/* VisualProcessingScore */ 
	$text_color = imagecolorallocate($im, 255, 153, 51);
	
	if (strlen($fVisualProcessingScore) == 1)
   {
    imagettftext ($im, 30, 0, 373, 520, $text_color, $font, $fVisualProcessingScore);
   }
    elseif (strlen($fVisualProcessingScore) > 2)
    {
      imagettftext ($im, 30, 0, 353, 520, $text_color, $font, $fVisualProcessingScore);
    }
	else
    {
       imagettftext ($im, 30, 0, 363, 520, $text_color, $font, $fVisualProcessingScore);
    }
   /* FocusAndAttentionScore */ 
	$text_color = imagecolorallocate($im, 102, 204, 0);
	
	if (strlen($fFocusAndAttentionScore) == 1)
   {
    imagettftext ($im, 30, 0, 484, 520, $text_color, $font, $fFocusAndAttentionScore);
   }
    elseif (strlen($fFocusAndAttentionScore) > 2)
    {
      imagettftext ($im, 30, 0, 464, 520, $text_color, $font, $fFocusAndAttentionScore);
    }
	else
    {
        imagettftext ($im, 30, 0, 474, 520, $text_color, $font, $fFocusAndAttentionScore);
    }
   /* ProblemSolvingScore */ 
	$text_color = imagecolorallocate($im, 230, 107, 25);
	
	if (strlen($fProblemSolvingScore) == 1)
  {
   imagettftext ($im, 30, 0, 594, 520, $text_color, $font, $fProblemSolvingScore);
   }
  elseif (strlen($fProblemSolvingScore) > 2)
    {
      imagettftext ($im, 30, 0, 574, 520, $text_color, $font, $fProblemSolvingScore);
    }
	else
    {
       imagettftext ($im, 30, 0, 584, 520, $text_color, $font, $fProblemSolvingScore);
    }
   /* LinguisticsScore */ 
	$text_color = imagecolorallocate($im, 51, 204, 255);
	
	if (strlen($fLinguisticsScore) == 1)
  {
  imagettftext ($im, 30, 0, 705, 520, $text_color, $font, $fLinguisticsScore);
  }
  elseif (strlen($fLinguisticsScore) > 2)
    {
      imagettftext ($im, 30, 0, 685, 520, $text_color, $font, $fLinguisticsScore);
    }
	else
    {
        imagettftext ($im, 30, 0, 695, 520, $text_color, $font, $fLinguisticsScore);
    }
	/* Greetings Range */
	$text_color = imagecolorallocate($im, 255, 255, 255);
	
 if ($fBSPIScore < 11)
  {
  imagestring($im, 5, 0, 77, str_pad($fGreeting1,40," ",STR_PAD_BOTH), $text_color);
  }
  elseif ($fBSPIScore < 21)
    {
      imagestring($im, 5, 0, 77, str_pad($fGreeting2,40," ",STR_PAD_BOTH), $text_color);
    }
	elseif ($fBSPIScore < 31)
    {
      imagestring($im, 5, 0, 77, str_pad($fGreeting3,40," ",STR_PAD_BOTH), $text_color);
    }
	 elseif ($fBSPIScore < 41)
    {
      imagestring($im, 5, 0, 77, str_pad($fGreeting4,40," ",STR_PAD_BOTH), $text_color);
    }
	 elseif ($fBSPIScore < 51)
    {
      imagestring($im, 5, 0, 77, str_pad($fGreeting5,40," ",STR_PAD_BOTH), $text_color);
    }
	 elseif ($fBSPIScore < 61)
    {
      imagestring($im, 5, 0, 77, str_pad($fGreeting6,40," ",STR_PAD_BOTH), $text_color);
    }
	 elseif ($fBSPIScore < 71)
    {
      imagestring($im, 5, 0, 77, str_pad($fGreeting7,40," ",STR_PAD_BOTH), $text_color);
    }
	 elseif ($fBSPIScore < 81)
    {
      imagestring($im, 5, 0, 77, str_pad($fGreeting8,40," ",STR_PAD_BOTH), $text_color);
    }
	elseif ($fBSPIScore < 91)
    {
      imagestring($im, 5, 0, 77, str_pad($fGreeting9,40," ",STR_PAD_BOTH), $text_color);
    }
	else
    {
imagestring($im, 5, 0, 77, str_pad($fGreeting10,40," ",STR_PAD_BOTH), $text_color);
    }
	
    return $im;
}

?>
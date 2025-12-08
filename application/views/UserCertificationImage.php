<?php
include("db_connection.php");
include("qry/Query.php");
/* if(isset($_SESSION['userId'])){header("Location:profile.php");exit;} */
header('Content-Type: image/jpeg');

//$BackgroundImage= 'images/bg/m'.str_pad(ROUND(($BSPIScore/2),0)*2,3,"0",STR_PAD_LEFT).'.png';
$BackgroundImage= 'images/bg/certification.jpg';
$class = str_replace("Grade","", $_SESSION["gradename"]);
//echo $BackgroundImage;exit;
$img = LoadJpeg($BackgroundImage,$_SESSION['name'],$class,$_SESSION["schoolname"]);

imagejpeg($img);
imagedestroy($img);

function LoadJpeg($fBackgroundImage,$name,$class,$schoolname)
{
    /* Attempt to open */
    $im = @imagecreatefromjpeg($fBackgroundImage);
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
	imagettftext ($im, 20, 0, 415, 365, $text_color, $font, $name);
	imagettftext ($im, 20, 0, 300, 420, $text_color, $font, $class);
	imagettftext ($im, 18, 0, 480, 420, $text_color, $font, $schoolname);
	/* imagestring($im, 5, 200, 92, str_pad($fCity,50," ",STR_PAD_BOTH), $text_color);
	imagestring($im, 5, 200, 107, str_pad($fState,50," ",STR_PAD_BOTH), $text_color); */
	/* BSPIScore */ 
	$text_color = imagecolorallocate($im, 255, 255, 255);

	
    return $im;
}

?>
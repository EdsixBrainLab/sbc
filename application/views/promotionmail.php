<?php 

date_default_timezone_set('Asia/Kolkata');
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE); 
require 'mailer/PHPMailerAutoload.php';  
	
$baseurl=sprintf("%s://%s%s",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',$_SERVER['SERVER_NAME'],dirname($_SERVER['PHP_SELF']));

	$message='<div style="background-color:#fff;margin:1% 5%;font-family: Calibri;">
	<table style="width:100%;font-size: 14px;">
	<tbody>						
	  
	 	<tr style="font-size: 14px;">
		<td style="font-size: 14px;"><br/> Dear Sir / Madam,<br/><br/><br/></td>
	</tr>
	<tr style="display: block;font-size: 14px;">
		<td style="font-size: 14px;">
With grace of divine, support and prayers from wonderful people like you, we have been selected to implement Higher Order Thinking Skills in schools in Dubai !!!!<br/><br/></td>
	</tr>
	 
	 <tr style="display:block;overflow:hidden;font-size: 14px;">
		<td style="float:left;border:0px;text-align: center;padding: 10px 0px; color: #fff;">
			<a href="https://www.youtube.com/watch?reload=9&v=YYRE_EZyleQ&feature=youtu.be" ><img alt="'.$baseurl.'" src="'.$baseurl.'/promotionalimages/SkillAngels-play-600px.jpg" style="float: left;width:100%;"></a>
		</td>
		 
	</tr> 
	
	  
	</tbody></table><br/>';
	 
	
	 $message.='<table style="display: block;font-size: 14px;"><tbody>
	<tr style="font-size: 14px;">
		<td style="font-size: 14px;">Regards,</td>
	</tr>
	<tr style="font-size: 14px;">
		<td style="font-size: 14px;"> Team Edsix</td>
	</tr>
	</div>'; 
	
	/*$message.="<tr style='font-size: 14px;'>
		<td style='font-size: 14px;'> Edsix Brain Lab Private Limited, <br/>
		Supported by IIT Madras RTBI <br/>
		And by IIM Ahmedabad's CIIE <br/>";*/
	/*$message.='<br/>
		<a href="www.facebook.com/skillangels" title="Skillangels" >www.facebook.com/skillangels</a>
		<br/>
		(P) : +91 97880 91988
		<br/>
		URL : <a href="www.skillangels.com" title="Skillangels">www.skillangels.com</a>
		</td>
	</tr>
	</tbody>                
	</table></div>'; */
	
	$toemailids=array('kritika.m1@gmail.com','srisankaravidyalayaa@gmail.com');
	 
	 foreach($toemailids as $toemailid)
	 {
	$subject="SkillAngels Launch in Dubai";		

	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host = "smtp.falconide.com";
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "";
	$mail->Username = "skillsangelsfal";
	$mail->Password = "SkillAngels@123";
	$mail->setFrom('info@skillangels.com', 'SkillAngels');
	$mail->addReplyTo('info@skillangels.com', 'SkillAngels');
	$mail->addAddress($toemailid, ""); 
	//$mail->addBCC("priyat@skillangels.com", "Priya");		
	//$mail->addBCC("damu@skillangels.com", "Damu"); 

	$mail->Subject = $subject;
	$mail->msgHTML($message);			
	//$mail->addAttachment("/mnt/vol1/sites/skillangels/sbc/".$filename);
	if(!$mail->send()){
	   echo "Mailer Error: " . $mail->ErrorInfo;
	}else{
	   echo "Message sent!"."<br/>";
	}
		
	 }		
 ?>
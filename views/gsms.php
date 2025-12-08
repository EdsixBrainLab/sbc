<?php 
/* $ch = curl_init("http://api-alerts.solutionsinfini.com/v3/?method=sms&api_key=Ac79406bbeca30e25c926bad8928bcc17&to=+919789120543&sender=SBRAIN&message=".urlencode ("Welcome to Super Brain Game Contest Your contest date : 10-10-2017, Time : 10:00 AM  to 11PM Please visit http://superbraingame.skillangels.com"));

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);       
curl_close($ch);
echo $output;exit; */
$baseurl="http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
$subject = 'Registration confirmation - Super Brain Game Contest';
$message1 = "Thank you for registering with Gifted Angels.<br/>
Following are the credentials to access the service at";


$message = '<table align="center" width="800px" border="1" cellspacing="0" cellpadding="0" style="font-size:medium;margin-right:auto;margin-left:auto;border:1px solid rgb(197,197,197);font-family:Arial,Helvetica,sans-serif;background-image:initial;background-repeat:initial">

<tbody>
<tr style="display:block;overflow:hidden">
<td style="float:left;border:0px;">
<a href="'.$baseurl.'" target="_blank" ><img src="'.$baseurl.'/images/emailer/header.jpg" width="100%"  alt="Skillangels" /></a>

</td>

</tr>

<tr style="padding:0px;margin:10px 42px 20px;display:block;font-size:13px;font-family:Verdana,Geneva,sans-serif;line-height:18px;text-align:justify">
<td colspan="2" style="border:0px">
Dear sun,<br/><br/>


Thank you for registering with Gifted Angels.<br/>
Following are the credentials to access the service at <a href="'.$baseurl.'" target="_blank" >'.$baseurl.'</a><br/><br/>

Your username is <strong>xxxx</strong><br/>
Your password: <strong>123456</strong><br/><br/>

Click below link to proceed payment:<br/><br/>

<a href="'.$baseurl.'/payment.php?uid=1&key=5" style="color:green" target="_blank" >Click Here</a><br/><br/>

All The Very Best!!!<br/><br/>

Best Regards,<br/>
Super Brain Game Contest Team<br/>


</td>
</tr>


<tr style="">
<td style="text-align:center;color:#ee1b5b;border:0px;background-size:100%;background-image: url('.$baseurl.'/images/emailer/footer.jpg);padding-top:20px;padding-bottom:20px;font-family: cursive;font-size: 20px;">
<div style="width:100%;font-family:; float:left;text-align:center">
<a href="http://www.skillangels.com/" target="_blank" style="color:#ee1b5b;text-decoration: none;" >www.skillangels.com</a><br/>
<a href="mailto:support@skillangels.com"  style="color:#ee1b5b;text-decoration: none;" >support@skillangels.com</a>
</div>
</td>

</tr>
<tr style="display:block;overflow:hidden">
<td style="float:left;border:0px;">

</td>

</tr>
</tbody>
</table>';
 
 
 /* $mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host = "smtp.falconide.com";
	$mail->Port = 25;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "";
	$mail->Username = "skillsangelsfal";
	$mail->Password = "SkillAngels@123";
	$mail->setFrom('pro.gensmart@gteceducation.com', 'Super Brain Olympiad 2017');
	$mail->addReplyTo('pro.gensmart@gteceducation.com', 'Super Brain Olympiad 2017');
	$mail->addAddress($to, ''); //to mail id
	$mail->Subject = $subject;
	$mail->msgHTML($message); */
	
	
require 'mailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host = "smtp.falconide.com";
	$mail->Port = 25;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "";
	$mail->Username = "skillsangelsfal";
	$mail->Password = "SkillAngels@123";
	$mail->setFrom('pro.gensmart@gteceducation.com', 'Super Brain Game Contest');
	$mail->addReplyTo('pro.gensmart@gteceducation.com', 'Super Brain Game Contest');
	$mail->addAddress('damu@skillangels.com', ''); //to mail id
 	$mail->Subject = $subject;
	$mail->msgHTML($message);

//send the message, check for errors
 if (!$mail->send()) {
    $msg="Mailer Error: " . $mail->ErrorInfo;
} else {
   $msg="success";
} 
echo $msg;exit;
?>
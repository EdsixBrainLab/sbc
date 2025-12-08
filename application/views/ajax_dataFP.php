<?php
include("db_connection.php");
include("qry/Query.php");
date_default_timezone_set('Asia/Kolkata');
		 if(isset($_REQUEST['emailID']))
		{ 
		$qry=Emailexist($_REQUEST['emailID']);
		$qryEmailexist = $conn->query($qry);		
		while($objEmailexist =$qryEmailexist->fetch_assoc()){
			$Emailexist=$objEmailexist;
		}
			if($Emailexist['existcount']>0){
				$randid=rand(1000000, 9999999);
				$qryinsertLog=forgetpwdlog($Emailexist['id'],$randid);
				$conn->query($qryinsertLog);
//$baseurl="http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
$subject = 'Super Brain Game Contest - Password Reset - Activation Link';
$message = '<table align="center" width="800px" border="1" cellspacing="0" cellpadding="0" style="font-size:medium;margin-right:auto;margin-left:auto;border:1px solid rgb(197,197,197);font-family:Arial,Helvetica,sans-serif;background-image:initial;background-repeat:initial">

<tbody>
<tr style="display:block;overflow:hidden">
<td style="float:left;border:0px;">
<a href="'.$baseurl.'" target="_blank" ><img src="'.$baseurl.'/images/emailer/header.jpg" width="100%"  alt="Skillangels" /></a>

</td>

</tr>

<tr style="padding:0px;margin:10px 42px 20px;display:block;font-size:13px;font-family:Verdana,Geneva,sans-serif;line-height:18px;text-align:justify">
<td colspan="2" style="border:0px">
Dear '.$Emailexist['first_name'].',<br/><br/>


Please click the following activation link to reset your password.<br/><br/>

<a href="'.$baseurl.'/change_password.php?res='.md5($randid).'&ud='.md5($Emailexist['id']).'" style="color:green" target="_blank" >Click Here</a><br/><br/>

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

require 'mailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host = "smtpout.secureserver.net";
	$mail->Port = 465;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	$mail->Username = "sundar@skillangels.com";
	$mail->Password = "sandy@08cs081";
	$mail->setFrom('sundar@skillangels.com', 'Contest');
	$mail->addReplyTo('sundar@skillangels.com', 'Contest');
	$mail->addAddress($_REQUEST['emailID'], ''); //to mail id
	$mail->Subject = $subject;
	$mail->msgHTML($message);
//send the message, check for errors
if (!$mail->send()) {
    //echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    //echo "Message sent!";
}
echo "<div style='color:green'>An Email has been sent with link to change password.</div>";
}
else{echo "<div style='color:red'>Please enter valid Email ID. The given Email ID is not registered.</div>";}
exit;
}
else{echo "<div style='color:red'>Please enter valid Email ID. The given Email ID is not registered.</div>";}
		
?>
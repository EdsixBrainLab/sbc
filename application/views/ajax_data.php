<?php 
include("db_connection.php");
include("qry/Query.php");
date_default_timezone_set('Asia/Kolkata');
?>
<?php
$contest_level_id=1;
$contest_id=1;

	if(isset($_POST['CType']) && $_POST['CType']=='TS')
	{
	$newconditionqry='';

if(date('Y-m-d', strtotime(str_replace('/', '-', $_POST['date_slotID'])))==date('Y-m-d')){ $newconditionqry=" and starttime>hour('".date("H:i:s")."')+1 ";}
	
		$qryTimeslotList=TimeslotList($newconditionqry,$_POST['contest_level_id'],$_POST['date_slotID']);
		//echo $qryTimeslotList;exit;
		$qryTimeslotList = $conn->query($qryTimeslotList);
		if ($qryTimeslotList->num_rows > 0) 
		{
			while($objTimeslotList =$qryTimeslotList->fetch_assoc()){
				$TimeslotList[]=$objTimeslotList;
			}
			?>
			<option value="">Select</option>
			<?php
			 foreach($TimeslotList as $Timeslot){
		?>
			<option value="<?php echo $Timeslot['starttime']; ?>"><?php echo date('h a', strtotime($Timeslot['starttime'].":00:00"))." - ".date('h a', strtotime($Timeslot['endtime'].":00:00")); ?> IST</option>
		<?php }
		}
		else
		{
			echo 0;exit;
		}
	}
	else if(isset($_POST['CType']) && $_POST['CType']=='ST')
	{
		$qryStateList=StateList($_POST['countryID']);
		$qryStateList = $conn->query($qryStateList);
		while($objStateList =$qryStateList->fetch_assoc()){
			$StateList[]=$objStateList;
		}
		?>
		<option value="">Select</option>
		<?php
		 foreach($StateList as $state){
	?>
	<option value="<?php echo $state['id']; ?>"><?php echo $state['state_name']; ?></option>
	<?php }
	}
	else if(isset($_POST['CType']) && $_POST['CType']=='CT')
	{	
		$qryCityList=CityList($_POST['stateID']);
		$qryCityList = $conn->query($qryCityList);
		while($objCityList =$qryCityList->fetch_assoc()){
			$CityList[]=$objCityList;
		}
		?>
		<option value="">Select</option>
		<?php
		 foreach($CityList as $city){
	?>
	<option value="<?php echo $city['id']; ?>"><?php echo $city['city_name']; ?></option>
	<?php }
	}
	else if(isset($_POST['CType']) && $_POST['CType']=='EC')
	{
		$qryEmailexist=Emailexist($_POST['emailID']);
		$qryEmailexist = $conn->query($qryEmailexist);
		while($objEmailexist =$qryEmailexist->fetch_assoc()){
			$Emailexist=$objEmailexist;
		}
			echo ($Emailexist['existcount']);exit;
	}
	else
	{
		
		if($_POST['txtEmail']!='' && $_POST['txtOPassword']!='' && $_POST['ddlGrade']!='' && $_POST['txtCouponcode']!='')
		{
			 
			$rdGender="M";
			if($_POST['rdGender']=="M"){$rdGender="M";}else{$rdGender="F";}
			// Generate two salts (both are numerical)
			$salt1 = mt_rand(1000,9999999999);
			$salt2 = mt_rand(100,999999999);

			// Append our salts to the password
			$salted_pass = $salt1.$_POST['txtOPassword'].$salt2;
			// Generate a salted hash
			$pwdhash = sha1($salted_pass);
			// Place into an array
			$salt1 = $salt1;
			$salt2 = $salt2;
			$password = $pwdhash;

			$city = '';
			$academy = '';
			$address='';
			$dob='';
			$pincode='';
			$Couponcode=$_POST['txtCouponcode'];
			
			$qryEmailexist=Emailexist($_POST['txtEmail']);
			$qryEmailexist = $conn->query($qryEmailexist);
			while($objEmailexist =$qryEmailexist->fetch_assoc()){
				$Emailexist=$objEmailexist;
			}
			
			if($Emailexist['existcount']==0)
			{
				
				$qrycoupon=GetCouponCodeDetailsnew($Couponcode);
				$execoupon = $conn->query($qrycoupon);
				while($objcoupon =$execoupon->fetch_assoc()){
					$arrcoupon=$objcoupon;
				}
				//echo "<pre>";print_r($arrcoupon);exit;
				if($arrcoupon['iscouponvalid']==1)
				{ 
					$qryapplycoupon=applycouponnew($Couponcode);
					$exeapplycoupon= $conn->query($qryapplycoupon);
					while($objapplycoupon=$exeapplycoupon->fetch_assoc())
					{
						$couponcheck=$objapplycoupon;
					} 
					
					if($arrcoupon['coupon_valid_times']==0)
					{ // User can use many time
						$isallow =1;
					}
					else if($arrcoupon['coupon_valid_times']>0 && $couponcheck['iscouponvalid']==1)
					{ // Restricted Use
						
						if($couponcheck['iscouponvalid']==1)
						{
							$isallow =1;
						}
						else
						{
							$isallow =0;
						}
					}
					else
					{
						$isallow =0;
					} 
					if($isallow==1)
					{ 
						$uploaddir = 'user_proofs/';
						$imageFileType = pathinfo(basename(basename($_FILES["txtUID"]["name"])),PATHINFO_EXTENSION);
						$uploadfile = $uploaddir .$_POST['txtEmail'].".".$imageFileType;

						$isfileuploaded='Not Uploaded';
						if (move_uploaded_file($_FILES['txtUID']['tmp_name'], $uploadfile))
						{
							$isfileuploaded='Uploaded';
							//echo "File is valid, and was successfully uploaded.\n";
						} else 
						{
							$isfileuploaded='Not Uploaded';
							//echo "Possible file upload attack!\n";
						}
			 
						 
						$qryinsertRegister="CALL InsertRegister('".$_POST['txtFName']."','".$_POST['txtLName']."','".$_POST['txtEmail']."','".$password."','".$dob."','".$_POST['txtSchool']."','".$_POST['ddlState']."','".$city."','".$_POST['txtMobile']."','".$contest_id."','".$contest_level_id."','".$_POST['ddlGrade']."','".$pincode."','".$address."','".$rdGender."','".$_POST['ddlCountry']."','".$salt1."','".$salt2."','".$city."','".$academy."','".$_POST['txtOPassword']."','".$Couponcode."')";

						$qryinsertRegister = $conn->query($qryinsertRegister);
						while($objinsertRegister =$qryinsertRegister->fetch_assoc()){ 
						$insertRegister=$objinsertRegister;
						}

						if($insertRegister['resp']>0)
						{
							mysqli_free_result($qryinsertRegister);
							mysqli_next_result($conn); 

							//echo $insertRegister['resp'];echo "<br/>";
							$qryUserDetails=UserDetails($insertRegister['resp']);
							$qryUserDetails = $conn->query($qryUserDetails);
							while($row = $qryUserDetails->fetch_assoc())
							{
								$userdetails=$row;
							}
						 
							$discount_start_date = $userdetails['created_on']; 
							$cdate = date('YmdHis', strtotime($discount_start_date));
							 

							$to=$_POST['txtEmail'];
							//$baseurl="https://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
							$subject = 'Super Brain Challenge - Registration confirmation';
							$message = '<table align="center" width="800px" border="1" cellspacing="0" cellpadding="0" style="font-size:medium;margin-right:auto;margin-left:auto;border:1px solid rgb(197,197,197);font-family:Arial,Helvetica,sans-serif;background-image:initial;background-repeat:initial">
							<tbody>
							<tr style="display:block;overflow:hidden">
							<td style="float:left;border:0px;">
							<a href="'.$baseurl.'" target="_blank" ><img src="'.$baseurl.'/images/skillangels_logo.png" width="210"  alt="skillangels" /></a>
							</td>
							</tr>
							<tr style="padding:0px;margin:10px 42px 20px;display:block;font-size:13px;font-family:Verdana,Geneva,sans-serif;line-height:18px;text-align:justify">
							<td colspan="2" style="border:0px">
							Dear '.$_POST['txtFName'].',<br/><br/>
							Thank you for registering with Super Brain Challenge.<br/><br/>
							Click below link to complete user registration :<br/><br/>
							<a href="'.$baseurl.'/payment.php?uid='.md5($userdetails['id']).'&key='.md5($cdate).'" style="color:green" target="_blank" >Click Here</a><br/><br/>
							Wish you the Very Best!!!<br/><br/>
							Best Regards,<br/>
							Super Brain Challenge Team<br/>
							</td>
							</tr>
							<tr style="">
							<td style="text-align:center;color:#ee1b5b;border:0px;background-size:100%;background-image: url('.$baseurl.'/images/emailer/Gtecfooter.png);padding-top:20px;padding-bottom:20px;font-family: cursive;font-size: 20px;">
							</td>
							</tr>
							<tr style="display:block;overflow:hidden">
							<td style="float:left;border:0px;"></td></tr>
							</tbody>
							</table>';

							
							require 'mailer/PHPMailerAutoload.php'; 
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
							$mail->setFrom('angel@skillangels.com', 'Super Brain Challenge');
							$mail->addReplyTo('angel@skillangels.com', 'Super Brain Challenge');
							$mail->addAddress($to, ''); //to mail id
							$mail->Subject = $subject;
							$mail->msgHTML($message); 
							if (!$mail->send()){
								$msg="Mailer Error: " . $mail->ErrorInfo;
							}else{
							   $msg="success";
							}  

							 
							$arrResult=array("response"=>"1","msg"=>"Registered successfully");
							echo json_encode($arrResult);exit;
						}
					
						$arrResult=array("response"=>"0","msg"=>"Please try again...");
						echo json_encode($arrResult);exit; 
					}
					else
					{
						$arrResult=array("response"=>"0","msg"=>"Coupon code has expired");
						echo json_encode($arrResult);exit;
					}
				}
				else
				{
					$arrResult=array("response"=>"0","msg"=>"Invalid Couponcode");
					echo json_encode($arrResult);exit;
				}
			}
			else
			{
				$arrResult=array("response"=>"0","msg"=>"This E-Mail ID is already registered");
				echo json_encode($arrResult);exit;
			}
		}
		else
		{
			$arrResult=array("response"=>"0","msg"=>"Please fill the mandatory fields");
			echo json_encode($arrResult);exit;
		}	
			
}
?>
<?php 
include("db_connection.php");
include("qry/Query.php");
date_default_timezone_set('Asia/Kolkata');
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE); 
 
 
require 'mailer/PHPMailerAutoload.php';  
 
$date= date('Y-m-d',strtotime (date('Y-m-d')));
$dayname=date('l', strtotime($date));
if($dayname!='Sunday')
{
	$qryofschools=dailymailschool();
	$arrofschools = $conn->query($qryofschools);
	//echo "<pre>";print_r($arrofschools);exit;
	while($sid =$arrofschools->fetch_assoc())
	//foreach($arrofschools as $sid)
	{
		$qrycheckmailsenttoday=checkMailSentToday($sid['id']);
		$issend = $conn->query($qrycheckmailsenttoday)->fetch_assoc();
		
		if($issend['issenton']==0)
		{
			$qryRegisteredUserCount =GetRegisteredStudentCountbyschool($sid['id']);
			$arrRegisteredUserCount = $conn->query($qryRegisteredUserCount);
			$arrRegisteredUserCount1 =  $conn->query($qryRegisteredUserCount);
			$qrAllGrade =getSchoolAllGrade($sid['id']);
			$arrRegisteredUserCount2 = $conn->query($qrAllGrade);
			$qryAssessmentTakenCount=GetAssessmentTakenStudentCountbyschool($sid['id']); 
			$arrAssessmentTakenCount = $conn->query($qryAssessmentTakenCount);
			$qryFullyAssessmentTakenCount =GetFullyAssessmentTakenStudentCountbyschool($sid['id']);
			$arrFullyAssessmentTakenCount = $conn->query($qryFullyAssessmentTakenCount);
					
			$Registered=array();
			while($row =$arrRegisteredUserCount->fetch_assoc())
			//foreach($RegisteredUserCount as $row)
			{
				$Registered[$row['rowval']]=$row['RegisteredCount'];
			}
			$RegisteredUserCount=$Registered;
			
			$taken=array();
			while($row =$arrAssessmentTakenCount->fetch_assoc())
			//foreach($AssessmentTakenCount as $row)
			{
				$taken[$row['rowval']]=$row['AssessmentTaken'];
			}
			$AssessmentTakenCount=$taken;
			 		
			$Fully=array();
			while($row =$arrFullyAssessmentTakenCount->fetch_assoc())
			//foreach($FullyAssessmentTakenCount as $row)
			{
				$Fully[$row['rowval']]=$row['AssessmentFullyTaken'];
			}
			$FullyAssessmentTakenCount=$Fully;
			$message='';
			$curdate=date('d/m/Y',strtotime($date));
			$message='<div style="background-color:#fafafa;margin:1% 5%;border: 1px solid;font-family: Calibri;">
			<table style="width:100%;font-size: 14px;">
			<tbody>						
			<tr style="display:block;overflow:hidden;background: #20489c;font-size: 14px;">
			<td style="float:left;border:0px;text-align: center;padding: 10px 0px;width:33%;color: #fff;">
				<img alt="'.$baseurl.'" src="'.$baseurl.'/images/skillangels_logo.png" style="float: left;width:220px;">
			</td>
			<td style="border:0px;text-align: -webkit-auto;padding: 10px 0px;width: 67%;color: #fff;font-size: 36px;">
				Super Brain Challenge - 2019
			</td>
			</tr> 
			<tr>
				<td style="float:left;text-align: center;width: 100%;color: #20489c;font-size: 25px;">'.$sid['schoolname'].'</td>
			</tr>
			<tr style="font-size: 14px;">
				<td style="font-size: 14px;"><br/> Dear Madam / Sir,<br/><br/><br/></td>
			</tr>
			<tr style="display: block;font-size: 14px;">
				<td style="font-size: 14px;">The <strong>Super Brain Challenge - 2019</strong> is currently underway.<br/><br/></td>
			</tr>
			<tr style="display: block;font-size: 14px;">
				<td style="font-size: 14px;">As you know, SBC-2019 is an international contest, and we are pleased to report that <strong>your students have been participating enthusiastically.</strong><br/><br/></td>
			</tr>
			<tr style="display: block;font-size: 14px;">
				<td style="font-size: 14px;">Some students are yet to take the contest. We request you to encourage them to participate soon!<br/><br/></td>
			</tr>
			<tr style="display: block;font-size: 14px;">
				<td style="font-size: 14px;">For your reference, we have listed their names in the attached document.<br/><br/></td>
			</tr>
			<tr style="display: block;font-size: 14px;">
				<td style="font-size: 14px;">Let them <strong>Sharpen their skills, and nurture the genius within!</strong><br/><br/></td>
			</tr>
			 
			</tbody></table><br/>';
			$message.='<table align="center" border="1" cellspacing="0" cellpadding="0" style="border: gray;font-size:14px;margin:0px;width: 100%;padding:1% 0.5%;">			
			<thead style="background-color:#1c366b; color:#FFF;">
				<tr style="font-size: 14px;">
					<th style="padding:5px;font-weight: normal;font-size: 16px;">S.No.</th>
					<th style="padding:5px;font-weight: normal;font-size: 16px;">Grade</th>
					<th style="padding:5px;font-weight: normal;font-size: 16px;">Section</th>
					<th style="padding:5px;font-weight: normal;font-size: 16px;">Total Users</th>
					<th style="padding:5px;font-weight: normal;font-size: 16px;">User Taken SBC</th>
					<th style="padding:5px;font-weight: normal;font-size: 16px;">User Completed SBC</th>
					<th style="padding:5px;font-weight: normal;font-size: 16px;">Pending</th>
					<th style="padding:5px;font-weight: normal;font-size: 16px;">In-Complete</th>
				 </tr>
			 </thead>
				<tbody>';
				$val1=0;$val2=0;$val3=0;$val4=0;$val5=0;$i=1;				 
				while($row =$arrRegisteredUserCount1->fetch_assoc()) 
				{ 
					//echo "<pre>";print_r($RegisteredUserCount[$row['rowval']]);exit;
					if(isset($RegisteredUserCount[$row['rowval']])){$rcount=$RegisteredUserCount[$row['rowval']];}else{$rcount='0';}
					if(isset($AssessmentTakenCount[$row['rowval']])){$tcount=$AssessmentTakenCount[$row['rowval']];}else{$tcount='0';}
					if(isset($FullyAssessmentTakenCount[$row['rowval']])){$fcount=$FullyAssessmentTakenCount[$row['rowval']];}else{$fcount='0';}
					
					$pending=$rcount-$tcount;
					$Incomplete=$tcount-$fcount;
					
					$val1+=$rcount;
					$val2+=$tcount;
					$val3+=$fcount;
					$val4+=$pending;
					$val5+=$Incomplete;
					
					 $message.='<tr style="font-size: 14px;">
						<td style="padding:5px;font-weight: normal;font-size: 14px;">'.$i.'</td>
						<td style="padding:5px;font-weight: normal;font-size: 14px;">'.$row['gradename'].'</td>
						<td style="padding:5px;font-weight: normal;font-size: 14px;">'.$row['section'].'</td>
						<td style="padding:5px;font-weight: normal;font-size: 14px;">'.$rcount.'</td>
						<td style="padding:5px;font-weight: normal;font-size: 14px;">'.$tcount.'</td>
						<td style="padding:5px;font-weight: normal;font-size: 14px;">'.$fcount.'</td>
						<td style="padding:5px;font-weight: normal;font-size: 14px;">'.$pending.'</td>
						<td style="padding:5px;font-weight: normal;font-size: 14px;">'.$Incomplete.'</td>
					</tr>';	
					$i++; 
				}
				
			$message.='<tr>
						<td colspan="3" class="boldcls" style="padding:5px;font-weight: normal;font-size: 14px;">Total</td>						
						<td style="padding:5px;font-weight: normal;font-size: 14px;">'.$val1.'</td>
						<td style="padding:5px;font-weight: normal;font-size: 14px;">'.$val2.'</td>
						<td style="padding:5px;font-weight: normal;font-size: 14px;">'.$val3.'</td>
						<td style="padding:5px;font-weight: normal;font-size: 14px;">'.$val4.'</td>
						<td style="padding:5px;font-weight: normal;font-size: 14px;">'.$val5.'</td>
					</tr>			
			</tbody></table><br/>';
			$message.='<table style="display: block;font-size: 14px;"><tbody>
			<tr style="font-size: 14px;">
				<td style="font-size: 14px;">Thanks & Regards,</td>
			</tr>
			<tr style="font-size: 14px;">
				<td style="font-size: 14px;"> Priya</td>
			</tr>
			<tr style="font-size: 14px;">
				<td style="color:blue;font-size: 14px;"><i> SkillAngels</i> - <i>"We aim to Delight"</i></td>
			</tr>
			<tr style="font-size: 14px;">
				<td style="font-size: 14px;"> Customer Delight Executive  <br/> <br/></td>
			</tr>';
			$message.="<tr style='font-size: 14px;'>
				<td style='font-size: 14px;'> Edsix Brain Lab Private Limited, <br/>
				Supported by IIT Madras RTBI <br/>
				And by IIM Ahmedabad's CIIE <br/>";
			$message.='<br/>
				<a href="www.facebook.com/skillangels" title="Skillangels" >www.facebook.com/skillangels</a>
				<br/>
				(P) : +91 97880 91988
				<br/>
				URL : <a href="www.skillangels.com" title="Skillangels">www.skillangels.com</a>
				</td>
			</tr>
			</tbody>                
			</table></div>';

/** Include PHPExcel */
require_once 'excel/Classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Edsix Brain Lab")
							 ->setLastModifiedBy("Edsix Brain Lab")
							 ->setTitle("Super Brain Challenge")
							 ->setSubject("SkillAngels Super Brain Challenge - Todays Status")
							 ->setDescription("SkillAngels Super Brain Challenge - Todays Status.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Todays Status");
		$m=1;
		while($row =$arrRegisteredUserCount2->fetch_assoc())
		{
			$ini=2;
			$sheetname=$row['gradename'];
			if($m==1){$activesheet=$row['gradename'];}
			  // Add new sheet
			  $objWorkSheet = $objPHPExcel->createSheet(); //Setting index when creating
			  $objWorkSheet->setTitle("$sheetname");
			  $objPHPExcel->setActiveSheetIndexByName("$sheetname");
			  //Write cells
			  $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray(
					array(
						'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('rgb' => '5cb85c')
						),'font'  => array(
						'bold'  => true),
						'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
							'color' => array('rgb' => 'DDDDDD')
							)
						)
					)
				);
				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'S.No')
							   ->setCellValue('B1', 'Name')
							   ->setCellValue('C1', 'Username')
							   ->setCellValue('D1', 'Section')
							   ->setCellValue('E1', 'Status'); 
				$qryUnAttendtedUsers=GetUnAttendtedUsers($sid['id'],$row['grade_id']);
				$arrUnAttendtedUsers = $conn->query($qryUnAttendtedUsers);
			
				while($result =$arrUnAttendtedUsers->fetch_assoc())
				{
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$ini, $ini-1);
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$ini, $result['name']);
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$ini, $result['email']);
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$ini, $result['section']);
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$ini, "Pending");
					$ini++;
				}
				
				$qryAttendtedUsers=GetAttendtedUsers($sid['id'],$row['grade_id']);
				$arrAttendtedUsers = $conn->query($qryAttendtedUsers);
			
				while($result =$arrAttendtedUsers->fetch_assoc())
				{
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$ini, $ini-1);
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$ini, $result['name']);
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$ini, $result['email']);
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$ini, $result['section']);
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$ini, "In-Complete");
					$ini++;
				}
				
			$m++;
		}

			$objPHPExcel->removeSheetByIndex(
				$objPHPExcel->getIndex(
					$objPHPExcel->getSheetByName('Worksheet')
				)
			);
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndexByName("$activesheet");	
			PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

			/** PHPExcel_IOFactory */
			require_once 'excel/Classes/PHPExcel/IOFactory.php';

			// Save Excel 2007 file
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
			$filename = 'excel/'.$sid['schoolname'].'-'.date('Y-m-d').'.xlsx';
			$objWriter->save($filename);

			$emailarr=array();
			$a=explode(",",$sid['emailcc']);						
			foreach($a as $e)
			{
				array_push($emailarr,$e);
			}
			$subject="SkillAngels Super Brain Challenge - Todays Status";		
			
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
			$mail->setFrom('support@skillangels.com', 'SkillAngels');
			$mail->addReplyTo('support@skillangels.com', 'SkillAngels');
			foreach($emailarr as $email)
			{
			   $mail->addAddress($email,'');
			} 
			
			$mail->addBCC("priyat@skillangels.com", "Priya");		
			$mail->addBCC("damu@skillangels.com", "Damu"); 
			
			$mail->Subject = $subject;
			$mail->msgHTML($message);			
			$mail->addAttachment("/mnt/vol1/sites/skillangels/sbc/".$filename);
			
			if(!$mail->send()){
			   echo "Mailer Error: " . $mail->ErrorInfo;
			}else{
			   echo "Message sent!"."<br/>";
			}
			//echo "<pre>";print_r($mail);exit;
			$qryinsertTodayMailsentlog=InsertTodayMail($sid['id']);
			$conn->query($qryinsertTodayMailsentlog);
			
			echo $sid['schoolname']." Maill Sent successfully"."<br/>";			
		}
		else
		{
			echo $sid['schoolname']." Mail already sent for the day<br/><br/>";//exit;
		}
	}
}
else
{
	echo $sid['schoolname']." Today Sunday <br/><br/>";//exit;
}
 ?>
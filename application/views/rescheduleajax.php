<?php
include_once("db_connection.php");
include_once("qry/Query.php");
$User_ID=$_SESSION['userId'];
$contest_level_id=1;
date_default_timezone_set('Asia/Kolkata');
$rescheduledate='2017-11-12';
$starttime=$_POST['TimeSlot'].":00:00";
$endtime=date('H:i:s', strtotime($_POST['TimeSlot'].":00:00") + 1*60*60);

$qrycheckslotavailability="CALL CheckSlotAvailability('".$contest_level_id."','".$rescheduledate."','".$starttime."','".$endtime."')";
$qrycheckslotavailability = $conn->query($qrycheckslotavailability);
while($objavailability =$qrycheckslotavailability->fetch_assoc()){ 
$slotavailability=$objavailability;
}
mysqli_free_result($qrycheckslotavailability);
mysqli_next_result($conn); 
$qryiscanreschedule="CALL IsusercanReschedule(".$User_ID.")";
$qryiscanreschedule=$conn->query($qryiscanreschedule);
while($objiscan =$qryiscanreschedule->fetch_assoc()){ 
$iscan=$objiscan;
}
mysqli_free_result($qryiscanreschedule);
mysqli_next_result($conn); 
if($iscan['iscan']==1)
{
	if($slotavailability['resp']==1)
	{
		$qryupdateusertnewschedule=UpdateRescheduleDetails($User_ID,$rescheduledate,$starttime,$endtime);
		//echo $qryupdateusertnewschedule;
		$conn->query($qryupdateusertnewschedule);
		
		$qryupdateuseroldschedule=UpdateRescheduleHistoryDetails($User_ID,$_SESSION['cdate'],$_SESSION['cstartime']."-".$_SESSION['cendtime'],$rescheduledate,$starttime,$endtime);
		$conn->query($qryupdateuseroldschedule);
		echo 1;exit;
	}
	else
	{
		echo 'NS';exit;
	}
}
else
{
	echo 0;exit;
}
// echo $contestdate."==".$startime."==".$endtime;exit;
?>
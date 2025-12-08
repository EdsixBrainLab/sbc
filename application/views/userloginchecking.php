<?php
include_once("db_connection.php");
include("qry/Query.php");
date_default_timezone_set('Asia/Kolkata');
if (!empty($_POST))
{
	$type=$_POST['type'];
	if($type=='ISUSER')
	{	
		$username=$_POST['user_name'];
		$pwd=$_POST['User_PWD'];
		
		$qryislogin=islogin($username,$pwd);/* echo $qryislogin;exit; */
		$arrisuser=$conn->query($qryislogin);
		while($row = $arrisuser->fetch_assoc()){
			$islogin=$row["islogin"];
		}
		mysqli_close($conn);
		if($islogin==0)
		{
			echo 0;
		}
		else
		{
			echo 2;exit; // You are logging into another system
		}
	}
	if($type=='ISLOGIN')
	{
		$username=$_POST['user_name'];
		$pwd=$_POST['User_PWD'];
		$sql =LoginCheck($username,$pwd);
		$result = $conn->query($sql);
		//echo "<pre>";print_r($result->fetch_assoc());
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc()) 
			{
				$ErrMsg="success";
				$_SESSION["userId"]=$row["userid"];
				$_SESSION["name"]=$row["first_name"]." ".$row["last_name"];
				$_SESSION["gradeid"]=$row["grade_id"];
				$_SESSION["gp_id"]=$row["gp_id"];
				$_SESSION["mobile"]=$row["mobile"];
				$_SESSION["email"]=$row["email"];
				if($row["sid"]==3)
				{
					$_SESSION["schoolname"]=$row["school_name"];
				}
				else
				{
					$_SESSION["schoolname"]=$row["schoolname"];
				}
				$_SESSION["asid"]=$row["sid"];
				$_SESSION["gradename"]=$row["gradename"];
				$_SESSION["section"]=$row["section"];
				$_SESSION["conteststartdate"]=$row["startdatetime"];
				$_SESSION["contestenddate"]=$row["enddatetime"];
				
				
				$conteststartdate=$row["startdatetime"];
				$contestenddate=$row["enddatetime"];
				 
				$contestenddate=strtotime($_SESSION["contestenddate"]);
				$currentDate=strtotime(date('Y-m-d H:i:s'));
				if($contestenddate>=$currentDate)
				{
					$_SESSION["isexpired"]='1';
				}
				else
				{
					$_SESSION["isexpired"]='0';
				}
				/* if($row["sid"]==58){
					$_SESSION["contestenddate"]='2018-08-30';
				}
				else if($row["sid"]==2){
					$_SESSION["contestenddate"]='2018-11-01';
				}else{
					$_SESSION["contestenddate"]='2017-12-06';
				} */
			}
			//echo "<pre>";print_r($_SESSION);exit;
			/* $sqlcs =CheckContestStatus($_SESSION["userId"]);
			$arrres = $conn->query($sqlcs);
			if ($arrres->num_rows > 0) {
				while($row = $arrres->fetch_assoc()) {
					$_SESSION["conteststartdate"]=$row["contestdate"];
					$conteststartdate=$row["contestdate"];
				}
			}  */
			/* Generate Unique ID */
			$uniqueId =$_SESSION["userId"]."".date("YmdHis")."".round(microtime(true) * 1000);
			$_SESSION['login_session_id']=$uniqueId;
			/* Get IpAddress */
			 if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			 $ip=$_SERVER['HTTP_CLIENT_IP'];}
			 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			 {
				$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			 }
			 else
			 {
				$ip=$_SERVER['REMOTE_ADDR'];
			 }  
			
			$update_loginDetails=update_loginDetails($_SESSION["userId"],$uniqueId);
			$conn->query($update_loginDetails);
			
			/* User Login log */
			$qryloginlog=insert_login_log($_SESSION["userId"],$uniqueId,$ip,$_POST['txcountry'],$_POST['txregion'],$_POST['txcity'],$_POST['txisp'],$_SERVER['HTTP_USER_AGENT'],1);
			$conn->query($qryloginlog);
			/* User Login log */
			
			
			$curdatetime=date('Y-m-d H:i:s');
			$time_one = new DateTime($conteststartdate);
			$time_two = new DateTime($curdatetime);
			$contestdate=$time_one->getTimestamp()- $time_two->getTimestamp();
			mysqli_close($conn);
			//echo $contestdate."==".$curdatetime;exit;
			if($contestdate>0)
			{ 
				echo "COUNTDOWN";exit;
			}
			else
			{	
				echo "PROFILE";exit;
			}
			/* ------ Decide Before/After Contest Page Redirection END */
		}
		else
		{
			mysqli_close($conn);
			echo 0;exit;
		}
	}
	if($type=='ISACTIVE')
	{
		$qryupdateuseractivetime=UpdateUserActiveTime($_SESSION["userId"]);
		$conn->query($qryupdateuseractivetime);
		/* Update user Login log */
			$qryloginlog=update_login_log($_SESSION["userId"],$_SESSION['login_session_id']);
			$conn->query($qryloginlog);
		/*Update User Login log */
			
		$qryuserisalive=isuseralive($_SESSION["userId"],$_SESSION['login_session_id']);
		
		$arrisalive=$conn->query($qryuserisalive);
		
		while($row = $arrisalive->fetch_assoc()) 
		{
			$isalive=$row['isalive'];
		}
		mysqli_close($conn);
		if($isalive!=1)
		{ 
			unset($_SESSION['userId']); // will delete just the name data
			session_write_close();
			session_regenerate_id(true);
			echo 1;exit;
		}
		else
		{
			echo 0;exit;
		}
	}
	if($type=='ISEXPIRED')
	{
		// Check The Contest date and time was expired or not 
		if($_POST['isactive']<0)
		{
			 $qryisexpired=CheckIsExpired($_SESSION["userId"]);
			 $arrisexpired=$conn->query($qryisexpired);
			 while($objisexpired= $arrisexpired->fetch_assoc()){
				$isexp=$objisexpired;
			 }
			if($isexp['expired']==0)
			{
				 $qryofexpire=CheckContestExpiredorNot($_SESSION["userId"]);
				 $arrofexpire = $conn->query($qryofexpire);
				 while($objofexpire= $arrofexpire->fetch_assoc()){
					$isexpired=$objofexpire;
				 }
mysqli_close($conn);
				 echo $isexpired['conteststatus'];exit;
			}
			else
			{
mysqli_close($conn);
				echo 1;exit;
			}
			
		}
		else
		{
mysqli_close($conn);
			echo 1;exit;
		}
	}
}

?>
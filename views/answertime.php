<?php include("counterconnection.php");
      $query = "SELECT  SUM(gtime) as gtime_total , SUM(correct_answer) as gtime_total_ans,SUM(attempted_question) as gtime_total_att FROM counters 
	  WHERE gtime IS NOT NULL AND correct_answer IS NOT NULL "; 	 
      $result = mysql_query($query);	
		while($row = mysql_fetch_array($result)){                                               
			 $gtime_total =  $row['gtime_total'];
			 $gtime_total_ans =  $row['gtime_total_ans'];
			 $gtime_total_att =  $row['gtime_total_att'];
		}	

$arrdata=array('gtime'=>$gtime_total,'tot_ans'=> $gtime_total_ans,'tot_att'=>$gtime_total_att);
echo json_encode($arrdata);	exit;
		

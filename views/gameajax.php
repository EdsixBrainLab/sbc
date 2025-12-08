<?php
include_once("db_connection.php");
include("qry/Query.php");


		$gameurl =  $_POST['gameurl']; 
		$gname = substr($gameurl, strrpos($gameurl, '/') + 1);
	//	$gamename = str_replace('.html','', $gname); 
		$gamename = str_replace('games.php?gamename=','', $gname); 
		$qryuserassignedgame=CheckIsUserAssignedGame($gamename,$_SESSION["gradeid"],$_SESSION['userId']);
		$arruserassignedgame = $conn->query($qryuserassignedgame);
		while($row = $arruserassignedgame->fetch_assoc()) {
			$userassignedgame=$row;
		 }
		$IsUserAssignedGame=$userassignedgame['userassignedgame']; 
		$qrygamestatus=CheckGameAlreadyPlayed($gamename,$_SESSION['userId']);
		$arrgamestatus = $conn->query($qrygamestatus);
		while($row = $arrgamestatus->fetch_assoc()) {
			$gameplayedstatus=$row;
		}
		/* echo $gameplayedstatus['played']."==".$gameplayedstatus['gameover']."==".$IsUserAssignedGame;exit; */
		if($gameplayedstatus['played']!='YES' && $gameplayedstatus['gameover']!='YES' && $IsUserAssignedGame!=0)
		{
			echo 'ALLOW';exit;
		}
		else{echo 'IA'; exit;}
		


?>
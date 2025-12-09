<?php
$baseurl = base_url();
$isexpired['conteststatus']=$this->session->isexpired;

// User Skill Game Scores - Memory

$Mscore=array();
//echo '<pre>'; print_r($vp);
if(count($mem)>0)
{
	$intRows=0;
	foreach($mem as $row)
	{
		$TotalScore+=$row["score"];
		$Mscore[]=$row;
	}
}
else {
   if ($ErrorFlag == "Y") echo "0 results";
}



// User Skill Game Scores - vp
$VPscore=array();
if(count($vp)>0)
{
	$intRows=0;
	foreach($vp as $row)
	{
		$TotalScore+=$row["score"];
		$VPscore[]=$row;
	}
}
else {
   if ($ErrorFlag == "Y") echo "0 results";
}

// User Skill Game Scores - FA
$FAscore=array();
if(count($fa)>0)
{
	$intRows=0;
	foreach($fa as $row)
	{
		$TotalScore+=$row["score"];
		$FAscore[]=$row;
	}
}
else {
   if ($ErrorFlag == "Y") echo "0 results";
}

// User Skill Game Scores - PS
$PSscore=array();
if(count($ps)>0)
{
	$intRows=0;
	foreach($ps as $row)
	{
		$TotalScore+=$row["score"];
		$PSscore[]=$row;
	}
}
else {
   if ($ErrorFlag == "Y") echo "0 results";
}


// User Skill Game Scores - LI
$LIscore=array();
if(count($ling)>0)
{
	$intRows=0;
	foreach($ling as $row)
	{
		$TotalScore+=$row["score"];
		$LIscore[]=$row;
	}
}
else {
   if ($ErrorFlag == "Y") echo "0 results";
}

$ContestDate =$SlotDate;//StudentDetails[0].ContestDate;
$ContestSlot =$SlotTime; //StudentDetails[0].ContestSlot;
$UserID =$User_ID;
$UserContestLevelID =$UserContestLevelID;

$MemoryColor=array(
array('classApply'=>'memoryColor','content'=>'','Totaltip'=>''),
array('classApply'=>'memoryColor','content'=>'','Totaltip'=>''),
array('classApply'=>'memoryColor','content'=>'','Totaltip'=>''),
array('classApply'=>'memoryColor','content'=>'','Totaltip'=>''),
array('classApply'=>'memoryColor','content'=>'','Totaltip'=>''),
array('classApply'=>'memoryColor','content'=>'','Totaltip'=>''),
array('classApply'=>'memoryColor','content'=>'','Totaltip'=>''),
array('classApply'=>'memoryColor','content'=>'','Totaltip'=>''),
array('classApply'=>'memoryColor','content'=>'','Totaltip'=>''),
array('classApply'=>'memoryColor','content'=>'','Totaltip'=>''));	


$vpColor=array(
array('classApply'=>'VPColor','content'=>'','Totaltip'=>''),
array('classApply'=>'VPColor','content'=>'','Totaltip'=>''),
array('classApply'=>'VPColor','content'=>'','Totaltip'=>''),
array('classApply'=>'VPColor','content'=>'','Totaltip'=>''),
array('classApply'=>'VPColor','content'=>'','Totaltip'=>''),
array('classApply'=>'VPColor','content'=>'','Totaltip'=>''),
array('classApply'=>'VPColor','content'=>'','Totaltip'=>''),
array('classApply'=>'VPColor','content'=>'','Totaltip'=>''),
array('classApply'=>'VPColor','content'=>'','Totaltip'=>''),
array('classApply'=>'VPColor','content'=>'','Totaltip'=>''));

$faColor=array(
array('classApply'=>'FAColor','content'=>'','Totaltip'=>''),
array('classApply'=>'FAColor','content'=>'','Totaltip'=>''),
array('classApply'=>'FAColor','content'=>'','Totaltip'=>''),
array('classApply'=>'FAColor','content'=>'','Totaltip'=>''),
array('classApply'=>'FAColor','content'=>'','Totaltip'=>''),
array('classApply'=>'FAColor','content'=>'','Totaltip'=>''),
array('classApply'=>'FAColor','content'=>'','Totaltip'=>''),
array('classApply'=>'FAColor','content'=>'','Totaltip'=>''),
array('classApply'=>'FAColor','content'=>'','Totaltip'=>''),
array('classApply'=>'FAColor','content'=>'','Totaltip'=>''));	
$psColor=array(
array('classApply'=>'PSColor','content'=>'','Totaltip'=>''),
array('classApply'=>'PSColor','content'=>'','Totaltip'=>''),
array('classApply'=>'PSColor','content'=>'','Totaltip'=>''),
array('classApply'=>'PSColor','content'=>'','Totaltip'=>''),
array('classApply'=>'PSColor','content'=>'','Totaltip'=>''),
array('classApply'=>'PSColor','content'=>'','Totaltip'=>''),
array('classApply'=>'PSColor','content'=>'','Totaltip'=>''),
array('classApply'=>'PSColor','content'=>'','Totaltip'=>''),
array('classApply'=>'PSColor','content'=>'','Totaltip'=>''),
array('classApply'=>'PSColor','content'=>'','Totaltip'=>''));	

$liColor=array(
array('classApply'=>'LIColor','content'=>'','Totaltip'=>''),
array('classApply'=>'LIColor','content'=>'','Totaltip'=>''),
array('classApply'=>'LIColor','content'=>'','Totaltip'=>''),
array('classApply'=>'LIColor','content'=>'','Totaltip'=>''),
array('classApply'=>'LIColor','content'=>'','Totaltip'=>''),
array('classApply'=>'LIColor','content'=>'','Totaltip'=>''),
array('classApply'=>'LIColor','content'=>'','Totaltip'=>''),
array('classApply'=>'LIColor','content'=>'','Totaltip'=>''),
array('classApply'=>'LIColor','content'=>'','Totaltip'=>''),
array('classApply'=>'LIColor','content'=>'','Totaltip'=>''));	

$AverageScore=$TotalScore/5;
$TotalQuestion=10;
$MTotalQuestions=10;$VPTotalQuestions=10;$FATotalQuestions=10;$PSTotalQuestions=10;$LITotalQuestions=10;
$MAttemptedQuestions=0;
$VPAttemptedQuestions =0;
$FAAttemptedQuestions=0;
$PSAttemptedQuestions=0;
$LIAttemptedQuestions=0;

$MCorrectQuestions=0;$VPCorrectQuestions=0;$FACorrectQuestions=0;$PSCorrectQuestions=0;$LICorrectQuestions=0;


if(!empty($Mscore)){if(count($Mscore)<=10){$MAttemptedQuestions=count($Mscore);}else{$MAttemptedQuestions=10;}}else{$MAttemptedQuestions=0;}

if(!empty($VPscore)){if(count($VPscore)<=10){$VPAttemptedQuestions=count($VPscore);}else{$VPAttemptedQuestions=10;}}else{$VPAttemptedQuestions=0;}

if(!empty($FAscore)){if(count($FAscore)<=10){$FAAttemptedQuestions=count($FAscore);}else{$FAAttemptedQuestions=10;}}else{$FAAttemptedQuestions=0;}

if(!empty($PSscore)){if(count($PSscore)<=10){$PSAttemptedQuestions=count($PSscore);}else{$PSAttemptedQuestions=10;}}else{$PSAttemptedQuestions=0;}

if(!empty($LIscore)){if(count($LIscore)<=10){$LIAttemptedQuestions=count($LIscore);}else{$LIAttemptedQuestions=10;}}else{$LIAttemptedQuestions=0;}

$MemoryAttemptedQuestions=!empty($Mscore) ? count($Mscore): 0;
$VPAttemptedQuestions1=!empty($VPscore) ? count($VPscore): 0;
$FAAttemptedQuestions1=!empty($FAscore) ? count($FAscore): 0;
$PSAttemptedQuestions1=!empty($PSscore) ? count($PSscore): 0;
$LIAttemptedQuestions1=!empty($LIscore) ? count($LIscore): 0;


$MemoryScorechart=10 * $MemoryAttemptedQuestions;
$VisualProcessingScorechart=10 * $VPAttemptedQuestions1;
$FocusAttentionScorechart=10 * $FAAttemptedQuestions1;
$ProblemSolvingScorechart=10 * $PSAttemptedQuestions1;
$LinguisticsScorechart=10 * $LIAttemptedQuestions1;


$MemoryScore= 0;
$VisualProcessingScore= 0;
$FocusandAttentionScore= 0;
$ProblemSolvingScore= 0;
$LinguisticsScore= 0;

$MemoryPlayStatus="MColor-border";	
$VPPlayStatus="VPColor-border";
$FAPlayStatus="FAColor-border"; 
$PSPlayStatus="PSColor-border";
$LIPlayStatus="LIColor-border"; 

$MPlayNow="";	
$VPPlayNow="";
$FAPlayNow=""; 
$PSPlayNow="";
$LIPlayNow=""; 

//echo "<pre>";print_r($GameDetails);exit;
$MPlayText="Play Now";
$VPPlayText="Play Now";
$FAPlayText="Play Now";
$PSPlayText="Play Now";
$LIPlayText="Play Now";
foreach($GameDetails as $arr)
{	//echo "<pre>";print_r($arr);exit;
	if($arr['Skill_ID']==1)
	{	
		$MMGameType=$arr['Skill_Name'];
		$MMGameID=$arr['Skill_ID'];
		$MMGameImage=$arr['Game_Icon_Path'];
		$MMGameUrl=$arr['gameurl'];
		$MMGameName=$arr['Game_Name'];
		$MMGame_ID=$arr['Game_ID'];
		$MMSkillDescription=$arr['Skill_Description'];
		$MMGameDescription=$arr['Game_Description'];
		
		if ($TotalQuestion==$MAttemptedQuestions)
		{
			$MGamePlayStatus="Completed";
			$MPlaytooltipstatus="Played";
			$MPlayText="Played";
			$MGamePlayStatusIcon="statusCompletedIcon";
			$MGamePlayLink="#";
			$MemoryPlayStatus="MColor";
			$MPlayNow="not-active";
		}
		if ($MAttemptedQuestions===0)
		{
			$MPlaytooltipstatus="Start";
			$MPlayText="Play Now";
			if($isexpired['conteststatus']==1){$MGamePlayStatus="Yet to Play"; }else{$MGamePlayStatus="Time Expired"; }
			$MGamePlayStatusIcon="statusNotPlayIcon";//$MGamePlayLink="playgame.php?user_id=".$UserID."&skill_id=1&game_id=".$arr['Game_ID']."&contest_lid=".$UserContestLevelID;
			$MGamePlayLink=$baseurl."assets/swf/1/".$MMGameUrl;			
		}
		if (($MAttemptedQuestions<$TotalQuestion) && ($MAttemptedQuestions>0))
		{
			
			$MGamePlayStatus="In-complete";
			$MGamePlayStatusIcon="statusInCompletedIcon";//$MGamePlayLink="playgame.php?user_id=".$UserID."&skill_id=1&game_id=".$arr['Game_ID']."&contest_lid=".$UserContestLevelID;
			$MGamePlayLink=$baseurl."assets/swf/1/".$MMGameUrl;
			
			if(isset($Mscore[count($Mscore)-1]['timervalue']) && ($Mscore[count($Mscore)-1]['timervalue']>0))
			{
				$MPlaytooltipstatus="Questions Left ".($TotalQuestion-$MAttemptedQuestions)." Time Left ".$Mscore[count($Mscore)-1]['timervalue']; 	
				$MPlayText="Continue";
			}
			else
			{
				$MGamePlayLink="#";
				$MPlaytooltipstatus="Attempted Questions"+$MAttemptedQuestions;
				$MPlayText="Time Over";
				$MemoryPlayStatus="MColor";
				$MPlayNow="not-active";	
				//alert('set tooltip with game over');		

			}
		}

	}
	else if($arr['Skill_ID']==2)
	{	
		$VPGameType= $arr['Skill_Name'];
		$VPGameImage= $arr['Game_Icon_Path'];
		$VPGameName= $arr['Game_Name'];
		$VPGameurl=$arr['gameurl'];
		$VPGame_ID= $arr['Game_ID'];
		$VPSkillDescription= $arr['Skill_Description'];
		$VPGameDescription= $arr['Game_Description'];
		
		if($TotalQuestion==$VPAttemptedQuestions)
		{
			$VPGamePlayStatus="Completed";
			$VPPlaytooltipstatus="Played";
			$VPPlayText="Played";
			$VPGamePlayStatusIcon="statusCompletedIcon";			
			$VPPlayStatus="VPColor";			
			$VPGamePlayLink="#";
			$VPPlayNow="not-active";
		}
		if ($VPAttemptedQuestions===0)
		{
			$VPPlaytooltipstatus="Start";
			$VPPlayText="Play Now";
			if($isexpired['conteststatus']==1){ $VPGamePlayStatus="Yet to Play"; } else { $VPGamePlayStatus = "Time Expired"; }
			$VPGamePlayStatusIcon="statusNotPlayIcon";			//$VPGamePlayLink="playgame.php?user_id=".$UserID."&skill_id=2&game_id=".$arr['Game_ID']."&contest_lid=".$UserContestLevelID;
			$VPGamePlayLink=$baseurl."assets/swf/1/".$VPGameurl;
		}
		if (($VPAttemptedQuestions<$TotalQuestion) && ($VPAttemptedQuestions>0))
		{
			
			$VPGamePlayStatus="In-complete";
			$VPGamePlayStatusIcon="statusInCompletedIcon";//$VPGamePlayLink="playgame.php?user_id=".$UserID."&skill_id=2&game_id=".$arr['Game_ID']."&contest_lid=".$UserContestLevelID;
			$VPGamePlayLink=$baseurl."assets/swf/1/".$VPGameurl;
			
			if (isset($VPscore[count($VPscore)-1]['timervalue']) && ($VPscore[count($VPscore)-1]['timervalue']>0))
			{
				$VPPlaytooltipstatus="Questions Left ".($TotalQuestion-$VPAttemptedQuestions)." Time Left ".$VPscore[count($VPscore)-1]['timervalue'];
				$VPPlayText="Continue";
			}
			else
			{
				$VPGamePlayLink="#";
				$VPPlaytooltipstatus="Attempted Questions"+$VPAttemptedQuestions;
				$VPPlayText="Time Over";
				$VPPlayStatus="VPColor";
				$VPPlayNow="not-active";
			}
		}
			
	}
	else if($arr['Skill_ID']==3)
	{
		$FAGameType=$arr['Skill_Name'];
		$FAGameImage=$arr['Game_Icon_Path'];
		$FAGameName=$arr['Game_Name'];
		$FAGameurl=$arr['gameurl'];
		$FAGame_ID=$arr['Game_ID'];
		$FASkillDescription=$arr['Skill_Description'];
		$FAGameDescription=str_replace('~','`',$arr['Game_Description']);
		
		if ($TotalQuestion==$FAAttemptedQuestions)
		{
			$FAGamePlayStatus="Completed";
			$FAPlaytooltipstatus="Played";
			$FAPlayText="Played";
			$FAGamePlayStatusIcon="statusCompletedIcon";
			$FAPlayStatus="FAColor";
			$FAGamePlayLink="#";
			$FAPlayNow="not-active";
		}
		if($FAAttemptedQuestions===0)
		{
			$FAPlaytooltipstatus="Start";
			$FAPlayText="Play Now";
			if($isexpired['conteststatus']==1){ $FAGamePlayStatus="Yet to Play"; } else { $FAGamePlayStatus="Time Expired"; }
			$FAGamePlayStatusIcon="statusNotPlayIcon";			//$FAGamePlayLink="playgame.php?user_id=".$UserID."&skill_id=3&game_id=".$arr['Game_ID']."&contest_lid=".$UserContestLevelID;
			$FAGamePlayLink=$baseurl."assets/swf/1/".$FAGameurl;
		}
		if (($FAAttemptedQuestions<$TotalQuestion) && ($FAAttemptedQuestions>0))
		{
			
			$FAGamePlayStatus="In-complete";
			$FAGamePlayStatusIcon="statusInCompletedIcon";//$FAGamePlayLink="playgame.php?user_id=".$UserID."&skill_id=3&game_id=".$arr['Game_ID']."&contest_lid=".$UserContestLevelID;
			$FAGamePlayLink=$baseurl."assets/swf/1/".$FAGameurl;
			
			if (isset($FAscore[count($FAscore)-1]['timervalue']) && ($FAscore[count($FAscore)-1]['timervalue']>0))
			{
				$FAPlaytooltipstatus="Questions Left ".($TotalQuestion - $FAAttemptedQuestions)." Time Left ".$FAscore[count($FAscore)-1]['timervalue'];
				$FAPlayText="Continue";
				
			}
			else
			{
				$FAGamePlayLink="#";
				$FAPlaytooltipstatus="Attempted Questions".$FAAttemptedQuestions;
				$FAPlayText="Time Over";
				$FAPlayStatus="FAColor";
				$FAPlayNow="not-active";
			}
		}
		
	}	
	else if($arr['Skill_ID']==4)
	{	
		$PSGameType= $arr['Skill_Name'];
		$PSGameImage= $arr['Game_Icon_Path'];
		$PSGameName= $arr['Game_Name'];
		$PSGameurl= $arr['gameurl'];
		$PSGame_ID= $arr['Game_ID'];
		$PSSkillDescription= $arr['Skill_Description'];
		$PSGameDescription= $arr['Game_Description'];
		
		if ($TotalQuestion==$PSAttemptedQuestions)
		{
			$PSGamePlayStatus="Completed";
			$PSPlaytooltipstatus="Played";
			$PSPlayText="Played";
			$PSGamePlayStatusIcon="statusCompletedIcon";
			$PSPlayStatus="PSColor";
			$PSGamePlayLink="#";
			$PSPlayNow="not-active";
		}
		if ($PSAttemptedQuestions===0)
		{
			$PSPlaytooltipstatus="Start";
			$PSPlayText="Play Now";
			if($isexpired['conteststatus']==1){ $PSGamePlayStatus="Yet to Play"; } else { $PSGamePlayStatus = "Time Expired"; }
			$PSGamePlayStatusIcon="statusNotPlayIcon";			//$PSGamePlayLink="playgame.php?user_id=".$UserID."&skill_id=4&game_id=".$arr['Game_ID']."&contest_lid=".$UserContestLevelID;
			$PSGamePlayLink=$baseurl."assets/swf/1/".$PSGameurl;
		}
		if (($PSAttemptedQuestions<$TotalQuestion) && ($PSAttemptedQuestions>0))
		{
			$PSGamePlayStatus="In-complete";
			$PSGamePlayStatusIcon="statusInCompletedIcon";//$PSGamePlayLink="playgame.php?user_id=".$UserID."&skill_id=4&game_id=".$arr['Game_ID']."&contest_lid=".$UserContestLevelID;
			$PSGamePlayLink=$baseurl."assets/swf/1/".$PSGameurl;
			
			if (isset($PSscore[count($PSscore)-1]['timervalue']) && ($PSscore[count($PSscore)-1]['timervalue']>0))
			{
				$PSPlaytooltipstatus="Questions Left ".($TotalQuestion-$PSAttemptedQuestions)." Time Left ".$PSscore[count($PSscore)-1]['timervalue'];
				$PSPlayText="Continue";
			}
			else
			{
				$PSGamePlayLink="#";
				$PSPlaytooltipstatus="Attempted Questions".$PSAttemptedQuestions;
				$PSPlayText="Time Over";
				$PSPlayStatus="PSColor";
				$PSPlayNow="not-active";
			}
		}
	}
	else if($arr['Skill_ID']==5)
	{
		$LIGameType= $arr['Skill_Name'];
		$LIGameImage= $arr['Game_Icon_Path'];
		$LIGameName= $arr['Game_Name'];
		$LIGameurl= $arr['gameurl'];
		$LIGame_ID= $arr['Game_ID'];
		$LISkillDescription= $arr['Skill_Description'];
		$LIGameDescription= $arr['Game_Description'];
		
		if ($TotalQuestion==$LIAttemptedQuestions)
		{
			$LIGamePlayStatus="Completed";
			$LIPlaytooltipstatus="Played";
			$LIPlayText="Played";
			$LIGamePlayStatusIcon="statusCompletedIcon";
			$LIPlayStatus="LIColor";
			$LIGamePlayLink="#";
			$LIPlayNow="not-active";
		}
		if ($LIAttemptedQuestions===0)
		{
			$LIPlaytooltipstatus="Start";
			$LIPlayText="Play Now";
			if($isexpired['conteststatus']==1){$LIGamePlayStatus="Yet to Play"; } else {  $LIGamePlayStatus="Time Expired";}
			$LIGamePlayStatusIcon="statusNotPlayIcon";//$LIGamePlayLink="playgame.php?user_id=".$UserID."&skill_id=5&game_id=".$arr['Game_ID']."&contest_lid=".$UserContestLevelID;
			$LIGamePlayLink=$baseurl."assets/swf/1/".$LIGameurl;
		}
		if (($LIAttemptedQuestions<$TotalQuestion) && ($LIAttemptedQuestions>0))
		{
			
			$LIGamePlayStatus="In-complete";
			$LIGamePlayStatusIcon="statusInCompletedIcon";			//$LIGamePlayLink="playgame.php?"."user_id=".$UserID."&skill_id=5&game_id=".$arr['Game_ID']."&contest_lid=".$UserContestLevelID;
			$LIGamePlayLink=$baseurl."assets/swf/1/".$LIGameurl;
			
			if (isset($LIscore[count($LIscore)-1]['timervalue']) && ($LIscore[count($LIscore)-1]['timervalue']>0))
			{
				$LIPlaytooltipstatus="Questions Left ".($TotalQuestion-$LIAttemptedQuestions)." Time Left ".$LIscore[count($LIscore)-1]['timervalue']; 	
				$LIPlayText="Continue";
			}
			else
			{
				$LIGamePlayLink="#";
				$LIPlaytooltipstatus="Attempted Questions".$LIAttemptedQuestions;
				$LIPlayText="Time Over";
				$LIPlayStatus="LIColor";
				$LIPlayNow="not-active";
			}
		}
	}
}


// Game performance starts here
/*ME*/
for ($i = 0;$i < 10;$i++)
{
	$MemoryColor[$i]['classApply']='';
	$MemoryColor[$i]['content']='';
}
for ($i = 0;$i<count($Mscore);$i++)
{
//---To Calculate Score-----
if(isset($Mscore[$i]['score']) && $Mscore[$i]['score']!='')
{
	$MemoryScore=$MemoryScore + $Mscore[$i]['score'];
}

//-------- GamePerformance Memory Status
$MemoryColor[$i]['classApply']='';
$MemoryColor[$i]['content']='';
if(isset($Mscore[$i]['score'])){
$MemoryColor[$i]['Totaltip']=$Mscore[$i]['score'];
}
else
{
	$MemoryColor[$i]['Totaltip']='';
}

if(isset($Mscore[$i]['status']) && ($Mscore[$i]['status']=='Correct'))
{
$MemoryColor[$i]['classApply']='memoryColor';
$MCorrectQuestions=$MCorrectQuestions+1;}
//--------$in-Correct--------
if(isset($Mscore[$i]['status']) && $Mscore[$i]['status']=='In-correct')
{	

$MemoryColor[$i]['content']='x';

}
//--------Un-attended-- Blank------	
if(isset($Mscore[$i]['status']) && $Mscore[$i]['status']== 'Un-attended')
{	
$MemoryColor[$i]['content']='';
}
if($i===9)
{
break;
}
}

/* VP */
for ($i = 0; $i < 10; $i++)
{
$vpColor[$i]['classApply']='';
$vpColor[$i]['content']='';
}
for ($i = 0; $i <count($VPscore); $i++)
{
//---To Calculate Score-----
if(isset($VPscore[$i]['score']) && $VPscore[$i]['score'] != '')
{
$VisualProcessingScore=$VisualProcessingScore+$VPscore[$i]['score'];
}
//-------- GamePerformance Memory Status
$vpColor[$i]['classApply']='';
$vpColor[$i]['content']='';
if(isset($VPscore[$i]['score'])){
$vpColor[$i]['Totaltip']=$VPscore[$i]['score'];
}
else{$vpColor[$i]['Totaltip']='';}

if(isset($VPscore[$i]['status']) && $VPscore[$i]['status']=='Correct')
{
$vpColor[$i]['classApply']='VPColor';
$VPCorrectQuestions=$VPCorrectQuestions+1;
}
//--------$in-Correct--------
if(isset($VPscore[$i]['status']) && $VPscore[$i]['status'] == 'In-correct')
{	

$vpColor[$i]['content']='x';

}
//--------Un-attended-- Blank------	
if(isset($VPscore[$i]['status']) && $VPscore[$i]['status']== 'Un-attended')
{	
	$vpColor[$i]['content']='';
}
if ($i===9)
{
break;
}
}

for ($i = 0; $i < 10; $i++)
{
$faColor[$i]['classApply']='';
$faColor[$i]['content']='';
}
for ($i=0; $i <count($FAscore);$i++)
{
//---To Calculate Score-----

if(isset($FAscore[$i]['score']) && $FAscore[$i]['score'] != '')
{
$FocusandAttentionScore+=$FAscore[$i]['score'];
}
//-------- GamePerformance faColor Status
$faColor[$i]['classApply']='';
$faColor[$i]['content']='';
$faColor[$i]['Totaltip']='';
if(isset($FAscore[$i]['score']))
{
$faColor[$i]['Totaltip']=$FAscore[$i]['score'];
}
else{$faColor[$i]['Totaltip']='';}

if(isset($FAscore[$i]['status']) && $FAscore[$i]['status']== 'Correct')
{
$faColor[$i]['classApply']='FAColor';
$FACorrectQuestions=$FACorrectQuestions+1;
}
//--------In-Correct--------
if(isset($FAscore[$i]['status']) && $FAscore[$i]['status']== 'In-correct')
{	
	$faColor[$i]['content']='x';
}
//--------Un-attended-- Blank------	
if(isset($FAscore[$i]['status']) && $FAscore[$i]['status']== 'Un-attended')
{	$faColor[$i]['content']='';	
		
}
if ($i===9)
{
break;
}
}

for ($i = 0; $i < 10; $i++)
{
$psColor[$i]['classApply']='';
$psColor[$i]['content']='';
}	
for ($i=0;$i<count($PSscore);$i++)
{
//---To Calculate Score-----

if(isset($PSscore[$i]['score']) && $PSscore[$i]['score'] != '')
$ProblemSolvingScore+=$PSscore[$i]['score'];
//-------- GamePerformance faColor Status
$psColor[$i]['classApply']='';
$psColor[$i]['content']='';
if(isset($PSscore[$i]['score']))
{ $psColor[$i]['Totaltip']=$PSscore[$i]['score'];
}
else{$psColor[$i]['Totaltip']='';
}

if(isset($PSscore[$i]['status']) && $PSscore[$i]['status']=='Correct')
{
	$psColor[$i]['classApply']='PSColor';
	$PSCorrectQuestions=$PSCorrectQuestions+1;
}

//--------In-Correct--------
if(isset($PSscore[$i]['status']) && $PSscore[$i]['status']== 'In-correct')
{	
	$psColor[$i]['content']='x';
}
//--------Un-attended-- Blank------	
if(isset($PSscore[$i]['status']) && $PSscore[$i]['status']=='Un-attended')
{	
	$psColor[$i]['content']='';
}
if ($i===9)
{
break;
}
}


for ($i=0;$i<10;$i++)
{
$liColor[$i]['classApply']='';
$liColor[$i]['content']='';
}
for ($i=0;$i<count($LIscore);$i++)
{
//---To Calculate Score-----

if(isset($LIscore[$i]['score']) && $LIscore[$i]['score']!= '')
$LinguisticsScore+=$LIscore[$i]['score'];
//-------- GamePerformance l$iColor Status
$liColor[$i]['classApply']='';
$liColor[$i]['content']='';
if(isset($LIscore[$i]['score'])){
$liColor[$i]['Totaltip']=$LIscore[$i]['score'];
}else{$liColor[$i]['Totaltip']='';
}
if(isset($LIscore[$i]['status']) && $LIscore[$i]['status']=='Correct')
{
	$liColor[$i]['classApply']='LIColor';
	$LICorrectQuestions=$LICorrectQuestions+1;
}
//--------In-Correct--------
if(isset($LIscore[$i]['status']) && $LIscore[$i]['status']=='In-correct')
{	
	$liColor[$i]['content']='x';
}
//--------Un-attended-- Blank------	
if(isset($LIscore[$i]['status']) && $LIscore[$i]['status']=='Un-attended')
{	
	$liColor[$i]['content']='';
}
if ($i===9)
{
	break;
}
} 

$starsWon=0;

$MemoryStars=array(
array(
"Star1"=>"NoStar",
"Star2"=>"NoStar",
"Star3"=>"NoStar",
"Star4"=>"NoStar",
"Star5"=>"NoStar",
"Star6"=>"NoStar",
"Star7"=>"NoStar",
"Star8"=>"NoStar",
"Star9"=>"NoStar",
"Star10"=>"NoStar")
);

if($MemoryScore>0 ) {$MemoryStars[0]['Star1']="memoryStar";$starsWon=$starsWon+1;}
if($MemoryScore>10) {$MemoryStars[0]['Star2']="memoryStar";$starsWon=$starsWon+1;}
if($MemoryScore>20) {$MemoryStars[0]['Star3']="memoryStar";$starsWon=$starsWon+1;}
if($MemoryScore>30 ) {$MemoryStars[0]['Star4']="memoryStar";$starsWon=$starsWon+1;}
if($MemoryScore>40 ) {$MemoryStars[0]['Star5']="memoryStar";$starsWon=$starsWon+1;}
if($MemoryScore>50 ) {$MemoryStars[0]['Star6']="memoryStar";$starsWon=$starsWon+1;}
if($MemoryScore>60 ) {$MemoryStars[0]['Star7']="memoryStar";$starsWon=$starsWon+1;}
if($MemoryScore>70 ) {$MemoryStars[0]['Star8']="memoryStar";$starsWon=$starsWon+1;}
if($MemoryScore>80 ) {$MemoryStars[0]['Star9']="memoryStar";$starsWon=$starsWon+1;}
if($MemoryScore>90 ) {$MemoryStars[0]['Star10']="memoryStar";$starsWon=$starsWon+1;}



$VisualProcessingStars=array(
array(
"Star1"=>"NoStar",
"Star2"=>"NoStar",
"Star3"=>"NoStar",
"Star4"=>"NoStar",
"Star5"=>"NoStar",
"Star6"=>"NoStar",
"Star7"=>"NoStar",
"Star8"=>"NoStar",
"Star9"=>"NoStar",
"Star10"=>"NoStar"
));

if($VisualProcessingScore>0 ) {$VisualProcessingStars[0]['Star1']="VPStar1";$starsWon=$starsWon+1;}
if($VisualProcessingScore>10) {$VisualProcessingStars[0]['Star2']="VPStar1";$starsWon=$starsWon+1;}
if($VisualProcessingScore>20) {$VisualProcessingStars[0]['Star3']="VPStar1";$starsWon=$starsWon+1;}
if($VisualProcessingScore>30 ) {$VisualProcessingStars[0]['Star4']="VPStar1";$starsWon=$starsWon+1;}
if($VisualProcessingScore>40 ) {$VisualProcessingStars[0]['Star5']="VPStar1";$starsWon=$starsWon+1;}
if($VisualProcessingScore>50 ) {$VisualProcessingStars[0]['Star6']="VPStar1";$starsWon=$starsWon+1;}
if($VisualProcessingScore>60 ) {$VisualProcessingStars[0]['Star7']="VPStar1";$starsWon=$starsWon+1;}
if($VisualProcessingScore>70 ) {$VisualProcessingStars[0]['Star8']="VPStar1";$starsWon=$starsWon+1;}
if($VisualProcessingScore>80 ) {$VisualProcessingStars[0]['Star9']="VPStar1";$starsWon=$starsWon+1;}
if($VisualProcessingScore>90 ) {$VisualProcessingStars[0]['Star10']="VPStar1";$starsWon=$starsWon+1;}

$FocusandAttentionStars=array(
array(
"Star1"=>"NoStar",
"Star2"=>"NoStar",
"Star3"=>"NoStar",
"Star4"=>"NoStar",
"Star5"=>"NoStar",
"Star6"=>"NoStar",
"Star7"=>"NoStar",
"Star8"=>"NoStar",
"Star9"=>"NoStar",
"Star10"=>"NoStar"
));
if($FocusandAttentionScore>0 ) {$FocusandAttentionStars[0]['Star1']="FAStar1";$starsWon=$starsWon+1;}
if($FocusandAttentionScore>10) {$FocusandAttentionStars[0]['Star2']="FAStar1";$starsWon=$starsWon+1;}
if($FocusandAttentionScore>20) {$FocusandAttentionStars[0]['Star3']="FAStar1";$starsWon=$starsWon+1;}
if($FocusandAttentionScore>30 ) {$FocusandAttentionStars[0]['Star4']="FAStar1";$starsWon=$starsWon+1;}
if($FocusandAttentionScore>40 ) {$FocusandAttentionStars[0]['Star5']="FAStar1";$starsWon=$starsWon+1;}
if($FocusandAttentionScore>50 ) {$FocusandAttentionStars[0]['Star6']="FAStar1";$starsWon=$starsWon+1;}
if($FocusandAttentionScore>60 ) {$FocusandAttentionStars[0]['Star7']="FAStar1";$starsWon=$starsWon+1;}
if($FocusandAttentionScore>70 ) {$FocusandAttentionStars[0]['Star8']="FAStar1";$starsWon=$starsWon+1;}
if($FocusandAttentionScore>80 ) {$FocusandAttentionStars[0]['Star9']="FAStar1";$starsWon=$starsWon+1;}
if($FocusandAttentionScore>90 ) {$FocusandAttentionStars[0]['Star10']="FAStar1";$starsWon=$starsWon+1;}


$ProblemSolvingStars=array(
array(
"Star1"=>"NoStar",
"Star2"=>"NoStar",
"Star3"=>"NoStar",
"Star4"=>"NoStar",
"Star5"=>"NoStar",
"Star6"=>"NoStar",
"Star7"=>"NoStar",
"Star8"=>"NoStar",
"Star9"=>"NoStar",
"Star10"=>"NoStar"
)
);
if($ProblemSolvingScore>0 ) {$ProblemSolvingStars[0]['Star1']="PSStar1";$starsWon=$starsWon+1;}
if($ProblemSolvingScore>10) {$ProblemSolvingStars[0]['Star2']="PSStar1";$starsWon=$starsWon+1;}
if($ProblemSolvingScore>20) {$ProblemSolvingStars[0]['Star3']="PSStar1";$starsWon=$starsWon+1;}
if($ProblemSolvingScore>30 ) {$ProblemSolvingStars[0]['Star4']="PSStar1";$starsWon=$starsWon+1;}
if($ProblemSolvingScore>40 ) {$ProblemSolvingStars[0]['Star5']="PSStar1";$starsWon=$starsWon+1;}
if($ProblemSolvingScore>50 ) {$ProblemSolvingStars[0]['Star6']="PSStar1";$starsWon=$starsWon+1;}
if($ProblemSolvingScore>60 ) {$ProblemSolvingStars[0]['Star7']="PSStar1";$starsWon=$starsWon+1;}
if($ProblemSolvingScore>70 ) {$ProblemSolvingStars[0]['Star8']="PSStar1";$starsWon=$starsWon+1;}
if($ProblemSolvingScore>80 ) {$ProblemSolvingStars[0]['Star9']="PSStar1";$starsWon=$starsWon+1;}
if($ProblemSolvingScore>90 ) {$ProblemSolvingStars[0]['Star10']="PSStar1";$starsWon=$starsWon+1;}



$LinguisticsStars=array(
array(
"Star1"=>"NoStar",
"Star2"=>"NoStar",
"Star3"=>"NoStar",
"Star4"=>"NoStar",
"Star5"=>"NoStar",
"Star6"=>"NoStar",
"Star7"=>"NoStar",
"Star8"=>"NoStar",
"Star9"=>"NoStar",
"Star10"=>"NoStar"
));
if($LinguisticsScore>0 ) {$LinguisticsStars[0]['Star1']="linguisticsStar1";$starsWon=$starsWon+1;}
if($LinguisticsScore>10) {$LinguisticsStars[0]['Star2']="linguisticsStar1";$starsWon=$starsWon+1;}
if($LinguisticsScore>20) {$LinguisticsStars[0]['Star3']="linguisticsStar1";$starsWon=$starsWon+1;}
if($LinguisticsScore>30 ) {$LinguisticsStars[0]['Star4']="linguisticsStar1";$starsWon=$starsWon+1;}
if($LinguisticsScore>40 ) {$LinguisticsStars[0]['Star5']="linguisticsStar1";$starsWon=$starsWon+1;}
if($LinguisticsScore>50 ) {$LinguisticsStars[0]['Star6']="linguisticsStar1";$starsWon=$starsWon+1;}
if($LinguisticsScore>60 ) {$LinguisticsStars[0]['Star7']="linguisticsStar1";$starsWon=$starsWon+1;}
if($LinguisticsScore>70 ) {$LinguisticsStars[0]['Star8']="linguisticsStar1";$starsWon=$starsWon+1;}
if($LinguisticsScore>80 ) {$LinguisticsStars[0]['Star9']="linguisticsStar1";$starsWon=$starsWon+1;}
if($LinguisticsScore>90 ) {$LinguisticsStars[0]['Star10']="linguisticsStar1";$starsWon=$starsWon+1;}

$memoryStars=array(
array('classApply'=> $MemoryStars[0]['Star1']),
array('classApply'=> $MemoryStars[0]['Star2']),
array('classApply'=> $MemoryStars[0]['Star3']),
array('classApply'=> $MemoryStars[0]['Star4']),
array('classApply'=> $MemoryStars[0]['Star5']),
array('classApply'=> $MemoryStars[0]['Star6']),
array('classApply'=> $MemoryStars[0]['Star7']),
array('classApply'=> $MemoryStars[0]['Star8']),
array('classApply'=> $MemoryStars[0]['Star9']),
array('classApply'=> $MemoryStars[0]['Star10'])
);

$vpStar= array(
array('classApply'=>$VisualProcessingStars[0]['Star1']),
array('classApply'=>$VisualProcessingStars[0]['Star2']),
array('classApply'=>$VisualProcessingStars[0]['Star3']),
array('classApply'=>$VisualProcessingStars[0]['Star4']),
array('classApply'=>$VisualProcessingStars[0]['Star5']),
array('classApply'=>$VisualProcessingStars[0]['Star6']),
array('classApply'=>$VisualProcessingStars[0]['Star7']),
array('classApply'=>$VisualProcessingStars[0]['Star8']),
array('classApply'=>$VisualProcessingStars[0]['Star9']),
array('classApply'=>$VisualProcessingStars[0]['Star10'])
);

$faStar=array(
array('classApply'=>$FocusandAttentionStars[0]['Star1']),
array('classApply'=>$FocusandAttentionStars[0]['Star2']),
array('classApply'=>$FocusandAttentionStars[0]['Star3']),
array('classApply'=>$FocusandAttentionStars[0]['Star4']),
array('classApply'=>$FocusandAttentionStars[0]['Star5']),
array('classApply'=>$FocusandAttentionStars[0]['Star6']),
array('classApply'=>$FocusandAttentionStars[0]['Star7']),
array('classApply'=>$FocusandAttentionStars[0]['Star8']),
array('classApply'=>$FocusandAttentionStars[0]['Star9']),
array('classApply'=>$FocusandAttentionStars[0]['Star10'])
);
	
$psStar=array(
array('classApply'=>$ProblemSolvingStars[0]['Star1']),
array('classApply'=>$ProblemSolvingStars[0]['Star2']),
array('classApply'=>$ProblemSolvingStars[0]['Star3']),
array('classApply'=>$ProblemSolvingStars[0]['Star4']),
array('classApply'=>$ProblemSolvingStars[0]['Star5']),
array('classApply'=>$ProblemSolvingStars[0]['Star6']),
array('classApply'=>$ProblemSolvingStars[0]['Star7']),
array('classApply'=>$ProblemSolvingStars[0]['Star8']),
array('classApply'=>$ProblemSolvingStars[0]['Star9']),
array('classApply'=>$ProblemSolvingStars[0]['Star10'])
);
 $liStar=array(
array('classApply'=>$LinguisticsStars[0]['Star1']),
array('classApply'=>$LinguisticsStars[0]['Star2']),
array('classApply'=>$LinguisticsStars[0]['Star3']),
array('classApply'=>$LinguisticsStars[0]['Star4']),
array('classApply'=>$LinguisticsStars[0]['Star5']),
array('classApply'=>$LinguisticsStars[0]['Star6']),
array('classApply'=>$LinguisticsStars[0]['Star7']),
array('classApply'=>$LinguisticsStars[0]['Star8']),
array('classApply'=>$LinguisticsStars[0]['Star9']),
array('classApply'=>$LinguisticsStars[0]['Star10'])
);


$MemoryTotalScore=$MemoryScore;
$VisualProcessingTotalScore=$VisualProcessingScore;
$FocusandAttentionTotalScore=$FocusandAttentionScore; 
$ProblemSolvingTotalScore=$ProblemSolvingScore;
$LinguisticsTotalScore=$LinguisticsScore;


$MTotalQuestions=$MTotalQuestions;
$MAttemptedQuestions=$MAttemptedQuestions;
$MCorrectQuestions=$MCorrectQuestions;

$VPTotalQuestions=$VPTotalQuestions;
$VPAttemptedQuestions=$VPAttemptedQuestions;
$VPCorrectQuestions=$VPCorrectQuestions;

$FATotalQuestions=$FATotalQuestions;
$FAAttemptedQuestions=$FAAttemptedQuestions;
$FACorrectQuestions=$FACorrectQuestions;  

$PSTotalQuestions=$PSTotalQuestions;
$PSAttemptedQuestions=$PSAttemptedQuestions;
$PSCorrectQuestions=$PSCorrectQuestions; 


$LITotalQuestions=$LITotalQuestions;
$LIAttemptedQuestions=$LIAttemptedQuestions;
$LICorrectQuestions=$LICorrectQuestions;


?>
<div id="wrapper">
<div class="container">
<!--MY Report starts here-->
<div class="MyReportsPager pageHomePagerHide Dashboardhide mygameshide  myprofilehide">
            <div class="portal-shell">
            <div class="portal-hero" style="margin-bottom:18px;">
                <div>
                    <div class="portal-hero__eyebrow">Report</div>
                    <h1>Skill Performance</h1>
                    <p>Your latest SkillAngels breakdown across all abilities.</p>
                </div>
                <div class="portal-hero__pill">
                    <span class="fa fa-star" aria-hidden="true"></span>
                    <div>
                        <strong>Brain Skill Power Index</strong><br>
                        <small><?php echo $AverageScore; ?> points</small>
                    </div>
                </div>
            </div>
            <div class="report-spotlight">
                <div class="report-tile">
                    <small>Games attempted</small>
                    <strong><?php echo $MAttemptedQuestions + $VPAttemptedQuestions + $FAAttemptedQuestions + $PSAttemptedQuestions + $LIAttemptedQuestions; ?></strong>
                    <p class="subtitle">Keep playing to unlock more insights.</p>
                </div>
                <div class="report-tile">
                    <small>Skills measured</small>
                    <strong>5 skills</strong>
                    <p class="subtitle">Memory, Visual, Focus, Problem Solving, Linguistics.</p>
                </div>
                <div class="report-tile">
                    <small>Brain Skill Power Index</small>
                    <strong><?php echo $AverageScore; ?></strong>
                    <p class="subtitle">Average of all your skill scores.</p>
                </div>
            </div>
            <div class="report-layout">
                <div class="report-card">
                    <h3>Skill Scores</h3>
                    <div class="skill-score-row">
                        <span class="label">Memory</span>
                        <span class="value-pill"><?php echo $MemoryTotalScore; ?>%</span>
                    </div>
                    <div class="progress-bar-modern"><span style="width:<?php if($MemoryTotalScore<=5){ echo '5'; } else { echo $MemoryTotalScore; } ?>%"></span></div>

                    <div class="skill-score-row">
                        <span class="label">Visual Processing</span>
                        <span class="value-pill"><?php echo $VisualProcessingTotalScore; ?>%</span>
                    </div>
                    <div class="progress-bar-modern"><span style="width:<?php if($VisualProcessingTotalScore<=5){ echo '5'; } else { echo $VisualProcessingTotalScore; } ?>%"></span></div>

                    <div class="skill-score-row">
                        <span class="label">Focus and Attention</span>
                        <span class="value-pill"><?php echo $FocusandAttentionTotalScore; ?>%</span>
                    </div>
                    <div class="progress-bar-modern"><span style="width:<?php if($FocusandAttentionTotalScore<=5){ echo '5'; } else { echo $FocusandAttentionTotalScore; } ?>%"></span></div>

                    <div class="skill-score-row">
                        <span class="label">Problem Solving</span>
                        <span class="value-pill"><?php echo $ProblemSolvingTotalScore; ?>%</span>
                    </div>
                    <div class="progress-bar-modern"><span style="width:<?php if($ProblemSolvingTotalScore<=5){ echo '5'; } else { echo $ProblemSolvingTotalScore; } ?>%"></span></div>

                    <div class="skill-score-row">
                        <span class="label">Linguistics</span>
                        <span class="value-pill"><?php echo $LinguisticsTotalScore; ?>%</span>
                    </div>
                    <div class="progress-bar-modern"><span style="width:<?php if($LinguisticsTotalScore<=5){ echo '5'; } else { echo $LinguisticsTotalScore; } ?>%"></span></div>
                </div>
                <div class="report-card">
                    <h3 style="display:flex;align-items:center;gap:8px;">
                        <a style="top:-3px;position:relative;" href="javascript:;" data-toggle="tooltip" data-placement="top" data-html="true" title='<div class=""><span style="font-size:12px;">Your BSPI score reflects <br/>the average score<br/> of the five cognitive skills.</span></div>'><i  style="color:#1f7096; font-size:16px;" class="fa fa-info-circle"></i></a>
                        Brain Skill Power Index
                    </h3>
                    <div class="progress-bar-modern" aria-label="Brain Skill Power Index" style="margin-bottom:14px;">
                        <span style="width:<?php echo $AverageScore; ?>%;"></span>
                    </div>
                    <div class="panel panel-default" style="border:0;box-shadow:none;">
                        <div class="panel-body reportChartContainer" style="padding:0;">
                            <div id="chart-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--my report ends here-->

<!-- skill performance starts here -->

<div class="SkillPerformancePager pageHomePagerHide DashboardPager MyReportsPager MyGamesPager myprofilehide">
	   <div class="skillPerformanceContainer">
    	<div class="row">
                	<!--<div class="col-lg-3 col-md-6 superBrainWrapper">-->
                    	<!--<div class="superBrainContainer">
                    		<h3>Assessment Date</h3>
                            <i class="fa fa-clock-o roundClock"></i> 
                        	<p>
							<span> Date :</span><?php echo $ContestDate; ?>
							</p>
							<br>
							 
                        </div> -->
                        <!--<div class="playStatusContainer">
                        	<h3>Game Play Status</h3>
                            <a href="javascript:;" class="btn btn-default btn-circle" data-toggle="tooltip" data-placement="right" data-html="true" title="Empty circle indicates the game is not played or incomplete. Filled Circle indicates the game is completed"><i class="fa fa-info"></i></a>-->
							<!--<button type="button" class="btn btn-default btn-circle"><a href="javascript:;" data-toggle="tooltip" data-placement="top" data-html="true" title='<div class=""><span style="font-size:12px;">Empty circle indicates the game is not played or incomplete.</span></div>'><i class="fa fa-info"></i></a></button>-->
                            <!--<ul>
						
                            	<li>M<span class="<?php echo $MemoryPlayStatus; ?>"></span></li>
                                <li>VP<span class="<?php echo $VPPlayStatus; ?>"></span></li>
                                <li>FA<span class="<?php echo $FAPlayStatus; ?>"></span></li>
                                <li>PS<span class="<?php echo $PSPlayStatus; ?>"></span></li>
                                <li>LI<span class="<?php echo $LIPlayStatus; ?>"></span></li>
                            </ul>
                        </div>
                    </div>-->
                    <div class="col-lg-4 col-md-6">
                    	<h3>My Skill Pie</h3>
                  <div class="performanceBox">
							<div id="container" class="pieChartContainer"></div>
                            <ul class="chartLegend col-lg-4 col-md-2">
                            	<li><span class="MColor"></span>Memory</li>
                                <li><span class="VPColor"></span>Visual Processing</li>
                                <li><span class="FAColor"></span>Focus and Attention</li> 
                            </ul>
							<ul class="chartLegend col-lg-4 col-md-2">
                                <li><span class="PSColor"></span>Problem Solving</li>
                                <li><span class="LIColor"></span>Linguistics</li>
                            </ul>
                        </div>
                    </div>
<div class="col-lg-4 col-md-6 boxBorder">
<h3>My Game Performance</h3>
	<ul class="gamePerformanceChat">
		<li><span class="gamePerformanceHead">Q</span>
		<div class="gamePerformanceInner">
		<span>1</span>
		<span>2</span>
		<span>3</span>
		<span>4</span>
		<span>5</span>
		<span>6</span>
		<span>7</span>
		<span>8</span>
		<span>9</span>
		<span>10</span>
		</div>
		</li>
		<li><span class="gamePerformanceHead">M</span>
		<div class="gamePerformanceInner">
		<?php foreach($MemoryColor as $r1){ ?>
		<span class="<?php echo $r1['classApply']; ?> viewMoreBtn" title="Score: <?php echo $r1['Totaltip']; ?>"> <?php echo $r1['content']; ?></span>
		<?php } ?>
		</div>
		</li>
		<li><span class="gamePerformanceHead">VP</span>
		<div class="gamePerformanceInner">
		<?php foreach($vpColor as $r2){ ?>
			<span class="<?php echo $r2['classApply']; ?> viewMoreBtn" title="Score: <?php echo $r2['Totaltip']; ?>"><?php echo $r2['content']; ?></span>
		<?php } ?>
		</div>                            	
		</li>
		<li><span class="gamePerformanceHead">FA</span>
		<div class="gamePerformanceInner">
		<?php foreach($faColor as $r3){ ?>
			<span class="<?php echo $r3['classApply']; ?> viewMoreBtn" title="Score: <?php echo  $r3['Totaltip']; ?>"><?php echo $r3['content']; ?></span>
		<?php } ?>
		</div>
		</li>
		<li><span class="gamePerformanceHead">PS</span>
		<div class="gamePerformanceInner">
		<?php foreach($psColor as $r4){ ?>
			<span class="<?php echo $r4['classApply']; ?> viewMoreBtn" title="Score: <?php echo  $r4['Totaltip']; ?>"><?php echo  $r4['content']; ?></span>
		<?php } ?>
		</div>
		</li>
		<li><span class="gamePerformanceHead">LI</span>
		<div class="gamePerformanceInner">  
		<?php foreach($liColor as $r5){ ?>
			<span class="<?php echo $r5['classApply']; ?> viewMoreBtn"  title="Score:<?php echo $r5['Totaltip']; ?>"><?php echo $r5['content']; ?></span>
		<?php } ?>

		</div>
		</li>
	</ul>
	<ul class="gamePerformanceStatus">
		<li><span class="Correct"></span>Correct</li>
		<li><span class="Unattended"></span>Unattended</li>
		<li><span class="InCorrect">x</span>InCorrect</li>
	</ul>
</div>
<div class="col-lg-4 col-md-6 boxBorder performanceBoxContainer">
<h3>Congrats! You have won</h3>
<div class="performanceBox" >

<div>
<div class="starsWonBg"><?php echo $starsWon; ?></div>
</div>
<!-- <div class="starsWonBg">{{starsWon}}</div> -->
</div>
</div>
</div>
</div>
</div>
<!---Skill performance ends here-->

</div>
<!-- Footer starts here-->
<?php include_once('footer.php'); ?>
<!-- Footer end here-->

<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            polar: true,
			events: {
            load: function(event) {
               $("text").html('');
			   $(".highcharts-legend-item").hide();
			   $(".highcharts-button").hide();
            }
        } 
        },

        title: {
            text: ''
        },

        pane: {
            startAngle: 0,
            endAngle: 360
        },
		       
        xAxis: {
            tickInterval: 45,
            min: 0,
            max: 360,
            labels: {
                formatter: function () {
                    return '';
                }
            }
        },

        yAxis: {
            min: 0,
			max:100
        },

        plotOptions: {
            series: {
                pointStart: 0,
                pointInterval: 72
            },
            column: {
                pointPadding: 0,
                groupPadding: 0
            }
        },

        series: [{
            type: 'column',
            name: 'Percentage completed',
            data: [<?php echo $MemoryScorechart; ?>,<?php echo $VisualProcessingScorechart; ?>,<?php echo $FocusAttentionScorechart; ?>,<?php echo $ProblemSolvingScorechart; ?>,<?php echo $LinguisticsScorechart; ?>],
            pointPlacement: 'between',
			tooltip: {
                valueSuffix: ' %'
            }
        }]
    });
});

</script>
<script type="text/javascript">

FusionCharts.ready(function () {
	
    var csatGauge = new FusionCharts({
        "type": "angulargauge",
        "renderAt": "chart-container",
        "width": "100%",
        "height": "250",
        "dataFormat": "json",
            "dataSource": {
    "chart": {
        "caption": "",
        "lowerlimit": "0",
        "upperlimit": "100",
        "lowerlimitdisplay": "0",
        "upperlimitdisplay": "100",
        "palette": "1",
        "numbersuffix": "",
        "tickvaluedistance": "10",
        "showvalue": "0",
        "gaugeinnerradius": "0",
        "bgcolor": "FFFFFF",
        "pivotfillcolor": "333333",
        "pivotradius": "8",
        "pivotfillmix": "333333, 333333",
        "pivotfilltype": "radial",
        "pivotfillratio": "0,100",
        "showtickvalues": "1",
        "showborder": "0"
    },
    "colorrange": {
        "color": [
            {
                "minvalue": "0",
                "maxvalue": "20",
                "code": "c01f25"
            },
			{
                "minvalue": "20",
                "maxvalue": "40",
                "code": "f36621"
            },
			{
                "minvalue": "40",
                "maxvalue": "60",
                "code": "fdc010"
            },
			{
                "minvalue": "60",
                "maxvalue": "80",
                "code": "94c953"
            },
			
            {
                "minvalue": "80",
                "maxvalue": "100",
                "code": "00b04e"
            }
        ]
    },
	
	
	
    "dials": {
        "dial": [
            {
                "value": "<?php echo $AverageScore ?>",
                "rearextension": "15",
                "radius": "100",
                "bgcolor": "333333",
                "bordercolor": "333333",
                "basewidth": "8"
            }
        ]
    }
}
      });

    csatGauge.render();
	
	
});


/* FusionCharts.ready(function () {
	
    var csatGauge = new FusionCharts({
        "type": "angulargauge",
        "renderAt": "chart-container",
        "width": "400",
        "height": "250",
        "dataFormat": "json",
            "dataSource": {
    "chart": {
        "caption": "",
        "lowerlimit": "0",
        "upperlimit": "100",
        "lowerlimitdisplay": "0",
        "upperlimitdisplay": "100",
        "palette": "1",
        "numbersuffix": "",
        "tickvaluedistance": "10",
        "showvalue": "0",
        "gaugeinnerradius": "0",
        "bgcolor": "FFFFFF",
        "pivotfillcolor": "333333",
        "pivotradius": "8",
        "pivotfillmix": "333333, 333333",
        "pivotfilltype": "radial",
        "pivotfillratio": "0,100",
        "showtickvalues": "1",
        "showborder": "0"
    },
    "colorrange": {
        "color": [
            {
                "minvalue": "0",
                "maxvalue": "<?php echo $AverageScore+.5 ?>",
                "code": "e44a00"
            },
            {
                "minvalue": "<?php echo $AverageScore+1 ?>",
                "maxvalue": "100",
                "code": "#B0B0B0"
            }
        ]
    },
	
	
	
    "dials": {
        "dial": [
            {
                "value": "<?php echo $AverageScore ?>",
                "rearextension": "15",
                "radius": "100",
                "bgcolor": "333333",
                "bordercolor": "333333",
                "basewidth": "8"
            }
        ]
    }
}
      });

    csatGauge.render();
	
	
}); */
//alert(csatGauge.dataSource.dials);
</script><script>$(function () {   $('[data-toggle="tooltip"]').tooltip();});</script><style>.tooltip {background-color:transparent !important;opacity:1 }.tooltip-inner {max-width:320px;text-align: inherit;}.section_two{height:90px;}.tooltip-inner {    background-color:#ffffbc;    color: #000;    border: 3px solid #dede71;    border-radius: 10px;}.tooltip.in{opacity:1 !important}
.starsWonBg{letter-spacing : 2px;}
</style>
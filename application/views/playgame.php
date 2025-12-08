<?php
include_once("db_connection.php");
include("qry/Query.php");


$userid=$_GET['user_id'];
$skillid=$_GET["skill_id"];
$gameid=$_GET["game_id"];
$contestlid=$_GET["contest_lid"];

$sql =QuestionCount($userid,$skillid,$gameid,$contestlid);
$qn1="";
$result = $conn->query($sql);
//echo "Callaghan";
if ($result->num_rows > 0) {
    // output data of each row

	$intRows=0;

    while($row = $result->fetch_assoc()) {
		
	
		$qn1=$row['qcount1'];
	    
			//echo $qn1; 
		
	}

}else {
    echo "0 results";
}

$sql=GamePath($gameid);
$gamepath="";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

	$intRows=0;

    while($row = $result->fetch_assoc()) {
		
	
		$gamepath="swf/1/".$row['gamename'];
	    //echo $gamepath;
			
		
	}

}
else {
    echo "0 results";
}

$conn->close();

//$gamepath = "assets/swf/AbsentAlphabet.html";
?>



<html>
<title>SkillAngels</title>
<body>
<object width="800" height="600" scrolling=no>
    <param name="movie"   value="<?php echo $gamepath.".html"; ?>">
    <embed width=100% height=100% src="<?php echo $gamepath.".html"; ?>"  >
    </embed>
<param name="flashvars" value="tn=<?php echo $qn1;?>"/>
</object>
</body>
</html>

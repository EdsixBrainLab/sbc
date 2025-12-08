<?php
if (substr($_SERVER['HTTP_HOST'], 0, 4) === 'www.') {
    header('Location: http'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 's':'').'://' . substr($_SERVER['HTTP_HOST'], 4).$_SERVER['REQUEST_URI']);
    exit;
}
date_default_timezone_set('Asia/Kolkata');
$servername = "localhost";
$username = "root";
$password = "";
$database='sbc2019';
$ErrorFlag = "N";
// Create connection
$conn = new mysqli($servername, $username, $password,$database,"3306");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else
{	
	session_start();
}

$baseurl=sprintf("%s://%s%s",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',$_SERVER['SERVER_NAME'],dirname($_SERVER['PHP_SELF']));

?>
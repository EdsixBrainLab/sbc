<?php 
error_reporting(0);
include('headerinner.php'); ?>
<?php 

$qryupdateislogin=UpdateIsLogin($_SESSION['userId']);
$conn->query($qryupdateislogin);
$qryuserlogoutlog=update_logout_log($_SESSION["userId"],$_SESSION['login_session_id']);
$conn->query($qryuserlogoutlog);

?>
<body>
<h2>You have been logged out...<h2>
<?php 

unset($_SESSION['userId']); // will delete just the name data
session_write_close();
session_regenerate_id(true);

?>
</body>
<?php include('footer.php'); ?>
<script type="text/javascript">
<?php if(!isset($_SESSION['userId'])){?>
	window.location.href="index.php";
<?php } ?>
</script>
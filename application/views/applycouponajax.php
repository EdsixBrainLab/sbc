<?php 
include("db_connection.php");
include("qry/Query.php");

$couponcode = $_POST['couponcode']; 
$userid =  $_POST['userid']; 
$qryplandetails =PlanDetails(); //echo "<br/>".$qryplandetails;
$qryplandetails = $conn->query($qryplandetails);
while($row =$qryplandetails->fetch_assoc()){
	$data['plandetails'][]=$row;
}

$qryapplycouponcode=Applycouponcode($couponcode); //echo "<br/>".$qryapplycouponcode;exit;
$qryapplycouponcode = $conn->query($qryapplycouponcode);
while($objinsertRegister =$qryapplycouponcode->fetch_assoc()){ 
$data['couponcheck']=$objinsertRegister;
}
/*  mysqli_free_result();
mysqli_next_result($conn);
		 */
$planamount = $data['plandetails'][1]['value'];
$discountperc = $data['couponcheck']['Discount_Percentage'];

$discountamt=($planamount*$discountperc/100);
$paidamount=$planamount-$discountamt;
$arrResult=array("discountamount"=>round($discountamt,2), "paidamount"=>round($paidamount,2));

echo json_encode($arrResult);
?>
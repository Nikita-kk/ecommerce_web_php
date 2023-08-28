<?php
session_start();
include('../includes/connect.php');
if(isset($_POST['amt']) && isset($_POST['name']) && isset($_POST['oid']) && isset($_POST['inv'])){
    $amt=$_POST['amt'];
    $name=$_POST['name'];
    $oid=$_POST['oid'];
    $inv=$_POST['inv'];
    $payment_status="pending";
    $payment_mode="Razorpay";
    // $added_on=date('Y-m-d h:i:s');
    mysqli_query($conn,"INSERT INTO `user_payments` (name,amount,order_id,invoice_number,payment_status,payment_mode) VALUES ('$name','$amt','$oid','$inv','$payment_status','$payment_mode')");
    $_SESSION['OID']=mysqli_insert_id($conn);
}


if(isset($_POST['payment_id']) && isset($_SESSION['OID'])){
    $payment_id=$_POST['payment_id'];
    mysqli_query($conn,"UPDATE `user_payments` SET payment_status='complete',payment_id='$payment_id' WHERE id='".$_SESSION['OID']."'");
}
?>
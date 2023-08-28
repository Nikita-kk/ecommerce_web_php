<?php
include("../includes/connect.php");
session_start();

 if(isset($_GET['user_id']))
{
//  echo $_SESSION['price'];
 $price = $_SESSION['price'];
 $quantity=$_SESSION['quantity'];
 $product_id=$_SESSION['product_id'] ;
 $invoice_no= mt_rand();
 $total_product=1*$quantity;
 $user_id=$_GET['user_id'];

 $insert_orders="INSERT INTO `user_orders`( user_id, amount_due, invoice_number, total_products,order_date, 
    order_status,quantity ,product_id )values('$user_id','$price','$invoice_no','$total_product',NOW(),'' ,'$quantity','$product_id')";
$result_query=mysqli_query($conn,$insert_orders);
if($result_query){
    $select = "SELECT * FROM `user_orders` where user_id='$user_id' && invoice_number ='$invoice_number'";
    $result =mysqli_query($conn,$select);
    $row=mysqli_fetch_assoc($result);
     $order_id = $row['order_id'];
     $_SESSION['order_id'] = $order_id;
     $_SESSION['invoice_number']=$invoice_number;
     $_SESSION['total']=$price;
   echo "<script>window.open('confirm_payment.php','_self')</script>";
}
}
?>
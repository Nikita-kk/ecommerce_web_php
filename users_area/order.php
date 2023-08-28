<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();

if (isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
} else {
    // Handle the case when user_id is not present in the URL
    // You can display an error message or redirect the user to an appropriate page
    echo "User ID not found";
    exit();
}

// getting total items and total price of all items
if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
$subtotal = $_SESSION['total'];
$cart_query_price="SELECT * FROM `cart_details` WHERE user_id= $user_id";
$result_cart_price=mysqli_query($conn ,$cart_query_price);
$invoice_number=Mt_rand();
$status='pending';

$count_products=mysqli_num_rows($result_cart_price);
$product_ids = array();
$quantities= array();
while($row_price=mysqli_fetch_array($result_cart_price)){
$product_id=$row_price['product_id'];
$quantity=$row_price['quantity'];

$product_ids[] = $product_id;
$quantities[] = $quantity;
$order_id = "";
$invoice="";
}

//  string mde data lane ke liye
$all_product_id = implode(',',$product_ids);
$all_quantities = implode(',',$quantities);
// echo $all_quantities;
$insert_orders="INSERT INTO `user_orders`( user_id, amount_due, invoice_number, total_products,order_date,
 order_status)values('$user_id','$subtotal','$invoice_number','$count_products',NOW(),'$status')";
$result_query=mysqli_query($conn,$insert_orders);
if($result_query){
     $select = "SELECT * FROM `user_orders` where user_id='$user_id' && invoice_number ='$invoice_number'";
     $result =mysqli_query($conn,$select);
     $row=mysqli_fetch_assoc($result);
      $order_id = $row['order_id'];
      $_SESSION['order_id'] = $order_id;
      $_SESSION['invoice_number']=$invoice_number;
    echo "<script>window.open('confirm_payment.php','_self')</script>";
}

// orders pending
$insert_pending_orders="INSERT INTO `orders_pending`( user_id, invoice_number, product_id ,quantity,
 order_status)values('$user_id','$invoice_number','$all_product_id' ,'$all_quantities','$status')";
$result_pending_orders=mysqli_query($conn,$insert_pending_orders);

// delete items form cart
$_SESSION['order_id'] = $order_id;
$_SESSION['invoice_number']=$invoice;


$empty_cart="DELETE FROM `cart_details` WHERE user_id='$user_id'";
$result_delete=mysqli_query($conn,$empty_cart);
}

?>
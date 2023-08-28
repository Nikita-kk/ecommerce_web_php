<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
// session_start();

   $username=$_SESSION['username'] ;
   $get_user="SELECT * FROM `user_table` WHERE username ='$username'";
   $result=mysqli_query($conn, $get_user);
   $row_fetch=mysqli_fetch_assoc($result);
   $user_id=$row_fetch['user_id'];
//    echo $user_id

?>

<h3 class="text-success">All My Orders</h3>
<table class="table table-bordered mt-5">
<thead class="bg-info">
    <tr>
        <th>Si no</th>
        <th>Amount Due</th>
        <th>Total Products</th>
        <th>Invoice number</th>
        <th>Date</th>
        <th>order_Details</th>
    </tr>
</thead>
<tbody class="bg-secondary text-light">
<?php

$get_order_details="SELECT * FROM `user_orders` WHERE user_id = $user_id";
$result_order=mysqli_query($conn,$get_order_details);
$number=1;

while($row_orders=mysqli_fetch_assoc($result_order)){
    $order_id=$row_orders['order_id'];
    $amount_due=$row_orders['amount_due'];
    $total_products=$row_orders['total_products'];
    $invoice_number=$row_orders['invoice_number'];
    $order_status=$row_orders['order_status'];
    if($order_status=='pending'){
        $order_status='Incomplete';
    }else{
        $order_status='Complete';

    }
    $order_date=$row_orders['order_date'];
   echo" <tr>
   <td>$number</td>
   <td>$amount_due</td>        
   <td>$total_products</td>
   <td>$invoice_number</td>
   <td>$order_date</td>
   <td><a href='order_info.php?user_id=$user_id'>MyOrder</a></td>
   
   

   
</tr>";
$number++;
}

?>

<a href=""></a>

   
</tbody>
</table>
</body>
</html>
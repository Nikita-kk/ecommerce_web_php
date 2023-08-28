<?php

if(isset($_GET['delete_order'])){
    $delete_id=$_GET['delete_order'];
    // echo  $delete_id;


    $delete_order="DELETE FROM `user_orders` WHERE order_id=$delete_id";
    $result_order=mysqli_query($conn,$delete_order);
    if($result_order){
        echo "<script>alert('order deleted successfully')</script>";
            echo "<script>window.open('./index.php','_self')</script>";
    }
}

?>
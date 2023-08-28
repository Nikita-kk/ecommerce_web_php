<?php

if(isset($_GET['delete_payments'])){
    $delete_id=$_GET['delete_payments'];
    // echo  $delete_id;


    $delete_payment="DELETE FROM `user_payments` WHERE payment_id=$delete_id";
    $result_payment=mysqli_query($conn,$delete_payment);
    if($result_payment){
        echo "<script>alert('payment deleted successfully')</script>";
            echo "<script>window.open('./index.php','_self')</script>";
    }
}

?>
<?php

if(isset($_GET['delete_users'])){
    $delete_id=$_GET['delete_users'];
    // echo  $delete_id;


    $delete_user="DELETE FROM `user_table` WHERE user_id=$delete_id";
    $result_user=mysqli_query($conn,$delete_user);
    if($result_user){
        echo "<script>alert('user deleted successfully')</script>";
            echo "<script>window.open('./index.php','_self')</script>";
    }
}

?>
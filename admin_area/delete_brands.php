<?php
if(isset($_GET['delete_brands'])){
    $delete_brands=$_GET['delete_brands'];
    // echo  $delete_brands;

    $delete_query="DELETE FROM `brands` WHERE brands_id='$delete_brands'";
    $result=mysqli_query($conn,$delete_query);
    if($result){
        echo "<script>alert('brands is been deleted successfully')</script>";

            echo "<script>window.open('./index.php?view_brands','_self')</script>";
    }
}

?> 
<?php
if(isset($_GET['edit_brands'])){
    $edit_brands=$_GET['edit_brands'];
    // echo $edit_category;

    $get_brands="SELECT * FROM  `brands` WHERE brands_id=$edit_brands";
    $result=mysqli_query($conn,$get_brands);
    $row=mysqli_fetch_assoc($result);
    $brands_title=$row['brands_title'];
    // echo $category_title;

    if(isset($_POST['edit_brand'])){
        $brands_title=$_POST['brands_title'];

        $update_query="UPDATE  `brands` SET brands_title='$brands_title' WHERE brands_id=$edit_brands";
        $result_brand=mysqli_query($conn,$update_query);
        if($result_brand){
            echo "<script>alert('Brand is been updated successfully')</script>";
            echo "<script>window.open('./index.php?view_brands','_self')</script>";

        }
    }
}

?>


<div class="container mt-3">
    <h1 class="text-center">Edit Brands</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="brands_title" class="form-label">Brands Title</label>
            <input type="text" name="brands_title" id="brands_title" class="form-control" required="required"
                value='<?php echo $brands_title;?>'>
        </div>
        <input type="submit" value="Update Brand" class="btn btn-info px-3 mb-3" name="edit_brand">
    </form>
</div>
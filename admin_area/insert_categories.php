<?php
include('../includes/connect.php');
if(isset($_POST['insert_cat'])){
  $category_title=$_POST['cat_title'];

// select data form db (double data )
    $select_query="select * from `categories` where category_title='$category_title'";
    $result_select=mysqli_query($conn,$select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){
      echo "<script>alert('this category is present inside the database')</script>";
    } else{


  $insert_query="insert into `categories`(category_title) values('$category_title')";
  $result=mysqli_query($conn,$insert_query);
  If($result){
    echo "<script>alert('category has been inserted successfully')</script>";
    echo "<script>window.open('./index.php?view_categories','_self')</script>";
  }
}}

?>

<h2 class="text-center">Insert Categories</h2>
<form action="" method="post" class="mb-2">
  <div class="input-group w-90 mb-3">
    <span class="input-group-text" bg-info id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
    <input type="text" class="form-control" name="cat_title" placeholder="Insert categories" aria-label="categories"
      aria-describedby="basic-addon1">
  </div>

  <div class="input-group w-10 mb-2 m-auto">
    <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_cat" value="insert categories">
    <!-- <button class="bg-info p-2 m-3 border-0">Insert categories</button> -->
  </div>
</form>
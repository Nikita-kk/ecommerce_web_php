<?php
include('../includes/connect.php');

if(isset($_POST['insert_product']))
{
   $product_tile=$_POST['product_title'];
   $description=$_POST['description'];
   $product_keyword=$_POST['product_keywords'];
   $product_category=$_POST['product_category'];
   $product_brands=$_POST['product_brands'];
   $product_price=$_POST['product_price'];
   $product_status='true';


//    accessing the image
   $product_image1 = $_FILES['product_image1']['name'];
   $product_image2 = $_FILES['product_image2']['name'];
   $product_image3 = $_FILES['product_image3']['name'];

//    accessing temp name

     $temp_image1 = $_FILES['product_image1']['tmp_name'];
     $temp_image2 = $_FILES['product_image2']['tmp_name'];
     $temp_image3 = $_FILES['product_image3']['tmp_name'];
// $product_image1=$_FILES['product_image1']['tmp_name'];
// $product_image2=$_FILES['product_image2']['tmp_name'];
// $product_image3=$_FILES['product_image3']['tmp_name'];

//  checking empty condition
   if($product_tile=='' or $description=='' or $product_keyword=='' or $product_category=='' or $product_brands=='' 
   or $product_price=='' or $product_image1==''
    //  or$product_image2 =='' or $product_image3==''
    )
   {
    echo "<script>alert('please fill all the fields')</script>";
   
   }
   else{
    move_uploaded_file($temp_image1, "./product_images/$product_image1");
    move_uploaded_file($temp_image2, "./product_images/$product_image2");
    move_uploaded_file($temp_image3, "./product_images/$product_image3");

    //   insert query
    $insert_products="INSERT INTO `products`(product_title, product_description, product_keywords, category_id, brands_id,
    product_image1, product_image2, product_image3, product_price, date, status) 
    values('$product_tile','$description','$product_keyword','$product_category','$product_brands',
    '$product_image1','$product_image2','$product_image3','$product_price',NOW(),'$product_status' )";

      $result_query=mysqli_query($conn ,$insert_products);

    if($result_query){
        echo "<script>alert('successfully inserted product')</script>";
        echo "<script>window.open('./index.php?view_products','_self')</script>";

    }
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product</title>


    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- css link -->
    <link rel="stylesheet" href="../style.css">

    <!--font awesome link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="bg-light">
    <div class="container mt-3 ">
        <h1 class="text-center">Insert Product</h1>

        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control"
                    placeholder="Enter Product title" autocomplete="off" required>
            </div>

            <!-- description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label"> Product Description</label>
                <input type="text" name="description" id="description" class="form-control"
                    placeholder="Enter Description" autocomplete="off" required>
            </div>

            <!-- keyword -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label"> Product Keyword</label>
                <input type="text" name="product_keywords" id="product_keyword" class="form-control"
                    placeholder="Enter keyword" autocomplete="off" required>

            </div>

            <!-- categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" id="" class="form-select">
                    <option value="">Select a category</option>
                    <?php
                    $select_query="Select * from `categories`";
                    $result_query=mysqli_query($conn,$select_query);
                    while($row=mysqli_fetch_assoc($result_query))
                    {
                        $category_title=$row['category_title'];
                        $category_id=$row['category_id'];

                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>
                    <!-- <option value="">category1</option>
                    <option value="">category1</option>
                    <option value="">category1</option>
                    <option value="">category1</option> -->
                </select>
            </div>

            <!-- brands -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brands" id="" class="form-select">
                    <option value="">Select a brands</option>

                    <?php
                    $select_query="Select * from `brands`";
                    $result_query=mysqli_query($conn,$select_query);
                    while($row=mysqli_fetch_assoc($result_query))
                    {
                        $brand_title=$row['brands_title'];
                        $brand_id=$row['brands_id'];

                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                    ?>

                    <!-- <option value="">brand 1</option>
                    <option value="">brand 1</option>
                    <option value="">brand 1</option>
                    <option value="">brand 1</option> -->
                </select>
            </div>

            <!-- images 1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label"> Product Image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required>
            </div>

            <!-- images 2 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label"> Product Image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" >
            </div>

            <!-- images 3 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label"> Product Image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control">
            </div>

            <!-- price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label"> Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control"
                    placeholder="Enter Price" autocomplete="off" required>
            </div>

            <!-- btn -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="insert_product">
            </div>
               

        </form>
    </div>

    
   
</body>

</html>
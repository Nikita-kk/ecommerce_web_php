<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
  if(isset($_SESSION['username'])){
  $user_type=$_SESSION['user_type'];
   if($user_type==0){
    
   }else{
    echo "<script>window.open('index.php', '_self')</script>";
   }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce website-cart details</title>

    <link rel="stylesheet" href="style1.css">

    <!-- bootstrap link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--font awesome link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    .cart_img {
        width: 80px;
        height: 80px;
    }
</style>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!--first child  -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">

                <img src="images/logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./users_area/user_registration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup>
                                    <?php cart_item(); ?></sup></a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Total Price: 
                                <?php  total_cart_price(); ?>/-
                            </a>
                        </li> -->
                    </ul>

                </div>
            </div>
        </nav>
        <!-- calling cart function -->
        <?php
        cart();
        ?>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">

                <?php
                     if(!isset($_SESSION['username'])){
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='#'>Welcome Guest</a>
                         </li>";
                       }else{
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
                        </li>";
                       }


                   if(!isset($_SESSION['username'])){
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='./users_area/user_login.php'>Login</a>
                     </li>";
                   }else{
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='./users_area/logout.php'>Logout</a>
                    </li>";
                   }
                   ?>

            </ul>
        </nav>

        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Communication is at the heart of e-commerce and community</p>
        </div>

        <!-- fourth child-table -->
        <div class="container">
            <div class="row">
                <form action="" method="POST">
                    <table class="table table-bordered text-center">

                        <!--  here th ka code tha -->
                        <!-- php code to dynamic data for td -->
                        <?php
                        $product_prices = [];
                        global $conn; 
                        if(isset($_SESSION['username'])){
                       $username = $_SESSION['username'];
                       $get_user= "SELECT * FROM `user_table` WHERE username='$username'";
                       $result = mysqli_query($conn, $get_user);
                       $row= mysqli_fetch_array($result);
                       $user_id=$row['user_id'];
                        $total_price=0;
                         $cart_query="SELECT * FROM `cart_details` WHERE user_id='$user_id'";
                         $result=mysqli_query($conn,$cart_query);

                         $result_count=mysqli_num_rows($result);
                         if($result_count > 0){
                            echo"  <thead>
                            <tr>
                            <th>Sl.no</th>
                          <th>Product Title</th>
                          <th>Product Image</th>
                          <th>Price</th>

                          <th>Quantity</th>
                          <th>Total Price</th>
                          <th>Remove</th>
                          <th colspan='2'>Operations</th>
                            </tr>
                        </thead>
                        <tbody> ";

                        
                                 $number = 0;
                                    foreach ($result  as $d) {
                                        $product_id = $d['product_id'];
                                        $quantities = $d['quantity'];
                                        $select_product = "SELECT * FROM `products` WHERE product_id ='$product_id' ";
                                        $data1 = mysqli_query($conn, $select_product);
                                        $number++;
                                    
                                        foreach ($data1 as $d1) {
                                            // $product_id = $d1['product_id'];
                                            $product_price = $d1['product_price'];
                                            $product_title = $d1['product_title'];
                                            $product_image1 = $d1['product_image1'];
                                            $product = $product_price * $quantities;
                                            $product_prices[] = $product;
                                           
                                        }
                                    
                            ?>

                        <tr>
                            <td>
                                <?php echo $number ?>
                                <input type="hidden" name="product_id[]" value="<?php echo $product_id ?>">
                            </td>
                            <td><?php echo $product_title?></td>

                            <td><img src="./admin_area/product_images/<?php echo $product_image1?>" alt=""
                                    class="cart_img"></td>
                            <td><?php echo $product_price ?> </td>

                            <td><input type="text" name="qty[]" value="<?php echo $quantities ?>"
                                    class="form-input w-50"></td>

                            <td><?php echo $product ?></td>
                            <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                            <td>

                                <!-- <button class="bg-info  p-3  py-2 border-0 mx-3">Update</button> -->
                                <input type="submit" value="Update cart" name="update_cart"
                                    class="bg-info px-3 py-2 border-0 mx-3">
                                <!-- <button class="bg-info  p-3  py-2 border-0 mx-3">Remove</button> -->
                                <input type="submit" value="Remove cart" name="remove_cart"
                                    class="bg-danger text-light px-3 py-2 border-0 mx-3">

                            </td>
                        </tr>

                        <?php  
                    }
                    //  assuming the form has been submitted and the updated_cart button is clicked
                    if(isset($_POST['update_cart'])){
                        // get  the product_ids and quantities from the form
                        $product_ids = $_POST['product_id'];
                        $quantities = $_POST['qty'];

                        // iterate over the array and update the cart for each product
                        for($i=0; $i<count($product_ids); $i++){
                            $product_id = $product_ids[$i];
                            $quantity=$quantities[$i];

                            if($quantity>0){
                                $update_query="UPDATE `cart_details` SET quantity=$quantity WHERE product_id=$product_id";
                                $data_update =mysqli_query($conn, $update_query);

                                if($data_update){
                                    echo"<script>alert('Quantity updated successfully')</script>";
                                    echo"<script>window.open('cart.php','_self')</script>";


                                }
                            }
                        }

                    }
                }
                     else{
                        echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
                     }
                
                    }
                    else{
                        echo "<script>window.open('./users_area/user_login.php','_self')</script>";
                    }

                    $total_price = 0;
                    for ($i = 0; $i < count($product_prices); $i++) {
                        $total_price += $product_prices[$i];
                    }
                    $_SESSION['total'] = $total_price;
                    // echo $_SESSION['total'];
                    ?>

                        </tbody>
                    </table>
                    <!--subtotal -->
                    <div class="d-flex mb-5 ">
                        <?php
                   
                    $cart_query="SELECT * FROM `cart_details` WHERE user_id= $user_id ";
                    $result=mysqli_query($conn,$cart_query);

                    $result_count=mysqli_num_rows($result);
                    if($result_count>0){
                        echo "  <h4 class='px-3'>Subtotal: <strong class='text-info'> $total_price/-</strong></h4>
                        <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3'name='continue_shopping'>
                       <button class='bg-success  p-3 py-2 border-0 text-light'> <a href='./users_area/order_details.php?user_id=".$user_id."'class='text-light text-decoration-none'>Buy Now</a></button>";
                    }else{
                        echo"
                        <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3'name='continue_shopping'>";

                    }
                    if(isset($_POST['continue_shopping'])){
                        echo"<script>window.open('index.php','_self')</script>";
                    }
                
                
                   ?>


                    </div>
            </div>
        </div>

        </form>

        <!-- function to remove item -->
        <?php

           function remove_cart_item(){
           global $conn;
           if(isset($_POST['remove_cart'])){
           if(isset($_POST['removeitem'])){
            foreach($_POST['removeitem']as $remove_id){
                echo $remove_id;
                $delete_query="DELETE FROM `cart_details` WHERE product_id=$remove_id";
                $run_delete=mysqli_query($conn,$delete_query);
                if($run_delete){
                    echo"<script>window.open('cart.php','_self')</script>";
                }
            }
        }
        else{
             echo"<script>alert('please trick the remove box')</script>";
            echo"<script>window.open('cart.php','_self')</script>";

        }
           }
        }
        echo $remove_item=remove_cart_item();
           ?>



        <!-- last child -->
        <!-- include footer -->
        <?php   include("./includes/footer.php") ?>

    </div>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
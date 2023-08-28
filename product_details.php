<?php
include 'includes/connect.php';
include 'functions/common_function.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce website using php</title>

    <link rel="stylesheet" href="style1.css">

    <!-- bootstrap link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--font awesome link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    body {
        overflow-x: hidden;
    }

    .card-img-viewmore {
        width: 300px;
        height: 400px;
        display: block;
        margin: auto;
        object-fit: contain;
    }
</style>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!--first child  -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">

                <img src="images/logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                            <a class="nav-link" href="#">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i><sup>
                                    <?php cart_item(); ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price: <?php total_cart_price(); ?>/-</a>
                        </li>

                    </ul>

                    <form class="d-flex" action="search_product.php" method="get">
                        <input class="form-control me-2" type="search" name="search_data" placeholder="Search" aria-label="Search">
                        <input type="submit" value="search" name="search_data_product" class="btn btn-outline-light">

                    </form>
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
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome Guest</a>
                     </li>";
                } else {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . "</a>
                    </li>";
                }

                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='./users_area/user_login.php'>Login</a>
                     </li>";
                } else {
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

        <!-- fourth child -->
        <div class="row px-1">
            <div class="col-md-10 ">

                <!-- fetching products -->
                <?php
                // calling function
                // getproducts();
                // view_details();
                get_unique_categories();
                get_unique_brands();

                // condition to check isset or not
                // view_details
                if (isset($_GET['product_id'])) {
                    if (!isset($_GET['category'])) {
                        if (!isset($_GET['brand'])) {
                            $product_id = $_GET['product_id'];
                            $select_query = "Select * from `products` where product_id=$product_id ";
                            $result_query = mysqli_query($conn, $select_query);
                            $row = mysqli_fetch_assoc($result_query);

                            $product_id = $row['product_id'];
                            $product_title = $row['product_title'];
                            $product_description = $row['product_description'];
                            $product_description1 = $row['product_description1'];

                            $product_image2 = $row['product_image2'];
                            $product_image3 = $row['product_image3'];
                            $product_image1 = $row['product_image1'];

                            $product_price = $row['product_price'];
                            $category_id = $row['category_id'];
                            $brands_id = $row['brands_id'];
                        }
                    }
                }

                ?>
                <form action="./users_area/order_details.php" method="POST">
                <div class="row my-3">
                    <div class='col-md-6 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/<?php echo $product_image1 ?>' class='card-img-viewmore' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'><?php echo $product_title ?></h5>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                <?php
                                if (isset($_SESSION['username'])) {
                                    $username = $_SESSION['username'];
                                    $get_user_id = "SELECT * FROM `user_table` where username='$username'";
                                    $result = mysqli_query($conn, $get_user_id);
                                    $row = mysqli_fetch_assoc($result);
                                    $user_id = $row['user_id'];
                                    // $_SESSION['order_id'] = $order_id;
                                    // $_SESSION['invoice_number']=$invoice_number;
                                }
                                ?>
                                <input type="text" name="user_id" value="<?= $user_id ?>">
                                <input type="text" name="product_id" value="<?= $product_id ?>">
                                <input type="text" name="title" value="<?= $product_title ?>">
                                <input type="text" name="price" value="<?= $product_price ?>">
                                <input type="text" name="image" value="<?= $product_image1 ?>">



                                <input type="submit" name="buy" class="btn btn-success" value="BUY Now">
                            </div>
                        </div>
                    </div>

                    <div class='col-md-6'>
                        <!--KO related images -->
                        <div class='row'>
                            <h5 class='card-text'>price: <?php echo $product_price ?>/- </h5>
                            <br>
                            <div class='col-md-6'>
                                <p class='card-des-top' alt='$product_title'> <?php echo $product_description1 ?></p>

                                <div class="my-4">
                                <label for="">Quantity</label>
                                <input type="number" name="quantity" value="1" style="width: 50px;">
                                </div>
                                <h5>Available offers</h5>

                                <p>Bank Offer5% Cashback on mystore Axis Bank CardT&C </p>

                                <p>Bank Offer₹50 off on 1200 for UPIT&C</p>

                                <p>Expiry Date 26 Oct 2023 <br>
                                    Manufactured date 29 Jun 2023</p>
                            </div>
                        </div>
                    </div>

                    <!-- row end -->
                </div>
                </form>
                <!-- column end -->
            </div>

            <!-- side nav -->
            <div class="col-md-2 bg-secondary p-0">
                <ul class="navbar-nav me-auto text-center ">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light">
                            <h4>Delivery Brand</h4>
                        </a>
                    </li>

                    <!-- how to connect brand after insert the brand -->
                    <?php

                    getbrands();

                    ?>
                </ul>


                <!-- catrgory to be displayed -->
                <ul class="navbar-nav me-auto text-center ">

                    <!-- same as brands -->
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light">
                            <h4>Categories</h4>
                        </a>
                    </li>

                    <?php
                    getcategories();
                    ?>
                </ul>
            </div>

        </div>

        <!-- last child -->
        <!-- include footer -->
        <?php include "./includes/footer.php" ?>

    </div>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
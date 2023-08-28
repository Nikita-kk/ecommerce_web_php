<?php
include('../includes/connect.php');
session_start();
$subtotal = $_SESSION['total'];
$user_id =  $_SESSION['user_id'];
echo $subtotal;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- css link -->
    <link rel="stylesheet" type="text/css" href="../public/styles.css">
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- font awsemome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5">
                <h3 class="mt-4 text-center">Product Details </h3>

                <?php
                if (isset( $_GET['user_id'])) {
                    $user_id =  $_GET['user_id'];
                    $cart_query = "SELECT * FROM `cart_details` WHERE user_id= '$user_id' ";
                    $data = mysqli_query($conn, $cart_query);
                    foreach ($data as $d) {
                        $product_id = $d['product_id'];
                        $quantitys = $d['quantity'];
                        $select_product = "SELECT * FROM `products` WHERE product_id ='$product_id' ";
                        $data1 = mysqli_query($conn, $select_product);
                        foreach ($data1 as $d1) {
                            $product_price = $d1['product_price'];
                            $product_title = $d1['product_title'];
                            $product_image1 = $d1['product_image1'];
                        }
                ?>

                <table class="table table-bordered  mt-5">
                      <tr>
                        <th>Product Name : </th>
                        <td><?= $product_title ?></td>
                        <td rowspan="4" class="text-center"><img
                                src="../admin_area/product_images/<?= $product_image1 ?>" width="200"></td>
                      </tr>
                    <tr>
                        <th>Product Price : </th>
                        <td>Rs. <?= $product_price ?>/-</td>
                    </tr>
                    <tr>
                        <th>Product quantiyy : </th>
                        <td>Rs. <?= $quantitys ?>/-</td>
                    </tr>
                    <tr>
                        <th>Delivery Charge : </th>
                        <td>free deliveary.</td>
                    </tr>
                </table>
                <?php
                    }
                }
                ?>

                <h3 class="text-success fw-bold">SubTotal Rs. <span class="text-dark"><?= $subtotal ?>/-</span></h3>
                <div class="d-flex align-items-center justify-content-center">
                <a href="order.php?user_id=<?= $user_id ?>" class="btn btn-primary ">Continue</a>       

                </div>

            </div>
             </div>
    </div>
</body>

</html>
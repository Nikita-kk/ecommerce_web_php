<?php
include '../includes/connect.php';
session_start();

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
    <style>
        #continueButton {
            position: relative;
            top: 500px;
            left: 100px;
        }

        .inactive {
            opacity: 0.5;
            /* You can adjust the opacity value */
            /* cursor: not-allowed; */
            pointer-events: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5">
                <h3 class="mt-4 text-center">Product Details </h3>

                <?php
                if (isset($_POST['buy'])) {
                    $user_id = $_POST['user_id'];
                    $product_id = $_POST['product_id'];
                    $title = $_POST['title']; //name in form location product details.php- input type is hidden
                    $quantity = $_POST['quantity'];
                    $price = $_POST['price'];
                    $product_image1 = $_POST['image'];
                    $total = $quantity * $price;
                    
                     $_SESSION['price'] = $total;
                     $_SESSION['quantity'] = $quantity;
                     $_SESSION['product_id'] = $product_id;
                     
                ?>
                    <table class="table table-bordered  mt-4">
                        <tr>
                            <th>Product Name : </th>
                            <td><?= $title ?></td>
                            <td rowspan=" 4" class="text-center">
                                <img src="../admin_area/product_images/<?= $product_image1 ?>" style="width:150px;">
                            </td>
                        </tr>
                        <tr>
                            <th>Product Price : </th>
                            <td>Rs. <?= $price ?>/-</td>
                        </tr>
                        <tr>
                            <th>Product quantity : </th>
                            <td>Rs. <?= $quantity ?>/-</td>
                        </tr>
                        <tr>
                            <th>Delivery Charge : </th>
                            <td>free delivery.</td>
                        </tr>
                    </table>
                    <h3 class="text-success fw-bold">SubTotal Rs. <span class="text-dark"><?= $total ?>/-</span></h3>
                    <div class="d-flex align-items-center justify-content-center">
                    <a href="order_buy.php?user_id=<?= $user_id ?>" class="btn btn-primary inactive" id="continueButton">Continue</a>
                    </div>
                    <?php

                } else {
                    if (isset($_GET['user_id'])) {
                        $user_id = $_GET['user_id'];
                        $subtotal = $_SESSION['total'];
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
                                    <td rowspan="4" class="text-center"><img src="../admin_area/product_images/<?= $product_image1 ?>" width="200"></td>
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
                        ?>
                        <h3 class="text-success fw-bold">SubTotal Rs. <span class="text-dark"><?= $subtotal ?>/-</span></h3>
                        <div class="d-flex align-items-center justify-content-center">
                            <!-- for add to cart - buy - continue - button -->
                            <a href="order.php?user_id=<?= $user_id ?>" class="btn btn-primary inactive" id="continueButton">Continue</a>
                        </div>
                <?php
                    }
                }
                ?>
                <div class="mt-5">
                    <h4 class="my-3 fw-bold text-center text-danger"> Delivary Address</h4>

                    <?php
                    if (isset($_SESSION['username'])) {
                        $username = $_SESSION['username'];
                        $query = "SELECT * FROM `user_table` WHERE username= '$username'";
                        $result_query = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result_query);
                        $user_ids = $row['user_id'];
                    }
                    ?>
                    <form action="" method="POST" class="w-50 m-auto">
                        <div class="form-group">
                            <input type="hidden" name="user_id" class="form-control user_id" value="<?= $user_id ?>">
                            <input type="text" name="address1" class="form-control address1" placeholder="House no/ Building no." required>
                        </div>
                        <div class="form-group mt-4">
                            <input type="text" name="address2" class="form-control address2" placeholder="Road / Area / Colony." required>
                        </div>
                        <div class="form-group mt-4 ">
                            <input type="text" name="pincode" class="form-control w-50 pincode" placeholder="Pinecode." required>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-md-6">
                                <input type="text" name="city" class="form-control city" placeholder="city." required>
                            </div>
                            <div class="col-md-6">
                                <select name="state" class="form-control state">
                                    <option selected>Select State</option>
                                    <option value="">Maharadhtra</option>
                                    <option value="">Rajastan</option>
                                    <option value="">Uttrpradesh</option>
                                    <option value="">Bihar</option>
                                    <option value="">Gujarat</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-4 ">
                            <input type="text" name="nearbye_location" class="form-control w-50 nearbye_location" placeholder="Nearbey feamous shop/ street/ etc." required>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control name" placeholder="Name." required>
                            </div>
                            <div class="col-md-6">
                                <input type="tel" name="phone" class="form-control phone" placeholder="Phone." required>
                            </div>
                        </div>
                        <div class="form-group mt-4 d-flex justify-content-center align-items-center">
                            <input type="submit" name="user_details" class="btn btn-success fw-bold btn-lg mb-5 align-button-left" id="add_submit" value="Submit">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var submitButton = document.getElementById("add_submit");
            var continueButton = document.getElementById("continueButton");

            submitButton.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent the default form submission
                var user_id = $('.user_id').val();
                var address1 = $('.address1').val();
                var address2 = $('.address2').val();
                var pincode = $('.pincode').val();
                var city = $('.city').val();
                var state = $('.state').val();
                var nearbye_location = $('.nearbye_location').val();
                var name = $('.name').val();
                var phone = $('.phone').val();
                // Perform your AJAX form submission here
                // For example, using jQuery AJAX:
                $.ajax({
                    type: "POST", // or "GET" depending on your form's method
                    url: "ajax_code.php",
                    data: {
                        'checking_add': true,
                        'user_id': user_id,
                        'address1': address1,
                        'address2': address2,
                        'pincode': pincode,
                        'city': city,
                        'state': state,
                        'nearbye_location': nearbye_location,
                        'name': name,
                        'phone': phone,
                    },
                    success: function(response) {
                        console.log(response);
                        // After successful submission, activate the "Continue" button
                        continueButton.classList.remove("inactive");
                    },
                    error: function(error) {
                        // Handle errors if necessary
                        console.error("Error:", error);
                    }
                });
            });
        });
    </script>
</body>

</html>
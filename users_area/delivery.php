<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $query = "SELECT * FROM `user_table` WHERE user_id='$user_id'";
    $result_query = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result_query);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['username'] ?></title>
    <!-- css link -->
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- font awsemome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        .profile_image {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }

        .edit_image {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body style="overflow-x: hidden;">
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first-child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../images/shopping_logo.jpg" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="profile.php">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../cart.php"><i class="fa-sharp fa-solid fa-cart-shopping"></i><sup><b> <?php cart_item(); ?></b></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Total Price: <b><?php total_cart_price() ?></b></a>
                        </li>
                    </ul>
                    <form class="d-flex" action="../search_product.php" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Search" name="search_data" aria-label="search">
                        <button type="submit" class="btn btn-outline-light" name="search">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- add cart function here... -->
        <?php
        cart();
        ?>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php
                if (!isset($_SESSION['username'])) {
                    echo '  <li class="nav-item">
                               <a class="nav-link" href="#">Welcome Guest</a>
                            </li>';
                } else {
                    echo '  <li class="nav-item">
                               <a class="nav-link" href="#">Welcome: <span class="text-light fw-bolder">' . $_SESSION['username'] . '</span></a>
                            </li>';
                }
                ?>&nbsp;
                <?php
                if (!isset($_SESSION['username'])) {
                    echo ' <li class="nav-item">
                              <a class="nav-link" href="../login.php">Login</a>
                           </li>';
                } else {
                    echo ' <li class="nav-item">
                              <a class="nav-link" href="../logout.php">Logout</a>
                           </li>';
                }
                ?>
            </ul>
        </nav>

        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center">Welcome to the ShopMarket</h3>
            <p class="text-center ">Enjoy your Journey, Get the desired items with the ToP Brands.</p>
        </div>

        <!-- forth child -->
        <h4 class="my-3 fw-bold text-center text-danger"> Delivary Address</h4>

        <form action="" method="POST" class="w-50 m-auto">
            <div class="form-group">
                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                <input type="text" name="address1" class="form-control" placeholder="House no/ Building no." required>
            </div>
            <div class="form-group mt-4">
                <input type="text" name="address2" class="form-control" placeholder="Road / Area / Colony." required>
            </div>
            <div class="form-group mt-4 ">
                <input type="text" name="pincode" class="form-control w-50" placeholder="Pinecode." required>
            </div>
            <div class="form-group row mt-4">
                <div class="col-md-6">
                    <input type="text" name="city" class="form-control" placeholder="city." required>
                </div>
                <div class="col-md-6">
                    <select name="state" class="form-control">
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
                <input type="text" name="nearbye_location" class="form-control w-50" placeholder="Nearbey feamous shop/ street/ etc." required>
            </div>
            <div class="form-group row mt-4">
                <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Name." required>
                </div>
                <div class="col-md-6">
                    <input type="tel" name="phone" class="form-control" placeholder="Phone." required>
                </div>
            </div>
            <div class="form-group mt-4 d-flex justify-content-center align-items-center">
                <input type="submit" name="user_details" class="btn btn-danger fw-bold btn-lg mb-5" value="Submit">
            </div>
        </form>

        <!-- last child -->
        <!-- include footer -->
        <?php include('../includes/footer.php') ?>

    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<?php

if (isset($_POST['user_details'])) {
    $user_id = $_POST['user_id'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $pincode = $_POST['pincode'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $nearbye_location = $_POST['nearbye_location'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $insert_query = "INSERT INTO `delivery` (user_id, address1, address2, pincode, city, state, nearbye_location, name, phone)
                      VALUES('$user_id', '$address1', '$address2', '$pincode' ,'$city', '$state', '$nearbye_location', '$name', '$phone')";
    $result = mysqli_query($conn, $insert_query);

    if ($result) {
        $_SESSION['user_id']= $user_id;
        echo "<script>window.open('order_details.php', '_self')</script>";
    }
}

?>
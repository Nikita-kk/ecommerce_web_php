<?php
include("../includes/connect.php");


if (isset($_POST['checking_add'])) {
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
        echo $return="Data Store Successfully";
    }
    else{
        echo $return="Failed";

    }
}

// Get references to the buttons

?>
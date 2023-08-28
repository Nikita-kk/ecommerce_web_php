<?php
include('../includes/connect.php');
include('../functions/common_function.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>user-registration</title>
  <!-- bootstrap link  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- font awesome link 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
</head>

<body>
  <div class="container-fluid my-3">
    <h2 class="text-center">New User Registration</h2>
    <div class="row d-flex align-items-center justify-content-center">
      <div class="col-lg-12 col-xl-6">

        <form action="" method="post" enctype="multipart/form-data">

          <!-- username  -->
          <div class="form-outline mb-4">
            <label for="user_username" class="form-label">Username</label>
            <input type="text" id="user_username" class="form-control" placeholder="Enter your username"
              autocomplete="off" name="user_username" required />
          </div>

          <!-- email -->
          <div class="form-outline mb-4">
            <label for="user_email" class="form-label">Email</label>
            <input type="text" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off"
              name="user_email" required />
          </div>

          <!-- image -->
          <div class="form-outline mb-4">
            <label for="user_image" class="form-label">User Image</label>
            <input type="file" id="user_image" class="form-control" autocomplete="off" name="user_image" required />
          </div>

          <!-- password -->
          <div class="form-outline mb-4">
            <label for="user_password" class="form-label">Password</label>
            <input type="password" id="user_password" class="form-control" placeholder="Enter your password"
              autocomplete="off" name="user_password" required />
          </div>

          <!-- confirm password -->
          <div class="form-outline mb-4">
            <label for="conf_user_password" class="form-label">Confirm Password</label>
            <input type="password" id="conf_user_password" class="form-control"
              placeholder="Enter your confirm password" autocomplete="off" name="conf_user_password" required />
          </div>

          <!-- address -->
          <div class="form-outline mb-4">
            <label for="user_address" class="form-label">Address</label>
            <input type="text" id="user_address" class="form-control" placeholder="Enter your address"
              autocomplete="off" name="user_address" required />
          </div>

          <!-- contact -->
          <div class="form-outline mb-4">
            <label for="user_contact" class="form-label">Contact</label>
            <input type="number" id="user_contact" class="form-control" placeholder="Enter your mobile number"
              autocomplete="off" name="user_contact" required />
          </div>

          <!-- button -->
          <div class="mt-4 pt-2">
            <input type="submit" value="Register" class="bg-info py-2 px-3 border-0 " name="user_register">
          </div>
          <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account ? <a href="user_login.php"
              class="text-danger"> Login</a></p>

        </form>

      </div>
    </div>
  </div>
</body>

</html>

<!-- php code -->
<?php
if(isset($_POST['user_register']))
{
  $user_username=$_POST['user_username'];
  $user_email=$_POST['user_email'];
  $user_password=$_POST['user_password'];
  $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
  $conf_user_password=$_POST['conf_user_password'];
  $user_address=$_POST['user_address'];
  $user_contact=$_POST['user_contact'];

  // image
  $user_image=$_FILES['user_image']['name'];
  $user_image_tmp=$_FILES['user_image']['tmp_name'];
   $user_ip= getIPAddress();

// select query
$select_query="SELECT * FROM `user_table` WHERE username='$user_username' or user_email='$user_email' ";
$result=mysqli_query($conn,$select_query);
$rows_count=mysqli_num_rows($result);
if($rows_count>0){
  echo "<script>alert('Data inserted successfully')</script>";
}
else if($user_password!=$conf_user_password){
  echo "<script>alert('Password do not match')</script>";

}

else{
  // insert query
  move_uploaded_file($user_image_tmp,"./user_images/$user_image");
 $insert_query="INSERT INTO `user_table`(username,user_email,user_password,user_image,user_ip,user_address,user_mobile)
   VALUES ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_contact')";
   
  $sql_execute=mysqli_query($conn,$insert_query); 
  if($sql_execute){
    echo "<script>alert('Data inserted successfully')</script>";
  } else{
    echo "die(mysqli_error($conn))";
  }
}


  //  insert query 
//   move_uploaded_file($user_image_tmp,"./user_images/$user_image");
//  $insert_query="INSERT INTO `user_table`(username,user_email,user_password,user_image,user_ip,user_address,user_mobile)
//    VALUES ('$user_username', '$user_email', '$user_password', '$user_image', '$user_ip', '$user_address', '$user_contact')";
   
//   $sql_execute=mysqli_query($conn,$insert_query); 
//   if($sql_execute){
//     echo "<script>alert('Data inserted successfully')</script>";
//   } else{
//     echo "die(mysqli_error($conn))";
//   }


// selecting cart items
$select_cart_items="SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
$result_cart=mysqli_query($conn,$select_cart_items);
$rows_count=mysqli_num_rows($result_cart);
if($rows_count>0){


  $_SESSION['username']=$user_username;
 echo "<script>alert('You have items in cart')</script>";
 echo "<script>window.open('checkout.php','_self')</script>";
}else{
  echo "<script>window.open('../index.php','_self')</script>";

}
}

?>
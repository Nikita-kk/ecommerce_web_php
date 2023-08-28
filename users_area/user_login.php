<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>user-Login</title>
  <!-- bootstrap link  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- font awesome link 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
</head>
<style>
  body {
    overflow-x: hidden;
  }
</style>

<body>
  <div class="container-fluid my-3">
    <h2 class="text-center">User Login</h2>
    <div class="row d-flex align-items-center justify-content-center mt-5">
      <div class="col-lg-12 col-xl-6">
        <form action="" method="post">
          <!-- username  -->
          <div class="form-outline mb-4">
            <label for="user_username" class="form-label">Username</label>
            <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" name="user_username" require />
          </div>


          <!-- password -->
          <div class="form-outline mb-4">
            <label for="user_password" class="form-label">Password</label>
            <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" name="user_password" require />
          </div>


          <!-- button -->
          <div class="mt-4 pt-2">
            <input type="submit" value="Login" class="bg-info py-2 px-3 border-0 " name="user_login">
          </div>
          <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account ? <a href="user_registration.php" class="text-danger"> Register</a></p>


        </form>

      </div>
    </div>
  </div>



</body>

</html>
<?php
if (isset($_POST['user_login'])) {
  $user_username = $_POST['user_username'];
  $user_password = $_POST['user_password'];

  $select_query = "SELECT * FROM `user_table` WHERE username= '$user_username' ";
  $result = mysqli_query($conn, $select_query);
  $rows_count = mysqli_num_rows($result);

  if ($rows_count > 0) {
    $row_data = mysqli_fetch_assoc($result);
    $user_type = $row_data['user_type'];
    $user_ip = $row_data['user_ip'];
    // echo $user_type;

    // cart item
    $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address= '$user_ip' ";
    $select_cart = mysqli_query($conn, $select_query_cart);
    $row_count_cart = mysqli_num_rows($select_cart);

    if ($user_type == 0) {
      $_SESSION['user_type'] = $user_type;
      $_SESSION['username'] = $user_username;
      if (password_verify($user_password, $row_data['user_password'])) {
        if ($rows_count == 1 and $row_count_cart == 0) {
          $_SESSION['username'] = $user_username;
          $_SESSION['user_type'] = $user_type;
          echo "<script>window.open('../display_all.php','_self')</script>";
        } else {
          $_SESSION['username'] = $user_username;
          $_SESSION['user_type'] = $user_type;
          echo "<script>window.open('profile.php','_self')</script>";
        }
      } else {
        echo "<script>alert('Invalid Password')</script>";
      }
    } elseif ($user_type == 1) {
      if (password_verify($user_password, $row_data['user_password'])) {
        $_SESSION['username'] = $user_username;
        $_SESSION['user_type'] = $user_type;
        echo "<script>alert('Login Successful')</script>";
        echo "<script>window.open('../admin_area/index.php','_self')</script>";
      } else {
        echo "<script>alert('Invalid Credential')</script>";
      }
    }
  }
}
?>
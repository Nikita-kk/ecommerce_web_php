<?php
// include('./includes/connect.php');
// getting products
 function getproducts(){
    global $conn;

    // condition to check isset or not
     if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){

    $select_query="Select * from `products` order by rand() LIMIT 0,8";
                        $result_query=mysqli_query($conn,$select_query);
                        while($row=mysqli_fetch_assoc($result_query))
                        {
                            $product_id=$row['product_id'];
                            $product_title=$row['product_title'];
                            $product_description=$row['product_description'];
                            $product_image1=$row['product_image1'];
                            $product_price=$row['product_price'];
                            $category_id=$row['category_id'];
                            $brands_id=$row['brands_id'];

                            echo " <div class='col-md-3 mb-4'>
                            <div class='card shadow'>
                            <a href='product_details.php?product_id=$product_id'> <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'></a>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'>price: $product_price/-</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                </div>
                            </div>
                        </div>";
                       }
 }
 }
 }

//  getting all product

  function get_all_products(){
    global $conn;

    // condition to check isset or not
     if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){

    $select_query="Select * from `products` order by rand()";
                        $result_query=mysqli_query($conn,$select_query);
                        while($row=mysqli_fetch_assoc($result_query))
                        {
                            $product_id=$row['product_id'];
                            $product_title=$row['product_title'];
                            $product_description=$row['product_description'];
                            $product_image1=$row['product_image1'];
                            $product_price=$row['product_price'];
                            $category_id=$row['category_id'];
                            $brands_id=$row['brands_id'];

                            echo " <div class='col-md-4 mb-2'>
                            <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'>price: $product_price/-</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                </div>
                            </div>
                        </div>";
                       }
 }
 }
  }
 
//  getting unique categories

function get_unique_categories(){
    global $conn;

    // condition to check isset or not

     if(isset($_GET['category'])){
      $category_id=$_GET['category'];

    $select_query="Select * from `products` where category_id=$category_id ";
                        $result_query=mysqli_query($conn,$select_query);

                         $num_Of_rows=mysqli_num_rows($result_query);
                         if($num_Of_rows==0){
                            echo "<h2 class='text-center text-danger'>No stock for this category</h2>";
                         }
                        while($row=mysqli_fetch_assoc($result_query))
                        {
                            $product_id=$row['product_id'];
                            $product_title=$row['product_title'];
                            $product_description=$row['product_description'];
                            $product_image2=$row['product_image2'];
                            $product_price=$row['product_price'];
                            $category_id=$row['category_id'];
                            $brands_id=$row['brands_id'];

                            echo " <div class='col-md-4 mb-2'>
                            <div class='card'>
                            <img src='./admin_area/product_images/$product_image2' class='card-img-top' alt='$product_title'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_description</p>                                    
                                    <p class='card-text'>price: $product_price/-</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                    <a href='product_details.php?product_id=$product_id' class='btn btn-Secondary'>View more</a>
                                </div>
                            </div>
                        </div>";
                       }
 }


//  getting unique brands

function get_unique_brands(){
    global $conn;

    // condition to check isset or not
 if(isset($_GET['brand'])){
    $brands_id=$_GET['brand'];

    $select_query = "SELECT * FROM `products` WHERE brands_id = $brands_id";

    $result_query = mysqli_query($conn,$select_query);

                       $num_Of_rows=mysqli_num_rows($result_query);
                       if($num_Of_rows==0){
                          echo "<h2 class='text-center text-danger'>This brand available to service </h2>";
                       }
                      while($row=mysqli_fetch_assoc($result_query))
                      {
                          $product_id=$row['product_id'];
                          $product_title=$row['product_title'];
                          $product_description=$row['product_description'];
                          $product_image2=$row['product_image2'];
                          $product_price=$row['product_price'];
                          $category_id=$row['category_id'];
                          $brands_id=$row['brands_id'];

                          echo " <div class='col-md-4 mb-2'>
                          <div class='card'>
                          <img src='./admin_area/product_images/$product_image2' class='card-img-top' alt='$product_title'>
                              <div class='card-body'>
                                  <h5 class='card-title'>$product_title</h5>
                                  <p class='card-text'>$product_description</p>
                                  <p class='card-text'>price: $product_price/-</p>
                                  <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                  <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                  </div>
                          </div>
                      </div>";
                     }
}




          //  displaying brands in sidenav

         function getbrands(){
        global $conn;
        $select_brands="Select *from `brands`";
        $result_brands=mysqli_query($conn,$select_brands);

        while($row_data=mysqli_fetch_assoc($result_brands))
        {
           $brand_title=$row_data['brands_title'];
           $brand_id=$row_data['brands_id'];
           echo "<li class='nav-item'>
               <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
          </li>";
        }
    }


    // displaying  category in side nav
    function getcategories(){
        global $conn;

        $select_categories="Select *from `categories`";
        $result_categories=mysqli_query($conn,$select_categories);

        while($row_data=mysqli_fetch_assoc($result_categories))
        {
           $category_title=$row_data['category_title'];
           $category_id=$row_data['category_id'];
           echo "<li class='nav-item'>
               <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
          </li>";
        }
    }
}}

// searching products
 function search_product(){
    global $conn;
      if(isset($_GET['search_data_product'])){
         $search_data_product=$_GET['search_data'];
         $search_query = "SELECT * FROM `products` where product_keywords like '%$search_data_product%'";
         $result_query=mysqli_query($conn,$search_query);

         $num_Of_rows=mysqli_num_rows($result_query);
                       if($num_Of_rows==0){
                          echo "<h2 class='text-center text-danger'>No result match  NO product founds this category!</h2>";
                       }

                        while($row=mysqli_fetch_assoc($result_query))
                        {
                            $product_id=$row['product_id'];
                            $product_title=$row['product_title'];
                            $product_description=$row['product_description'];
                            $product_image2=$row['product_image2'];
                            $product_price=$row['product_price'];
                            $category_id=$row['category_id'];
                            $brands_id=$row['brands_id'];

                            echo " <div class='col-md-4 mb-2'>
                            <div class='card'>
                            <a href='product_details.php?product_id=$product_id'>
                            <img src='./admin_area/product_images/$product_image2' class='card-img-top' alt='$product_title'></a>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'>price: $product_price/-</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                </div>
                            </div>
                        </div>";
                       }
 }}

 //   view details function
 
           
    // get ip address function

    function getIPAddress() {  
        //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
    //whether ip is from the remote address  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    }  
    // $ip = getIPAddress();  
    // echo 'User Real IP Address - '.$ip;  


    // cart function 

    function cart(){
        if(isset($_GET['add_to_cart'])){
            global $conn;
            // if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
            $select_user="SELECT * FROM `user_table`  WHERE username = '$username' ";
            $result_user=mysqli_query($conn,$select_user);
            $row=mysqli_fetch_assoc($result_user);
            $user_id=$row['user_id'];
            $user_ip=$row['user_ip'];

            $get_product_id=$_GET['add_to_cart'];
            $select_query="SELECT * FROM `cart_details` WHERE product_id ='$get_product_id'and user_id='$user_id' ";
            $result_query=mysqli_query($conn,$select_query);
            $num_Of_rows=mysqli_num_rows($result_query);
                       if($num_Of_rows > 0){
                        echo "<script>alert('The item is already present inside CART')</script>";
                        echo "<script>window.open('index.php','_self')</script>";                       

            } else{
            $insert_query = "INSERT INTO `cart_details` (product_id , ip_address , user_id , quantity) 
                          VALUES ('$get_product_id','$user_ip', '$user_id', 1)";
                            $result_query=mysqli_query($conn,$insert_query);

                            echo "<script>alert('Item is added to CART')</script>";
                            echo "<script>window.open('index.php','_self')</script>";                       
                      }
              }
         }


        //  function to get cart  item number 

function cart_item(){

    global $conn;
                if(isset($_GET['add_to_cart'])){
                    if(!isset($_SESSION['username'])){
                    echo"<script>window.open('./users_area/user_login.php','_self')</script>";

                 }}else{
                    if(isset($_SESSION['username'])){
                        $username=$_SESSION['username'];
                        $get_user="SELECT * FROM `user_table` WHERE username='$username'";
                        $result= mysqli_query($conn,$get_user);
                        $row=mysqli_fetch_assoc($result);
                        $user_id=$row['user_id'];

                        $select_query="SELECT * FROM `cart_details` WHERE user_id=$user_id ";
                        $data=mysqli_query($conn, $select_query);
                        $count_cart_item =mysqli_num_rows($data);

                        echo $count_cart_item; 
                   
                 }
                }
            }
                    // $get_ip_add=getIPAddress();
                    // $select_query="SELECT * FROM `cart_details` WHERE ip_address ='$get_ip_add'";
                    // $result_query=mysqli_query($conn,$select_query);
                    // $count_cart_items=mysqli_num_rows($result_query);    
                    // } else{
                    //     global $conn;
                    //     $get_ip_add=getIPAddress();
                    //     $select_query="SELECT * FROM `cart_details` WHERE ip_address ='$get_ip_add'";
                    //     $result_query=mysqli_query($conn,$select_query);
                    //     $count_cart_items=mysqli_num_rows($result_query);                      
                    //           }

                    // echo $count_cart_items;       
                //   } 
                // }
                 
        //   total prize function
         function total_cart_price(){
            global $conn;
            if(isset($_SESSION['username'])){
                $username=$_SESSION['username'];
                $get_user="SELECT * FROM `user_table` WHERE username='$username'";
                $result= mysqli_query($conn,$get_user);
                $row=mysqli_fetch_assoc($result);
                $user_id=$row['user_id'];
            $total_price=0;
             $cart_query="SELECT * FROM `cart_details` WHERE user_id='$user_id'";
             $result=mysqli_query($conn,$cart_query);
              while($row=mysqli_fetch_array($result)){
                $product_id=$row['product_id'];
                $quantity=$row['quantity'];
                $select_products="SELECT * FROM `products` WHERE product_id='$product_id'";
                $result_products=mysqli_query($conn,$select_products);

                   while($row_product_price=mysqli_fetch_array($result_products)){
                    $product_price = $row_product_price['product_price'];    //[300 200]
                    // $product_values=array_sum($product_price);        //[500]
                    // $total_price+=$product_values;          
                   $product = $product_price * $quantity;
                   $product_prices[] = $product;
                   for($i=0; $i< count($product_prices); $i++){
                       $total_price +=$product_prices[$i];
                       $_SESSION['total'] = $total_price;
                   }  
                }
              }
              echo $total_price;
         }
         else{

         }
         }
        //  get user order details
        function get_user_order_details(){
            global $conn;
            $username = $_SESSION['username'];
            $get_details="SELECT * FROM `user_table` WHERE username='$username'";
            $result_query=mysqli_query($conn,$get_details);
            
            while($row_query=mysqli_fetch_array($result_query)){
                $user_id=$row_query['user_id'];
                if(!isset($_GET['edit_account'])){
                    if(!isset($_GET['my_orders'])){
                        if(!isset($_GET['delete_account'])){
                           $get_orders = "SELECT * FROM `user_orders` WHERE user_id=$user_id and
                            order_status='pending'"; 
                            $result_orders_query=mysqli_query($conn , $get_orders );
                            $row_count=mysqli_num_rows($result_orders_query);
                            if($row_count>0){
                                echo "<h3 class='text-center text-success mt-5 mb-2'>You have<span class='text-danger'>$row_count</span> pending orders</h3>
                                <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Orders Details</a><p>";
                            }else{
                                echo "<h3 class='text-center text-success mt-5 mb-2'>You have zero pending orders</h3>
                                <p class='text-center'><a href='../index.php' class='text-dark'>Explore products
                                </a><p>";
                            }
                        }
                    }
            }
        }
    }

        
 ?>
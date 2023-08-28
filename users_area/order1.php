<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();

if (isset($_SESSION['user_id'])){
        echo $_SESSION['user_id'];
};

<?php
include('../includes/connect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- font awsemome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.js" ></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script> -->

</head>

<body>

    <div class="container my-5">

        <h1 class="text-center my-3">Select Payment Method</h1>
        <hr>

        <center>
            <form>
                <input type="textbox" name="name" id="name"  placeholder="Enter your name" /><br /><br />
                <input type="textbox" name="amt" id="amt" value="<?= $_SESSION[']]]'] ?>" placeholder="Enter amt" /><br /><br />
                <input type="textbox" name="oid" id="oid" value="<?= $_SESSION['order_id'] ?>" placeholder="Enter oid" /><br /><br />
                <input type="textbox" name="inv" id="inv" value="<?= $_SESSION['invoice_number'] ?>" placeholder="Enter inv" /><br /><br />
                <input type="button" name="btn" id="btn" value="Pay Now" onclick="pay_now()" />
            </form>
        </center>

        <!-- Make sure to include jQuery and Razorpay libraries in your HTML -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

        <script>
            function pay_now() {
                var name = jQuery('#name').val();
                var amt = jQuery('#amt').val();
                var oid = jQuery('#oid').val();
                var inv = jQuery('#inv').val();

                jQuery.ajax({
                    type: 'post',
                    url: 'payment_process.php',
                    data: "amt=" + amt + "& name=" + name + "& oid=" + oid + "& inv=" + inv,
                    success: function(result) {
                        var options = {
                            "key": "rzp_test_evEOCCEcbjwPij",
                            "amount": amt * 100,
                            "currency": "INR",
                            "name": "Acme Corp",
                            "description": "Test Transaction",
                            "image": "https://image.freepik.com/free-vector/logo-sample-text_355-558.jpg",
                            "handler": function(response) {
                                jQuery.ajax({
                                    type: 'post',
                                    url: 'payment_process.php',
                                    data: "payment_id=" + response.razorpay_payment_id,
                                    success: function(result) {
                                        window.location.href = "thank_you.php";
                                    }
                                });
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    }
                });


            }
        </script>

    </div>
</body>

</html>
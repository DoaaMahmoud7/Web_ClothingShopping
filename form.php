<?php
require('function.php');
session_start();
if (isset($_POST['placeorder'])) {
    if (isset($_POST['quantity']) && is_array($_POST['quantity']) && isset($_SESSION['cart'])) {
        $newQuantities = array_values($_POST['quantity']);
        $cart = $_SESSION['cart'];
        $keys = array_keys($cart);

        foreach ($keys as $index => $key) {
            $cart[$key] = $newQuantities[$index];
        }

        $_SESSION['cart'] = $cart; // Update the cart in the session
    }
}

foreach ($_SESSION['cart'] as $cartKey => $quantity) {
    $keyComponents = explode('_', $cartKey);
    update_items($keyComponents[0], $keyComponents[1], $keyComponents[2], $quantity, $_SESSION['user_id']);
}

// echo "<pre>";
// print_r($_SESSION['cart']);
// echo "</pre>";



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form - Sagar Developer</title>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
</head>

<body>
    <div class="wrapper">
        <!-- <h2>Payment Form</h2> -->
        <form action="pay.php">

            <!-- <h4>Account</h4> -->

            <div class="input_group">
                <div class="input_box">
                    <input type="text" placeholder="Full Name" required class="name">
                    <i class="fa fa-user icon"></i>
                </div>
                <div class="input_box">
                    <input type="text" placeholder="Name on Card" required class="name">
                    <i class="fa fa-user icon"></i>
                </div>
            </div>
            <div class="input_group">
                <div class="input_box">
                    <input type="email" placeholder="Email Address" class="name">
                    <i class="fa fa-envelope icon"></i>
                </div>
            </div>
            <div class="input_group">
                <div class="input_box">
                    <input type="text" placeholder="Address" class="name">
                    <i class="fa fa-map-marker icon" aria-hidden="true"></i>
                </div>
            </div>
            <div class="input_group">
                <div class="input_box">
                    <input type="text" placeholder="City" class="name">
                    <i class="fa fa-institution icon"></i>
                </div>
            </div>

            <div class="input_group">
                <div class="input_box">
                    <h4>Date Of Birth</h4>
                    <input type="text" placeholder="DD" class="dob">
                    <input type="text" placeholder="MM" class="dob">
                    <input type="text" placeholder="YYYY" class="dob">
                </div>
                <div class="input_box">
                    <h4>Gender</h4>
                    <input type="radio" name="gender" class="radio" id="b1" checked>
                    <label for="b1">Male</label>
                    <input type="radio" name="gender" class="radio" id="b2">
                    <label for="b2">Female</label>
                </div>
            </div>

            <div class="input_group">
                <div class="input_box">
                    <h4>Payment Details</h4>
                    <input type="radio" name="pay" class="radio" id="bc1" checked>
                    <label for="bc1"><span>
                            <i class="fa fa-cc-visa"></i>Credit Card</span></label>
                    <input type="radio" name="pay" class="radio" id="bc2">
                    <label for="bc2"><span>
                            <i class="fa fa-cc-paypal"></i>Paypal</span></label>
                </div>
            </div>
            <div class="input_group">
                <div class="input_box">
                    <input type="tel" name="" class="name" placeholder="Card Number 1111-2222-3333-4444">
                    <i class="fa fa-credit-card icon"></i>
                </div>
            </div>
            <div class="input_group">
                <div class="input_box">
                    <input type="tel" name="" class="name" placeholder="Card CVC 632">
                    <i class="fa fa-user icon"></i>
                </div>
            </div>
            <div class="input_group">
                <div class="input_box">
                    <div class="input_box">
                        <input type="number" placeholder="Exp Month" class="name">
                        <i class="fa fa-calendar icon" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="input_box">
                    <input type="number" placeholder="Exp Year" class="name">
                    <i class="fa fa-calendar-o icon" aria-hidden="true"></i>
                </div>
            </div>



            <div class="input_group">
                <div class="input_box">
                    <button type="submit">PAY NOW</button>
                </div>
            </div>

        </form>
        <!-- <div class="backing">
            <button id="back"><a href="cart.php">Back</a></button>

        </div> -->

    </div>


</body>

</html>
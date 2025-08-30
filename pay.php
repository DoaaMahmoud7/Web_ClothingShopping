<?php
require('function.php');
session_start();

foreach ($_SESSION['cart'] as $cartKey => $quantity) {
    $keyComponents = explode('_', $cartKey);
    $real_quantity = select_quantity($keyComponents[1], $keyComponents[2], $keyComponents[0]);
    $real_quantity = intval($real_quantity['quantity']);
    $quantity = intval($quantity);
    $real_quantity -= $quantity;
    update_quantity($keyComponents[0], $keyComponents[1], $keyComponents[2], $real_quantity);
    unset($_SESSION['cart']);
    clear_items();
    if ($real_quantity == 0) {    ///////deleteeeeeee
        $conn = db();
        $stmt = $conn->prepare("SELECT id FROM product_atribute WHERE quantity=0");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $stmt->close();

        $stmt = $conn->prepare("DELETE FROM product_atribute WHERE quantity=0");
        $stmt->execute();
        $stmt->close();

        $stmt = $conn->prepare("SELECT * FROM product_atribute WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $stmt = $conn->prepare("DELETE FROM product WHERE product_id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }

        $conn->close();
    }









}

?>






<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        body {
            background-color: rgb(203, 194, 181);


        }

        div {
            margin-top: 250px;
            font-weight: 900;
            text-align: center;
            color: black;
            margin-bottom: 10px;
        }

        .backing button {
            width: 80px;
            height: 50px;
            background-color: black;
            text-align: center;
            border: 1px solid antiquewhite;
            border-radius: 8px;

            /* margin-bottom: 12px; */
            /* margin-top: 5px; */

        }

        .backing button a {
            color: white;
            text-decoration: none;


        }
    </style>
</head>

<body>

    <div>
        <h1>Payment Done <i class="fas fa-check text-success"></i></h1>
    </div>
    <div>
        <div class="backing">
            <button id="back"><a href="home.php#trending">Back</a></button>

        </div>
    </div>
</body>

</html>
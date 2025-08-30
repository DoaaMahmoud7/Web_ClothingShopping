<?php
require('admin_function.php');
session_start();

if (!isset($_SESSION['attribute'])) {
    header('location:insert.php');
    exit();
}

if (isset($_POST["price"])) { ////modifffffffffyyyyyyy searrrrrrrrch 
    update_price($_SESSION['attribute']['id'], $_POST["price"]);
    add_quantity($_SESSION['attribute']['item_id'], $_POST["quantity"]);
    $_SESSION['attribute'] = search($_SESSION['item_id']);
    $_SESSION['product'] = select_id($_SESSION['attribute']['id']);


}







// echo "<pre>";

// print_r($_SESSION['attribute']);

// print_r($_SESSION['product']);


// echo "</pre>";

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product Management</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .product-attributes {
            display: flex;
            align-items: center;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            /* Increased width */
            padding: 20px;
        }

        .product-attributes img {
            max-width: 200px;
            height: auto;
            margin-right: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="submit"] {

            margin: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        div a {
            text-decoration: none;
            margin: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;

        }

        input[type="submit"],
        div a:hover {

            background-color: #45a049;
        }

        .submit {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="product-attributes">
        <img src="<?= $_SESSION['product']['image_url'] ?>" alt="Product Image">
        <div>
            <h2>Product Details</h2>
            <p>Name:
                <?= $_SESSION['product']['product_name'] ?>
            </p>
            <p>Color:
                <?= $_SESSION['attribute']['color'] ?>
            </p>
            <p>Size:
                <?= $_SESSION['attribute']['size'] ?>
            </p>
            <p>Price:
                <?= $_SESSION['product']['price'] ?>
            </p>
            <p>Quantity:
                <?= $_SESSION['attribute']['quantity'] ?>
            </p>
            <form action="modify.php" method="post">
                New Price: <input type="text" name="price" required><br>
                New Quantity: <input type="text" name="quantity" required><br>
                <div class="submit">
                    <a href="insert.php">back </a>
                    <a href="add.php">add </a>

                    <input type="submit" value="Modify Product">

                </div>

            </form>
        </div>
    </div>
</body>

</html>
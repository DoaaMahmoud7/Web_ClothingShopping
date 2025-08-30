<?php
require('admin_function.php');
session_start();
if (isset($_SESSION['image'])) {
    $image = "images/" . $_SESSION['image'];
    $price = $_SESSION['price'];
    $name = $_SESSION['name'];
    if (!isset($_SESSION['product_inserted'])) {
        $conn = db();
        $stmt = $conn->prepare("SELECT * FROM product WHERE product_name=? AND price=? AND image_url=?");
        $stmt->bind_param("sis", $name, $price, $image);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            insert_product($image, $_SESSION['name'], $_SESSION['price'], $_SESSION['desc']); //adddddddddddddddd
            $_SESSION['product_inserted'] = true; //to not duplicate product
        } else {
            echo '<script>alert("Product already exists")</script>';
        }
    }
} else if (isset($_SESSION['product']['image_url'])) {
    $_SESSION['image'] = substr($_SESSION['product']['image_url'], 7);
    $_SESSION['name'] = $_SESSION['product']['product_name'];
    $_SESSION['price'] = $_SESSION['product']['price'];
    $_SESSION['id'] = $_SESSION['product']['product_id'];

} else {
    header('location:insert.php');
    exit();
}

if (isset($_POST['color'])) {   ////addd color , size
    $color = $_POST['color'];
    $size = $_POST['size'];
    $id = $_SESSION['id'];
    $conn = db();
    $stmt = $conn->prepare("SELECT * FROM product_atribute WHERE id=? AND color=? AND size=?");
    $stmt->bind_param("iss", $id, $color, $size);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo '<script>alert("Product already exists")</script>';
    } else {
        insert_attribute($_POST['color'], $_POST['size'], $_POST['quantity'], $_SESSION['id']);

    }
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product Management</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">

</head>

<body>
    <div class="product-attributes">
        <h2>Product Details</h2>
        <p>Name:
            <?php echo $_SESSION['name'] ?>
        <p>Price:
            <?php echo $_SESSION['price'] ?>
        </p>
        <div class="back">
            <img src="images\<?php echo $_SESSION['image'] ?> " alt="Product Image">
            <a href="insert.php">Back</a>
        </div>

        <form action="add.php" method="post">
            New Color: <input type="text" name="color" required><br>
            New Size: <input type="text" name="size" required><br>
            New Quantity: <input type="text" name="quantity" required><br>
            <input type="submit" value="Modify Product">
        </form>
    </div>
</body>

</html>
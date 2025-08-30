<?php
session_start();
require('admin_function.php');
unset($_SESSION['name']);
unset($_SESSION['image']);
unset($_SESSION['price']);
unset($_SESSION['product']);

if (isset($_POST['product_name'])) {
    unset($_SESSION['product_inserted']);
    unset($_SESSION['attribute']);

    $_SESSION['name'] = $_POST['product_name'];
    $_SESSION['price'] = $_POST['product_price'];
    $_SESSION['desc'] = $_POST['description'];
    // File upload path
    $targetDirectory = "C:/xampp/htdocs/New folder/final-project/images/"; // Use forward slashes for directory path
    $targetFile = $targetDirectory . basename($_FILES["product_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["product_image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
            $_SESSION['image'] = $_FILES["product_image"]["name"]; // Use correct array key
            header('location:add.php');
            exit();
            // Handle the rest of the form data and database update here
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

}
$ids = get_ids(); //search by id
if (isset($_POST['product_id'])) {
    $_SESSION['item_id'] = $_POST['product_id'];
    $_SESSION['attribute'] = search($_POST["product_id"]);
    $_SESSION['product'] = select_id($_SESSION['attribute']['id']);
    header("location:modify.php");
    exit();
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
    <h2>Add New Product</h2>
    <form action="insert.php" method="post" enctype="multipart/form-data"> <!-- Add enctype for file upload -->
        Product Name: <input type="text" name="product_name" required><br>
        Product Price: <input type="text" name="product_price" required><br>
        Image: <input type="file" name="product_image" required><br>
        Description: <textarea name="description" rows="4"></textarea>
        <input type="submit" value="Add">
    </form>

    <h2>Search by Product ID</h2>
    <form action="insert.php" method="post">
        Product ID: <select name="product_id" required>
            <option value="" disabled selected>Select</option>
            <?php foreach ($ids as $id): ?>
                <option value="<?php echo $id['item_id']; ?>">
                    <?php echo $id['item_id']; ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <input type="submit" value="Search" name="submit">
    </form>
</body>

</html>
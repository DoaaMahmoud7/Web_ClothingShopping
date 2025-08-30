<?php
require 'function.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if they are not logged in
    header("Location: login.php");
    exit();
} else {
    $user_id = $_SESSION['user_id'];
}
if (isset($_POST['submit'])) {
    $total_quantity = select_quantity($_POST['color'], $_POST['size'], $_POST['product_id']);
    $quantity = $_POST['quantity'];
    $alertMessage = "";
    if ($total_quantity['quantity'] >= $quantity) {
        $cartKey = $_POST['product_id'] . '_' . $_POST['color'] . '_' . $_POST['size'];
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
            // $_SESSION['cart'][$cartKey] = $quantity;
            // insert_items($_POST['product_id'], $quantity, $user_id, $_POST['size'], $_POST['color']);
        }
        if (array_key_exists($cartKey, $_SESSION['cart'])) {

            $alertMessage = "Product with the same attributes already exists in cart";
        } else {

            $_SESSION['cart'][$cartKey] = $quantity;
            insert_items($_POST['product_id'], $quantity, $user_id, $_POST['size'], $_POST['color']);
            $_SESSION['num'] = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
        }
    } else {
        // Quantity is not available
        $alertMessage = "Please select another quantity";
    }

    if (empty($alertMessage)) {
        // Redirect to cart page only if there are no alert messages
        header("Location: cart.php");
        exit();
    } else {
        // Display the alert message
        echo '<script>alert("' . $alertMessage . '")</script>';
    }

}

if (isset($_POST['product_id'])) {

    $product = select_id($_POST['product_id']);
    $attributes = select_attribute($_POST['product_id']);
}

if (isset($_GET['id'])) {
    $product = select_id($_GET['id']);
    $attributes = select_attribute($_GET['id']);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- font-icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- box icon link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!-- remix icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Noto+Nastaliq+Urdu&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Work+Sans:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,600&display=swap"
        rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/header.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="css/cart.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->



    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .ff {
            font-size: 3em;
            color: white;
            font-weight: bold;
            background: linear-gradient(to right,
                    rgb(255, 251, 0),
                    rgb(216, 216, 51),
                    rgb(210, 246, 7));
            background-clip: text;
            -webkit-background-clip: text;
            animation: flame 1s infinite alternate;
            text-decoration: none;
        }

        .d {
            font-size: 3em;
            color: white;

            background: linear-gradient(to right,
                    rgb(255, 251, 0),
                    rgb(216, 216, 51),
                    rgb(210, 246, 7));
            background-clip: text;
            -webkit-background-clip: text;
            animation: flame 1s infinite alternate;
            text-decoration: none;
            font-family: "Brush Script MT", cursive;
            text-decoration: none;
        }

        @keyframes flame {
            0% {
                text-shadow: 0 0 10px rgb(92, 111, 188), 0 0 20px rgb(195, 255, 0),
                    0 0 30px rgb(80, 200, 0);
            }

            100% {
                text-shadow: 0 0 10px rgb(92, 111, 188), 0 0 20px rgb(187, 255, 0),
                    0 0 30px rgb(255, 0, 21);
            }
        }

        header {
            background-color: burlywood;
            padding: 10px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5em;
        }

        nav {
            display: flex;
            align-items: center;
            position: sticky;
        }

        .styled-word {
            font-weight: bold;
            color: blue;
        }

        .another-word {
            font-style: italic;
            color: red;
        }

        .styled-word {
            font-weight: bold;
            color: blue;
        }

        .another-word {
            font-style: italic;
            color: red;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 30px;
            margin-right: 30px;
        }

        nav a:hover {
            color: rgb(107, 139, 0);
            text-decoration: none;
            margin-left: 30px;
            margin-right: 30px;
        }

        .menu-icon {
            display: none;
            font-size: 1.5em;
            cursor: pointer;
        }

        .our {
            color: white;
            text-decoration: none;
        }

        .fatma i {
            padding: 15px;
            display: flex;
            flex-grow: 1;
            flex-basis: 0;
            justify-content: flex-end;
            align-items: center;
            position: relative;
            /* padding: 15px; */
        }

        .icon_span {
            display: inline-block;
            text-align: center;
            background-color: #63748e;
            border-radius: 50%;
            color: #FFFFFF;
            font-size: 12px;
            line-height: 16px;
            width: 16px;
            height: 16px;
            font-weight: bold;
            position: absolute;
            top: 22px;
            right: 0;
        }

        @media (max-width: 768px) {
            nav {
                display: none;
                flex-direction: column;
                width: 100%;
                text-align: center;
                position: absolute;
                top: 90px;
                left: 0;
                background-color: burlywood;
                z-index: 1000;
                margin-bottom: 50;
            }

            nav.active {
                display: flex;
            }

            nav a {
                margin-left: 30px;
                margin-right: 30px;
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .menu-icon {
                display: block;
            }
        }
    </style>
</head>

<body>
    <header>
        <p class="fire-text">
            <span><a href="#" class="d">Online</a></span>
            <span> <a href="#" class="ff">Shop</a></span>
        </p>

        <div class="menu-icon" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </div>

        <nav>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="home.php">Home</a>
                <a href="home.php#trending">Shop</a>
                <!-- <a href="contact.php">Help</a> -->
                <a href="contact.php">Contact Us</a>
                <a href="logout.php">Logout</a>
                <div class="fatma">
                    <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span class="icon_span">
                            <?php echo $_SESSION['num'] ?>
                        </span> </a>

            </nav>
        <?php endif ?>

    </header>

    <script>
        function toggleMenu() {
            var nav = document.querySelector("nav");
            nav.classList.toggle("active");
        }
    </script>



    <main>
        <div class="product">
            <img src="<?= $product['image_url'] ?>" width="500" height="500" alt="<?= $product['product_name'] ?>">
            <div>
                <h1 class="name">
                    <?= $product['product_name'] ?>


                </h1>
                <span class="price">
                    &dollar;
                    <?= $product['price'] ?>
                </span>
                <form action="product.php" method="post">
                    <div class="selector">
                        <label for="color">color</label><br>
                        <select id="color" name="color" required>
                            <option value="select">Select</option>
                            <?php
                            $uniquecolors = array_unique(array_column($attributes, 'color'));
                            foreach ($uniquecolors as $color):
                                ?>
                                <option value="<?php echo $color; ?>">
                                    <?php echo $color; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                    <div class="selector">
                        <label for="size">size</label><br>
                        <select id="size" name="size" required>
                            <option value="select">Select</option>
                            <?php
                            $uniqueSizes = array_unique(array_column($attributes, 'size'));
                            foreach ($uniqueSizes as $size):
                                ?>
                                <option value="<?php echo $size; ?>">
                                    <?php echo $size; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </div>

                    <input type="number" name="quantity" value="1" min="1" max="50" placeholder="Quantity" required>
                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                    <input type="submit" value="Add To Cart" name="submit">
                </form>
                <div class="desc">
                    <?= $product['describtion'] ?>
                </div>
            </div>
        </div>

    </main>
</body>

</html>
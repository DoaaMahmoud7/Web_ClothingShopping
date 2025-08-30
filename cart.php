<?php

require('function.php');
session_start();

$_SESSION['num'] = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $items = select_items($user_id);
    $subtotal = 0.00;
} else {
    header("location:login.php");
    exit();
}
if (isset($_GET['id'])) { //remove
    delete_items($_GET['id'], $user_id, $_GET['color'], $_GET['size']);
    $items = select_items($user_id);
    unset($_SESSION['cart']);
    foreach ($items as $item) {

        $cartKey = $item['product_id'] . '_' . $item['color'] . '_' . $item['size'];
        $_SESSION['cart'][$cartKey] = $item['quantity'];
    }
    $_SESSION['num'] = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
}
// echo "<pre>";
// print_r($_SESSION['cart']);

// echo "</pre>";

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
    <!-- <link rel="stylesheet" href="css/header.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
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

                <a href="contact.php">Contact Us</a>
                <a href="logout.php">Logout</a>
                <div class="fatma">
                    <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span class="icon_span">
                            <?php echo $_SESSION['num'] ?>
                        </span> </a>
                </div>

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
        <div class="cart">
            <form action="form.php" method="post">
                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Product</td>
                            <td>Color</td>
                            <td>Size</td>
                            <td>Price</td>
                            <td>Quantity</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($items)): ?>
                            <tr>
                                <td colspan="5" style="text-align:center;">You have no products added in your Shopping
                                    Cart
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($items as $item):

                                $product = select_id($item['product_id']);
                                $total_quantity = select_quantity($item['color'], $item['size'], $item['product_id']);
                                $itemSubtotal = (float) $product['price'] * (int) $item['quantity']; // Calculate initial subtotal for the item
                                $subtotal += $itemSubtotal; // Add the item's initial subtotal to the total subtotal
                        

                                ?>
                                <tr>
                                    <td class="img">
                                        <a href="product.php?id=<?= $product['product_id'] ?>">
                                            <img src="<?= $product['image_url'] ?>" width="50" height="50"
                                                alt="<?= $product['product_name'] ?>">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="product.php?id=<?= $product['product_id'] ?>">
                                            <?= $product['product_name'] ?>
                                        </a>
                                        <br>
                                        <a href="cart.php?id=<?= $product['product_id'] ?>&color=<?= $item['color'] ?>&size=<?= $item['size'] ?>"
                                            class="remove">Remove</a>
                                    </td>
                                    <td class="price">
                                        <?= $item['color'] ?>
                                    </td>
                                    <td class="price">
                                        <?= $item['size'] ?>
                                    </td>
                                    <td class="price">
                                        <?= $product['price'] ?>
                                    </td>
                                    <td class="quantity">
                                        <input type="number" name="quantity[]" value="<?= $item['quantity'] ?>" min="1"
                                            max="<?= $total_quantity['quantity'] ?>" placeholder="Quantity"
                                            onchange="updateTotalPrice()" required>
                                    </td>
                                    <td class="price" id="total">&dollar;
                                        <?= number_format($product['price'] * $item['quantity'], 2) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>


                        <?php endif; ?>
                        <script>
                            function updateTotalPrice() {
                                let subtotal = 0;
                                const quantityInputs = document.querySelectorAll('.quantity input');
                                quantityInputs.forEach(input => {
                                    const quantity = parseInt(input.value);
                                    const price = parseFloat(input.parentElement.previousElementSibling.textContent);
                                    const total = quantity * price;
                                    subtotal += total;
                                    input.parentElement.nextElementSibling.textContent = '$' + total.toFixed(2);
                                });
                                document.querySelector('.subtotal .price').textContent = subtotal.toFixed(2);
                            }
                        </script>

                    </tbody>
                </table>

                <div class="subtotal">
                    <span class="text">Subtotal</span>
                    <span class="price">&dollar;
                        <?= $subtotal ?>
                    </span>
                </div>
                <div class="buttons">
                    <!-- <a href="home.php" class="buy_btn">Back to shop</a> -->
                    <a href="home.php#trending">Back to shop</a>
                    <input type="submit" value="Place Order" name="placeorder">
                </div>
            </form>
        </div>
    </main>

    <footer>

        <div class="footercontainer">
            <div class="socialicons">
                <a href=""> <i class="fa-brands fa-facebook"></i></a>
                <a href=""> <i class="fa-brands fa-instagram"></i></a>
                <a href=""> <i class="fa-brands fa-twitter"></i></a>
                <a href=""> <i class="fa-brands fa-google"></i></a>
                <a href=""> <i class="fa-brands fa-youtube"></i></a>
            </div>
            <div class="footernav">
                <ul>
                    <li><a href="./home.php">Home</a></li>
                    <li><a href="./home.php">Shop</a></li>
                    <li><a href="./contact.php">Contact Us</a></li>
                    <li><a href="./cart.php">My Cart</a></li>
                </ul>
            </div>
        </div>
        <div class="footerbottom">
            <p>
                copyright &copy; 2023 Designed by
                <span class="designer">Our Team</span>
            </p>
        </div>
    </footer>

</body>

</html>
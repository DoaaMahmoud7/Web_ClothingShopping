<!DOCTYPE html>
<HTML lang="en">

<HEAD>
    <!--<META NAME="GENERATOR" Content="Microsoft Visual Studio"-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <TITLE>Clothing Shopping Online</TITLE>
    <!--css-link-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/contact.css">
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
</HEAD>

<BODY>
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
                <a href="logout.php">Logout</a>
                <div class="fatma">
                    <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span class="icon_span">
                            <?php echo $num_items_in_cart ?>
                        </span> </a>

                </div>

            <?php endif ?>

    </header>

    <script>
        function toggleMenu() {
            var nav = document.querySelector("nav");
            nav.classList.toggle("active");
        }
    </script>


    <!-- end header -->
    <!-- start contact -->
    <div class="contact" id="contact">
        <div class="container">
            <div class="main-heading">

                <h2>Contact Us</h2>

                <hp>contact us if you need to know more information about us and our products</p>
            </div>
            <div class="content">
                <form action="">
                    <input class="main-input" type="text" name="name" placeholder="your name">
                    <input class="main-input" type="email" name="mail" placeholder="your email">
                    <textarea class="main-input" name="message" placeholder="your message"></textarea>
                    <input type="submit" value="send message">

                </form>
                <div class="info">
                    <h4>get in touch</h4>
                    <span class="phone">+00 123.456.789</span>
                    <span class="phone">+00 123.456.789</span>
                    <h4>where we are</h4>
                    <address>
                        Awesome addrees 17<br> new york,NYC<br>123-4567-890<br>USA
                    </address>

                </div>
            </div>

        </div>
    </div>
    <!-- end contact -->
    <!-- start footer -->
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
            <div class="footerbottom">
                <p>
                    copyright &copy; 2023 Designed by
                    <span class="designer">Our Team</span>
                </p>
            </div>
        </div>
    </footer>

    <!-- end footer -->

</BODY>

</html>
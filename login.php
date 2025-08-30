<?php
require 'function.php';
$cookieLifetime = 86400; //one day
if (isset($_POST['email'], $_POST['password'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $conn = db();
  $stmt = $conn->prepare("SELECT id, email, Group_id , password FROM customer WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    if ($row['Group_id'] === 0) {
      if ($row['password'] === $password) {
        session_set_cookie_params($cookieLifetime);
        session_start();
        session_regenerate_id();
        $_SESSION['email'] = $row['email'];
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['cart'] = array();
        $items = select_items($_SESSION['user_id']);
        foreach ($items as $item) {
          $cartKey = $item['product_id'] . '_' . $item['color'] . '_' . $item['size'];
          $_SESSION['cart'][$cartKey] = $item['quantity'];
        }
        header("Location: home.php");
        exit();
      } else {
        echo '<script>alert("Incorrect password!")</script>';
      }
    } else {
      header('location:insert.php');
    }
  } else {
    echo '<script>alert("Incorrect email!")</script>';
  }
}

?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="css/login.css" />
</head>

<body>
  <div>
    <section>
      <div class="login_box">
        <form action="login.php" method="post">
          <h2>Login</h2>
          <div class="input_box">
            <span class="icon">
              <ion-icon name="mail"></ion-icon>
            </span>
            <input type="email" name="email" required />
            <label for="">Email</label>
          </div>
          <div class="input_box">
            <span class="icon">
              <ion-icon name="lock-closed"></ion-icon>
            </span>
            <input type="password" name="password" required />
            <label for="">Password</label>
          </div>
          <div class="remember_forgot">
            <label> <input type="checkbox" />Remmber Me </label>
            <a href="signup.php">ForgetPassword?</a>
          </div>
          <button type="submit">Login</button>
          <div class="register_link">
            <p>Don't have an account? <a href="signup.php">Register</a></p>
          </div>
          <div class="backing">
            <button id="back"><a href="home.php">Back</a></button>

          </div>
        </form>

    </section>

    <div>



    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
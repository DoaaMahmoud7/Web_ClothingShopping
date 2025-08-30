<?php
require 'function.php';
if (isset($_POST["email"]) && $_POST["password"]) {
  if (($_POST["password"]) === $_POST["confirm"]) {

    $id = 0;
    $conn = db();
    $atmt = $conn->prepare("insert into customer(password,email,Group_id) VALUES(?,?,?)");
    $atmt->bind_param("ssi", $_POST["password"], $_POST["email"], $id);
    $atmt->execute();
    $atmt->close();

    $stmt = $conn->prepare("SELECT id FROM customer WHERE email =?");
    $stmt->bind_param("s", $_POST["email"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_id = $result->fetch_assoc();
    $stmt->close();

    $stmt = $conn->prepare("insert into cart (user_id) VALUES(?)");
    $stmt->bind_param("i", $user_id['id']);
    $stmt->execute();
    $stmt->close();

    $conn->close();
    header("location:login.php");
    exit();
  } else {
    echo '<script>alert("Incorrect matching!")</script>';
  }
}
?>




<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="css/signup.css" />
</head>

<body>
  <section>
    <div class="login_box">
      <form action="signup.php" method="post">
        <h2>Sign Up</h2>
        <div class="input_box">
          <span class="icon">
            <ion-icon name="person"></ion-icon>
          </span>
          <input type="name" required />
          <label for="">Name *</label>
        </div>
        <div class="input_box">
          <span class="icon">
            <ion-icon name="mail"></ion-icon>
          </span>
          <input type="email" name="email" required />
          <label for="">Email *</label>
        </div>
        <div class="input_box">
          <span class="icon">
            <ion-icon name="lock-closed"></ion-icon>
          </span>
          <input type="password" name="password" required />
          <label for="">Password *</label>
        </div>
        <div class="input_box">
          <span class="icon">
            <ion-icon name="lock-closed"></ion-icon>
          </span>
          <input type="password" name="confirm" required />
          <label for="">Confirm Password *</label>
        </div>

        <button type="submit">Sign Up</button>
        <div class="register_link">
          <p>have account? <a href="./login.php">Login here</a></p>
        </div>
        <div class="backing">
          <button id="back"><a href="login.php">Back</a></button>

        </div>
  </section>

  </form>
  </div>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
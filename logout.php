<?php
session_start();
unset($_SESSION["user_id"]);
unset($_SESSION["password"]);
header("location:login.php");
exit();
?>
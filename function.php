<?php
function db()
{
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "db";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  return $conn;
}
function select_product()
{
  $conn = db();
  $sql = "select *from product";
  $product = $conn->query($sql);
  $conn->close();
  return $product;
}

function select_id($id)
{
  $conn = db();
  $stmt = $conn->prepare("SELECT * FROM product WHERE product_id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $product = $result->fetch_assoc();
  $stmt->close();
  $conn->close();
  return $product;
}
function select_quantity($color, $size, $id)
{
  $conn = db();
  $stmt = $conn->prepare("SELECT * FROM product_atribute WHERE color = ? and size = ? and id = ?");
  $stmt->bind_param("ssi", $color, $size, $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $attributes = $result->fetch_assoc();
  $stmt->close();
  $conn->close();
  return $attributes;
}
function update_quantity($product_id, $color, $size, $quantity)
{
  $conn = db();
  $stmt = $conn->prepare("UPDATE product_atribute SET quantity = ? WHERE id = ? AND color = ? AND size = ?  ");
  $stmt->bind_param("iiss", $quantity, $product_id, $color, $size);
  if ($stmt->execute() === TRUE) {
    // update successful
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}

function select_attribute($id)
{
  $conn = db();

  $sql = "SELECT * FROM product_atribute WHERE id = $id";
  $result = $conn->query($sql);
  $attributes = $result->fetch_all(MYSQLI_ASSOC);
  $conn->close();
  return $attributes;
}
function select_items($user_id)
{
  $conn = db();
  $stmt = $conn->prepare("SELECT product_id, quantity, size, color FROM items WHERE cart_id=(SELECT cart_id FROM cart WHERE user_id=?)");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $items = $result->fetch_all(MYSQLI_ASSOC);
  $stmt->close();
  $conn->close();
  return $items;
}

function insert_items($product_id, $quantity, $user_id, $size, $color)
{
  $conn = db();
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("INSERT INTO items (cart_id, product_id, quantity, size, color) SELECT cart_id, ?, ?, ?, ? FROM cart WHERE user_id = ?");
  $stmt->bind_param("iissi", $product_id, $quantity, $size, $color, $user_id);

  if ($stmt->execute() === TRUE) {
    // Insert successful
  } else {
    echo "Error: " . $conn->error;
  }

  $stmt->close();
  $conn->close();
}


function delete_items($product_id, $user_id, $color, $size)
{
  $conn = db();
  $stmt = $conn->prepare("DELETE FROM items WHERE product_id = ? AND color = ? AND size = ? AND cart_id = (SELECT cart_id FROM cart WHERE user_id = ?)");
  $stmt->bind_param("issi", $product_id, $color, $size, $user_id);
  if ($stmt->execute() === TRUE) {
    // Delete successful
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
function clear_items()
{
  $conn = db();
  $sql = "delete from  items ";
  $conn->query($sql);

  $conn->close();
}


function update_items($product_id, $color, $size, $quantity, $user_id)
{
  $conn = db();
  $stmt = $conn->prepare("UPDATE items SET quantity = ? WHERE product_id = ? AND color = ? AND size = ?  AND cart_id = (SELECT cart_id FROM cart WHERE user_id = ?)");
  $stmt->bind_param("iissi", $quantity, $product_id, $color, $size, $user_id);
  if ($stmt->execute() === TRUE) {
    // update successful
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}




?>
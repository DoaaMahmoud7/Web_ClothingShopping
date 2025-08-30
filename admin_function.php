<?php
require('function.php');
function insert_product($image, $name, $price, $desc)
{
    $conn = db();

    $stmt = $conn->prepare('INSERT INTO product (product_name, describtion, price, image_url) VALUES (?, ?, ?, ?)');

    $stmt->bind_param('ssis', $name, $desc, $price, $image);

    $stmt->execute();

    $row_id = $stmt->insert_id; // Retrieve the ID of the last inserted row

    $stmt->close();
    $conn->close();

    $_SESSION['id'] = $row_id; // Return the ID of the last inserted row
}

function insert_attribute($color, $size, $quantity, $id)
{
    $conn = db();

    $stmt = $conn->prepare('INSERT INTO product_atribute (color,size,id,quantity) VALUES (?, ?, ?, ?)');

    $stmt->bind_param('ssii', $color, $size, $id, $quantity);

    $stmt->execute();
    $stmt->close();
}
function search($id)
{
    $conn = db();
    $stmt = $conn->prepare("SELECT * FROM product_atribute WHERE item_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $attribute = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $attribute;
}
function get_ids()
{
    $conn = db();
    $sql = "SELECT * FROM product_atribute ";
    $result = $conn->query($sql);
    $ids = $result->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $ids;

}
function add_quantity($id, $quantity)
{
    $conn = db();
    $stmt = $conn->prepare("UPDATE product_atribute SET quantity = ? WHERE item_id = ?");
    $stmt->bind_param("ii", $quantity, $id);
    if ($stmt->execute() === TRUE) {
        // Update successful
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function update_price($id, $price)
{
    $conn = db();
    $stmt = $conn->prepare("UPDATE product SET price = ? WHERE product_id = ?");
    $stmt->bind_param("ii", $price, $id);
    if ($stmt->execute() === TRUE) {
        // Update successful
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

?>
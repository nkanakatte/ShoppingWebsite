<?php
require_once('database.php');
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['checkout'] = true;
    header("Location:login.php");
    exit();
}

$cart = $_SESSION['cart'];

$order_id = add_order();
$allSaved = true;
foreach ($cart as $product_id => $item) {
    $order_item_id = add_order_item(
        $order_id,
        $item['id'],
        $item['price'],
        $item['quantity']
    );
    if ($order_item_id != 0) {
        $quantity_reduced = reduce_quantity($item['id'], $item['quantity']);
    }
    if ($order_item_id == 0 && $quantity_reduced == false) {
        $allSaved = false;
    }
}
if ($allSaved) {
    clear_cart();
    Header('Location:' . 'order_confirmation.php');
}

// Remove all items from the cart
function clear_cart()
{
    $_SESSION['cart'] = array();
}

function add_order()
{
    global $db;
    $customer_id = $_SESSION['user']['ID'];
    $order_date = date("Y-m-d H:i:s");

    $query = 'INSERT INTO orders (CustomerID, OrderDate, isDeleted)
         VALUES (:customer_id, :order_date, 0)';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->bindValue(':order_date', $order_date);
    $statement->execute();
    $order_id = $db->lastInsertId();
    $statement->closeCursor();
    return $order_id;
}

function add_order_item(
    $order_id,
    $product_id,
    $item_price,
    $quantity
) {
    global $db;
    $query = 'INSERT INTO OrderItems (OrderID, ProductID, Price, Quantity)
        VALUES (:order_id, :product_id, :item_price, :quantity)';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->bindValue(':product_id', $product_id);
    $statement->bindValue(':item_price', $item_price);
    $statement->bindValue(':quantity', $quantity);
    $statement->execute();
    $order_item_id = $db->lastInsertId();
    $statement->closeCursor();
    return $order_item_id;
}

function reduce_quantity($product_id, $quantity)
{
    global $db;

    $query = 'update Products set Quantity=Quantity - :quantity
        where Id=:product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->bindValue(':quantity', $quantity);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}

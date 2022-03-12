<?php
require_once('database.php');
session_start();

if (!isset($_POST['checkout'])) {
    $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $quantity = filter_input(INPUT_POST, 'quantity');

    // validate the quantity entry

    // Create an empty cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    // check if the Quantity exists in the database
    $product_exists = check_quantity($product_id, $quantity);
    if ($product_exists) {
        $size=count($_SESSION['cart']);
        $_SESSION['cart'][$product_id] = round($quantity, 0);
        $size=count($_SESSION['cart']);
        // Get all items from the cart
        $cart = cart_get_items();
        $_SESSION['cart'] =$cart;
        //setcookie('cart', json_encode($cart), time() + 3600);
    } else {
        // Send back to index.php with a message
        $_SESSION['message'] = 'Not enough quantity in stock.';
        $_SESSION['pid'] = $product_id;
        header("Location:index.php");
    }
}
// Get an array of items for the cart
function cart_get_items()
{
    require_once('database.php');
    $items = array();
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        // Get product data from db
        $product = get_product($product_id);
        $quantity = intval($quantity);
        // Store data in items array
        $items[$product_id]['id'] = $product_id;
        $items[$product_id]['name'] = $product['Name'];
        $items[$product_id]['description'] = $product['Description'];
        $items[$product_id]['price'] = $product['Price'];
        $items[$product_id]['quantity'] = $quantity;
        $items[$product_id]['total'] = $quantity * $product['Price'];
    }
    return $items;
}

// Get the number of products in the cart
function cart_product_count()
{
    return count($_SESSION['cart']);
}

// Get the subtotal for the cart
function cart_subtotal()
{
    $subtotal = 0;
    $cart = cart_get_items();
    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    return $subtotal;
}

function get_product($product_id)
{
    global $db;
    $query = 'SELECT * FROM products WHERE Id = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}

function check_quantity($product_id, $quantity)
{
    global $db;
    $query = 'SELECT quantity FROM `Products` WHERE Id=:product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $result = $statement->fetch();
    if ($result['quantity'] > $quantity) {
        $valid = true;
        $statement->closeCursor();
        return $valid;
    } else {
        $valid = false;
        $statement->closeCursor();
        return $valid;
    }
}

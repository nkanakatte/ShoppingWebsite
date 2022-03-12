<?php
require_once('database.php');
require_once('valid_admin.php');

// Get the product values form data and sanitize the input
$quantity = filter_input(INPUT_POST, 'Quantity', FILTER_VALIDATE_INT);
$orderItemid = filter_input(INPUT_POST, 'order_item_id', FILTER_VALIDATE_INT);
$orderid = filter_input(INPUT_POST, 'OrderID', FILTER_VALIDATE_INT);

// Get the current ordered quantity from the database
$queryAllOrders = 'SELECT OI.OrderID,oi.Quantity,p.Id FROM `OrderItems` OI
join orders o on oi.OrderID=o.ID
join Products p on OI.ProductID=p.Id
where OI.ID=:orderItemid';
$statement = $db->prepare($queryAllOrders);
$statement->bindValue(':orderItemid', $orderItemid);
$statement->execute();
$order = $statement->fetch();
$statement->closeCursor();


// update the product to the database  
if ($orderItemid == null || $quantity == null) {
    $error = "Invalid data. Check all fields and try again.";
    include('error.php');
} else {
    $query = 'update OrderItems set Quantity=:quantity WHERE ID = :orderItemid';
    $statement = $db->prepare($query);
    $statement->bindValue(':quantity', $quantity);
    $statement->bindValue(':orderItemid', $orderItemid);
    $statement->execute();
    $statement->closeCursor();
}

// Get the details for the product
$query = 'select * from Products
where Id=:id';
$statement = $db->prepare($query);
$statement->bindValue(':id', $order['Id']);
$statement->execute();
$product = $statement->fetch();
$statement->closeCursor();


// if the new quantity is less than previous, increase the available stock else decrease
if ($quantity > $order['Quantity']) {
    $quantity = $quantity- $order['Quantity'];
    $newQuantity = $product['Quantity']-$quantity;

    $query = 'update Products set Quantity=:quantity WHERE Id = :id';

    $statement = $db->prepare($query);
    $statement->bindValue(':quantity', $newQuantity);
    $statement->bindValue(':id', $order['Id']);
    $statement->execute();
    $statement->closeCursor();
} else {
    $quantity = $order['Quantity'] - $quantity ;
    $newQuantity = $product['Quantity']+$quantity;

    $query = 'update Products set Quantity=:quantity WHERE Id = :id';

    $statement = $db->prepare($query);
    $statement->bindValue(':quantity', $newQuantity);
    $statement->bindValue(':id', $order['Id']);
    $statement->execute();
    $statement->closeCursor();
}

$_GET['id'] = $orderid;
// Display the Home page
include('order.php');

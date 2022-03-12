<?php
require_once('database.php');

// Get the product details form data and sanitize the input
$productName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
$productid = filter_input(INPUT_POST, 'product_id');

// Add the product to the database  
if ($productName == null || $description == null || $price == null || is_null($quantity)) {
    $error = "Invalid data. Check all fields and try again.";
    include('error.php');
} else {
    if ($productid == null) {
        $query = 'INSERT INTO Products
                 (Name, Description, Price, Quantity, isDeleted)
              VALUES
                 (:productName, :description, :price, :quantity, :isDeleted)';
        $statement = $db->prepare($query);
        $statement->bindValue(':productName', $productName);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':isDeleted', 0);
        $statement->execute();
        $statement->closeCursor();
    } else {
        $query = 'update Products set Name=:productName, Description=:description, 
        Price=:price, Quantity=:quantity WHERE Id = :id';

        $statement = $db->prepare($query);
        $statement->bindValue(':productName', $productName);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':id', $productid);
        $statement->execute();
        $statement->closeCursor();
    }
}


// Display the product List page
include('products_list.php');

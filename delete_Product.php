<?php
require_once('database.php');
$productid = $_GET['id'];

// Delete the product from the database
if ($productid != null) {
    $query = 'update products set isDeleted=1
              WHERE Id = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $productid);
    $success = $statement->execute();
    $statement->closeCursor();    
}

// Display the Home page
include('products_list.php');
<?php
require_once('database.php');
require_once('valid_admin.php');

$orderid = $_GET['id'];
$customerid = $_GET['customerid'];

// Delete the order from the database
if ($orderid != null) {
    $query = 'update Orders set isDeleted=1
              WHERE ID = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $orderid);
    $success = $statement->execute();
    $statement->closeCursor();
}
$_GET['id'] = $customerid;
// Display the Home page
include('view_orders.php');

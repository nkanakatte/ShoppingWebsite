<?php

require_once('database.php');

// Get the customer form data and sanitize the input
$firstName = filter_input(INPUT_POST, 'firstName',FILTER_SANITIZE_STRING);
$lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

// Add the customer to the database  
if ($firstName == null || $lastName == null || $email == null) {
    $error = "Invalid data. Check all fields and try again.";
    include('error.php');
} else {
    $query = 'INSERT INTO Customers
                 (FirstName, LastName, Email)
              VALUES
                 (:firstName, :lastName, :email)';
    $statement = $db->prepare($query);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $statement->closeCursor();
}


// Display the customer List page
include('index.php');

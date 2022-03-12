<?php
require_once('database.php');

session_start();
if (!isset($_SESSION['is_valid_admin'])) {
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        header("Location:login.php");
    } else {
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        if (is_valid_admin_login($email, $password)) {
            $_SESSION['is_valid_admin'] = true;
            $_SESSION['user'] = get_admin_by_email($email);
            header("Location:admin.php");
        } elseif (is_valid_customer_login($email, $password)) {
            $_SESSION['is_valid_customer'] = true;
            $_SESSION['user'] = get_customer_by_email($email);
            if (isset($_SESSION['checkout'])) {
                header("Location:checkout.php");
            } else {
                header("Location:customer.php");
            }
        } else {
            $login_message = 'Invalid credentials. Please try again.';
            include('login.php');
        }
    }
}
else{
    header("Location:admin.php");
}
function is_valid_customer_login($email, $password)
{
    global $db;
    $query = '
        SELECT * FROM customers
        WHERE Email = :email AND Password = :password';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}


function is_valid_admin_login($email, $password)
{
    global $db;
    $query = 'SELECT ID FROM Administrators
            WHERE emailAddress = :email AND password = :password';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}
function get_customer_by_email($email)
{
    global $db;
    $query = 'SELECT * FROM customers WHERE Email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();
    return $customer;
}

function get_admin_by_email($email)
{
    global $db;
    $query = 'SELECT * FROM Administrators WHERE EmailAddress = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();
    return $customer;
}
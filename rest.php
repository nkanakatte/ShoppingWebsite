<?php
require_once('database.php');

if (isset($_GET['object'])) {
    if ($_GET['object'] == "products") {
        header("content-type: application/json;");
        if (!$_GET['action']) {
            // Get all Products from the database
            $queryAllProducts = 'select Id, Name, Description, Price, Quantity FROM Products where isDeleted = 0 order by ID';
            $statement = $db->prepare($queryAllProducts);
            $statement->execute();
            $products = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();

            // Check if there are products
            if (!empty($products)) {
                echo json_encode($products, JSON_PRETTY_PRINT);
            } else {
                echo "No Products found in the database";
            }
        } elseif (isset($_GET['action']) && $_GET['action'] == "keyword") {
            if (isset($_GET['term'])) {
                // Get all Products with the keyword matching the name
                $pattern = '%' . $_GET['term'] . '%';
                $queryAllProducts = 'select Id, Name, Description, Price, Quantity FROM Products where Name like :text and isDeleted = 0 order by ID';
                $statement2 = $db->prepare($queryAllProducts);
                $statement2->bindValue(':text', $pattern);
                $statement2->execute();
                $products = $statement2->fetchAll(PDO::FETCH_ASSOC);
                $statement2->closeCursor();

                // Check if there are products
                if (!empty($products)) {
                    echo json_encode($products, JSON_PRETTY_PRINT);
                } else {
                    echo "Products not found";
                }
            } else {
                echo "Invalid format";
            }
        } elseif (isset($_GET['action']) && $_GET['action'] == "pricerange") {
            if (isset($_GET['start']) && isset($_GET['end'])) {
                // Get all Products within the price range
                $start = $_GET['start'];
                $end = $_GET['end'];
                $queryAllProducts = 'select Id, Name, Description, Price, Quantity FROM Products where price >= :start and Price < :end and isDeleted = 0 order by ID';
                $statement2 = $db->prepare($queryAllProducts);
                $statement2->bindValue(':start', $start);
                $statement2->bindValue(':end', $end);
                $statement2->execute();
                $products = $statement2->fetchAll(PDO::FETCH_ASSOC);
                $statement2->closeCursor();

                // Check if there are products 
                if (!empty($products)) {
                    echo json_encode($products, JSON_PRETTY_PRINT);
                } else {
                    echo "Products not found";
                }
            } else {
                echo "Invalid format";
            }
        } else {
            echo "Invalid format";
        }
    } else {
        echo "Invalid format";
    }
}

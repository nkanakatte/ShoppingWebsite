<?php
require_once('database.php');

// Get all Products matching the search Text
$searchText = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
$pattern = '%' . $searchText . '%';

$queryAllProducts = 'SELECT * FROM Products WHERE Name like :text or Description like :text and isDeleted = 0 order by ID' ;
$statement = $db->prepare($queryAllProducts);
$statement->bindValue(':text', $pattern);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();
?>
<?php include 'header.php'; ?>

    <main>
        <h2>Search Results for: <?php echo $searchText ?></h2>
        <?php if (!$products == null) { ?>
            <table>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td width="30px">
                    <p><?php echo $product['Name']; ?></p>
                </td>
                <td width="30px">
                    <p><?php echo $product['Description']; ?></p>
                </td>
                <td width="30px">
                    <p>$<?php echo $product['Price']; ?> each</p>
                </td>
                <td width="30px">
                    <p>Available <?php if ($product['Quantity'] == 0) {
                                        echo 'Out of Stock';
                                    } else {
                                        echo $product['Quantity']; ?>
                </td>
                <td width="30px">
                    <form action="cart_view.php" method="POST" id="add_to_cart_form">
                        <input type="hidden" name="product_id" value="<?php echo $product['Id'] ?>" />
                        <b>Quantity:</b>&nbsp;
                        <input type="text" name="quantity" value="1" size="2" required />
                        <input type="submit" value="Add to Cart" class="addtocartButton" />
                    </form>
                <?php
                                        if (isset($message) && ($pid == $product['Id'])) {
                                            echo $message;
                                        }
                                    } ?>
                </p>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
        <?php } else {
            echo 'No products found were matching your search text. Please try a different search text. ';
        } ?>

    </main>

    <?php include 'footer.php'; ?>
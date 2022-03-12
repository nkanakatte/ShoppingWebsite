<?php
require_once('database.php');
$lifetime = 60 * 60;
session_set_cookie_params($lifetime, '/');
session_start();

$queryAllProducts = 'SELECT * FROM products where isDeleted = 0 order by ID';
$statement = $db->prepare($queryAllProducts);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();
// if (isset($_SESSION['cart'])) {
//     $_SESSION['cart'] = array();
// }
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $pid = $_SESSION['pid'];
    unset($_SESSION['message']);
    unset($_SESSION['pid']);
}
?>
<?php include 'header.php'; ?>
<main>
    <div class="welcomeBlock">
        <h3>Welcome to Samshta Sports Shop</h3>
        <p>The ultimate place to buy sports equipment for all ages. You will have an experience like never before and get a guaranteed 100% satisfaction.</p>
    </div>

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
                    <?php if ($product['Quantity'] == 0) {
                                        echo 'Out of Stock';
                                    } else {?>
                                        <p>Available 
                                        <?php echo $product['Quantity']; ?>
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
</main>
<?php include 'footer.php'; ?>
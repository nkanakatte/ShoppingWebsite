<?php
require('database.php');
require_once('valid_admin.php');

$productid = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
if (!$productid == null) {
    $query = 'select * from Products
              where Id=:id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $productid);
    $statement->execute();
    $product = $statement->fetch();
    $statement->closeCursor();
}


?>
<?php include 'header.php'; ?>

<main>
    <h2>Add A Product</h2>
    <form action="add_product.php" method="post" id="add_product_form">
        <table>
            <tr>
                <td width="10%">
                    <label class="label">Product Name</label>
                </td>
                <td>
                    <input type="text" name="name" value="<?php echo $product['Name']; ?>" required class="input">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label">Description</label>
                </td>
                <td>
                    <textarea name="description" rows="5" columns="75" class="input" required><?php echo $product['Description']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label">Price</label>
                </td>
                <td>
                    <input type="text" name="price" value="<?php echo $product['Price']; ?>" required class="input">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label">Quantity in Stock</label>
                </td>
                <td>
                    <input type="text" name="quantity" value="<?php echo $product['Quantity']; ?>" required class="input">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="product_id" value="<?php echo $product['Id']; ?>">
                    <?php if ($productid == null) { ?>
                        <input type="submit" value="Add Product" class="loginButton"><br>
                    <?php } else { ?>
                        <input type="submit" value="Update Product" class="loginButton"><br><?php } ?>
                </td>

    </form>
    </table>
    <input type="button" class="loginButton" onclick="location.href='admin.php';" value="Admin Home" />
</main>
<footer class="footer">
    <p class="footerp">© <?php echo date("Y"); ?> All rights reserved. No content or images, either in full or part can be reproduced
        without explicit permission from the Company.</p>
</footer>
</body>

</html>
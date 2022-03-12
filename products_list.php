<?php
require_once('database.php');
require_once('valid_admin.php');

$queryAllProducts = 'SELECT * FROM products where isDeleted = 0 order by ID';
$statement = $db->prepare($queryAllProducts);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();
?>
<?php include 'header.php'; ?>
    <main>
        <h2>Product List</h2>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Price</th>
                <th>Quantity In Stock</th>
            </tr>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <!-- add code for the rest of the table here -->
                    <td>
                        <?php echo $product['Name']; ?>
                    </td>
                    <td>
                        <?php echo $product['Description']; ?>
                    </td>
                    <td>
                        <?php echo $product['Price']; ?>
                    </td>
                    <td>
                        <?php echo $product['Quantity']; ?>
                    </td>
                    <td>
                        <a href="add_product_form.php?id=<?php echo $product['Id']; ?>"> Edit
                        </a>
                    </td>
                    <td>
                        <a href="delete_product.php?id=<?php echo $product['Id']; ?>"> Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <input type="button" class="loginButton" onclick="location.href='add_product_form.php';" value="Add Product"/>
        <input type="button" class="loginButton" onclick="location.href='admin.php';" value="Admin Home"/>

        </main>
  <footer class="footer">
    <p class="footerp">© <?php echo date("Y"); ?> All rights reserved. No content or images, either in full or part can be reproduced
        without explicit permission from the Company.</p>
</footer>
</body>

</html>
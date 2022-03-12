<?php
require('database.php');
require_once('valid_admin.php');

$orderid = $_GET['id'];

$queryAllOrders = 'SELECT OI.ID, OI.OrderID,o.OrderDate,p.Name,oi.Price,oi.Quantity FROM `OrderItems` OI
join orders o on oi.OrderID=o.ID
join Products p on OI.ProductID=p.Id
where OI.ID=:orderid';
$statement = $db->prepare($queryAllOrders);
$statement->bindValue(':orderid', $orderid);
$statement->execute();
$order = $statement->fetch();
$statement->closeCursor();

?>
<?php include 'header.php'; ?>

<main>
    <h2>Update Order</h2>
    <form action="edit_order.php" method="post" id="edit_order_form">
        <table>
            <tr>
                <td width="10%">
                    <label class="label">Order ID</label>
                </td>
                <td>
                    <input type="text" name="OrderID" value="<?php echo $order['OrderID']; ?>" readonly class="input">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label">Order Date</label>
                </td>
                <td>
                    <input type="text" name="OrderDate" value="<?php echo $order['OrderDate']; ?>" readonly class="input">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label">Product</label>
                </td>
                <td>
                    <input type="text" name="Product" value="<?php echo $order['Name']; ?>" readonly class="input">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label">Price</label>
                </td>
                <td>
                    <input type="text" name="price" value="<?php echo $order['Price']; ?>" readonly class="input">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label">Quantity</label>
                </td>
                <td>
                    <input type="text" name="Quantity" value="<?php echo $order['Quantity']; ?>" required class="input">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="order_item_id" value="<?php echo $order['ID']; ?>">

                    <label>&nbsp;</label>
                    <input type="submit" value="Update Order" class="loginButton">
                    </td>
            </tr>
        </table>
    </form>
    <input type="button" class="loginButton" onclick="location.href='admin.php';" value="Admin Home" />
    </main>
  <footer class="footer">
    <p class="footerp">© <?php echo date("Y"); ?> All rights reserved. No content or images, either in full or part can be reproduced
        without explicit permission from the Company.</p>
</footer>
</body>

</html>
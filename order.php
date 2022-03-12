<?php
require_once('database.php');
require_once('valid_admin.php');

$orderid = $_GET['id'];

$queryAllOrders = 'SELECT OI.ID, OI.OrderID,o.OrderDate,p.Name,oi.Price,oi.Quantity,o.CustomerID FROM `OrderItems` OI
join orders o on oi.OrderID=o.ID
join Products p on OI.ProductID=p.Id
where OrderID=:orderid order by OI.ID asc';
$statement = $db->prepare($queryAllOrders);
$statement->bindValue(':orderid', $orderid);
$statement->execute();
$orders = $statement->fetchAll();
$statement->closeCursor();


function cart_subtotal($orders)
{
    $subtotal = 0;
    foreach ($orders as $order) {
        $subtotal += $order['Price'] * $order['Quantity'];
    }
    return $subtotal;
}
?>
<?php include 'header.php'; ?>

    <main>
        <h2>View Order</h2>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <!-- add code for the rest of the table here -->
                    <td>
                        <?php echo $order['OrderID']; 
                        $customerID=$order['CustomerID']?>
                    </td>
                    <td>
                        <?php echo $order['OrderDate']; ?>
                    </td>
                    <td>
                        <?php echo $order['Name']; ?>
                    </td>
                    <td>
                        <?php echo $order['Price']; ?>
                    </td>
                     <td>
                        <?php echo $order['Quantity']; ?>
                    </td>
                    <td>
                        <a href="edit_order_form.php?id=<?php echo $order['ID']; ?>"> Edit
                        </a>
                    </td>
                  
                </tr>
                <?php endforeach; ?>
                <tr id="cart_footer">
                    <td colspan="4" class="right"><b>Subtotal</b></td>
                    <td class="right">
                        <?php echo sprintf('$%.2f', cart_subtotal($orders)); ?>
                    </td>
                    <td class="right"></td>
                </tr>
        </table>
        <input type="button" class="loginButton" onclick="location.href='view_orders.php?id=<?php echo $customerID; ?>';" value="Back to Orders"/>

        </main>
  <footer class="footer">
    <p class="footerp">© <?php echo date("Y"); ?> All rights reserved. No content or images, either in full or part can be reproduced
        without explicit permission from the Company.</p>
</footer>
</body>

</html>
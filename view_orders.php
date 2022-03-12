<?php
require_once('database.php');
require_once('valid_admin.php');

$customerid = $_GET['id'];

$queryAllOrders = 'SELECT * FROM Orders where customerID = :customerid and isDeleted=0 order by OrderDate desc';
$statement = $db->prepare($queryAllOrders);
$statement->bindValue(':customerid', $customerid);
$statement->execute();
$orders = $statement->fetchAll();
$statement->closeCursor();
?>
<?php include 'header.php'; ?>
    <main>
        <h2>View Orders</h2>
        <?php if (!$orders == null) { ?>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Action</th>
            </tr>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <!-- add code for the rest of the table here -->
                    <td>
                        <?php echo $order['ID']; ?>
                    </td>
                    <td>
                        <?php echo $order['OrderDate']; ?>
                    </td>
                    <td>
                        <a href="order.php?id=<?php echo $order['ID']; ?>"> View Order
                        </a>
                    </td>
                    <td>
                        <a href="delete_order.php?id=<?php echo $order['ID']; ?>&customerid=<?php echo $customerid ?>"> Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php }else{
            echo 'No order for the selected Customer.'; 
        }?>
        <input type="button" class="loginButton" onclick="location.href='customers_list.php';" value="Back to Customers"/>
       
        </main>
  <footer class="footer">
    <p class="footerp">© <?php echo date("Y"); ?> All rights reserved. No content or images, either in full or part can be reproduced
        without explicit permission from the Company.</p>
</footer>
</body>

</html>
<?php
require_once('database.php');
session_start();

if (!isset($_SESSION['is_valid_customer'])) {
    header("Location:login.php");
}
$customer = $_SESSION['user'];
$customerid = $customer['ID'];

$queryAllOrders = 'SELECT * FROM Orders where customerID = :customerid and isDeleted=0 order by OrderDate desc';
$statement = $db->prepare($queryAllOrders);
$statement->bindValue(':customerid', $customerid);
$statement->execute();
$orders = $statement->fetchAll();
$statement->closeCursor();
?>
<?php include 'header.php'; ?>

    <main>
    <h3> Welcome <?php echo $_SESSION['user']['FirstName']?>!</h3>
        <p>My Orders</p>
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
                        <a href="customer_orders.php?id=<?php echo $order['ID']; ?>"> View Order
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <input type="button" class="loginButton" onclick="location.href='logout.php';" value="Logout"/>
    </main>

    </main>
  <footer class="footer">
    <p class="footerp">© <?php echo date("Y"); ?> All rights reserved. No content or images, either in full or part can be reproduced
        without explicit permission from the Company.</p>
</footer>
</body>

</html>
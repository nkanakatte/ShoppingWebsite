<?php
require_once('database.php');
session_start();

if (!isset($_SESSION['is_valid_customer'])) {
    header("Location:login.php");
}

$orderid = $_GET['id'];
$queryAllOrders = 'SELECT OI.ID, OI.OrderID,o.OrderDate,p.Name,oi.Price,oi.Quantity,o.CustomerID FROM `OrderItems` OI
join orders o on oi.OrderID=o.ID
join Products p on OI.ProductID=p.Id
where OrderID=:orderid';
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
        <h2>My Order</h2>
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
        <input type="button" class="loginButton" onclick="location.href='customer.php';" value="Back to Orders"/>

    </main>

    <?php include 'footer.php'; ?>
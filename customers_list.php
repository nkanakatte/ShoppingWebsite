<?php
require_once('database.php');
require_once('valid_admin.php');

$queryAllCustomers = 'SELECT * FROM Customers where isDeleted = 0 order by ID';
$statement = $db->prepare($queryAllCustomers);
$statement->execute();
$customers = $statement->fetchAll();
$statement->closeCursor();
?>
<?php include 'header.php'; ?>
    <main>
        <h2>Customers List</h2>
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php foreach ($customers as $customer) : ?>
                <tr>
                    <!-- add code for the rest of the table here -->
                    <td>
                        <?php echo $customer['FirstName']; ?>
                    </td>
                    <td>
                        <?php echo $customer['LastName']; ?>
                    </td>
                    <td>
                        <?php echo $customer['Email']; ?>
                    </td>
                    <td>
                        <a href="view_orders.php?id=<?php echo $customer['ID']; ?>"> View Orders
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <input type="button" class="loginButton" onclick="location.href='admin.php';" value="Admin Home"/>
        </main>
  <footer class="footer">
    <p class="footerp">© <?php echo date("Y"); ?> All rights reserved. No content or images, either in full or part can be reproduced
        without explicit permission from the Company.</p>
</footer>
</body>

</html>
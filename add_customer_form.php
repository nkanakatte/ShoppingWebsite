<?php
require('database.php');
require_once('valid_admin.php');
?>
<?php include 'header.php'; ?>


<main>
    <h2>Add A Customer</h2>
    <form action="add_customer.php" method="post" id="add_customer_form">
        <table>
            <tr>
                <td width="10%">
                    <label class="label">First Name</label>
                </td>
                <td>
                    <input type="text" name="firstName" class="input" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label">Last Name</label>
                </td>
                <td>
                    <input type="text" name="lastName" required class="input">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label">Email</label>
                </td>
                <td>
                    <input type="email" name="email" required class="input">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Add Customer" class="loginButton">
                </td>
            </tr>
        </table>
    </form>
    <input type="button" class="loginButton" onclick="location.href='admin.php';" value="Admin Home" />
</main>

<?php include 'footer.php'; ?>
<?php
require_once('database.php');
require_once('valid_admin.php');
?>
<?php include 'header.php'; ?>


  <p> Welcome <?php echo $_SESSION['user']['FirstName']?>!</p>
  <input type="button" class="loginButton" onclick="location.href='products_list.php';" value="Products"/>
  <input type="button" class="loginButton" onclick="location.href='customers_list.php';" value="Customers"/>
  <input type="button" class="loginButton" onclick="location.href='add_customer_form.php';" value="Add A Customer"/>
  <input type="button" class="loginButton" onclick="location.href='logout.php';" value="Logout"/>
  </main>
  <footer class="footer">
    <p class="footerp">© <?php echo date("Y"); ?> All rights reserved. No content or images, either in full or part can be reproduced
        without explicit permission from the Company.</p>
</footer>
</body>

</html>
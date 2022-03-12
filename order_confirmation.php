<?php
if (isset($_GET['logout'])) {
    session_start();
    $_SESSION = array();
    $_SESSION['user'] = array();
    session_destroy();
    header("Location:index.php");
    exit;
}
?>

<?php include 'header.php'; ?>

<body>
    <p> Your order has been placed.
        <form action="order_confirmation.php" method="GET">
        <input type="hidden" name="logout" value="true" />
            <button type="submit" class="loginButton">Logout</button>
        </form>
        <input type="button" class="loginButton" onclick="location.href='customer.php';" value="View My Orders"/>
    </p>

    </main>
  <footer class="footer">
    <p class="footerp">© <?php echo date("Y"); ?> All rights reserved. No content or images, either in full or part can be reproduced
        without explicit permission from the Company.</p>
</footer>
</body>

</html>
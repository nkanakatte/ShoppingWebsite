<?php include 'header.php'; ?>

<main>
    <h2>Login</h2>
    <?php
    if (isset($login_message)) {
        echo $login_message;
    }
    ?>
    <form action="auth.php" method="post" id="login_form">
        <input type="hidden" name="action" value="login">

        <label class="label">Email</label>
        <input type="text" class="input" name="email" required>
        <br>

        <label>Password</label>
        <input type="password" class="input" name="password" required>
        <br>

        <input type="submit" value="Login" class="loginButton">
    </form>
</main>
<footer class="footer">
    <p class="footerp">© <?php echo date("Y"); ?> All rights reserved. No content or images, either in full or part can be reproduced
        without explicit permission from the Company.</p>
</footer>
</body>

</html>
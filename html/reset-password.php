<?php
/*
 * This is the login page.
 * Everyone can access it.
 */
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Reset your password </title>

    <!-- Fonts imports -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Stylesheets imports -->
    <link href="../css/base.css" rel="stylesheet">
    <link href="../css/registration.css" rel="stylesheet">

    <!-- Viewport Configuration -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="column">
    <div class="form centered">
        <h1>Reset your password</h1>
        <p>An e-mail will be sent to you with further instructions on how to reset your password.</p>
        <form action="../backend/reset-request.php" method="post">
            <label>
                <input type="text" placeholder="Type your e-mail here" id="email" name="email"/>
            </label>
            <button class="bold" name="reset-password-submit">Send e-mail</button>
        </form>
        <?php
        if (isset($_GET["reset"])) {
            if ($_GET["reset"] == "success") {
                echo "<p>Check your e-mail!</p>";
            }
        }
        ?>
    </div>
</div>
</body>
</html>

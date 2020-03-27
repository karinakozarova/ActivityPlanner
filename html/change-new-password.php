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
    <title> Login </title>
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
        <?php
          $selector = $_GET["selector"];
          $validator = $_GET["validator"];

          if(empty($selector) || empty($validator))
          {
              echo "<p>Failed to validate your request.</p>";
          }
          else
          {
              if(ctype_xdigit($selector) == true && ctype_xdigit($validator) == true)
              {
                  ?>
                  <form action="../backend/password-reset.php" method="post">
                      <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                      <input type="hidden" name="validator" value="<?php echo $validator; ?>">
                      <label>
                          <input type="password" placeholder="Enter new password" id="password" name="password"/>
                      </label>
                      <label>
                          <input type="password" placeholder="Repeat new password" id="confirmPassword" name="password-repeat"/>
                      </label>
                      <button class="bold" name="reset-password-submit">Reset password</button>
                  </form>
                  <?php
              }
          }
        ?>
    </div>
</div>
</body>
</html>

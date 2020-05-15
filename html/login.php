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
<?php require_once("../configurations/db.php"); ?>

<div class="column">
    <div class="form centered">
        <h1> Login to ActivityPlanner </h1>

        <?php
        $invalidLogin = false;
        $missingCredentials = false;

        if (isset($_POST["submitted"])) {
            if (empty($_POST['username']) || empty($_POST['password'])) {
                $missingCredentials = true;
            } else {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $login_query = $conn->prepare("SELECT password FROM users WHERE username=:username");
                $login_query->bindValue(":username", $username);
                $login_query->execute();
                $row = $login_query->fetch();

                if (password_verify($password, $row["password"])) {
                    $_SESSION["username"] = $_POST['username'];
                    header('Location: profile-dashboard.php');
                    exit;
                } else {
                    $invalidLogin = true;
                }
            }
        }
        ?>
        <?php
        if (isset($_GET["password"])) {
            if ($_GET["password"] == "updated") { ?>
                <div class="success-message"> Successfully changed password.</div>
                <?php
                $_SESSION["recentlyUpdatedPassword"] = true;
            }
        }
        ?>
        <div class="error-message <?php if ($invalidLogin == false) {
            echo "hidden";
        } ?>" id="invalidLoginError">
            Invalid login credentials. Please check your username or password and try again
        </div>
        <div class="error-message <?php if ($missingCredentials == false) {
            echo "hidden";
        } ?>" id="populatedFieldsError">
            Not all fields are populated
        </div>
        <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label>
                <input type="text" placeholder="Username" id="username" name="username"/>
            </label>
            <label>
                <input type="password" placeholder="Password" id="password" name="password"/>
            </label>
            <input type="hidden" name="submitted" value=1>
            <button class="bold">login</button>
            <b><p>Not registered yet? <a href="register.php">Create an account</a></p></b>
            <a href="reset-password.php">Forgot your passsword?</a>
        </form>
    </div>
</div>
</body>
</html>

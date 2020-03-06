<!DOCTYPE html>
<html lang="en">

<head>
    <title> Register </title>
    <!-- Fonts imports -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Stylesheets imports -->
    <link href="../css/base.css" rel="stylesheet">
    <link href="../css/registration.css" rel="stylesheet">

    <!-- Javascript imports -->
    <script type="application/javascript" src="../js/registration.js"></script>

    <!-- Viewport Configuration -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php require_once "../configurations/db.php"; ?>
    <div class="column">
        <div class="form centered">
            <h1> Create account </h1>
            <?php if(isset($_SESSION) && $_SESSION['usernameIsNotUnique']) { ?>
            <div class="error-message" id="validMailError">
                Please enter a valid email address
            </div>
            <?php } ?>
            <div class="error-message hidden" id="validMailError">
                Please enter a valid email address
            </div>
            <div class="error-message hidden" id="passwordsMatchError">
                Passwords don't match
            </div>
            <div class="error-message hidden" id = "populatedFieldsError">
                Not all fields are populated
            </div>
            <form class="login-form" action="profile-dashboard.php" method="post" onsubmit="//return validateForm()">
                <table>
                    <tr>
                        <td>
                            <input type="text" placeholder="First name" id="firstname" name="firstname"/>
                        </td>
                        <td>
                            <input type="text" placeholder="Last name" id="lastname" name="lastname" style="margin-left: 3px;"/>
                        </td>
                    </tr>
                </table>
                <label>
                    <input type="text" placeholder="Username" id="username" name="username"/>
                </label>
                <label>
                    <input type="text" placeholder="Email address" id="email" name="email"/>
                </label>
                <label>
                    <input type="password" placeholder="Password" id="password" name="password"/>
                </label>
                <label>
                    <input type="password" placeholder="Confirm Password" id="confirmPassword"/>
                </label>
                <button class="bold" type="submit"> Register</button>
                <p>
                    <b>Already have an account?
                        <a href="login.html">Login here</a>
                    </b>
                </p>
            </form>
        </div>
    </div>
</body>
</html>

<?php
/*
 * This is the edit profile page
 * If a user cant be logged in, it redirects to the index page.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
    <!-- Fonts imports -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Stylesheets imports -->
    <link href="../css/profile.css" rel="stylesheet">
    <link href="../css/editProfile.css" rel="stylesheet">

    <!-- Javascript imports -->
    <script type="text/javascript" src="../js/editprofile.js"></script>

    <!-- Viewport Configuration -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['username'])) header('Location: ../index.php');
include '../configurations/db.php';

try
{
    $user = $_SESSION['username'];
    $user_id_query = $conn->prepare("SELECT id FROM users WHERE username=\"$user\"");
    $user_id_query->execute();
    $user_id = $user_id_query->fetchColumn();

    if ($user_id == false) {
        // the user was not found
        header('Location: ../index.php');
    }
    $info_query = $conn->prepare("SELECT firstname, lastname, email, role_id FROM accounts WHERE user_id=\"$user_id\"");
    $info_query->execute();
    $row = $info_query->fetch();

    $_SESSION["firstname"] = $row["firstname"];
    $_SESSION["lastname"] = $row["lastname"];
    $_SESSION["email"] = $row["email"];
    $_SESSION["userid"] = $user_id;
}
catch (PDOException $e)
{
    var_dump("Error: " . $e);
    die;

    session_unset();    // remove all session variables
    session_destroy();    // destroy the session

    header('Location: ../index.php');
}

$fname = $_SESSION["firstname"];
$lname = $_SESSION["lastname"];
$email = $_SESSION["email"];
?>
<div class="big-container shadow">
    <div class="profile-sidebar">
        <div class="profile-nav">
            <ul>
                <!-- Edit profile tabs -->
                <li>General settings</li>
                <li>Preferences</li>
            </ul>
        </div>
    </div>
    <div class="profile-content">
        <div id="profile-picture">
            <img class="small-shadow center" src="../images/sample-avatar.jpg" alt="Planning Image Here" height="150" width="150">
        </div>
        <div class="form-wrapper">
            <form class="form-edit-account" id="form-general-info" method="post" onsubmit="return test()">
                <div class="block-wrapper">
                    <table class="form-table-left">
                        <tr>
                            <td>
                                <label for="firstname">First name</label><br>
                                <input type="text" value="<?php echo $fname; ?>" id="firstname" name="firstname"/>
                            </td>
                            <td>
                                <label for="lastname">Last name</label><br>
                                <input type="text" value="<?php echo $lname; ?>" id="lastname" name="lastname" class="marginleft"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="email">Email</label><br>
                                <input type="text" value="<?php echo $email; ?>" id="email" name="email"/>
                                <div class="error-message hidden" id="validMailError">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 1l-12 22h24l-12-22zm-1 8h2v7h-2v-7zm1 11.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z"/></svg>
                                    <span>Please enter a valid email address</span>
                                </div>
                                <div class="error-message hidden" id="populatedFieldsError">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 1l-12 22h24l-12-22zm-1 8h2v7h-2v-7zm1 11.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z"/></svg>
                                    <span>Missing information from required fields</span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <button class="bold" type="submit">Save changes</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

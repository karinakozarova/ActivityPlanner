<?php
/*
 * This is the edit profile page
 * If a user is not logged in, it redirects them back to the index page.
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
    <script type="application/javascript" src="../js/editprofile.js"></script>

    <!-- Viewport Configuration -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['username'])) header('Location: ../index.php');
include '../configurations/db.php';

try {
    $user = $_SESSION['username'];
    $user_id_query = $conn->prepare("SELECT id FROM users WHERE username=\"$user\"");
    $user_id_query->execute();
    $user_id = $user_id_query->fetchColumn();

    if ($user_id == false) {
        // the user was not found
        header('Location: ../index.php');
    }
    $info_query = $conn->prepare("SELECT firstname, lastname, email, role_id, avatar_path FROM accounts WHERE user_id=\"$user_id\"");
    $info_query->execute();
    $row = $info_query->fetch();

    $_SESSION["firstname"] = $row["firstname"];
    $_SESSION["lastname"] = $row["lastname"];
    $_SESSION["email"] = $row["email"];
    $_SESSION["userid"] = $user_id;
    $_SESSION["avatar"] = $row["avatar_path"];

    $file_path = '../uploads/' . $_SESSION["avatar"];

    if (isset($_SESSION["avatar"]) && file_exists($file_path)) $profilepic = "../uploads/" . $_SESSION["avatar"];
    else $profilepic = '../uploads/default-avatar.jpg';
} catch (PDOException $e) {
    session_unset();    // remove all session variables
    session_destroy();    // destroy the session
    var_dump("Error: " . $e);
    die;
}

$fname = $_SESSION["firstname"];
$lname = $_SESSION["lastname"];
$email = $_SESSION["email"];
?>
<div class="big-container shadow">
    <div class="profile-sidebar">
        <div class="profile-nav" id="settings-nav">
            <ul>
                <!-- Edit profile tabs -->
                <li><a href="./profile-dashboard.php">Go back to dashboard</a></li>
                <li><a href="#">General settings</a></li>
                <li><a href="#">Preferences</a></li>
            </ul>
        </div>
    </div>
    <div class="profile-content">
        <div class="form-wrapper">
            <form class="form-edit-account" action="../backend/profileSettings.php" method="post"
                  onsubmit="return validateForm()" enctype="multipart/form-data">
                <div id="profile-picture">
                    <div class="avatar-wrapper-wrapper">
                        <div class="avatar-wrapper">
                            <img class="small-shadow center" id="settings-profilepic" src="<?= $profilepic ?>"
                                 alt="Planning Image Here" height="150" width="150">
                            <input class="hidden" type="file" id="profilepic" name="profilepic"
                                   onchange="return validateFileUpload()">
                            <label class="upload-file-button" for="profilepic">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M17.831 7.672c1.096-1.096 2.875-1.865 3.688-3.106.892-1.362.508-3.192-.851-4.085-1.362-.892-3.187-.508-4.081.854-.842 1.286-.801 3.322-1.433 4.779-.817 1.882-3.553 2.116-6.698.474-1.727 3.352-4.075 6.949-6.456 9.874l2.263 1.484c1.018-.174 2.279-1.059 2.792-2.03-.04 1.167-.478 2.2-1.337 2.983l4.275 2.797c.546-.544 1.054-.976 1.616-1.345-.319.643-.532 1.324-.63 1.99l2.532 1.659c1.5-2.884 4.416-7.343 6.455-9.874-2.82-2.272-3.657-4.936-2.135-6.454zm1.762-5.545c.454.296.58.908.281 1.36-.294.457-.905.582-1.356.286-.456-.297-.582-.906-.284-1.36.295-.455.905-.583 1.359-.286zm-3.959 15.037l-8.225-5.386 1.616-2.469 8.221 5.387-1.612 2.468z"/>
                                </svg>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="error-message hidden" id="imageUploadError">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M12 1l-12 22h24l-12-22zm-1 8h2v7h-2v-7zm1 11.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z"/>
                    </svg>
                    <span id="uploadErrorMessage">Placeholder Error message</span>
                </div>
                <div class="block-wrapper">
                    <table class="form-table-left">
                        <tr>
                            <td>
                                <label for="firstname">First name</label><br>
                                <input type="text" value="<?php echo $fname; ?>" id="firstname" name="firstname"/>
                            </td>
                            <td>
                                <label for="lastname">Last name</label><br>
                                <input type="text" value="<?php echo $lname; ?>" id="lastname" name="lastname"
                                       class="marginleft"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label for="email">Email</label><br>
                                <input type="text" value="<?php echo $email; ?>" id="email" name="email"/>
                                <div class="error-message hidden" id="validMailError">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path d="M12 1l-12 22h24l-12-22zm-1 8h2v7h-2v-7zm1 11.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z"/>
                                    </svg>
                                    <span>Please enter a valid email address</span>
                                </div>
                                <div class="error-message hidden" id="populatedFieldsError">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path d="M12 1l-12 22h24l-12-22zm-1 8h2v7h-2v-7zm1 11.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z"/>
                                    </svg>
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

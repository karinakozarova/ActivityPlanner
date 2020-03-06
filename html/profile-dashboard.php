<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Profile</title>
    <!-- Fonts imports -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Stylesheets imports -->
    <link href="../css/profile.css" rel="stylesheet">
    <link href="../css/dashboard.css" rel="stylesheet">

    <!-- Viewport Configuration -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
session_start();

$fname = $_POST["firstname"];
$lname = $_POST["lastname"];
$email = $_POST["email"];
$user = $_POST["username"];
$psswd = $_POST["password"];

include '../configurations/db.php';

try {
    // insert login info into db
    $sql = "INSERT INTO users (username, password)
        VALUES (\"$user\", \"$psswd\")";
    $conn->exec($sql);

    // get new user id
    $user_id_query = $conn->prepare("SELECT id FROM users WHERE username=\"$user\"");
    $user_id_query->execute();
    $user_id = $user_id_query->fetchColumn();

    // insert account info into the db
    $sql = "INSERT INTO accounts (user_id, firstname, lastname, email)
        VALUES (\"$user_id\", \"$fname\", \"$lname\", \"$email\")";
    $conn->exec($sql);

    $_SESSION["username"] = $user;
    $_SESSION["firstname"] = $fname;
    $_SESSION["lastname"] = $lname;
} catch (PDOException $e) {
    if ($e->getCode() == "23000") {
        // TODO: deal with duplicating usernames
        $_SESSION['usernameIsNotUnique'] = true;
        header('Location: register.php');
        exit;
    }
    session_unset();    // remove all session variables
    session_destroy();    // destroy the session
}
$conn = null; // close the PDO
?>
<div class="big-container shadow">
    <div class="profile-sidebar">
        <div id="profile-picture">
            <img class="small-shadow center" src="../images/sample-avatar.jpg" alt="Planning Image Here" height="150" width="150">
            <?php
            echo "<h3>$fname $lname</h3>";
            ?>
            <h4>Enthusiast</h4>
        </div>
        <div class="profile-nav">
            <ul>
                <li>
                    <a href="">
                    <div class="nav-item active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                        <path d="M21.698 10.658l2.302 1.342-12.002 7-11.998-7 2.301-1.342 9.697 5.658 9.7-5.658zm-9.7 10.657l-9.697-5.658-2.301 1.343 11.998 7 12.002-7-2.302-1.342-9.7 5.657zm12.002-14.315l-12.002-7-11.998 7 11.998 7 12.002-7z"/>
                    </svg>
                    <p>Overview</p>
                    </div>
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M17 1c0-.552-.447-1-1-1s-1 .448-1 1v2c0 .552.447 1 1 1s1-.448 1-1v-2zm-12 2c0 .552-.447 1-1 1s-1-.448-1-1v-2c0-.552.447-1 1-1s1 .448 1 1v2zm13 5v10h-16v-10h16zm2-6h-2v1c0 1.103-.897 2-2 2s-2-.897-2-2v-1h-8v1c0 1.103-.897 2-2 2s-2-.897-2-2v-1h-2v18h20v-18zm4 3v19h-22v-2h20v-17h2zm-17 7h-2v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm-8 4h-2v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2z"/>
                    </svg>
                    <p>Planner</p>
                    </div>
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                        <path d="M12 0c-3.865 0-7 3.134-7 7s3.135 7 7 7 7-3.134 7-7-3.135-7-7-7zm0 12c-2.762 0-5-2.239-5-5s2.238-5 5-5 5 2.239 5 5-2.238 5-5 5zm1.484-4.315l1.516-1.457-2.083-.287-.917-1.892-.917 1.892-2.083.287 1.516 1.457-.369 2.07 1.853-.992 1.854.992-.37-2.07zm-1.734 8.302l-3.724 8.013-1.34-3.686-3.686 1.342 3.606-7.759c.505.461 1.064.862 1.675 1.184l-1.48 3.188 1.371.639 1.51-3.25c.657.196 1.351.307 2.068.329zm9.25 5.675l-3.66-1.345-1.34 3.683-3.752-8.013c.718-.022 1.414-.132 2.072-.332l1.523 3.251 1.353-.645-1.484-3.178c.61-.32 1.17-.72 1.674-1.18l3.614 7.759z"/>
                    </svg>
                    <p>Achievements</p>
                    </div>
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                        <path d="M14.172 7.396l1.413-1.39 1.414 1.414-1.414 1.39-1.413-1.414zm2.828 16.604h6v-13h-6v13zm-.559-18.834l1.414 1.414 1.435-1.41-1.415-1.415-1.434 1.411zm.591-3.951l4.771 4.771 1.197-5.986-5.968 1.215zm-8.032 22.785h6v-9h-6v9zm-8 0h6v-6h-6v6zm13.729-14.349l-1.414-1.414-1.45 1.425-3-3.002-7.841 7.797 1.41 1.418 6.427-6.39 2.991 2.993 2.877-2.827z"/>
                    </svg>
                    <p>Goals</p>
                    </div>
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                            <path d="M8 9v-4l8 7-8 7v-4h-8v-6h8zm2-7v2h12v16h-12v2h14v-20h-14z"/>
                    </svg>
                    <p>Sign out</p>
                    </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="profile-content">
        <div id="profile-greeting">
            <?php
            echo "<p>Good Morning<br><span>$fname</span><p>";
            ?>
        </div>
    </div>
</div>
</body>
</html>

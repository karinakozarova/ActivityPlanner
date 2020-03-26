<?php
/*
 * This is the coach page.
 * If a user cant be logged in as coach, it redirects to the login page.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Profile</title>
    <!-- Fonts imports -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Stylesheets imports -->
    <link href="../css/profile.css" rel="stylesheet">
    <link href="../css/dashboard.css" rel="stylesheet">

    <!-- Javascript imports -->
    <script src="../js/greetings.js"></script>
    <script src="../js/tabControl.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Viewport Configuration -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body onload="updateGreeting()">
<?php
session_start();
include '../configurations/db.php';
include '../backend/login.php';
include '../backend/utils.php';
include '../backend/achievements.php';
if($_SESSION['role'] != "COACH"){
    header('Location: login.php');
    exit;
}
?>
<script>
    $.ajax('https://quotes.rest/qod?language=en',   // request url
        {
            success: function (data, status, xhr) {// success callback function
                $('#quoteoftheday').html(data['contents']['quotes'][0]['quote']);
            }
        });
    </script>
<div class="big-container shadow">
    <div class="profile-sidebar">
        <div id="profile-picture">
            <img class="small-shadow center" src="<?= $profilepic ?>" alt="Planning Image Here" height="150"
                 width="150">
            <h3> <?= $fname ?> <?= $lname ?></h3>
            <h4> <?= $role ?></h4>
            <a id="edit-profile-link" href="./edit-profile.php"><div class="simple-button" id="edit-profile-button">Edit Profile</div></a>
        </div>
        <div class="profile-nav">

        </div>
    </div>
    <div class="profile-content">
        <div id="profile-greeting">
            <p>
                <placeholder id="profile-greeting-js"></placeholder>
                <br>
                <span> <?= $fname ?> </span>
            <p>
        </div>

        <div id="content">
            <div id="profile-greeting">
                <p>
                    In the future you will see information about your athletes here.
                <br> <br> <hr>
                <h1> Quote of the day</h1>
                    <h3>
                        <div id="quoteoftheday"></div>
                    </h3>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
/*
 * This is the main page.
 * If a user cant be logged in, it redirects to the index page.
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
    <script src="../js/tabControl.js"></script>
    <style>
        input {
            background: #f2f2f2;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
        }

        .wide-input{
            width: 90%;
        }

        form{
            padding-left: 2em;
        }

        textarea{
            background: #f2f2f2;
            border: 0;
            padding: 5px;
            box-sizing: border-box;
        }

        button{
            width: 45%;
            margin-left: 5%;
            padding: 14px;
        }

        #datePicker{
            width: 40%;
        }
    </style>

    <!-- Viewport Configuration -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
session_start();
include '../configurations/db.php';
include '../backend/login.php';
include '../backend/utils.php';
include '../backend/achievements.php';
?>

<div class="big-container shadow">
    <div class="profile-sidebar">
        <div id="profile-picture">
            <img class="small-shadow center" src="../images/sample-avatar.jpg" alt="Planning Image Here" height="150"
                 width="150">
            <h3> <?= $fname ?> <?= $lname ?></h3>
            <h4> <?= $role ?></h4>
        </div>
        <div class="profile-nav">
            <ul>
                <li>
                    <a onclick='showOverview();'>
                        <div class="nav-item active" id="overview-nav">
                            <svg width="30" height="30" viewBox="0 0 24 24">
                                <path d="M21.698 10.658l2.302 1.342-12.002 7-11.998-7 2.301-1.342 9.697 5.658 9.7-5.658zm-9.7 10.657l-9.697-5.658-2.301 1.343 11.998 7 12.002-7-2.302-1.342-9.7 5.657zm12.002-14.315l-12.002-7-11.998 7 11.998 7 12.002-7z"/>
                            </svg>
                            <p> Dashboard</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="signout.php">
                        <div class="nav-item">
                            <svg width="30" height="30" viewBox="0 0 24 24">
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
            <h2>
                Add achievement
            </h2>
        </div>
        <div id="content">
            <form class="add-achievement-form" action="addAchievement.php" method="post" onsubmit="//return validateForm()">
                <p>  Name </p>
                <input type="text" class="wide-input" placeholder="Name" id="name" name="name"/>
                <br>
                <p>  Description </p>
                <textarea  class="wide-input" rows="4" cols="50" name="description" id="description"> </textarea>
                <br>

                <p> Received on:</p>

                <input type="datetime-local" id="datePicker"
                       name="meeting-time" value="">
                <button class="bold" type="submit">Add achievement</button>

                <input type="hidden" name="user_id" value="<?= $_SESSION['userid']?>">
            </form>

        </div>
    </div>
</div>
<script src="../js/datepickerDefaultValue.js"></script>
</body>
</html>
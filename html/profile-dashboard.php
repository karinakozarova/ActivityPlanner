<?php
/*
 * This is the main dashboard page.
 * If a user is not logged in, it redirects them back to the index page.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Profile</title>
    <!-- Fonts imports -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Stylesheets imports -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="../js/jquery-sked-tape/dist/jquery.skedTape.css" rel="stylesheet">
    <link href="../css/profile.css" rel="stylesheet">
    <link href="../css/dashboard.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.css" />

    <!-- Calendar stylesheets imports (Used for the workout planner)-->
    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.css" />
    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.css" />

    <!-- Javascript imports -->
    <script src="../js/greetings.js"></script>
    <script src="../js/tabControl.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/radialIndicator/1.4.0/radialIndicator.min.js"></script>
    <script src="../js/jquery-sked-tape/dist/jquery.skedTape.js"></script>
    <script src="../js/overviewControls.js"></script>

    <!--Calendar imports (Used for the workout planner)-->
    <script src="https://uicdn.toast.com/tui.code-snippet/latest/tui-code-snippet.js"></script>
    <script src="https://uicdn.toast.com/tui.dom/v3.0.0/tui-dom.js"></script>
    <script src="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.min.js"></script>
    <script src="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.min.js"></script>
    <script src="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.js"></script>

    <!-- Viewport Configuration -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body onload="updateGreeting(); showOverview();">
<?php
session_start();
include '../configurations/db.php';
include '../backend/login.php';
include '../backend/achievements.php';
include '../backend/workouts.php';

$achievements = new Achievement();
$achievementsCount = Achievement::getUserAchievementsCount($_SESSION['userid']);
?>

<div class="big-container shadow">
    <div class="profile-sidebar">
        <div id="profile-picture">
            <img class="small-shadow center" src="<?= $profilepic ?>" alt="Planning Image Here" height="150"
                 width="150">
            <h3> <?= $fname ?> <?= $lname ?></h3>
            <h4> <?= $role ?></h4>
            <a id="edit-profile-link" href="./edit-profile.php">
                <div class="simple-button" id="edit-profile-button">Edit Profile</div>
            </a>
        </div>
        <div class="profile-nav">
            <ul>
                <li>
                    <a onclick='showOverview();'>
                        <div class="nav-item active" id="overview-nav">
                            <svg width="30" height="30" viewBox="0 0 24 24">
                                <path d="M21.698 10.658l2.302 1.342-12.002 7-11.998-7 2.301-1.342 9.697 5.658 9.7-5.658zm-9.7 10.657l-9.697-5.658-2.301 1.343 11.998 7 12.002-7-2.302-1.342-9.7 5.657zm12.002-14.315l-12.002-7-11.998 7 11.998 7 12.002-7z"/>
                            </svg>
                            <p>Overview</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a onclick='showPlanner();'>
                        <div class="nav-item" id="nav-planner">
                            <svg width="30" height="30" viewBox="0 0 24 24">
                                <path d="M17 1c0-.552-.447-1-1-1s-1 .448-1 1v2c0 .552.447 1 1 1s1-.448 1-1v-2zm-12 2c0 .552-.447 1-1 1s-1-.448-1-1v-2c0-.552.447-1 1-1s1 .448 1 1v2zm13 5v10h-16v-10h16zm2-6h-2v1c0 1.103-.897 2-2 2s-2-.897-2-2v-1h-8v1c0 1.103-.897 2-2 2s-2-.897-2-2v-1h-2v18h20v-18zm4 3v19h-22v-2h20v-17h2zm-17 7h-2v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm-8 4h-2v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2z"/>
                            </svg>
                            <p>Planner</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a onclick='showAchievements()'>
                        <div class="nav-item" id="nav-achievements">
                            <svg width="30" height="30" viewBox="0 0 24 24">
                                <path d="M12 0c-3.865 0-7 3.134-7 7s3.135 7 7 7 7-3.134 7-7-3.135-7-7-7zm0 12c-2.762 0-5-2.239-5-5s2.238-5 5-5 5 2.239 5 5-2.238 5-5 5zm1.484-4.315l1.516-1.457-2.083-.287-.917-1.892-.917 1.892-2.083.287 1.516 1.457-.369 2.07 1.853-.992 1.854.992-.37-2.07zm-1.734 8.302l-3.724 8.013-1.34-3.686-3.686 1.342 3.606-7.759c.505.461 1.064.862 1.675 1.184l-1.48 3.188 1.371.639 1.51-3.25c.657.196 1.351.307 2.068.329zm9.25 5.675l-3.66-1.345-1.34 3.683-3.752-8.013c.718-.022 1.414-.132 2.072-.332l1.523 3.251 1.353-.645-1.484-3.178c.61-.32 1.17-.72 1.674-1.18l3.614 7.759z"/>
                            </svg>
                            <p>Achievements</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a onclick='showGoals()'>
                        <div class="nav-item" id="nav-goals">
                            <svg width="30" height="30" viewBox="0 0 24 24">
                                <path d="M14.172 7.396l1.413-1.39 1.414 1.414-1.414 1.39-1.413-1.414zm2.828 16.604h6v-13h-6v13zm-.559-18.834l1.414 1.414 1.435-1.41-1.415-1.415-1.434 1.411zm.591-3.951l4.771 4.771 1.197-5.986-5.968 1.215zm-8.032 22.785h6v-9h-6v9zm-8 0h6v-6h-6v6zm13.729-14.349l-1.414-1.414-1.45 1.425-3-3.002-7.841 7.797 1.41 1.418 6.427-6.39 2.991 2.993 2.877-2.827z"/>
                            </svg>
                            <p>Goals</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a onclick='showWaterIntake()'>
                        <div class="nav-item" id="nav-water">
                            <svg width="30" height="30" viewBox="0 0 24 24">
                                <path d="M12 0c-4.87 7.197-8 11.699-8 16.075 0 4.378 3.579 7.925 8 7.925s8-3.547 8-7.925c0-4.376-3.13-8.878-8-16.075zm-.027 5.12c.467.725 1.027 1.987 1.027 3.32 0 3.908-4 4.548-4 2.17 0-1.633 1.988-4.044 2.973-5.49z"/>
                            </svg>
                            <p>Water Intake</p>
                        </div>
                    </a>
                </li>
                <?php if ($_SESSION['role'] == "COACH") { ?>
                <li>
                    <a href="../html/coachpage.php">
                        <div class="nav-item">
                            <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M15.517 24h-11.646c.522-3.035.897-6.162-.422-8.028-1.666-2.357-2.43-4.742-2.449-6.883-.045-5.19 4.231-9.114 10.203-9.089 7.236.03 9.328 6.156 9.773 7.943.34 1.369-.898 1.869-.166 2.702.596.679 1.035 1.364 1.789 2.177.292.315.405.646.401.943-.006.434-.291.798-.748.958-.429.15-.76.32-1.215.443-.145 1.16-.521 2.572-.798 3.557-.737 2.62-2.896 1.059-3.881 2.607-.426.668-.64 1.738-.841 2.67zm-3.844-19h-1.346c-.243.681-.312 1.122-.842 1.341-.53.22-.888-.041-1.545-.353l-.952.952c.311.654.573 1.015.353 1.545-.219.53-.66.599-1.341.841v1.347c.68.242 1.122.312 1.341.842.222.534-.047.902-.353 1.544l.952.952c.652-.309 1.015-.573 1.545-.353v.001c.529.219.599.657.842 1.341h1.346c.243-.682.313-1.121.845-1.343h.001c.526-.219.883.042 1.541.354l.952-.952c-.31-.651-.573-1.014-.354-1.544.219-.529.662-.6 1.342-.842v-1.347c-.688-.244-1.123-.313-1.341-.841-.22-.53.041-.89.353-1.545l-.952-.952c-.651.31-1.014.573-1.545.353-.529-.219-.598-.657-.842-1.341zm-.673 6.667c-.92 0-1.667-.747-1.667-1.667 0-.921.747-1.667 1.667-1.667s1.667.746 1.667 1.667c0 .92-.747 1.667-1.667 1.667z"/></svg>
                            <p> Coach page </p>
                        </div>
                    </a>
                </li>
                <?php } ?>
                <li>
                    <a href="../backend/signout.php">
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
            <p>
                <placeholder id="profile-greeting-js"></placeholder>
                <br>
                <span> <?= $fname ?> </span>
            <p>
        </div>
        <?php
        include('../backend/getWaterGoals.php');
        ?>
        <div id="content">
            <?php if (isset($_REQUEST['addedAchievement'])) { ?>
                <script src="../js/notifications/addedAchievement.js"></script>
            <?php }
            if (isset($_REQUEST['editedAchievement'])) { ?>
                <script src="../js/notifications/editAchievement.js"></script>
            <?php } else if (isset($_REQUEST['addedWater'])) { ?>
                <script src="../js/notifications/addedWater.js"></script>
            <?php } else if (isset($_REQUEST['addedGoals'])) { ?>
                <script src="../js/notifications/updatedGoals.js"></script>
            <?php } ?>
            <div id="tab-overview" class="tab hidden">
                <?php include("tab-overview.inc.php") ?>
            </div>
            <div id="tab-planner" class="tab hidden">
                <!--Planner-->
                <?php include("tab-planner.inc.php") ?>
                <h2><a href="newWorkout.php" class="card"><button>New workout plan</button></a></h2>
                <!--Planner navigation controls-->
                <button id="calendar-prev-button" class="small-circular-button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg></button>
                <button id="calendar-next-button" class="small-circular-button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z"/></svg></button>
                <div id="calendar"></div>
            </div>
            <div id="tab-achievements" class="tab hidden">
                <?php include("tab-achivements.inc.php") ?>
            </div>
            <div id="tab-water" class="tab hidden">
                <?php include("tab-water.inc.php") ?>
            </div>
            <div id="tab-goals" class="tab hidden">
                <?php include("tab-goals.inc.php") ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>

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
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="../css/profile.css" rel="stylesheet">
    <link href="../css/dashboard.css" rel="stylesheet">

    <!-- Javascript imports -->
    <script src="../js/greetings.js"></script>
    <script src="../js/tabControl.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/radialIndicator/1.4.0/radialIndicator.min.js"></script>
    <script src="../js/overviewControls.js"></script>

    <!-- Viewport Configuration -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body onload="updateGreeting(); showOverview();">
<?php
session_start();
include '../configurations/db.php';
include '../backend/login.php';
include '../backend/achievements.php';

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
            <?php } else if (isset($_REQUEST['addedWater'])) { ?>
                <script src="../js/notifications/addedWater.js"></script>
            <?php } else if (isset($_REQUEST['addedGoals'])) { ?>
                <script src="../js/notifications/updatedGoals.js"></script>
            <?php } ?>
            <div id="tab-overview" class="tab hidden">
                <p class="unselectable" id="overview-weekly-goals"><span>Weekly</span> Goals</p>
                <div class="progressbar-container">
                    <div class="progressbar-wrapper">
                        <div id="calories-progressbar"></div>
                        <svg id="calories-progressbar-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill-rule="evenodd" clip-rule="evenodd">
                            <path d="M8.625 0c.61 7.189-5.625 9.664-5.625 15.996 0 4.301 3.069 7.972 9 8.004 5.931.032 9-4.414 9-8.956 0-4.141-2.062-8.046-5.952-10.474.924 2.607-.306 4.988-1.501 5.808.07-3.337-1.125-8.289-4.922-10.378zm4.711 13c3.755 3.989 1.449 9-1.567 9-1.835 0-2.779-1.265-2.769-2.577.019-2.433 2.737-2.435 4.336-6.423z"/>
                        </svg>
                        <h4>270/<span>600</span></h4>
                        <p>Calories burned</p>
                    </div>
                    <div class="progressbar-wrapper">
                        <div id="exercises-progressbar"></div>
                        <svg id="exercises-progressbar-icon" enable-background="new 0 0 500.03 500.03" height="512"
                             viewBox="0 0 500.03 500.03" width="512" xmlns="http://www.w3.org/2000/svg">
                            <path d="m252.581 395.053c15.688 15.708 15.591 40.979 0 56.57l-35.28 35.28c-15.461 15.5-40.874 15.696-56.57 0l-147.61-147.61c-15.59-15.6-15.59-40.98 0-56.57l35.28-35.28c15.591-15.592 40.862-15.688 56.57 0zm-233.513-17.316c-3.609-3.609-9.609-2.946-12.395 1.331-11.067 16.986-7.654 37.463 5.028 50.146l59.11 59.11c12.572 12.572 33.034 16.189 50.14 5.034 4.278-2.79 4.949-8.788 1.338-12.4zm257.773-209.024c-6.25-6.24-16.38-6.24-22.63 0l-85.5 85.5c-6.25 6.25-6.25 16.38 0 22.63l54.47 54.47c6.229 6.229 16.359 6.251 22.63 0l85.5-85.5c6.25-6.25 6.25-16.38 0-22.63zm204.132-46.442c3.612 3.612 9.613 2.939 12.402-1.341 11.146-17.11 7.485-37.577-5.054-50.117l-59.11-59.11c-12.651-12.642-33.115-16.126-50.123-5.049-4.278 2.786-4.944 8.787-1.334 12.397zm-141.682-109.148c-15.6-15.59-40.98-15.6-56.57 0l-35.28 35.28c-15.591 15.59-15.688 40.861 0 56.57l147.61 147.61c15.723 15.703 40.996 15.575 56.57 0l35.28-35.28c15.59-15.59 15.59-40.97 0-56.57z"/>
                        </svg>
                        <h4>5/<span>10</span></h4>
                        <p>Exercises</p>
                    </div>
                    <div class="progressbar-wrapper">
                        <div id="steps-progressbar"></div>
                        <svg id="steps-progressbar-icon" height="512" viewBox="0 0 512 512" width="512"
                             xmlns="http://www.w3.org/2000/svg" data-name="Layer 1">
                            <path d="m332.118 489.943a34.6 34.6 0 0 0 36.864-32.183l1.519-22.411-67.324-30.1-3.242 47.835a34.642 34.642 0 0 0 32.183 36.859z"/>
                            <path d="m307.837 352.35 71.305 33.561 23.085-82.655c16.523-76.042 6.307-132.859-28.036-155.9-20.142-13.517-41.943-10.763-54.613-2.035-.143.1-.291.191-.442.277-.1.056-11.473 6.713-21.448 21.458-13.3 19.65-18.006 43.717-14 71.538z"/>
                            <path d="m208.509 289.305-67.382 29.979 1.473 22.416a34.6 34.6 0 1 0 69.057-4.55z"/>
                            <path d="m132.58 269.828 71.368-33.428 24.366-113.715c4.055-27.813-.61-51.888-13.868-71.563-9.948-14.764-21.312-21.443-21.425-21.508-.14-.081-.293-.178-.426-.269-12.652-8.75-34.447-11.546-54.616 1.933-34.387 22.979-44.708 79.778-28.328 155.851z"/>
                        </svg>
                        <h4>7000/<span>15,000</span></h4>
                        <p>Steps</p>
                    </div>
                    <div class="progressbar-wrapper">
                        <div id="distance-progressbar"></div>
                        <svg id="distance-progressbar-icon" version="1.1" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                             style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>
                                <g>
                                    <path d="M496,0H368c-8.832,0-16,7.168-16,16v96v64c0,8.832,7.168,16,16,16c8.832,0,16-7.168,16-16v-48h112c8.832,0,16-7.168,16-16
            			V16C512,7.168,504.832,0,496,0z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M448,352H288c-17.632,0-32-14.336-32-32s14.368-32,32-32h34.944c6.624,18.592,24.192,32,45.056,32
            			c26.496,0,48-21.504,48-48c0-26.496-21.504-48-48-48c-20.864,0-38.464,13.408-45.056,32H288c-35.296,0-64,28.704-64,64
            			c0,35.296,28.704,64,64,64h160c17.664,0,32,14.336,32,32s-14.336,32-32,32H157.056c-6.624-18.592-24.192-32-45.056-32
            			c-26.496,0-48,21.504-48,48c0,26.496,21.504,48,48,48c20.864,0,38.464-13.408,45.056-32H448c35.296,0,64-28.704,64-64
            			C512,380.704,483.296,352,448,352z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M112,96C50.24,96,0,146.24,0,208c0,57.472,89.856,159.264,100.096,170.688c3.04,3.36,7.36,5.312,11.904,5.312
            			s8.864-1.952,11.904-5.312C134.144,367.264,224,265.472,224,208C224,146.24,173.76,96,112,96z M112,256c-26.496,0-48-21.504-48-48
            			c0-26.496,21.504-48,48-48c26.496,0,48,21.504,48,48C160,234.496,138.496,256,112,256z"/>
                                </g>
                            </g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g>
                            <g></g></svg>
                        <h4>2.5km/<span>5km</span></h4>
                        <p>Distance</p>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        $('#calories-progressbar').radialIndicator({
                            roundCorner: true,
                            barColor: '#ff5733',
                            minValue: 0,
                            maxValue: 600,
                            initValue: 270,
                            barWidth: 10,
                            displayNumber: false
                        });
                        $('#exercises-progressbar').radialIndicator({
                            roundCorner: true,
                            barColor: '#0779e4',
                            minValue: 0,
                            maxValue: 10,
                            initValue: 5,
                            barWidth: 10,
                            displayNumber: false
                        });
                        $('#steps-progressbar').radialIndicator({
                            roundCorner: true,
                            barColor: '#5b8c5a',
                            minValue: 0,
                            maxValue: 10,
                            initValue: 5,
                            barWidth: 10,
                            displayNumber: false
                        });
                        $('#distance-progressbar').radialIndicator({
                            roundCorner: true,
                            barColor: '#552244',
                            minValue: 0,
                            maxValue: 10,
                            initValue: 5,
                            barWidth: 10,
                            displayNumber: false
                        });
                    });
                </script>

                <div class="big-container small-gray-shadow" id="activityChart">
                    <p class="unselectable" id="activityChartTitle"><span>Weekly</span> Statistics</p>
                    <div class="chart-wrapper" id="activity-chart-container">
                        <canvas id="myChart" width="200px" height="100px"></canvas>
                    </div>
                </div>
            </div>
            <div id="tab-planner" class="tab hidden">
                Planner
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

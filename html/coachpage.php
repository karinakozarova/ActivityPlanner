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
    <link href="../css/base.css" rel="stylesheet">
    <link href="../css/coachPage.css" rel="stylesheet">
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
include '../backend/achievements.php';
if ($_SESSION['role'] != "COACH") {
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
            <a id="edit-profile-link" href="./edit-profile.php">
                <div class="simple-button" id="edit-profile-button">Edit Profile</div>
            </a>
            <a class="simple-button no-decorations" href="./profile-dashboard.php">
                Back to dashboard
            </a>
        </div>
        <div class="profile-nav"></div>
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
                    A good coach can win medals and trophies. A great coach changes people's lives. <br> Be a great
                    coach! We believe in you.
                    <br> <br>
                <hr>
                <h1> Quote of the day</h1>
                <h3>
                    <div id="quoteoftheday"></div>
                </h3>
                <br>
                <h1>Useful articles from our team: </h1>
                <div class="row">
                    <div class="column">
                        <h2> How to motivate your athletes: </h2>
                        <h3>
                            <ul>
                                <li><a href="https://time.com/2933971/how-to-motivate-yourself-3-steps-backed-by-science" class="green-text"> How to Motivate Yourself: 3 Steps Backed By Science </a></li>
                                <li><a href="https://www.lifeoptimizer.org/2009/12/23/how-to-motivate-others/" class="green-text"> How to motivate others</a></li>
                                <li><a href="http://blog.idonethis.com/the-science-of-motivation-your-brain-on-dopamine/" class="green-text"> Your Brain on Dopamine: The Science of Motivation </a></li>
                                <li><a href="https://www.gse.harvard.edu/news/uk/19/03/unlocking-science-motivation" class="green-text"> Unlocking the Science of Motivation</a></li>
                            </ul>
                        </h3>
                    </div>
                    <div class="column">
                        <h2> Nutritional advice </h2>
                        <h3>
                            <ul>
                                <li><a href="https://www1.health.gov.au/internet/publications/publishing.nsf/Content/nhsc-trainers-manual~topic-1" class="green-text"> Nutrition basics </a></li>
                                <li><a href="https://www.eatrightpro.org/practice/practice-resources/international-nutrition-pilot-project/how-to-explain-basic-nutrition-concepts" class="green-text"> How to Explain Basic Nutrition Concepts</a></li>
                                <li><a href="https://www.hhs.gov/fitness/eat-healthy/importance-of-good-nutrition/index.html" class="green-text"> Importance of Good Nutrition</a></li>
                                <li><a href="https://www.webmd.com/men/features/benefits-protein" class="green-text"> The Benefits of Protein</a></li>
                                <li><a href="https://www.choosemyplate.gov/eathealthy/vegetables/vegetables-nutrients-health" class="green-text"> Why is it important to eat vegetables?</a></li>
                            </ul>
                        </h3>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <h2> Why sleep is important </h2>
                        <h3>
                            <ul>
                                <li><a href="https://www.medicalnewstoday.com/articles/325353" class="green-text"> Why sleep is essential for health</a></li>
                                <li><a href="https://www.nhlbi.nih.gov/health-topics/sleep-deprivation-and-deficiency" class="green-text"> Sleep Deprivation and Deficiency</a></li>
                                <li><a href="https://www.health.harvard.edu/press_releases/importance_of_sleep_and_health" class="green-text"> Importance of Sleep : Six reasons not to scrimp on sleep</a></li>
                                <li><a href="https://www.ninds.nih.gov/Disorders/patient-caregiver-education/understanding-sleep" class="green-text"> Brain Basics: Understanding Sleep</a></li>
                            </ul>
                        </h3>
                    </div>
                    <div class="column">
                        <h2> Trainings advice </h2>
                        <h3>
                            <ul>
                                <li><a href="https://www.verywellfit.com/weight-training-fundamentals-a-concise-guide-3498525" class="green-text"> A Fundamental Guide to Weight Training</a></li>
                                <li><a href="https://www.verywellfit.com/everything-you-need-to-know-about-cardio-1229553" class="green-text"> Everything You Need to Know About Cardio</a></li>
                                <li><a href="https://www.bmj.com/content/309/6948/180" class="green-text"> ABC of Sports Medicine: Assessment of physical performance</a></li>
                                <li><a href="https://onlinemasters.ohio.edu/blog/the-basics-of-physical-conditioning/" class="green-text"> The Basics Of Physical Conditioning</a></li>
                            </ul>
                        </h3>
                    </div>
                </div>

                <br>
            </div>
        </div>
    </div>
</div>
</body>
</html>

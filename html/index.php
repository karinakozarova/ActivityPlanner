<?php
session_start();

$logged_in = false;
if(isset($_SESSION) && isset($_SESSION['username']))
{
    $logged_in = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Workout Planner</title>
    <!-- Fonts imports -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Stylesheets imports -->
    <link href="../css/index.css" rel="stylesheet">
    <link href="../css/index-desktop.css" rel="stylesheet" media="(min-width: 480px)">
    <link href="../css/index-mobile.css" rel="stylesheet"  media="(max-width: 479px)">

    <!-- Viewport Configuration -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header class="container">
        <nav>
            <ul>
                <a href="register.php"><li class="square-button <?php if($logged_in == true) { echo "hidden";}?>">Sign Up</li></a>
                <a href="login.php"><li class="square-button <?php if($logged_in == true) { echo "hidden";}?>">Login</li></a>
                <a href="profile-dashboard.php"><li class="square-button <?php if($logged_in == false) { echo "hidden";}?>">My dashboard</li></a>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>
        <div id="quote-wrapper">
        <div class="nonselectable" id="header-quote">
            <p>Make yourself proud <span>plan your</span> ultimate<span> workout</span></p>
            <a class="rounded-button <?php if($logged_in == true) { echo "hidden";}?>" id="get-started" href="register.php">Get started now</a>
        </div>

        </div>
        <section class="scroll-button centered">
            <a href="#features">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm2 12l-4.5 4.5 1.527 1.5 5.973-6-5.973-6-1.527 1.5 4.5 4.5z"/>
                </svg>
                <p class="nonselectable">Scroll</p>
            </a>
        </section>
    </header>
    <div class="container" id="features">
        <h1>Features</h1>
        <h3>Making your workout plan has never been easier.</h3>
        <div class="features-wrapper">
            <div class="features-panel">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M15.91 13.34l2.636-4.026-.454-.406-3.673 3.099c-.675-.138-1.402.068-1.894.618-.736.823-.665 2.088.159 2.824.824.736 2.088.665 2.824-.159.492-.55.615-1.295.402-1.95zm-3.91-10.646v-2.694h4v2.694c-1.439-.243-2.592-.238-4 0zm8.851 2.064l1.407-1.407 1.414 1.414-1.321 1.321c-.462-.484-.964-.927-1.5-1.328zm-18.851 4.242h8v2h-8v-2zm-2 4h8v2h-8v-2zm3 4h7v2h-7v-2zm21-3c0 5.523-4.477 10-10 10-2.79 0-5.3-1.155-7.111-3h3.28c1.138.631 2.439 1 3.831 1 4.411 0 8-3.589 8-8s-3.589-8-8-8c-1.392 0-2.693.369-3.831 1h-3.28c1.811-1.845 4.321-3 7.111-3 5.523 0 10 4.477 10 10z"/>
                </svg>
                <h2>Easy-to-use Layout</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis ipsum at tortor pellentesque pulvinar dapibus convallis metus. Curabitur scelerisque libero eu turpis sollicitudin ornare.</p>
            </div>
            <div class="features-panel">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M12 9c.552 0 1 .449 1 1s-.448 1-1 1-1-.449-1-1 .448-1 1-1zm0-2c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm-9 4c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm18 0c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm-9-6c.343 0 .677.035 1 .101v-3.101c0-.552-.447-1-1-1s-1 .448-1 1v3.101c.323-.066.657-.101 1-.101zm9 4c.343 0 .677.035 1 .101v-7.101c0-.552-.447-1-1-1s-1 .448-1 1v7.101c.323-.066.657-.101 1-.101zm0 10c-.343 0-.677-.035-1-.101v3.101c0 .552.447 1 1 1s1-.448 1-1v-3.101c-.323.066-.657.101-1 .101zm-18-10c.343 0 .677.035 1 .101v-7.101c0-.552-.447-1-1-1s-1 .448-1 1v7.101c.323-.066.657-.101 1-.101zm9 6c-.343 0-.677-.035-1-.101v7.101c0 .552.447 1 1 1s1-.448 1-1v-7.101c-.323.066-.657.101-1 .101zm-9 4c-.343 0-.677-.035-1-.101v3.101c0 .552.447 1 1 1s1-.448 1-1v-3.101c-.323.066-.657.101-1 .101z"/>
                </svg>
                <h2>Customizable Environment</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis ipsum at tortor pellentesque pulvinar dapibus convallis metus. Curabitur scelerisque libero eu turpis sollicitudin ornare.</p>
            </div>
            <div class="features-panel">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 19l1.5-5h-4.5l7-9-1.5 5h4.5l-7 9z"/>
                </svg>
                <h2>Powerful Built-in Tools</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis ipsum at tortor pellentesque pulvinar dapibus convallis metus. Curabitur scelerisque libero eu turpis sollicitudin ornare.</p>
            </div>
        </div>
    </div>
    <div class="container" id="about">
        <h1>About</h1>
        <div class="about-wrapper">
            <div class="about-container">
                <h2>Plan your workout with MK3Planner.com — for FREE!</h2>
                <p>Praesent tincidunt augue elit, ornare convallis dolor efficitur nec. Vivamus quis lectus a turpis rutrum tristique. In ante massa, fringilla sit amet dictum elementum, porta at lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent tincidunt consequat tellus sed dictum. Phasellus bibendum mi sit amet quam hendrerit auctor vel ac nisi. Vivamus eu nunc porta, vulputate elit rhoncus, dictum nulla. Mauris finibus ante et tellus luctus, eget porttitor est tincidunt. Donec dolor turpis, consectetur sit amet enim in, cursus fermentum metus. Vivamus ultrices at magna eget suscipit. Morbi et dapibus ipsum. Fusce euismod turpis augue. Ut eget nisi porttitor, imperdiet velit vitae, tristique nisi. Quisque sollicitudin dapibus ultricies.</p>
            </div>
            <div class="about-container">
                <img src="../images/planning-image.png" alt="Planning Image Here" height="225" width="400">
                <h2>Don't wait! Make going to the gym a better experience - all for FREE!</h2>
            </div>
        </div>
        <center><a class="rounded-button" href="register.php">Join Now</a></center>
    </div>
    <footer>
        <div id="trademark">©2020 Martin Georgiev & Karina Kozarova. All Rights Reserved.</div>
    </footer>
<script>/* Fixing Chrome Transition Bug */</script>
</body>
</html>

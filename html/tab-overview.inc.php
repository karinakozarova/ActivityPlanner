<?php
require_once("../backend/waterIntake.class.php");

if (!isset($_SESSION["userid"])) header('Location: ../index.php');

//Getting the start and the end of the current week
$day = date('w') - 1;
$start  = date('Y-m-d', strtotime('-'.$day.' days'));
$end = date('Y-m-d', strtotime('+'.(6-$day).' days'));

$workoutsCount = Workout::getWorkoutsCount($start, $end);
$waterIntakeCupsCount = WaterIntake::getWaterWeeklyIntake($_SESSION["userid"], $start, $end);

//Calculation of Water intake
$waterIntake = round($waterIntakeCupsCount/4, 2);

//Calculation of burned calories
$caloriesBurned = $workoutsCount * 300;

$workoutsThreshold = 3;
$caloriesThreshold = 1500;
$waterIntakeThreshold = 14;
?>

<p class="unselectable" id="overview-weekly-goals"><span>Weekly</span> Goals</p>
<div class="progressbar-container">
    <div class="progressbar-wrapper">
        <div id="calories-progressbar"></div>
        <svg id="calories-progressbar-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             viewBox="0 0 24 24" fill-rule="evenodd" clip-rule="evenodd">
            <path d="M8.625 0c.61 7.189-5.625 9.664-5.625 15.996 0 4.301 3.069 7.972 9 8.004 5.931.032 9-4.414 9-8.956 0-4.141-2.062-8.046-5.952-10.474.924 2.607-.306 4.988-1.501 5.808.07-3.337-1.125-8.289-4.922-10.378zm4.711 13c3.755 3.989 1.449 9-1.567 9-1.835 0-2.779-1.265-2.769-2.577.019-2.433 2.737-2.435 4.336-6.423z"/>
        </svg>
        <h4><?=$caloriesBurned?> / <span><?=$caloriesThreshold?></span></h4>
        <p>Calories burned</p>
    </div>
    <div class="progressbar-wrapper">
        <div id="exercises-progressbar"></div>
        <svg id="exercises-progressbar-icon" enable-background="new 0 0 500.03 500.03" height="512"
             viewBox="0 0 500.03 500.03" width="512" xmlns="http://www.w3.org/2000/svg">
            <path d="m252.581 395.053c15.688 15.708 15.591 40.979 0 56.57l-35.28 35.28c-15.461 15.5-40.874 15.696-56.57 0l-147.61-147.61c-15.59-15.6-15.59-40.98 0-56.57l35.28-35.28c15.591-15.592 40.862-15.688 56.57 0zm-233.513-17.316c-3.609-3.609-9.609-2.946-12.395 1.331-11.067 16.986-7.654 37.463 5.028 50.146l59.11 59.11c12.572 12.572 33.034 16.189 50.14 5.034 4.278-2.79 4.949-8.788 1.338-12.4zm257.773-209.024c-6.25-6.24-16.38-6.24-22.63 0l-85.5 85.5c-6.25 6.25-6.25 16.38 0 22.63l54.47 54.47c6.229 6.229 16.359 6.251 22.63 0l85.5-85.5c6.25-6.25 6.25-16.38 0-22.63zm204.132-46.442c3.612 3.612 9.613 2.939 12.402-1.341 11.146-17.11 7.485-37.577-5.054-50.117l-59.11-59.11c-12.651-12.642-33.115-16.126-50.123-5.049-4.278 2.786-4.944 8.787-1.334 12.397zm-141.682-109.148c-15.6-15.59-40.98-15.6-56.57 0l-35.28 35.28c-15.591 15.59-15.688 40.861 0 56.57l147.61 147.61c15.723 15.703 40.996 15.575 56.57 0l35.28-35.28c15.59-15.59 15.59-40.97 0-56.57z"/>
        </svg>
        <h4><?=$workoutsCount?> / <span><?=$workoutsThreshold?></span></h4>
        <p>Workouts</p>
    </div>
    <div class="progressbar-wrapper">
        <div id="water-progressbar"></div>
        <svg id="water-progressbar-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M12 0c-4.87 7.197-8 11.699-8 16.075 0 4.378 3.579 7.925 8 7.925s8-3.547 8-7.925c0-4.376-3.13-8.878-8-16.075zm-.027 5.12c.467.725 1.027 1.987 1.027 3.32 0 3.908-4 4.548-4 2.17 0-1.633 1.988-4.044 2.973-5.49z"/>
        </svg>
        <h4><?=$waterIntake?>L / <span><?=$waterIntakeThreshold?>L</span></h4>
        <p>Water Intake</p>
    </div>
</div>
<div class="big-container small-gray-shadow" id="activityChart">
    <p class="unselectable" id="activityChartTitle"><span>Weekly</span> Statistics</p>
    <div class="chart-wrapper" id="activity-chart-container">
        <canvas id="myChart" width="200px" height="100px"></canvas>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#calories-progressbar').radialIndicator({
            roundCorner: true,
            barColor: '#f25635',
            minValue: 0,
            maxValue: <?=json_encode($caloriesThreshold)?>,
            initValue: <?=json_encode($caloriesBurned)?>,
            barWidth: 10,
            displayNumber: false
        });
        $('#exercises-progressbar').radialIndicator({
            roundCorner: true,
            barColor: '#5c2e4d',
            minValue: 0,
            maxValue: <?=json_encode($workoutsThreshold)?>,
            initValue: <?=json_encode($workoutsCount)?>,
            barWidth: 10,
            displayNumber: false
        });
        $('#water-progressbar').radialIndicator({
            roundCorner: true,
            barColor: '#4b93d6',
            minValue: 0,
            maxValue: <?=json_encode($waterIntakeThreshold)?>,
            initValue: <?=json_encode($waterIntake)?>,
            barWidth: 10,
            displayNumber: false
        });
    });
</script>

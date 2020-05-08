<link rel="stylesheet" href="../css/waterTab.css">
<?php
include('../backend/getDailyWaterIntake.php');
?>
<form action="../backend/addDailyCups.php" method="post">
    <label for="quantity">
        Number of cups today(250ml):
    </label> <br>
    <input type="number" id="quantity" name="quantity" min="0" value="<?= $waterCups ?>">
    <input type="submit">
</form>
<h4> Water statistics</h4>
<div class="chart-wrapper chart-container" id="activity-chart-container">
    <canvas id="line-chartcanvas" width="200px" height="80px"></canvas>
</div>

</div>
<?php
$date = date('Y-m-d');
$dayOfWeek = date("l", strtotime($date));
//Print out the day that our date fell on
$daynum = date("w", strtotime($dayOfWeek));
    if ($dayOfWeek = "Sunday") $daynum = 6;
$dates = [];

for ($i = (int)$daynum; $i >= 0; $i--) {
    $ago = '-' . $i . ' days';
    $thisDate = date("Y-m-d", strtotime($ago, strtotime($date)));
        $dates[] = $thisDate;
}
?>
<script>
    let dates = <?= json_encode($dates)?>;
    let dailyGoal = <?= $waterCupsGoals ?>;
</script>
<script src="../js/waterChart.js"></script>
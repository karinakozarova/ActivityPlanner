<?php
include('../backend/getWaterGoals.php');
?>

<h1> Goals: </h1>
<h3> Water </h3>

<form action="../backend/addWaterGoals.php" method="post">
    <label for="quantity">
        Number of cups per day(250ml):
    </label> <br>
    <input type="number" id="quantity" name="quantity" min="1" value="<?= $waterCupsGoals ?>">
    <input type="submit">
</form>

<h4 class="dodgerblue-text"> Total water intake today: <span id="totalWater"> <?= $waterCupsGoals * 250?> ml (<?= $waterCupsGoals ?> cups)</span></h4>

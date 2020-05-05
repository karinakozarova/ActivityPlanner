<?php
//$workouts = Workout::getWorkouts($_SESSION['userid']);
?>

<script type="text/javascript">
$(document).ready(function() {
    var workouts = <?php echo json_encode($workouts); ?>;
    for(int i = 0; i < workouts.length; i++)
    {
        addWorkout($workout->name, $workout->startTime, $workout->endTime);
    }
});
</script>

<h2>
    <a href="newWorkout.php" class="card"><button> Add new workout</button></a>
</h2>

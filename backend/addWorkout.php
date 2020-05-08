<?php
if (isset($_POST)) {
    include '../backend/workouts.php';
    $name = $_POST['name'];
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];
    $userId = $_POST['user_id'];
    Workout::addWorkout($userId, $name, $startTime, $endTime);
}

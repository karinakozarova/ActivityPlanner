<?php
if (isset($_POST)) {
    include '../backend/achievements.php';

    $name = $_POST['name'];
    $description = $_POST['description'];
    $time = $_POST["meeting-time"];
    $id = $_POST['achievement_id'];

    Achievement::editAchievement($id, $name, $description, $time);
}

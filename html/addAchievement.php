<?php
if(isset($_POST)) {
    var_dump($_POST);
    include '../backend/achievements.php';
    $name = $_POST['name'];
    $description= $_POST['description'];
    $time= $_POST["meeting-time"];
    $userId = $_POST['user_id'];
    Achievement::addAchievement($name, $userId, $description, $time);
}
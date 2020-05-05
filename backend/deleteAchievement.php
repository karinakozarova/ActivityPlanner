<?php
require_once("../configurations/credentials.php");
require_once("../backend/achievements.php");

$id = $_REQUEST['id'];

Achievement::deleteAchievement($id);
header('Location: ../html/profile-dashboard.php');
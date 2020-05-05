<?php
require_once("../configurations/credentials.php");
require_once("../backend/achievements.php");

$id = $_REQUEST['id'];
$userId = $_SESSION['userid'] ?? null;

if ($userId != null) Achievement::deleteAchievement($id);

header('Location: ../html/profile-dashboard.php');
<?php
require_once("../configurations/credentials.php");
require_once("../backend/waterGoals.class.php");

session_start();

$quantity = 0;
$userId = $_SESSION['userid'];

if (isset($_REQUEST['quantity']) && $_REQUEST['quantity'] != '') $quantity = $_REQUEST['quantity'];

WaterGoals::addWaterGoals($userId, $quantity);

header('Location: ../html/profile-dashboard.php?addedGoals');
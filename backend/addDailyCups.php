<?php
require_once("../configurations/credentials.php");
require_once("../backend/waterIntake.class.php");

session_start();
$quantity = 0;
$userId = $_SESSION['userid'];
$date = date("Y-m-d H:i:s");

if (isset($_REQUEST['quantity']) && $_REQUEST['quantity'] != '') $quantity = $_REQUEST['quantity'];

WaterIntake::addWaterIntake($userId, $quantity, $date);
header('Location: ../html/profile-dashboard.php?addedWater');
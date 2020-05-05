<?php
require_once("../configurations/credentials.php");
require_once("../backend/waterIntake.class.php");

date_default_timezone_set('Europe/Amsterdam');
session_start();

$userId = $_SESSION['userid'];
$date = date('Y-m-d');
if (isset($_REQUEST['date'])) {
    $date = $_REQUEST['date'];
}

$element = WaterIntake::getWaterIntake($_SESSION['userid'], $date);
$waterCups = $element['cups'] == NULL ? 0 : $element['cups'];
echo $waterCups;

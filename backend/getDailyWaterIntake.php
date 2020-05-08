<?php
require_once("../backend/waterIntake.class.php");
date_default_timezone_set('Europe/Amsterdam');

$userId = $_SESSION['userid'];
$date = date('Y-m-d');

$element = WaterIntake::getWaterIntake($_SESSION['userid'], $date);
$waterCups = $element['cups'] == NULL ? 0 : $element['cups'];
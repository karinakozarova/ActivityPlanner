<?php
require_once("../backend/waterGoals.class.php");
date_default_timezone_set('Europe/Amsterdam');

$element = WaterGoals::getWaterGoals($_SESSION['userid']);
$waterCupsGoals = $element['cups'] == NULL ? 0 : $element['cups'];
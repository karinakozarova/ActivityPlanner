<?php
require_once("../configurations/credentials.php");
date_default_timezone_set('Europe/Amsterdam');

$userId = $_SESSION['userid'];

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $conn->prepare("SELECT cups FROM water_goals WHERE user_id=\"$userId\" ORDER BY id desc LIMIT 1");
$query->execute();
$element = $query->fetch();

$waterCupsGoals =  $element['cups'] == NULL ? 0 : $element['cups'];

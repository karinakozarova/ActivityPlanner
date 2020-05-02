<?php
require_once("../configurations/credentials.php");
date_default_timezone_set('Europe/Amsterdam');

$userId = $_SESSION['userid'];
$date = date('Y-m-d');

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $conn->prepare("SELECT cups FROM water_intake WHERE user_id=\"$userId\" and date=\"$date\" ORDER BY id desc");
$query->execute();
$element = $query->fetch();

$waterCups = $element['cups'] == NULL ? 0 : $element['cups'];

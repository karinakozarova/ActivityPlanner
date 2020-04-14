<?php
require_once("../configurations/credentials.php");
session_start();
$userId = $_SESSION['userid'];
$quantity = $_REQUEST['quantity'];
$date = date("Y-m-d H:i:s");

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $conn->prepare("INSERT INTO water_intake(user_id, cups, date) VALUES (\"$userId\",\"$quantity\",\"$date\")");
$query->execute();
$conn = null;
header('Location: ../html/profile-dashboard.php?addedWater');
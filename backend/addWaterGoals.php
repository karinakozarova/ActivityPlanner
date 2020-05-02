<?php
require_once("../configurations/credentials.php");
session_start();
$userId = $_SESSION['userid'];
$quantity = $_REQUEST['quantity'];

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $conn->prepare("INSERT INTO water_goals(user_id, cups) VALUES (\"$userId\",\"$quantity\")");
$query->execute();
$conn = null;
header('Location: ../html/profile-dashboard.php?addedGoals');
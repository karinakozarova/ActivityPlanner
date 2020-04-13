<?php
require_once("../configurations/credentials.php");
$id = $_REQUEST['id'];
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $conn->prepare("DELETE FROM achievements WHERE id=\"$id\"");
$query->execute();
header('Location: ../html/profile-dashboard.php');
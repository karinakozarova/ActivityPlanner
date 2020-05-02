<?php
// gets the connection object
require_once("credentials.php");
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);     // set the PDO error mode to exception
    return $conn;
} catch (PDOException $e) {
    echo "<br /> connect file " . $e->getMessage();
}
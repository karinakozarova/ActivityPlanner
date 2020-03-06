<?php
$servername = "";
$dbusername = "";
$dbpassword = "";
$dbname = "";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<br /> connect file " . $e->getMessage();
}
?>
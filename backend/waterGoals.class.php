<?php

/**
 * Class WaterGoals
 */
class WaterGoals
{
    /**
     * @param $userId
     * @return mixed
     */
    public static function getWaterGoals($userId)
    {
        require("../configurations/credentials.php");
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("SELECT cups FROM water_goals WHERE user_id=\"$userId\" ORDER BY id desc LIMIT 1");
        $query->execute();
        if ($query->rowCount() > 0) {
            return $query->fetch();
        } else{
            return null;
        }
    }

    /**
     * @param int $userId
     * @param int $quantity
     */
    public static function addWaterGoals(int $userId, int $quantity = 0): void
    {
        require("../configurations/credentials.php");
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("INSERT INTO water_goals(user_id, cups) VALUES (\"$userId\",\"$quantity\")");
        $query->execute();
    }
}
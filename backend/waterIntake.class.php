<?php

/**
 * Class WaterIntake
 */
class WaterIntake
{
    /**
     * @param $userId
     * @param $date
     * @return mixed
     */
    public static function getWaterIntake($userId, $date)
    {
        require("../configurations/credentials.php");
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("SELECT cups FROM water_intake WHERE user_id=\"$userId\" and date=\"$date\" ORDER BY id desc LIMIT 1");
        $query->execute();
        return $query->fetch();
    }

    public static function getWaterWeeklyIntake($userid, $startDate, $endDate)
    {
        $waterCupsCount = 0;

        require("../configurations/credentials.php");
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("SELECT cups FROM water_intake WHERE date >= :startTime AND date <= :endTime AND user_id = :userID");
        $query->bindValue(":startTime", $startDate);
        $query->bindValue(":endTime", $endDate);
        $query->bindValue(":userID", $userid);
        $query->execute();
        $elements = $query->fetchAll();

        foreach ($elements as $element)
        {
            $waterCupsCount += $element['cups'];
        }
        $conn = null;
        return $waterCupsCount;
    }

    /**
     * @param int $userId
     * @param int $quantity
     */
    public static function addWaterIntake(int $userId, int $quantity = 0, $date): void
    {
        require("../configurations/credentials.php");
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("INSERT INTO water_intake(user_id, cups, date) VALUES (\"$userId\",\"$quantity\",\"$date\")");
        $query->execute();
    }
}
?>

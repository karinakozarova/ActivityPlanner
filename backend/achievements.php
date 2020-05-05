<?php

/**
 * Class Achievement
 */
class Achievement
{
    public $name;
    public $description;
    public $receivedOn;
    public $id;

    /**
     * @param $name
     * @param $userId
     * @param $description
     * @param $time
     */
    public static function addAchievement($name, $userId, $description, $time)
    {
        require_once("../configurations/credentials.php");
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("INSERT INTO achievements(name, user_id, description, received_on) VALUES (\"$name\",\"$userId\",\"$description\",\"$time\")");
        $query->execute();
        $conn = null;
        header('Location: ../html/profile-dashboard.php?addedAchievement');
    }

    /**
     * @param $conn
     * @param $userId
     * @return array $item
     */
    public static function getUserAchievements($conn, $userId)
    {
        $achievements = [];

        $query = $conn->prepare("SELECT name, user_id, description, received_on, id FROM achievements WHERE user_id=\"$userId\"");
        $query->execute();
        $elements = $query->fetchAll();

        foreach ($elements as $element) {
            $achievement = new Achievement();

            $achievement->description = $element["description"];
            $achievement->name = $element["name"];
            $achievement->receivedOn = $element["received_on"];
            $achievement->id = $element['id'];
            array_push($achievements, $achievement);
        }

        return $achievements;
    }

    /**
     * @param $conn
     * @param $userId
     * @return int
     */
    public static function getUserAchievementsCount($conn, $userId)
    {
        $query = $conn->prepare("SELECT count(*) as count FROM achievements WHERE user_id=\"$userId\"");
        $query->execute();
        $row = $query->fetch();
        return $row['count'];
    }
}


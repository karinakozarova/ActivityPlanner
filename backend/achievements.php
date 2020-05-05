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
     * @return PDO
     */
    public static function getConnection()
    {
        require("../configurations/credentials.php");
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    /**
     * @param $name
     * @param $userId
     * @param $description
     * @param $time
     */
    public static function addAchievement($name, $userId, $description, $time)
    {
        $conn = self::getConnection();
        $query = $conn->prepare("INSERT INTO achievements(name, user_id, description, received_on) VALUES (\"$name\",\"$userId\",\"$description\",\"$time\")");
        $query->execute();
        $conn = null;
        header('Location: ../html/profile-dashboard.php?addedAchievement');
    }

    /**
     * @param $userId
     * @return array $item
     */
    public static function getUserAchievements($userId)
    {
        $achievements = [];
        $conn = self::getConnection();
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
     * @param $userId
     * @return int
     */
    public static function getUserAchievementsCount($userId)
    {
        $conn = self::getConnection();
        $query = $conn->prepare("SELECT count(*) as count FROM achievements WHERE user_id=\"$userId\"");
        $query->execute();
        $row = $query->fetch();
        return $row['count'];
    }

    /**
     * @param $id
     */
    public static function deleteAchievement($id)
    {
        $conn = self::getConnection();
        $query = $conn->prepare("DELETE FROM achievements WHERE id=\"$id\"");
        $query->execute();
    }
}
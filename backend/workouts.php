<?php
/* Workout Class */
class Workout
{
    public $userId;
    public $name;
    public $startTime;
    public $endTime;

    public static function addWorkout($userId, $name, $startTime, $endTime)
    {
        require("../configurations/credentials.php");
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn-> prepare("INSERT INTO workouts(name, userID, startTime, endTime) VALUES (:name, :userid, :startTime, :endTime)");
        $query->bindValue(":name", $name);
        $query->bindValue(":userid", $userId);
        $query->bindValue(":startTime", $startTime);
        $query->bindValue(":endTime", $endTime);
        $query->execute();
        $conn = null;
        header('Location: ../html/profile-dashboard.php?addedWorkout');
    }

    public static function getWorkouts($userId)
    {
        $workouts = [];

        require("../configurations/credentials.php");
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("SELECT * FROM workouts WHERE userID=:userid");
        $query->bindValue(":userid", $userId);
        $query->execute();
        $elements = $query->fetchAll();

        foreach ($elements as $element)
        {
            $workout = new Workout();
            $workout->userId = $element['userID'];
            $workout->name = $element["name"];
            $workout->startTime = $element["startTime"];
            $workout->endTime = $element["endTime"];

            array_push($workouts, $workout);
        }
        $conn = null;
        return $workouts;
    }

    public static function getWorkoutsCount($startDate, $endDate)
    {
        $workoutsCount = 0;

        require("../configurations/credentials.php");
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("SELECT * FROM workouts WHERE startTime >= :startTime AND endTime <= :endTime");
        $query->bindValue(":startTime", $startDate);
        $query->bindValue(":endTime", $endDate);
        $query->execute();
        $workoutsCount = $query->rowCount();

        $conn = null;
        return $workoutsCount;
    }
}
?>

<?php
// TODO: not implemented correctly yet
//class Utils{
//    public static function connect() {
//        require_once("../configurations/credentials.php");
//        try {
//            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
//            // set the PDO error mode to exception
//            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        } catch (PDOException $e) {
//            echo "<br /> connect file " . $e->getMessage();
//            // TODO: return to page that shows the error
//        }
//    }
//
//    /**
//     * @return PDO
//     */
//    public static function connectToDb()
//    {
//        require_once("../configurations/credentials.php");
//        try {
//            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
//            // set the PDO error mode to exception
//            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            return $conn;
//        } catch (PDOException $e) {
//            echo "<br /> connect file " . $e->getMessage();
//            // TODO: return to page that shows the error
//        }
//    }
//
//    /**
//     * @return false|string
//     */
//    public function getDateTimeNow()
//    {
//        return date('YYYY-MM-DD HH:MI:SS');
//    }
//}
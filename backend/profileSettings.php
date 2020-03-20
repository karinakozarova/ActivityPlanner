<?php
session_start();
include '../configurations/db.php';
if (!isset($_SESSION['userid'])) header('Location: ../index.php');
else
{
    try
    {
        $_SESSION["firstname"] = $_POST["firstname"];
        $_SESSION["lastname"] = $_POST["lastname"];
        $_SESSION["email"] = $_POST["email"];

        $sql = "UPDATE accounts SET firstname=:firstname, lastname=:lastname, email=:email WHERE user_id=:userid";
        $statement = $conn->prepare($sql);
        $statement->bindValue(":firstname", $_SESSION["firstname"]);
        $statement->bindValue(":lastname", $_SESSION["lastname"]);
        $statement->bindValue(":email", $_SESSION["email"]);
        $statement->bindValue(":userid", $_SESSION["userid"]);
        $count = $statement->execute();

        if(isset($_FILES['profilepic']))
        {
            try
            {
                $file = $_FILES['profilepic'];
                $fileName = $file['name'];
                $fileTmpName = $file['tmp_name'];
                $fileError = $file['error'];
                $fileSize = $file['size'];

                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                if($fileError === 0 && $fileSize < 512000)
                {
                    $fileNewName = $_SESSION["userid"].".".$fileActualExt;

                    $fileDestination = "../uploads/".$fileNewName;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    try
                    {
                        $sql = "UPDATE accounts SET avatar_path=:filepath WHERE user_id=:userid";
                        $statement = $conn->prepare($sql);
                        $statement->bindValue(":filepath", $fileNewName);
                        $statement->bindValue(":userid", $_SESSION["userid"]);
                        $count = $statement->execute();
                    }
                    catch (PDOException $e) { var_dump("Error: " . $e); }
                }
            }
            catch (Exception $e)
            {
                var_dump("Error: " . $e);
                die;

                $conn = null;
                session_unset();    // remove all session variables
                session_destroy();    // destroy the session

                header('Location: ../index.php');
            }
        }

        $conn = null;
        header('Location: ../html/profile-dashboard.php');
    }
    catch (Exception $e)
    {
        var_dump("Error: " . $e);
        die;

        $conn = null;
        session_unset();    // remove all session variables
        session_destroy();    // destroy the session

        header('Location: ../index.php');
    }
}
?>

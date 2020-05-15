<?php
session_start();
include '../configurations/db.php';
if (!isset($_SESSION['userid'])) header('Location: ../index.php');
else {
    try {
        $_SESSION["firstname"] = $_POST["firstname"];
        $_SESSION["lastname"] = $_POST["lastname"];
        $_SESSION["email"] = $_POST["email"];

        $statement = $conn->prepare("UPDATE accounts SET firstname=:firstname, lastname=:lastname, email=:email WHERE user_id=:userid");
        $statement->bindValue(":firstname", $_SESSION["firstname"]);
        $statement->bindValue(":lastname", $_SESSION["lastname"]);
        $statement->bindValue(":email", $_SESSION["email"]);
        $statement->bindValue(":userid", $_SESSION["userid"]);
        $count = $statement->execute();

        // Updating profile picture if changed by user

        if (isset($_FILES['profilepic'])) {
            try {
                $file = $_FILES['profilepic'];
                $fileName = $file['name'];
                $fileTmpName = $file['tmp_name'];
                $fileError = $file['error'];
                $fileSize = $file['size'];

                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                // File size -> 512kb

                if ($fileError === 0 && $fileSize < 512000) {
                    $fileNewName = $_SESSION["userid"] . "." . $fileActualExt;

                    // Saving image to local storage

                    $fileDestination = "../uploads/" . $fileNewName;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    try {
                        // Creating image path reference and saving it to database
                        $statement = $conn->prepare("UPDATE accounts SET avatar_path=:filepath WHERE user_id=:userid");
                        $statement->bindValue(":filepath", $fileNewName);
                        $statement->bindValue(":userid", $_SESSION["userid"]);
                        $count = $statement->execute();
                    } catch (PDOException $e) {
                        var_dump("Error: " . $e);
                        die;
                    }
                }
            } catch (Exception $e) {
                $conn = null;
                session_unset();      // Removing all session variables
                session_destroy();    // Destroying session

                var_dump("Error: " . $e);
                die;
            }
        }

        $conn = null;
        header('Location: ../html/profile-dashboard.php');
    } catch (Exception $e) {
        $conn = null;
        session_unset();      // Removing all session variables
        session_destroy();    // Destroying the session

        var_dump("Error: " . $e);
        die;
    }
}

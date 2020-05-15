<?php
if (isset($_POST["reset-password-submit"])) {
    try {
        $selector = $_POST["selector"];
        $validator = $_POST["validator"];
        $password = $_POST["password"];
        $password_repeat = $_POST["password-repeat"];

        //An extra check whether the user has entered a valid password
        if (empty($password) || empty($password_repeat)) {
            header("Location: ../html/reset-password.php");
            exit();
        } else if ($password != $password_repeat) {
            header("Location: ../html/reset-password.php");
            exit();
        }

        $currentDate = date("U");

        require "../configurations/db.php";

        $statement = $conn->prepare("SELECT * FROM pwdtokens WHERE pwdResetSelector=:selector AND pwdExpiryDate >= :current");
        $statement->bindValue(":selector", $selector);
        $statement->bindValue(":current", $currentDate);
        $statement->execute();
        $row = $statement->fetch();

        if (count($row) <= 0) {
            header("Location: ../html/reset-password.php");
            $conn = null;
            exit();
        }

        $tokenBin = hex2bin($validator);
        $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

        // Validating authentication token

        if ($tokenCheck === false) {
            echo "Please resubmit your reset request.";
            $conn = null;
            exit();
        } elseif ($tokenCheck === true) {
            $tokenEmail = $row["pwdResetEmail"];
            $user_id_query = $conn->prepare("SELECT user_id FROM accounts WHERE email=:email");
            $user_id_query->bindValue(":email", $tokenEmail);
            $user_id_query->execute();
            $user_id = $user_id_query->fetchColumn();

            if ($user_id == false) {
                // the user was not found
                header('Location: ../index.php');
                $conn = null;
                exit();
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Updating the database with the newly-set hashed password

            $update_query = $conn->prepare("UPDATE users SET password=:newpass WHERE id=:userid");
            $update_query->bindValue(":newpass", $hashed_password);
            $update_query->bindValue(":userid", $user_id);
            $update_query->execute();

            // Deleting verification token from the database

            $delToken_query = $conn->prepare("DELETE FROM pwdtokens WHERE pwdResetEmail=:email");
            $delToken_query->bindValue(":email", $tokenEmail);
            $delToken_query->execute();

            header('Location: ../html/login.php?password=updated');
        }
        $conn = null;
    } catch (Exception $e) {
        $conn = null;
        session_unset();        // Removing all session variables
        session_destroy();      // Destroying session

        var_dump("Error: " . $e);
        die;
    }
} else {
    header("Location: ../index.php");
}

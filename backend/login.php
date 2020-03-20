<?php
if (isset($_POST["is_register"])) {
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $email = $_POST["email"];
    $user = $_POST["username"];
    $psswd = $_POST["password"];
    $role_id = $_POST["coach"] == 1 ? '1' : '2';

    try {
        // insert login info into db
        $sql = "INSERT INTO users (username, password)
            VALUES (\"$user\", \"$psswd\")";
        $conn->exec($sql);

        // get new user id
        $user_id_query = $conn->prepare("SELECT id FROM users WHERE username=\"$user\"");
        $user_id_query->execute();
        $user_id = $user_id_query->fetchColumn();

        // insert account info into the db
        $sql = "INSERT INTO accounts (user_id, role_id, firstname, lastname, email)
            VALUES (\"$user_id\", \"$role_id\",\"$fname\", \"$lname\", \"$email\")";
        $conn->exec($sql);

        $_SESSION["username"] = $user;
        $_SESSION["userid"] = $user_id;
        $_SESSION["firstname"] = $fname;
        $_SESSION["lastname"] = $lname;
        $_SESSION["role"] = strtoupper($role_id == '1' ? "Coach" : "Athlete");
    } catch (PDOException $e) {
        if ($e->getCode() == "23000") {
            $_SESSION['usernameIsNotUnique'] = true;
            header('Location: register.php');
            exit;
        }
        session_unset();    // remove all session variables
        session_destroy();    // destroy the session
        var_dump("Error: " . $e);
        die;
    }
} else {
    try {
        if (!isset($_SESSION['username'])) header('Location: ../index.php');
        $user = $_SESSION['username'];
        $user_id_query = $conn->prepare("SELECT id FROM users WHERE username=\"$user\"");
        $user_id_query->execute();
        $user_id = $user_id_query->fetchColumn();

        if ($user_id == false) {
            // the user was not found
            header('Location: ../index.php');
        }
        $info_query = $conn->prepare("SELECT firstname, lastname, email, role_id, avatar_path FROM accounts WHERE user_id=\"$user_id\"");
        $info_query->execute();
        $row = $info_query->fetch();

        $_SESSION["username"] = $user;
        $_SESSION["firstname"] = $row["firstname"];
        $_SESSION["lastname"] = $row["lastname"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["userid"] = $user_id;
        $avatar_path = $row["avatar_path"];

        $role_id = $row["role_id"];
        $info_query = $conn->prepare("SELECT role FROM roles WHERE id=\"$role_id\"");
        $info_query->execute();
        $row = $info_query->fetch();
        $_SESSION["role"] = strtoupper($row["role"]);

        $file_path = '../uploads/'.$avatar_path;
        $profilepic = '';
        if(isset($avatar_path)) $profilepic = $file_path;
        else $profilepic = '../uploads/default-avatar.jpg';

    } catch (PDOException $e) {
        var_dump("Error: " . $e);
        die;

        session_unset();    // remove all session variables
        session_destroy();    // destroy the session

        header('Location: ../index.php');
    }
}

$fname = $_SESSION["firstname"];
$lname = $_SESSION["lastname"];
$role = $_SESSION["role"];

//$conn = null; // close the PDO

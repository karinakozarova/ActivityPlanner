<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST["reset-password-submit"]))
{
    try
    {
        $selector = bin2hex(random_bytes(8));
        $auth_token = random_bytes(32);

        $url = "https://i426060.hera.fhict.nl/html/change-new-password.php?selector=".$selector."&validator=".bin2hex($auth_token);

        $expiry_date = date("U") + 1800;

        require "../configurations/db.php";

        $userEmail = $_POST["email"];

        $statement = $conn->prepare("DELETE FROM pwdtokens WHERE pwdResetEmail=:email");
        $statement->bindValue(":email", $userEmail);
        $statement->execute();

        $hashedToken = password_hash($auth_token, PASSWORD_DEFAULT);
        $statement = $conn->prepare("INSERT INTO pwdtokens (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdExpiryDate) VALUES (:email, :selector, :token, :expiry)");
        $statement->bindValue(":email", $userEmail);
        $statement->bindValue(":selector", $selector);
        $statement->bindValue(":token", $hashedToken);
        $statement->bindValue(":expiry", $expiry_date);
        $statement->execute();

        $conn = null;

        //Sending the e-mail to the user
        ini_set('SMTP', 'mailrelay.fhict.local');

        $emailSubject = "Reset your MK3Planner password";
        $emailMsg = '<p>A password reset request has been sent to us. If you were the person who made this request, click on the link below. Otherwise, please ignore this e-mail.</p>';
        $emailMsg .= '<p>Here is your password reset link: </br>';
        $emailMsg .= '<a href="'.$url.'">'.$url.'</a></p>';

        $headers = "From: MK3Planner <i426060@hera.fhict.nl>"."\r\n";
        $headers .= "Reply-To: i426060@hera.fhict.nl"."\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";

        mail($userEmail, $emailSubject, $emailMsg, $headers);

        require "../configurations/mail_credentials.php";

        /* Exception class. */
        //require './PHPMailer/src/Exception.php';

        /* The main PHPMailer class. */
        //require './PHPMailer/src/PHPMailer.php';

        /* SMTP class, needed if you want to use SMTP. */
        //require './PHPMailer/src/SMTP.php';

        /*$mail = new PHPMailer(TRUE);
        try
        {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->isHTML(TRUE);
            $mail->Username = $mailUsername;
            $mail->Password = $mailPassword;
            $mail->setFrom($mailUsername, "MK3Planner");
            $mail->addAddress($userEmail);
            $mail->Subject = 'Reset your MK3Planner password';
            $mail->Body = $emailMsg;
            $mail->send();
        }
        catch (Exception $e) { echo $e->errorMessage(); }
        catch (\Exception $e) { echo $e->getMessage(); }*/

        header("Location: ../html/reset-password.php?reset=success");
    }
    catch (Exception $e)
    {
        echo $e;
        var_dump("Error: " . $e);
        die;

        $conn = null;
        session_unset();    // remove all session variables
        session_destroy();    // destroy the session

        header('Location: ../index.php');
    }
}
else
{
    header("Location: ../index.php");
}
?>

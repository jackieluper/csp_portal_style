<?php

require_once "vendor/autoload.php";

$mail = new PHPMailer;

function email($email, $name, $subject, $message) {
    
    $mail->From = "billing@managedsolution.com";
    $mail->FromName = "Managed Solution";

    $mail->addAddress("$email", "$name");

//Provide file path and name of the attachments

    $mail->isHTML(true);

    $mail->Subject = "$subject";
    $mail->Body = "<i>$message</i>";
    $mail->AltBody = "$message";

    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message has been sent successfully";
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 6/7/2016
 * Time: 7:40 PM
 */
error_reporting(E_ALL);
require_once '../../public/vendor/autoload.php';

class Email{

    function sendMail($email, $subject, $body){ //function parameters, 4 variables.
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;

        $mail->Host = "smtp.gmail.com";
        $mail->Username = "lionsclubdiyawannawa@gmail.com";
        $mail->Password = "lionsclub1234";
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        $mail->From = "lionsclubdiyawannawa@gmail.com";
        $mail->FromName = "Lions Club - Diyawannawa";
        $mail->AddReplyTo("lionsclubdiyawannawa@gmail.com","Lions Club - Diyawannawa");
        $mail->addBCC("$email");
        $mail->WordWrap = 50;
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->send();

        //header("location: ../view/".$pageName);

        /*if($mail->send())
        {
            echo "sent mail";

        }else{
            echo "send mail failed" . $mail->ErrorInfo;

        }*/
    }

}

?>